<?php

	trait TraitMobileLegendBalancer
	{
		public function applyBalance($hero)
		{
			$heroTag = $hero->tags;

			if( isEqual('tank' , $heroTag) )
				return $this->tankHero($hero);

			if( isEqual('assassin' , $heroTag) || isEqual('fighter' , $heroTag) || isEqual('marksman' , $heroTag))
				return $this->damageHero($hero);

			if( isEqual('support' , $heroTag) || isEqual('mage' , $heroTag))
				return $this->magicHero($hero);
		}

		public function damageHero($hero)
		{
			$stats = $hero->stats;

			$durability = $stats->durability * .10;
			$offense = $stats->offense * .15;

			$row = (object)[
				'durability' => round($durability , 2),
				'offense' => round($offense , 2)
			];

			$hero->changes = $row;

			return $hero;
		}


		public function magicHero($hero)
		{
			$stats = $hero->stats;

			$durability = round($stats->durability * .14 , 2);
			$skillEffects = round($stats->skillEffects * .23 , 2);

			$row = (object)[
				'durability' => $durability,
				'skillEffects' => $skillEffects
			];
			
			$hero->changes = $row;

			return $hero;
		}

		public function tankHero($hero)
		{
			$stats = $hero->stats;

			$durability = $stats->durability * .21;
			$skillEffects = $stats->skillEffects * .13;

			$row = (object)[
				'durability' => round($durability , 2),
				'skillEffects' => round($skillEffects , 2)
			];
			
			$hero->changes = $row;

			return $hero;
		}

		public function revamp($heroes)
		{
			foreach($heroes as $key => $hero) 
			{
				if( is_null($hero) )
					continue;

				$winRate = $hero->winRatePercentage;
				$pickRate = $hero->winRatePercentage;

				//nerf
				$winRateFiftyPercent = $winRate >= floatval(50);
				//buff
				$winRateLessFiftyPercent = $winRate < floatval(50);

				if($winRateFiftyPercent)
				{
					$revampParam = (object) [
						'stats' => $this->nerf($hero->stats , $hero->changes),
						'type'  => 'nerf'
					];
				}

				if( $winRateLessFiftyPercent )
				{
					$revampParam = (object) [
						'stats' => $this->buff($hero->stats , $hero->changes),
						'type'  => 'buff'
					];
				}

				$hero->revamp = $revampParam;
			}

			return $heroes;
		}


		public function buff($stats , $changes)
		{
			foreach($changes as $key => $value) 
			{
				$currentStats  = floatval($stats->$key);
				$variableStats = floatval($value);

				//set stats to new!
				$changes->$key = $currentStats + $variableStats;
			}

			return $changes;
		}

		public function nerf($stats , $changes)
		{
			
			foreach($changes as $key => $value) 
			{
				$currentStats = floatval($stats->$key);
				$variableStats = floatval($value);
				//set stats to new!
				$changes->$key = $currentStats - $variableStats;
			}

			return $changes;
		}

	}