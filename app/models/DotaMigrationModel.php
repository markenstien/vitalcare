<?php
	
	load(['TraitAPIService'],APPROOT.DS.'trait');

	class DotaMigrationModel extends Model
	{
		use TraitAPIService;

		public function __construct()
		{
			parent::__construct();

			$this->db = Database::getInstance();
		}

		public function migrateHeroAbilities()
		{
			$endpoint = 'https://api.opendota.com/api/constants/hero_abilities';

			$results = $this->apiGet($endpoint);

			foreach($results as $key => $res) 
			{
				$ability = json_encode($res->abilities);
				$talent = json_encode($res->talents);

				$this->db->query(
					"INSERT INTO dota_hero_abilities(name , abilities , talents)
						VALUES('{$key}' , '{$ability}' , '{$talent}')"
				);

				$this->db->execute();
			}
		}

		public function migrateAbilities()
		{
			$endpoint = 'https://api.opendota.com/api/constants/abilities';

			$results = $this->apiGet($endpoint);

			foreach($results as $key => $res) 
			{
				if( isEqual( $key , ['dota_base_ability' , 'special_bonus_attributes' , 'ability_capture']))
					continue;

				$name = $key;
				$dname = str_escape($res->dname ?? '');
				$behavior = $res->behavior;
				$dmg_type = $res->dmg_type ?? 0;
				$bkbpierce = $res->bkbpierce ?? 0;
				$description = str_escape($res->desc);
				$attrib = json_encode($res->attrib);

				$mc = $res->mc ?? 0;

				$cd = $res->cd ?? [];
				$cd = json_encode($cd);
				
				$img = $res->img ?? '';

				$this->db->query(
					"INSERT INTO dota_abilities(name , dname , behavior , dmg_type ,bkbpierce,
						description, attrib ,mc , cd , img )
						VALUES('{$name}' , '{$dname}' , '{$behavior}' , 
							'{$dmg_type}' , '{$bkbpierce}',
							'{$description}' , '{$attrib}',
							'{$mc}' , '{$cd}' , '{$img}')"
				);

				$this->db->execute();
			}
		}
	}