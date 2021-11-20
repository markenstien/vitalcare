<?php

	trait TraitLeagueBalancer
	{

		public function applyBalance($hero)
		{
			$heroTag = $hero->tags;

			if( isEqual('mage' , $heroTag) || isEqual('support' , $heroTag))
				return $this->balancerMageSupport($hero);

			if( isEqual('marksman' , $heroTag) || isEqual('fighter' , $heroTag))
				return $this->balancerMarksmanFighter($hero);

			if( isEqual('assasin' , $heroTag))
				return $this->balancerAssasin($hero);
		}

		/*
		*tag mage support
		*/
		public function balancerMageSupport($hero)
		{
			$stats = $hero->stats;

			$hpPerLevel = round($stats->hpperlevel * .005 ,2);
			$magicPerLevel = round($stats->mpperlevel * .20 ,2);
			$manaPerLevel = round($stats->mpregenperlevel * .015,2);

			$row = (object)[
				'mpregenperlevel' => $manaPerLevel,
				'hpperlevel' => $hpPerLevel,
				'mpperlevel'    => $magicPerLevel
			];

			$hero->changes = $row;


			return $hero;
		}

		/*
		*prepare for lategame
		*tag balancer fighter
		*/
		public function balancerMarksmanFighter($hero)
		{
			$stats = $hero->stats;

			$attackDamagePerlevel = round($stats->attackdamageperlevel * 0.25 , 2);
			$armorPerLevel = round($stats->armorperlevel * .14 , 2);
			$spellBlock    = round($stats->spellblock * .05 , 2);
			$hpRegenPerLevel = round($stats->hpregenperlevel * .05 , 2);
			$attackSpeedPerLevel = round($stats->attackspeedperlevel * .16 , 2);

			$row = (object)[
				'attackdamageperlevel' => $attackDamagePerlevel,
				'armorperlevel' => $armorPerLevel,
				'spellblock'    => $spellBlock,
				'attackspeedperlevel' => $attackSpeedPerLevel,
				'hpregenperlevel' => $hpRegenPerLevel
			];

			$hero->changes = $row;

			return $hero;
		}

		/**
		 * Tagged as assasin
		 * */

		public function balancerAssasin($hero)
		{
			$stats = $hero->stats;
			
			$critperlevel = round($stats->critperlevel * .10);
			$mpperlevel = round($stats->mpperlevel * .12 , 2);
			$movespeed = round($stats->movespeed * .05, 2);

			$row = (object)[
				'mpregenperlevel' => $critperlevel,
				'movespeed' => $movespeed,
				'mpperlevel'    => $mpperlevel
			];

			$hero->changes = $row;

			return $hero;
		}
	}