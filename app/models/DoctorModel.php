<?php 

	class DoctorModel extends Model
	{
		public $table = 'doctors';

		public $_fillables  = ['id' , 'license_number' , 'user_id'];

		public function save($doctor_data , $id = null)
		{
			$fillable_datas = $this->getFillablesOnly($doctor_data);

			$license_number_exists = $this->getByLicenseNumber($license_number);

			if( !is_null($id) )
			{
				if( ! $this->validateLicensedNumber($doctor_data['lincense_number'] , $id) ) return false;
				//update
				return parent::update($fillable_datas , $id);
			}else
			{
				//create
				if( ! $this->validateLicensedNumber($doctor_data['lincense_number']) ) return false;
				return parent::store($fillable_datas );
			}
		}

		public function getByLicenseNumber($license_number)
		{
			return parent::single([
				'license_number' => $license_number
			]);
		}

		public function validateLicensedNumber($license_number , $id = null )
		{
			$license_number_exists = $this->getByLicenseNumber($license_number);

			if( !is_null($id) )
			{
				if( $license_number_exists->lincense_number &&  $license_number_exists->id != $id ){
					$this->addError("Invalid Lincese already owned by another doctor.");
					return false;
				}
			}else
			{
				if( $license_number_exists) {
					$this->addError("Invalid Lincese already owned by another doctor.");
					return false;
				}
			}

			return true;
		}

		public function getByUser($user_id)
		{
			return $this->getAll([
				'where' => [
					'user_id' => $user_id
				]
			])[0] ?? false;
		}

		public function getAll( $params = [] )
		{
			$where = null;
			$order = null;

			if( isset($params['where']) )
				$where = " WHERE ".$this->conditionConvert($params['where']) ;

			if( isset($params['order']) )
				$order = " ORDER BY ".$params['order'];

			$this->db->query(
				"SELECT user.* , doctor.* ,doctor.id as id
					FROM {$this->table} as doctor
					LEFT JOIN users as user 
					ON user.id = doctor.user_id
					{$where} {$order}"
			);

			return $this->db->resultSet();
		}
	}