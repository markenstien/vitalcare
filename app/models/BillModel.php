<?php

	class BillModel extends Model
	{
		public $table = 'bills';

		protected $_fillables = [
			'id' , 'reference' , 'user_id',
			'total_amount' , 'payment_status','payment_method',
			'bill_to_name' , 'bill_to_email' , 'bill_to_phone',
			'appointment_id'
		];



		public function getComplete($id)
		{
			$bill = parent::get($id);

			if(!$bill){
				$this->addError("Bill not found");
				return false;
			}	
			$this->bill_item_model = model('BillItemModel');
			
			$bill_items  = $this->bill_item_model->getItemsByBill($id);
			$bill->items = $bill_items;


			if( $bill->appointment_id )
			{
				$appointment = model('AppointmentModel');

				$bill->appointment = $appointment->get($bill->appointment_id);
			}


			return $bill;
		}

		public function getByAppointment( $appointment_id )
		{
			$bill = parent::single([
				'appointment_id' => $appointment_id
			]);

			if( !$bill ){
				$this->addError("appointment has no bill");
				return false;
			}

			$bill->payments = $this->getPayments($bill->id);

			return $bill;
		}

		public function getPayments($bill_id)
		{
			$payment = model('PaymentModel');

			return $payment->getAssoc('id' , [
				'bill_id' => $bill_id
			]);
		}

		/*
		*bill data accepts the ff
		*reference , user_id , 
		*total_amount
		*payment_status , payment_method
		*bill_to_name , bill_to_email , bill_to_phone, 
		*appoint_id
		*/
		public function createPullServiceCartItems($bill_data = null)
		{
			$this->service_cart_model = model('ServiceCartModel');

			$cart_token = $this->service_cart_model->getToken();

			$items = [];

			$total = 0;

			if( $cart_token )
			{
				$cart_items = $this->service_cart_model->getCart();

				foreach($cart_items as $key => $item)
				{
					$item_data = [
						'name' => '',
						'description' => '',
						'price' => ''
					];

					if( isEqual($item['type'] , 'bundle') )
					{
						$item_data['name'] = $item['bundle']->name;
						$item_data['price'] = floatval($item['bundle']->public_price);
						$item_data['description'] = $item['bundle']->description;
					}else
					{
						$item_data['name'] = $item['item']->service;
						$item_data['price'] = floatval( $item['item']->price );
						$item_data['description'] = $item['item']->description;
					}

					$total += $item_data['price'];

					array_push($items , $item_data);
				}

				$this->service_cart_model->destroyCart();
			}

			$bill_data['total_amount'] = $total;


			return $this->createBill( $bill_data , $items );
		}

		public function createBill( $bill_data = [] , $items = [])
		{
			$fillable_datas = $this->getFillablesOnly($bill_data);

			$total_item_amount = 0;

			if( !empty($items) )
			{
				$this->bill_item_model = model('BillItemModel');

				foreach($items as $key => $item){
					$this->bill_item_model->addItem($item);
					$total_item_amount += $item['price'];
				}
				
				$items = $this->bill_item_model->getItems();
			}


			if( !isset($fillable_datas['total_amount']) )
				$fillable_datas['total_amount'] = $total_item_amount;


			$fillable_datas['reference'] = $this->getReference();

			$bill_id = parent::store($fillable_datas);

			$this->bill_item_model->setBillId($bill_id);

			$this->bill_item_model->saveItems();

			return $bill_id;
		}


		public function getReference()
		{
			return strtoupper('BILL-'.get_token_random_char(7));
		}


		public function killToken()
		{
			$service_cart_model = model('ServiceCartModel');

			$service_cart_model->killToken();
		}
	}