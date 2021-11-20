<?php
	
	load(['TraitDotaBalancer' , 'TraitRevamp'] , APPROOT.DS.'trait');
	class DotaBalancerModel extends Model
	{
		use TraitDotaBalancer;
		use TraitRevamp;

		public function balanceHeroes($heroes)
		{
			// dd($heroes);

			$retVal = [];

			/**
			 * RETURN ONLY
			 * STATS
			 * WINRATELOSERATE
			 * PICKRATE
			 * STATBALANCE
			 */
			foreach($heroes as $key => $hero)
			{
				$info = json_decode($hero->hero_detail->info);

				$heroMinimizeData = (object)[
					'pickRate' => $hero->pickRate,
					'winLoseRate' => $hero->winLoseRate,
					'stats'  => (object)[
						'base_health' => $info->base_health,
						'base_health_regen' => $info->base_health_regen,
						'base_mana' => $info->base_mana,
						'base_mana_regen' => $info->base_mana_regen,
						'base_armor' => $info->base_armor,
						'base_mr' => $info->base_mr,
						'base_attack_min' => $info->base_attack_min,
						'base_attack_max' => $info->base_attack_max,
						'base_str' => $info->base_str,
						'base_agi' => $info->base_agi,

						'base_int' => $info->base_int,
						'str_gain' => $info->str_gain,
						'agi_gain' => $info->agi_gain,
						'int_gain' => $info->int_gain
					],
					'championName' => $info->localized_name,
					'tags'         => $info	->roles,
					'other'        => $info 
				];
	
				array_push($retVal , $this->applyBalance($heroMinimizeData));
			}

			$avatars = $this->revamp($retVal);

			return $avatars;
		}
	}