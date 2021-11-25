<?php

	class ServiceModel extends Model
	{
		public $table = 'services';


		protected $_fillables = [
			'id',
			'service',
			'price',
			'status',
			'description',
			'category_id',
			'is_visible',
			'created_by'
		];


		public function getAll( $params = [] )
		{

			$where = null;
			$order = null;

			if( isset($params['where']) )
			{
				$where = " WHERE " ;

				if( is_array($params['where']) ){
					$where .= $this->conditionEqual($params['where']);
				}else{
					$where .= " {$params['where']}";
				}
			}

			if( isset($params['order']) )
				$order = " ORDER BY {$params['order']} ";

			$this->db->query(
				"SELECT service.* , cat.category as category 
					FROM {$this->table} as service
					LEFT JOIN categories as cat 
					ON cat.id = service.category_id
					{$where} {$order}"
			);

			return $this->db->resultSet();
		}

		public function getByFilter($filter = [])
		{
			$key_word = null;

			$this->bundle = model('ServiceBundleModel');
			/*
			*look on bundles
			*look on services
			*look on categories
			*/

			$s_where = NULL;


			if(isset($filter['key_word']) && !empty($filter['key_word']))
			{
				$key_word = trim($filter['key_word']);

				$s_where = "service like '%{$key_word}%' OR 
						code = '{$key_word}' OR
						service.description like '%{$key_word}%'";
			}

			if( isset($filter['categories']) )
			{
				if( !empty($s_where) ) 
					$s_where .= " AND ";
				$s_where .= " category_id IN ('".implode("','" , $filter['categories'])."') ";
			}

			return $this->getAll([
				'where' => $s_where,
				'order' => 'service asc'
			]);
		}



		public function save($service_data , $id = null)
		{
			$fillable_datas = $this->getFillablesOnly($service_data);			

			if(!$this->validate( $fillable_datas )) return false;

			//update
			if( !is_null($id) )
			{
				$this->addMessage("Service {$fillable_datas['service']} has been updated!");
				return parent::update($fillable_datas , $id);
			}else
			{
				$fillable_datas['code'] = $this->generateCode( $fillable_datas['service'] );

				$this->addMessage("Service {$fillable_datas['service']} has been created");
				return parent::store($fillable_datas);
			}
		}

		public function validate($service_data)
		{
			$service_exist = parent::single( ['service' => $service_data['service'] ] );

			if($service_exist) 
			{
				//test service
				if( !isEqual($service_exist->id , $service_data['id'] ?? null) )
				{
					$this->addError("Service Already exists");
					return false;
				}
			}
			return true;
		}

		public function generateCode( $service )
		{
			return strtoupper(substr($service , 0 , 4).random_letter(3));
		}
	}