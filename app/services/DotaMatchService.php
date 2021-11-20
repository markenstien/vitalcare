<?php

	/**
	 * how to automatically fetch dota games
	 * 1.select pro-players
	 * 2.select player games
	 * 3.match details of the game
	 * */

	load(['TraitAPIService'], APPROOT.DS.'trait');

	class DotaMatchService
	{
		use TraitAPIService;

		public function populateMatches()
		{
			$dota = model('DotaModel');

			$pro_players = $this->fetchProPlayers();

			if(!$pro_players) return false;

			$pro_player = $pro_players[0];

			$matches = $this->fetchMatchesByPlayer($pro_player->account_id);

			$match_details = [];

			$counter = 0;
			foreach($matches as $key => $match) 
			{
				/**
				 * collect matches from all pick and captains mode
				 * source:https://github.com/odota/dotaconstants/blob/master/build/game_mode.json
				 * */
				if( !isEqual($match->game_mode , ['1' , '2' , '4', '16']) )
					continue;

				if( $counter >= 2)
					break;

				$match_detail = $this->fetchMatchDetails($match->match_id);

				$saveMatch = $dota->saveMatches([$match_detail]);

				if($saveMatch)
					$counter++;
			}
		}

		public function fetchProPlayers()
		{
			$endpoint = dotaApiWrapper("https://api.opendota.com/api/proPlayers");
			$pro_players = $this->apiGet($endpoint);

			if(!$pro_players)
				return false;

			return $pro_players;
		}

		/**
		 * returns match_id->use to collect match details*/
		public function fetchMatchesByPlayer($player_id)
		{
			$endpoint = dotaApiWrapper("https://api.opendota.com/api/players/{$player_id}/matches");
			$matches = $this->apiGet($endpoint);

			if(!$matches)
				return false;

			return $matches;
		}

		public function fetchMatchDetails($match_id)
		{
			$endpoint = dotaApiWrapper("https://api.opendota.com/api/matches/{$match_id}");
			$match = $this->apiGet($endpoint);

			if(!$match)
				return false;

			return $match;
		}
	}