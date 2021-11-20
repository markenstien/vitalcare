<?php

	class ApiKeyModel extends Model
	{

		public $table = 'api_keys';

		public function updateByApi($data , $api)
		{
			$res = $this->dbHelper->update(...[
				$this->table,
				$data,
				"api = '{$api}'"
			]);

			return $res;
		}
	}