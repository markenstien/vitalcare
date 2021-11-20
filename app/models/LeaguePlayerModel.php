<?php
    load(['TraitAPIService'] , APPROOT.DS.'trait');

    class LeaguePlayerModel extends Model
    {
        use TraitAPIService;

        private $_api_key = null;
        private $_regions = null;

        public function __construct()
        {
            $this->_api_key = getMLAPI();
            $this->_regions = $this->getRegions();
        }

        public function getRegions()
        {
            return [
                'BR1',
                'EUN1',
                'EUW1',
                'JP1',
                'KR',
                'LA1',
                'LA2',
                'NA1',
                'OC1',
                'RU',
                'TR1'
            ];
        }

        public function searchPlayerByNameAndRegion($name , $region)
        {
            $endpoint = "https://{$region}.api.riotgames.com/lol/summoner/v4/summoners/by-name/{$name}?api_key={$this->_api_key}";
            $player = $this->apiGet($endpoint);


            if( is_null($player) )
            {
                $this->addError("User not found in any servers");
                return false;
            }
            
            if( isset($player->status) )
            {
                $status_code = $player->status->status_code;

                switch($status_code)
                {
                    case 404:
                        $this->addError("Player {$name} not found in Region {$region}");
                    break;

                    default:
                        $this->addError("No user found or api key is expired");
                    break;
                }

                return false;
            }

            return $player;
        }

        public function getMatches($puuid)
        {
            $continents = [
                'ASIA',
                'AMERICAS',
                'EUROPE'
            ];

            $continent = 0;

            //find correct continent
            foreach($continents as $index => $row) 
            {
                $row = strtolower($row);
                
                $endpoint = "https://{$row}.api.riotgames.com/lol/match/v5/matches/by-puuid/{$puuid}/ids?start=0&count=20&api_key={$this->_api_key}";
                $matches = $this->apiGet($endpoint);

                if( !empty($matches) )
                {
                    $continent = $row;
                    break;
                }
            }
            
            if( empty($matches) ){
                $this->addError("No Match found");
                return false;
            }

            $retVal = [];
            
            foreach($matches as $index => $match)
            {
                $match_detail = $this->getMatchDetail($match , $continent);

                if( $index >= 20)
                    break;
                $retVal [] = $match_detail;
            }
            
            return $retVal;
        }


        public function sortMostUsed($matches)
		{
			$pickRate = array_column((array) $matches, 'total_matches');

			array_multisort($pickRate, SORT_DESC , $matches);

			return $matches;
		}


        public function getMatchDetail($match_id , $region)
        {
            $endpoint = "https://{$region}.api.riotgames.com/lol/match/v5/matches/{$match_id}?api_key={$this->_api_key}";
            $match = $this->apiGet($endpoint);

            if(!$match)
                return false;
            
            return $match;
        }

        public function matchesRemarks($param_matches , $puuid)
        {   
            if(!$param_matches)
                return false;
            /**
             * TEMPLATE
             * heroes = [
             *  'hero_name' => [
             *      ['match_a' , 'match_b']
             *  ]
             * ]
             */
            $heroes = [];

            $matches_with_kdaw = [];

            foreach($param_matches as $match_index => $match)
            {
                $participants = $match->info->participants;

                foreach($participants as $participant_index => $participant)
                {
                    if( !isEqual($participant->puuid , $puuid) )
                        continue;
                    $hero_name = $participant->championName;

                    if(!isset($heroes[$hero_name]))
                        $heroes[$hero_name] = (object)[
                            'matches' => [],
                            'remarks' => null
                        ];

                    $pass_data = (object) [
                        'name'   => $hero_name,
                        'deaths' => $participant->deaths,
                        'kills'  => $participant->kills,
                        'assists' => $participant->assists,
                        'win'    => boolval($participant->win)
                    ];

                    array_push($heroes[$hero_name]->matches , $pass_data);   
                    array_push($matches_with_kdaw , $pass_data);
                }
            }

            foreach($heroes as $index => $hero_index)
            {
                $matches = $hero_index->matches;
                $total_hero_matches = count($matches);
                $wins = 0;
                $win_rate = 0;
                $kda = 0;

                foreach($matches as $hero_match)
                {
                    if( $hero_match->win )
                        $wins++;
                    $kda += intval($hero_match->kills);
                }

                if( $wins )
                    $win_rate = ($wins / $total_hero_matches) * 100;

                if( $kda )
                    $kda = $kda / $total_hero_matches;
                

                $heroes[$index]->remarks = (object) [
                    'total_matches' => $total_hero_matches,
                    'wins'    => $wins,
                    'win_rate' => $win_rate,
                    'kda'      => $kda
                ];

                $heroes[$index]->total_matches = $total_hero_matches;
            }

            $matches_with_remarks = $this->sortMostUsed($heroes);

            return [
                'matches_with_remarks' => $matches_with_remarks,
                'matches' => $matches_with_kdaw
            ];
            return $matches;
        }
    }