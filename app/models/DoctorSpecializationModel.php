<?php 

	class DoctorSpecializationModel extends Model
	{
		public $table = 'doctors_specializations';

		public $_fillables = [
			'id','doctor_id' , 'specialty_id',
			'notes' , 'created_by'
		];

		public function getByUser($user_id)
		{
			return $this->getAll([
				'where' => [
					'doctor_id' => $user_id
				]
			]);
		}

		public function getAll($params = [])
		{
			$where = null;
			$order = null;

			if( isset($params['where']) )
				$where = " WHERE " .$this->conditionConvert($params['where']);
			if( isset($params['order']))
				$order = " ORDER BY {$params['order']}" ;


			$this->db->query(
				"SELECT specialty.*,tblmain.*
					FROM {$this->table} as tblmain
					LEFT JOIN specialties as specialty 
					on specialty.id = tblmain.specialty_id

					{$where}{$order}"
			);

			return $this->db->resultSet();
		}

		public function save($specialty_data , $id = null)
		{
			$fillable_datas = $this->getFillablesOnly($specialty_data);

			if( is_null($id) )
			{
				//check if specialty already in the user
				$check_specialty_exists = parent::single([
					'specialty_id' => $fillable_datas['specialty_id'],
					'doctor_id'    => $fillable_datas['doctor_id']
				]);

				if( $check_specialty_exists )
				{
					$this->addError("Specialty Exists.");
					return false;
				}

				return parent::store($fillable_datas);
			}else
			{
				return parent::update($fillable_datas , $id);
			}
		}


		public function add($specialty_data)
		{
			$res = $this->save($specialty_data);

			if($res){
				$this->addMessage("Specialty Added");
				return true;
			}

			return $res;
		}

		public function update($specialty_data , $id)
		{
			return $this->save($specialty_data , $id);
		}
	}