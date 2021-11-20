<?php
	
	/**
	*steps to collect games is 
	* 1.Select League
	* 2.Get Random User
	* 3.Get User Matches
	* 4.Get Match Details
	*/
	load(['TraitAPIService'], APPROOT.DS.'trait');

	class LeagueMatchService
	{
		use TraitAPIService;

		private $_key = null;

		public function __construct()
		{
			$this->_key = getMLAPI();
		}

		public function populateMatches()
		{
			$league = $this->fetchLeague();
			if( !$league )
				return false;
			$summoner = $this->fetchSummoner( $league->summonerId );

			$matches = $this->fetchSummonerMatchIds($summoner->puuid);

			$match_details = [];

			foreach($matches as $key => $match) 
			{
				$match_detail = $this->fetchMatchDetails($match);

				if( $key >= 2)
					break;

				array_push($match_details , $match_detail);
			}

			if( $match_details )
			{
				$league_model = model('LeagueModel');
				$league_model->saveMatches($match_details);
			}

		}

		public function fetchLeague()
		{
			$pages = [1 ,2 ,3 ,4];
			$rank_sets = [
				'I',
				'II',
				'III',
				'IV'
			];

			$random = mt_rand(0, 3);

			$rank = $rank_sets[$random];
			$page = $pages[$random];
			/**
			 * Korean games
			 * */
			$endpoint = "https://kr.api.riotgames.com/lol/league/v4/entries/RANKED_SOLO_5x5/DIAMOND/{$rank}?page={$page}&api_key={$this->_key}";
			
			try{
				$league = $this->apiGet($endpoint);

				if( isset($league->status) && isEqual($league->status->message , "Forbidden"))
					return false;

				if(!$league && !isset($league[0]))
					return false;

				return $league[0];//first instance
			}catch(Exception $e)
			{
				
			}
			
		}

		public function fetchSummoner($summonerEncrptedId)
		{
			$endpoint = "https://kr.api.riotgames.com/lol/summoner/v4/summoners/{$summonerEncrptedId}?api_key={$this->_key}";
			$summoner  = $this->apiGet($endpoint);

			return $summoner;
		}

		public function fetchSummonerMatchIds($puuid)
		{
			$endpoint = "https://asia.api.riotgames.com/lol/match/v5/matches/by-puuid/{$puuid}/ids?start=0&count=20&api_key={$this->_key}";
			$matches = $this->apiGet($endpoint);

			return $matches;
		}

		public function fetchMatchDetails($matchId , $region = 'asia')
		{
			$endpoint = "https://{$region}.api.riotgames.com/lol/match/v5/matches/{$matchId}?api_key={$this->_key}";
			$match = $this->apiGet($endpoint);

			return $match;
		}
	}