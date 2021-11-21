<?php 

	class SpecialtyModel extends Model
	{
		public $table = 'specialties';

		protected $_fillables = [
			'name',
			'description',
			'created_by',
			'category_id'
		];

		public function save($specialty_data , $id = null)
		{	
			$fillable_datas = $this->getFillablesOnly($specialty_data);

			if( !$this->validate($fillable_datas) ) return false;

			if( !is_null($id) )
			{
				return parent::update($fillable_datas , $id);

			}else
			{
				return parent::store($fillable_datas , $id);
			}
		}

		public function getAll($params = [] )
		{
			$where = null;
			$order = null;
			if( isset($params['where']) )
				$where = " WHERE " .$this->conditionEqual($params['where']);
			if( isset($params['order']) )
				$order = " ORDER BY {$params['order']} ";


			$this->db->query(
				"SELECT sp.* , cat.category as category 
					FROM {$this->table} as sp
					LEFT JOIN categories as cat 
					ON cat.id = sp.category_id
					{$where} {$order}"
			);

			return $this->db->resultSet();
		}

		public function validate($specialty_data)
		{
			if( parent::single(['name' => $specialty_data['name']]) )
			{
				$this->addError("Specialty {$specialty_data['name']} already exists");
				return false;
			}

			return true;
		}
	}