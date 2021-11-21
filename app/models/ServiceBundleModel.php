<?php 

	class ServiceBundleModel extends Model
	{
		public $table = 'service_bundles';

		protected $_fillables = [
			'id',
			'name',
			'code',
			'description',
			'price',
			'price_custom',
			'discount',
			'created_by',
			'status',
			'is_visible'
		];


		public function get($id)
		{
			$res = $this->getAll([
				'where' => ['id' => $id]
			]);

			if($res)
				return $res[0];

			return $res;
		}

		public function getAll($params = [] )
		{
			$where = null;
			$order = null;

			if( isset($params['where']) )
				$where = " WHERE  ". $this->conditionEqual($params['where']);
			if( isset($params['order']) )
				$order = " ORDER BY  {$params['order']}";

			$this->db->query(
				"SELECT * , 
					CASE
						WHEN price_custom = 0.0 THEN ifnull(price , 0) 
						WHEN price_custom != 0.0 THEN price_custom 
						end as public_price
						
						FROM {$this->table}
					{$where} {$order}"
			);

			return $this->db->resultSet();
		}

		public function save( $service_bundle_data , $id = null)
		{
			$fillable_datas = $this->getFillablesOnly($service_bundle_data);

			if( !$this->validate($service_bundle_data) ) return false;

			if( ! is_null($id) )
			{
				return parent::update($fillable_datas , $id);
			}else
			{
				$fillable_datas['code'] = $this->generateCode( $service_bundle_data['name'] );
				return parent::store($fillable_datas);
			}

		}

		public function validate($service_bundle_data , $id = null)
		{
			/*
			*save name
			*/
			$name = parent::single(['name' => $service_bundle_data['name'] ]);

			if(  $name && $name->id != $service_bundle_data['id'] )
			{
				$this->addError("Bundle {$service_bundle_data['name']} already exists");
				return false;
			}

			return true;
			/*
			*same items
			*/
		}

		public function generateCode($name)
		{
			return strtoupper(substr($name , 0 ,5).get_token_random_char(2).$this->last()->id ?? 0);
		}
	}