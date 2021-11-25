<?php 
	class AppointmentModel extends Model
	{

		public $table = 'appointments';

		
		public function create($appointment_data)
		{	
			extract($appointment_data);
			//cerate appointment

			$reference = $this->generateRefence();

			$appointment_id = parent::store([
				'reference' => $reference,
				'date' => $date,
				'user_id' => $user_id ?? null,
				'type'    => $type ?? 'online',
				'remark'  => $remark ?? '',
				'guest_name' => $guest_name,
				'guest_email' => $guest_email,
				'guest_phone' => $guest_phone,
				'status'      => $status ?? ''
			]);

			return $appointment_id;
		}

		public function createWithBill( $appointment_data )
		{
			$appointment_id = $this->create($appointment_data);

			$this->bill_model = model('BillModel');

			$bill_data = [
				'user_id' => $appointment_data['user_id'] ?? '',
				'payment_status' => $appointment_data['payment_status'] ?? 'unpaid',
				'payment_method' => $appointment_data['payment_method'] ?? 'na',
				'bill_to_name'  => $appointment_data['guest_name'],
				'bill_to_email'  => $appointment_data['guest_email'],
				'bill_to_phone'  => $appointment_data['guest_phone'],
				'appointment_id' => $appointment_id
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

			$bill_model = model('BillModel');
			$bill = $bill_model->getByAppointment($appointment->id);

			$appointment->bill = $bill;
			
			return $appointment;
		}
	}