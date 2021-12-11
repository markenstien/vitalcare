<?php

	class PaymentModel extends Model
	{	
		public $table = 'payments';

		protected $_fillables = [
			'id' , 'reference','amount',
			'method' , 'notes', 'org',
			'external_reference' , 'acc_no',
			'acc_name' , 'bill_id' , 'created_by'
		];

		public function create($payment_data)
		{

			$payment_data['reference'] = $this->getReference();

			$fillable_datas = $this->getFillablesOnly($payment_data);

			$payment_id = parent::store($fillable_datas);

			if( $payment_id )
			{
				$bill_model = model('BillModel');

				$bill_model->update([
					'payment_status' => 'paid',
					'payment_method' => $payment_data['method']
				] , $payment_data['bill_id']);

				$bill_model->killToken();

				$bill = $bill_model->get($payment_data['bill_id']);

				if( $bill->appointment_id )
				{
					$appointment_model = model('AppointmentModel');
					$appointment_model->updateStatus($bill->appointment_id , 'scheduled');
				}

				/*
				*if there's a user on bill
				*/
				if( $bill->user_id )
				{
					$this->user_model = model('UserModel');

					$user_first_name = $this->user_model->fetchSigleSingleColumn(['first_name' , '' , 'last_name'] , ['id' => $bill_id->user_id]);

					_notify("You have paid your balance {$fillable_datas['amount']} via {$fillable_datas['method']}.#{$payment_data['reference']} Payment reference" , [$bill->user_id]);
				}

				_notify_operations( $user_first_name ?? 'Guest' . ' ' .'submitted a payment of '.$fillable_datas['amount'] );

				$this->addMessage("Payment saved");
				return $payment_id;
			}

			$this->addError("Error to save payment!");
			
			return false;
		}

		public function getReference()
		{
			return strtoupper('PMT-'.get_token_random_char(7));
		}


		public function getByBill($bill_id)
		{
			return $this->getAssoc('id' , [
				'bill_id' => $bill_id
			]);
		}
	}