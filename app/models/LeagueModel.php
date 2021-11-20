<?php
	
	load(['TraitAPIService'] , APPROOT.DS.'trait');

	class LeagueModel extends Model
	{
		use TraitAPIService;

		private $_apiKey = null;

		public $table = 'league_of_legends'; 

		private $_matches = null;

		private $_champions = null;

		public $image_link = 'http://ddragon.leagueoflegends.com/cdn/11.21.1/img/champion/';

		public function __construct()
		{
			parent::__construct();

			if( is_null($this->_apiKey) ){
				$this->_apiKey = Module::get('apis')['lol']['key'];
			}
		}

		public function getChampion($championId)
		{
			$avatar = $this->apiGet('https://ddragon.leagueoflegends.com/cdn/11.21.1/data/en_US/champion/'.$championId.'.json' );
            return $avatar->data ?? null;
		}

		public function getChampions($pickFields = [] , $isObject = false)
		{
			if( is_null($this->_champions) ){
				$champions = $this->apiGet('http://ddragon.leagueoflegends.com/cdn/11.21.1/data/en_US/champion.json');
				$this->_champions = $champions->data ?? [];
			}

			if( !empty($pickFields) )
			{
				$champions = $this->_champions;

				$retVal = []; //new values

				foreach($this->_champions as $champions) 
				{
					$row = [];

					foreach(array_values($pickFields) as $key) {
						$row[$key] = $champions->$key;
					}

					if( $isObject )
						$row = (object) $row;

					array_push($retVal , $row);
				}

				return $retVal;
			}

			return $this->_champions;
		}

		public function getMatches()
		{
			$retVal = [];

			$matches = parent::dbgetDesc('id');

			foreach($matches as $match) 
			{
				$metaData = json_decode($match->meta_data);
				$info = json_decode($match->info);

				array_push($retVal , (object) [
					'id' => $match->id,
					'meta_data' => $metaData,
					'info'     => $info
				]);
			}
			if( is_null($this->_matches))
				$this->_matches = $retVal;

			return $retVal;
		}

		/*
		*responsible for pulling matches
		*into the riot api and storing it to the database
		*/
		public function populateMatches( $matchIds = [])
		{
			$imported_games = 10;

			if(empty($matchIds)){
				$matchIds = Module::get('lol')['matchIds'];
			}

			$matches = [];

			$apiKey = $this->_apiKey;

			foreach($matchIds as $key => $id) 	
			{

				$url = "https://asia.api.riotgames.com/lol/match/v5/matches/{$id}?api_key={$apiKey}";

				$matchData = $this->apiGet($url);
				
				if( $matchData ){
					$matches[] = $matchData;
				}

				$imported_games++;

				if($imported_games >= 20)
					break;
			}

			$this->saveMatches($matches);
		}

		public function saveMatches($matches)
		{
			if( empty($matches) )
				return false;


			$localized_matches = parent::dbgetAssoc('id');
			//extrach matchids

			$match_ids = [];
			foreach($localized_matches as $match) {
				array_push($match_ids , $match->match_id);
			}

			foreach($matches as $match) 
			{
				//means already exists
				if( isEqual($match->metadata->matchId , $match_ids))
					continue;

				$metadata = $match->metadata;
				$match_id = $metadata->matchId;

				$metadata = json_encode($metadata);
				$info     = json_encode($match->info);

				$this->db->query(
					"INSERT INTO {$this->table}(match_id , meta_data , info )
						VALUES('{$match_id}' , '{$metadata}' , '$info')"
				);

				$this->db->execute();
			}
		}

		public function getMatchesSummary()
		{
			$matches = $this->getMatches();

			$matches = $this->formatDatasForMostUsed($matches);

			$matchesWinAndLosesPerMatch = $this->calcHeroesWinsAndLosesPerMatch($matches);

			$matchesWinAndLosesRate = $this->calcWinRateLoseRate($matchesWinAndLosesPerMatch);

			$matchesWinAndLosesRateWithPickRate = $this->appendPickRate($matchesWinAndLosesRate);

			return $matchesWinAndLosesRateWithPickRate;
		}

		public function formatDatasForMostUsed($games)
		{
			$retVal = [];

			foreach($games as $game) 
			{
				$participants = $game->info->participants;
				
				foreach($participants as $participant)
				{
					$row = [];

					$row['championName'] = $participant->championName;
					$row['championId'] = $participant->championId;
					$row['win'] = $participant->win;

					$retVal[] = (object) $row;
				}
			}
			
			return $retVal;
		}


		/**
		 * DEFAULTS TO TOP 5
		 */
		public function fetchTopChampions($champions , $limit = 5 , $completeDetails = false)
		{
			$champions = $this->sortPickRate($champions);

			$champions = array_slice($champions , 0 , $limit);

			foreach($champions as $championName => $champion)
			{
				if( $completeDetails ) {
					$heroDetail = $this->getChampion($championName);
					$champion->hero_detail = $heroDetail;
				}
			}

			return $champions;
		}

		public function appendChampionDetailComplete($championsWithGames)
		{
			$champions = $this->getChampions();
			$championNames = array_keys($championsWithGames);

			foreach($championNames as $name) 
			{
				$name = trim($name);

				$row = $championsWithGames[$name];

				$row->stats = $champions->$name->stats;
				$row->tags  = $champions->$name->tags;
				
				$championsWithGames[$name] = $row;
			}

			return $championsWithGames;
		}

		public function sortPickRate($matches)
		{
			$pickRate = array_column((array) $matches, 'pickRate');

			array_multisort($pickRate, SORT_DESC , $matches);

			return $matches;
		}

		public function appendPickRate($championsMatchesSummary)
		{

			$totalMatches = 0;

			foreach($championsMatchesSummary as $champion) 
			{
				$totalMatches += $champion->winLoseRate->total;
			}
			foreach($championsMatchesSummary as $championName => $champion)
			{
				$totalPicks = $champion->winLoseRate->total;
				$pickRate = ($totalPicks / $totalMatches) * 100;
				$champion->pickRate = $pickRate;
				
				$championsMatchesSummary[$championName] = $champion;
			}
			return $championsMatchesSummary;
		}

		public function calcHeroesWinsAndLosesPerMatch($matches)
		{
			$retVal = [];

			$championsMatchesWinsAndLoses = [];

			foreach($matches as $match)
			{
				if( !isset($championsMatchesWinsAndLoses[$match->championName]) )
					$championsMatchesWinsAndLoses[$match->championName] = [];

				$winLose = boolval($match->win);
				array_push($championsMatchesWinsAndLoses[$match->championName] , $winLose);
			}


			foreach($championsMatchesWinsAndLoses as $key => $games)
			{
				$retVal[$key] = (object)[
					'matches' => $games
				];
			}

			return $retVal;
		}

		/**
		 * returns minimal set of datas
		 * info only
		 */
		public function calcWinRateLoseRate($championsWithGames)
		{
			foreach($championsWithGames as $championName => $championProps)
			{
				if( is_null($championProps) ) continue;

				$loseRate = 0;
				$winRate = 0;
				$matches = $championProps->matches;

				foreach($matches as $win) {
					if( $win ){
						$winRate++;
					}else{
						$loseRate++;
					}
				}

				$totalMatches = count($matches);

				if( $winRate )
					$winRate = round(($winRate / $totalMatches) * 100 , 2);

				if($loseRate)
					$loseRate = round(($loseRate / $totalMatches) * 100 , 2);

				$championsWithGames[$championName]->winLoseRate = (object) [
					'win' => $winRate,
					'lose' => $loseRate,
					'total' => $totalMatches
				];
			}

			return $championsWithGames;
		}
	}