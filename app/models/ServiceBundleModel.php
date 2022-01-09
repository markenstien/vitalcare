<?php 

	class ServiceBundleModel extends Model
	{
		public $table = 'service_bundles';

		protected $_fillables = [
			'id',
			'category_id',
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
				'where' => ['bundle.id' => $id]
			]);

			if($res)
				return $res[0];

			return $res;
		}

		public function getWithItems( $id )
		{
			$bundle = $this->get($id);

			if(!$bundle){
				$this->addError("Bundle not found!");
				return false;
			}

			$this->bundle_item = model('ServiceBundleItemModel');

			$items = $this->bundle_item->getByBundle($id);
			$bundle->items = $items;

			return $bundle;
		}

		public function getByFilter( $filter = [] )
		{
			$key_word = null;

			/*
			*look on bundles
			*look on services
			*look on categories
			*/

			$b_where = NULL;


			if(isset($_GET['key_word']) && !empty($_GET['key_word']))
			{
				$key_word = trim($_GET['key_word']);

				$b_where = "name like '%{$key_word}%' OR 
						code = '{$key_word}' OR
						bundle.description like '%{$key_word}%'";
			}

			if( isset($_GET['categories']) )
			{
				if( !empty($b_where) ) 
				$b_where .= " AND ";
				$b_where .= " category_id in ('".implode("','" , $_GET['categories'])."') ";
			}
			
			return $this->getAll([
				'where' => $b_where,
				'order' => 'name asc'
			]);
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
				"SELECT bundle.* , category,
					CASE
						WHEN price_custom = 0.0 THEN ifnull(price , 0) 
						WHEN price_custom != 0.0 THEN price_custom 
						end as public_price
						FROM {$this->table} as bundle

						LEFT join categories as category 
						ON category.id = bundle.category_id
						{$where} {$order}"
			);

			$results = $this->db->resultSet();
			
			$this->bundle_item = model('ServiceBundleItemModel');

			foreach($results as $key => $row) {
				$row->items = $this->bundle_item->getByBundle($row->id);
			}

			return $results;
		}

		public function save( $service_bundle_data , $id = null)
		{
			$fillable_datas = $this->getFillablesOnly($service_bundle_data);

			if( !$this->validate($service_bundle_data) ) return false;

			if( ! is_null($id) )
			{
				$this->addMessage( parent::$MESSAGE_UPDATE_SUCCESS );
				return parent::update($fillable_datas , $id);
			}else
			{
				$fillable_datas['code'] = $this->generateCode( $service_bundle_data['name'] );
				$this->addMessage( parent::$MESSAGE_CREATE_SUCCESS );

				$user_model = model('UserModel');

				$user_name = $user_model->fetchSigleSingleColumn(['first_name'] , ['id' => whoIs('id')]);

				_notify_operations("{$user_name} Created a new bundle {$service_bundle_data['name']}#{$fillable_datas['code']}");

				return parent::store($fillable_datas);
			}

		}

		public function validate($service_bundle_data , $id = null)
		{
			/*
			*save name
			*/
			$name = parent::single(['name' => $service_bundle_data['name'] ]);

			if(  $name && ($name->id != $service_bundle_data['id']) )
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