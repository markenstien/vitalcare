<?php

	class ServiceModel extends Model
	{
		public $table = 'services';


		protected $_fillables = [
			'service',
			'price',
			'status',
			'description',
			'category_id',
			'is_visible',
			'created_by'
		];


		public function getAll()
		{
			return parent::getAssoc('service');
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
			//check if service already exists
			if( parent::single( ['service' => $service_data['service'] ]) )
			{
				$this->addError("Service Already exists");
				return false;
			}

			return true;
		}

		public function generateCode( $service )
		{
			return strtoupper(substr($service , 0 , 4).random_letter(3));
		}
	}