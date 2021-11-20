<?php

	trait TraitDotaBalancer
	{
		/*
		*has tags and stats
		*/
		public function applyBalance($hero)
		{
			$heroTag = $hero->tags;

			if( isEqual('nuker' , $heroTag) || isEqual('escape' , $heroTag) || isEqual('support' , $heroTag))
				return $this->balanceNuker($hero);

			if( isEqual('carry' , $heroTag) || isEqual('pusher' , $heroTag))
				return $this->balanceCarry($hero);

			if( isEqual('durable' , $heroTag) || isEqual('initiator' , $heroTag))
				return $this->balanceDurable($hero);

			if( isEqual('jungler' , $heroTag) || isEqual('disabler' , $heroTag))
				return $this->balanceJungler($hero);
		}

		public function balanceCarry($hero)
		{
			$stats = $hero->stats;
			/*
			*alter the ff
			*/
			$agi_gain = $stats->agi_gain * .10;
			$base_agi = $stats->base_agi * .15;
			$str_gain = $stats->base_agi * 0.05;

			$row = (object)[
				'agi_gain' => round($agi_gain , 2),
				'base_agi' => round($base_agi , 2),
				'str_gain'    => $str_gain
			];

			$hero->changes = $row;

			return $hero;
		}

		public function balanceDurable($hero)
		{
			$stats = $hero->stats;
			/*
			*alter the ff
			*/
			$base_health_regen = $stats->base_health_regen * .12;
			$str_gain = $stats->str_gain * .05;
			$base_armor = $stats->base_armor * 0.10;

			$row = (object)[
				'base_health_regen' => round( $base_health_regen, 2),
				'str_gain' => round($str_gain , 2),
				'base_armor'    => round($base_armor , 2)	
			];
	
			$hero->changes = $row;

			return $hero;
		}

		public function balanceNuker($hero)
		{
			$stats = $hero->stats;
			/*
			*alter the ff
			*/
			$base_int = $stats->base_int * .30;
			$str_gain = $stats->str_gain * .05;
			$base_mana = $stats->base_mana * 0.10;

			$row = (object)[
				'base_int' => round($base_int , 2),
				'str_gain' => round($str_gain , 2),
				'base_mana'    => round($base_mana , 2)
			];

			$hero->changes = $row;

			return $hero;
		}

		public function balanceJungler()
		{
			$stats = $hero->stats;
			/*
			*alter the ff
			*/
			$base_health = $stats->base_health * .30;
			$base_attack_min = $stats->base_attack_min * .12;

			$row = (object)[
				'base_health' => round($base_health , 2),
				'base_attack_min' => round($base_attack_min , 2)
			];

			$hero->changes = $row;

			return $hero;
		}
	}