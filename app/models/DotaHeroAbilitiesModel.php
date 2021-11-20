<?php

	class DotaHeroAbilitiesModel extends Model
	{
		public $table = 'dota_abilities';

		public function getAbilitiesByHero($heroName = null)
		{
			$where = null;

			if( !is_null($heroName) )
				$where = " WHERE name = '{$heroName}'";

			$this->db->query(
				"SELECT * FROM dota_hero_abilities {$where}"
			);

			$dota_hero_abilities = $this->db->resultSet();

			foreach($dota_hero_abilities as $ability) 
			{
				$abilities = $ability->abilities = json_decode($ability->abilities);

				$this->db->query(
					"SELECT * FROM 
						dota_abilities 
						WHERE name in ('".implode("','" , $abilities)."')"
				);

				$dota_abilities = $this->db->resultSet();


				$ability->dota_abilities = $dota_abilities;
			}

			return $dota_hero_abilities;
		}
	}