<?php
	load(['TraitRevamp' , 'TraitLeagueBalancer'] , APPROOT.DS.'trait');

	class LeagueBalancerModel extends Model
	{
		use TraitRevamp;
		use TraitLeagueBalancer;

		private $_leagueModel = null;
		private $_matches = null;

		private $_leagueAvatarModel = null;


		public function __construct()
		{
			if( is_null($this->_leagueModel) )
				$this->_leagueModel = model('LeagueModel');
		}

		/*
		*get apis from database
		*/

		public function balanceChampions($champions)
		{
			$retVal = [];

			/**
			 * RETURN ONLY
			 * STATS
			 * WINRATELOSERATE
			 * PICKRATE
			 * STATBALANCE
			 */
			foreach($champions as $key => $champ)
			{
				$champMinimizeData = (object)[
					'pickRate' => $champ->pickRate,
					'winLoseRate' => $champ->winLoseRate,
					'stats'  => $champ->stats,
					'championName' => $key,
					'tags'         => $champ->tags
				];

				array_push($retVal , $this->applyBalance($champMinimizeData));
			}

			$avatars = $this->revamp($retVal);

			return $avatars;
		}
	}