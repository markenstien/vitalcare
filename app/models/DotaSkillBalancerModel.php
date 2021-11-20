<?php

	class DotaSkillBalancerModel extends Model
	{
		public function balanceSkills( $skills = [] , $nerf_or_buff = 'NERF')
		{
			foreach($skills as $skill_index => $skill)
			{
				$attributes = $skill->attrib;

				$mc = $skill->mc ?? null;
				$cd = $skill->cd ?? null;
				$dmg = $skill->dmg ?? null;

				foreach($attributes as $attrib_key => $attrib)
				{
					if( !isEqual($attrib->header , ['DAMAGE:' , 'DAMAGE PER KILL:' , 'SCEPTER DAMAGE:']) )
						continue;

					$skill_attribute_value = $attrib->value;

					if( is_array($skill_attribute_value) ) 
					{
						//increase every time
						$random_number = 0;
						$revamp = [];
						foreach($skill_attribute_value as $key => $attrib_value) 
						{	

							switch ($this->valueType($attrib_value)) 
							{
								case 'PERCENTAGE':
									//pag di na zero wag na mag reset ng percentage
									if( $random_number == 0)
										$random_number = $this->revampPercentage($attrib_value);
									/*
									*para semantic ang pag akyat
									*/
									if( $random_number != 0) 
										$random_number = (round($random_number * .36)) + $random_number;
									array_push( $revamp , $this->revamp( $random_number , $attrib_value , $nerf_or_buff));
									break;
								default:
									//pag di na zero wag na mag reset ng percentage
									if( $random_number == 0)
										$random_number = $this->revampDecimal($attrib_value);
									/*
									*para semantic ang pag akyat
									*/
									if( $random_number != 0) 
										$random_number = (round($random_number) * .46) + $random_number;
									array_push($revamp , $this->revamp( $random_number , $attrib_value , $nerf_or_buff));
									break;
							}
						}

					}else
					{
						switch ($this->valueType($skill_attribute_value)) {
							case 'PERCENTAGE':
								$revamp = $this->revamp( $this->revampPercentage($skill_attribute_value) , $skill_attribute_value , $nerf_or_buff);
								break;
							default:
								$revamp = $this->revamp( $this->revampDecimal($skill_attribute_value) , $skill_attribute_value , $nerf_or_buff);
								break;
						}
					}

					$attrib->revamp = $revamp;
				}

				if( !is_null($mc) )
				{
					if( is_array($mc) ) 
					{
						$mana_cost_set = [];

						foreach($mc as $index => $mana_cost) {
							array_push($mana_cost_set, $this->revamp( $this->revampDecimal($mana_cost) , $mana_cost , 
								$nerf_or_buff) );
						}
						$skill->mc_revamp = $mana_cost_set;
					}else
					{
						$skill->mc_revamp = $this->revamp( $this->revampDecimal($mc) , $mc , $nerf_or_buff);
					}
				}

				if( !is_null($cd) )
				{
					if( is_array($cd) ) 
					{
						$cd_set = [];

						foreach($cd as $index => $cd_cd) {
							array_push($cd_set, $this->revampSkill( $this->revampDecimal($cd_cd) , $cd_cd , 
								$nerf_or_buff) );
						}
						$skill->cd_revamp = $cd_set;
					}else
					{
						$skill->cd_revamp = $this->revampSkill( $this->revampDecimal($cd) , $cd , $nerf_or_buff);
					}
				}

				if( !is_null($dmg) )
				{
					if( is_array($dmg) ) 
					{
						$dmg_set = [];

						foreach($dmg as $index => $dmg_dmg) {
							array_push($dmg_set, $this->revampSkill( $this->revampDecimal($dmg_dmg) , $dmg_dmg , 
								$nerf_or_buff) );
						}
						$skill->dmg_revamp = $dmg_set;
					}else
					{
						$skill->dmg_revamp = $this->revampSkill( $this->revampDecimal($dmg) , $dmg , $nerf_or_buff);
					}
				}
			}
			return $skills;
		}


		public function revampSkill($revamp , $value , $revamp_type)
		{
			if (is_array($value))
			{
				$changes = [];

				foreach($value as $index => $val) 
				{
					if( isEqual($revamp_type , 'BUFF') ) {
						array_push($changes  , $this->nerf($val , $revamp[$index]));
					}else{
						array_push($changes  , $this->buff($val , $revamp[$index]));
					}
				}
			}else
			{
				if( isEqual($revamp_type , 'BUFF') )
				{
					$changes = $this->nerf($value , $revamp);
				}else{
					$changes = $this->buff($value , $revamp);
				}
			}

			return $changes;
		}
		public function revamp( $revamp , $value , $revamp_type )
		{
			if (is_array($value))
			{
				$changes = [];

				foreach($value as $index => $val) 
				{
					if( isEqual($revamp_type , 'NERF') ) {
						array_push($changes  , $this->nerf($val , $revamp[$index]));
					}else{
						array_push($changes  , $this->buff($val , $revamp[$index]));
					}
				}
			}else
			{
				if( isEqual($revamp_type , 'NERF') )
				{
					$changes = $this->nerf($value , $revamp);
				}else{
					$changes = $this->buff($value , $revamp);
				}
			}

			return $changes;
		}

		public function nerf($val , $revamp)
		{
			$type = $this->valueType($val);

			if( isEqual( $type , 'PERCENTAGE') ) {
				$val = preg_replace('/\D/', '', $val);
				$revamp = preg_replace('/\D/', '', $revamp);
			}

			return round($val - $revamp , 2);
		}

		public function buff($val , $revamp)
		{
			$type = $this->valueType($val);

			if( isEqual( $type , 'PERCENTAGE') ) {
				$val = preg_replace('/\D/', '', $val);
				$revamp = preg_replace('/\D/', '', $revamp);
			}

			return round( $val + $revamp , 2);
		}

		public function valueType($value)
		{
			if( strpos($value, '%') !== FALSE ){
				return 'PERCENTAGE';
			}else{
				return 'DECIMAL';
			}
		}

		public function revampPercentage($value)
		{
			$random_number = rand(2 , 12) + 1;
			return $random_number;
		}

		public function revampDecimal($value)
		{
			$multiplyer = 0;

			$random_number = abs(rand(1, 26) + 1);

			if( $random_number <= 9){
				$multiplyer = floatval(".0{$random_number}"); 
			}else{
				$multiplyer = floatval(".{$random_number}");
			}
			return $value * $multiplyer;
		}

	}