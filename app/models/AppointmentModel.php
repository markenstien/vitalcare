<?php 
	class AppointmentModel extends Model
	{

		public $table = 'appointments';

		public $_fillables = [
			'reference',
			'start_time',
			'end_time',
			'date',
			'user_id',
			'type',
			'remark',
			'guest_name',
			'guest_email',
			'guest_phone',
			'status'
		];

		public function save($appointment_data , $id = null)
		{

			$fillable_datas = $this->getFillablesOnly($appointment_data);

			if( !is_null($id) ){
				return parent::update($fillable_datas , $id);
			}else
			{
				return $this->create($fillable_datas);
			}
		}
		
		public function create($appointment_data)
		{	
			extract($appointment_data);

			if(!$this->checkAvailability($date)) 
				return false;
			/*check appointment date if in maximum*/

			$appointment_data['reference'] = $this->generateRefence();
			$appointment_data['user_id'] = $user_id ?? '';
			$appointment_data['type'] = $type ?? 'online';
			$appointment_data['remark'] = $remark ?? '';
			$appointment_data['status'] = $status ?? 'pending';

			$_fillables = $this->getFillablesOnly($appointment_data);
			$appointment_id = parent::store($_fillables);


			$appointment_link = _route('appointment:show' , $appointment_id);

			if( $appointment_id )
			{
				if( !is_null($user_id) )
				{

					$user_model = model('UserModel');

					$user = $user_model->single(['id' => $user_id]);

					$email = $user->email;
					$user_mobile_number = $user->phone_number;
					
					_notify_include_email("Appointment to vitalcare is submitted .#{$reference} appointment reference",[$user_id],[$email] , ['href' => $appointment_link ]);

					send_sms("Appointment to vitalcare is submitted .#{$reference} appointment reference" , [$user_mobile_number]);
				}
				
				_notify_operations("Appointment to vitalcare is submitted .#{$reference} appointment reference" , ['href' => $appointment_link]);
			}

			return $appointment_id;
		}

		public function createWithBill( $appointment_data )
		{
			$this->bill_model = model('BillModel');

			$cart_items = $this->bill_model->getCartItems();

			if(!$cart_items){
				$this->addError("Unable to save apointment no services selected ");
				return false;
			}

			//check item firsts
			$appointment_id = $this->create($appointment_data);

			if(!$appointment_id)
				return false;

			$this->bill_model = model('BillModel');

			$bill_data = [
				'user_id' => $appointment_data['user_id'] ?? '',
				'payment_status' => $appointment_data['payment_status'] ?? 'unpaid',
				'payment_method' => $appointment_data['payment_method'] ?? 'na',
				'bill_to_name'  => $appointment_data['guest_name'],
				'bill_to_email'  => $appointment_data['guest_email'],
				'bill_to_phone'  => $appointment_data['guest_phone'],
				'appointment_id' => $appointment_id,
				'discount' => $appointment_data['discount']
			];

			$this->bill_id = $this->bill_model->createPullServiceCartItems( $bill_data );

			return $appointment_id;
		}

		public function generateRefence()
		{
			return strtoupper('APT-'.get_token_random_char(7));
		}

		public function getComplete( $id )
		{
			$appointment = parent::get($id);

			if(!$appointment){
				$this->addError("appointment not found");
				return false;
			}

			//bill
			$bill = $this->getBill($id);

			$appointment->bill = $bill;

			return $appointment;
		}



		public function getBill($id)
		{
			$bill_model = model('BillModel');
			$bill = $bill_model->getByAppointment($id);

			return $bill;
		}

		public function updateStatus($id , $status)
		{
			$update_payment_status = parent::update([
				'status' => $status
			], $id);

			//create notification

			return $update_payment_status;
		}

		public function getTotalAppointmentByDate($date)
		{
			$this->db->query(
				"SELECT sum(id) as total 
					FROM {$this->table}
					WHERE date = '{$date}' 
					AND status not in ('pending' , 'cancelled')
					AND type = 'online'
					GROUP BY date"
			);

			return $this->db->single()->total ?? 0;
		}

		public function checkAvailability($date)
		{
			$schedule_model = model('ScheduleModel');

			$total_person_reserved = $this->getTotalAppointmentByDate($date);

			$day_name = date('l' , strtotime($date));

			$date_by_name = $schedule_model->getByAppointmentByDay($day_name);

			if( $date_by_name->max_visitor_count <= $total_person_reserved ){
				$this->addError("Date {$date}($day_name) is already full , please schedule another day");
				return false;
			}else{
				$this->addMessage("Date is available");
				return true;
			}
		}
	}