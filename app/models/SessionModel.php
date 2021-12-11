<?php 
	
	class SessionModel extends Model
	{
		public $table = 'sessions';

		public $attachment_key = "PATIENT_SESSION";
		

		public $_fillables = [
			'id',
			'doctor_id',
			'guest_name',
			'guest_phone',
			'guest_email',
			'guest_address',
			'user_id',
			'date_created',
			'time_created',
			'remarks',
			'appointment_id',
			'guest_gender',
			'doctor_recommendations',
			'created_at'
		];


		public function create($session_data)
		{
			$fillable_datas = $this->getFillablesOnly($session_data);
			
			$res = parent::store($fillable_datas);

			if(!$res){
				$this->addError("Creating patient session failed!");
				return false;
			} 

			//load appointment model if ok

			if( isset($session_data['appointment_id']) )
			{
				$this->appointment_model = model('AppointmentModel');

				$this->appointment_model->updateStatus($session_data['appointment_id'] , 'arrived');
			}

			$user_model = model('UserModel');

			$doctor_name  = $user_model->fetchSigleSingleColumn('first_name' , ['id' => $session_data['doctor_id']]);
			$patient_name = $user_model->fetchSigleSingleColumn('first_name' , ['id' => $session_data['user_id']]);

			_notify('DRA/DR. '.$doctor_name ." . started a session with you" , [$session_data['user_id']]);
			_notify_operations(" 'DRA/DR. '.{$doctor_name} started a session with {$patient_name}");


			return $res;
		}

		public function getComplete($id)
		{

			$session = $this->get($id);

			if(!$session){
				$this->addError("Patient Session does not exists");
				return false;
			}

			$this->user_model = model('UserModel');
			$this->doctor_model = model('DoctorModel');

			if( $session->user_id ){
				$patient = $this->user_model->get($session->user_id);
				$session->patient_account = $patient;
			}

			$doctor = $this->doctor_model->getByUser($session->doctor_id);

			$session->doctor = $doctor;
			$session->documents = $this->getDocuments( $id );

			return $session;
			//get user if exists and doctor
		}

		public function getDocuments( $id )
		{
			$this->attachment_model = model('AttachmentModel');


			return $this->attachment_model->getAssoc('label' , [
				'global_id' => $id,
				'global_key' => $this->attachment_key
			]);
		}


		public function getAll( $params = [] )
		{
			$where = null;
			$order = null;

			if( isset($params['where']) )
				$where = " WHERE ". $this->conditionConvert($params['where']);

			if( isset($params['order']) )
				$order = " ORDER BY ". $params['order'];
			

			$this->db->query(
				"SELECT session.* , user.first_name , user.last_name 
					FROM {$this->table} as session
					LEFT JOIN users as user 
					ON session.doctor_id = user.id
					{$where} {$order}"
			);

			return $this->db->resultSet();
		}
	}