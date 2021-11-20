<?php
	
	load(['TraitAPIService'], APPROOT.DS.'trait');

	class AbilityService
	{
		use TraitAPIService;

		/*
		*hero ability name only
		*/
		public function getByHeroAbilities($heroAbilities = [])
		{
			$endpoint = dotaApiWrapper('https://api.opendota.com/api/constants/abilities');

			$abilities = $this->apiGet($endpoint);

			$retVal = [];

			foreach($heroAbilities as $ability) {
				array_push($retVal , $abilities->$ability);
			}

			return $retVal;
		}
	}