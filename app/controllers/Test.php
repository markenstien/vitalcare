<?php 

	
	class Test extends Controller
	{

		public function index()
		{
			$array = [
				'a' => 'Mark',
				'b' => 'Dona',
				'c' => 'Aye'
			];

			$this->array_move_aftter('c' , 'b' , $array);
		}

		public function array_move_aftter($after_key , $key_to_move , $array = [])
		{
			$array_keys = array_keys($array);

			$move_position = array_search($key_to_move , $array_keys);

			$new_array_keys_order = [];

			foreach($array_keys as $pos => $key) 
			{
				if($after_key == $key) 
				{
					unset($array_keys[$move_position]);
					$new_array_keys_order = array_splice($array_keys, ($pos+1), 0 , $key_to_move);
					break;
				}
			}

			//reorder

			$new_order = [];

			foreach($array_keys as $pos => $key)
			{
				$new_order[$key] = $array[$key];
			}

			return $new_order;
		}
	}