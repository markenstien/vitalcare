<?php

	load(['TraitMobileLegendBalancer'], APPROOT.DS.'trait');

	class MobileLegendModel extends Model
	{
		use TraitMobileLegendBalancer;

		public function getHeroStats($hero_name = null)
		{
			$ml_stats = file_get_contents(LIBS.DS.'ml_stats.txt');

			$ml_stats = json_decode($ml_stats);


			foreach($ml_stats as $ml_stat) 
			{
				$ml_stat->winRatePercentage = round(floatval($ml_stat->winRate) * 100 , 2);
				$ml_stat->banRatePercentage = round(floatval($ml_stat->banRate) * 100 , 2);

				if( isEqual($ml_stat->HeroName , $hero_name) )
					return $ml_stat;
			}

			if( isset($hero_name) )
			{
				foreach($ml_stats as $ml_stat) {
					if( isEqual($ml_stat->HeroName , $hero_name) )
						return $ml_stat;
				}
			}

			return $ml_stats;
		}

		public function balanceHeroes($heroes_with_stats = [])
		{
			$retVal = [];

			$heroes = $this->getHeroes();

			foreach($heroes_with_stats as $hero) 
			{
				$cleaned_hero_name = ucwords(preg_replace("/[^A-Za-z0-9 ]/", ' ', $hero->HeroName));

				if( $cleaned_hero_name == 'X Borg') {
					$cleaned_hero_name = 'X';
				}

				$hero_info = $heroes[$cleaned_hero_name];

				$heroMinimizeData = (object)[
					'winRatePercentage'    => $hero->winRatePercentage,
					'stats'  => (object)[
						'durability' => $hero->durability * 100,
						'offense'    => $hero->offense * 100,
						'skillEffects' => $hero->skillEffects * 100
					],
					'heroName' => $hero->HeroName,
					'heroImage' => $hero_info['image_src'],
					'tags'     => $hero_info['type'],
				];

				array_push($retVal , $this->applyBalance($heroMinimizeData));
			}

			return $this->revamp($retVal);
		}

		public function getPopularHeroes( $limit = null)
		{
			$heroes = $this->getHeroStats();

			foreach($heroes as $hero) {
				$hero->winRatePercentage = round(floatval($hero->winRate) * 100 , 2);
				$hero->banRatePercentage = round(floatval($hero->banRate) * 100 , 2);
			}

			$heroes = $this->sortByWinRate($heroes);

			if( !is_null($limit) )
				return array_slice($heroes, 0 , $limit);

			return $heroes;
		}

		public function sortByWinRate($heroes)
		{
			if (!$length = count($heroes)) {
			  return $heroes;
			 }

			 for ($outer = 0; $outer < $length; $outer++) {
			  for ($inner = 0; $inner < $length; $inner++) {
			   if ($heroes[$outer]->winRatePercentage > $heroes[$inner]->winRatePercentage) {
			    $tmp = $heroes[$outer];
			    $heroes[$outer] = $heroes[$inner];
			    $heroes[$inner] = $tmp;
			   }
			  }
			 }

			 return $heroes;
		}

		public function getHeroes($hero_name = null)
		{
			$scan_base_path = BASE_DIR.DS.'public/assets/ml_heroes';

			$heroes_dir_folder = scandir($scan_base_path);

			$retVal =  [];

			foreach($heroes_dir_folder as $hero_type => $hero_list_dir)
			{
				if( isEqual($hero_list_dir, ['.','..']))
					continue;

				$hero_list_dir = trim($hero_list_dir);


				if( is_dir($scan_base_path.DS.$hero_list_dir) ) 
				{
					$hero_lists = scandir($scan_base_path.DS.$hero_list_dir);

					foreach($hero_lists as $hero) 
					{
						if( isEqual($hero,['.' , '..']))
							continue;

						$name = explode('.' , $hero);
						$name = current($name);
						$cleaned_hero_name = ucwords(preg_replace("/[^A-Za-z0-9 ]/", ' ', $name));

						if( isset( $retVal[$name]) )
						{
							$heroType = array_merge([$hero_list_dir] , $retVal[$name]['type']);
							$retVal[$name]['type'] = $heroType;
						}else{
							$retVal[$cleaned_hero_name] = [
								'name' => $name,
								'type' => [$hero_list_dir],
								'image_src' => URL.DS.'public/assets/ml_heroes/'.$hero_list_dir.'/'.$hero
							];
						}
					}
				}
			}

			$retVal = $this->sort($retVal);
			
			if( isset($hero_name) )
				return $retVal[$hero_name];

			return $retVal;
		}

		public function sort($heroes , $sort_on = 'name')
		{
			$sorted_on_column = array_column($heroes, $sort_on);
			array_multisort($sorted_on_column, SORT_ASC, $heroes);

			return $heroes;
		}
	}