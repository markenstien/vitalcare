<?php 

	class DoctorSpecializationModel extends Model
	{
		public $table = 'doctor_specializations';

		public $_fillables = [
			'doctor_id' , 'specialty_id',
			'notes' , 'created_by'
		];

		public function save($specialty_data , $id = null)
		{
			if( is_null($id) )
			{
				//check if specialty already in the user
				$check_specialty_exists = parent::single([
					'specialty_id' => $specialty_data['specialty_id'],
					'doctor_id'    => $specialty_data['doctor_id']
				]);

				if( $check_specialty_exists )
				{
					$this->addError("Specialty Exists.");
					return false;
				}

				return parent::store($specialty_data);
			}else
			{
				return parent::update($specialty_data , $id);
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