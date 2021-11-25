<?php 	

	class ServiceCartModel extends Model
	{

		public $table = 'service_cart';

		protected $_fillables = [
			'service_id' , 'type' , 'user_id' , 
			'session_token'
		];

		public function add($service_appointment_data = [] )
		{
			$service_appointment_data['session_token'] = $this->getAndCreateToken();

			$fillable_datas = $this->getFillablesOnly( $service_appointment_data );

			if( !$this->validate($fillable_datas) ) return false;

			$res = parent::store($fillable_datas);

			if(!$res) {
				$this->addError("Error Already exists");
				return false;
			}

			$this->addMessage("Service added");

			return true;
		}


		public function validate( $service_appointment_data )
		{	
			$data  = [
				'service_id' => $service_appointment_data['service_id'],
				'type'       => $service_appointment_data['type']
			];
				
			if( isset($service_appointment_data['user_id']) )
				$data['user_id'] = $service_appointment_data['user_id'];

			if( isset($service_appointment_data['session_token']) )
				$data['session_token'] = $service_appointment_data['session_token'];

			if( parent::single($data) ){
				$this->addError("Service Already added");
				return false;
			}

			return true;
		}

		public function getAndCreateToken()
		{
			if(!Session::get('service-appointment-token') )
				Session::set('service-appointment-token' , get_token_random_char(20));

			return Session::get('service-appointment-token');
		}


		public function getCartSummary()
		{
			$total = 0;
			$count = 0;

			$cart_items = $this->getCart();

			$count = count($cart_items);

			foreach($cart_items as $row)
			{
				if( isEqual($row['type'] , 'bundle') )
				{
					foreach($row['items'] as $r)
					{
						$total += $r->price;
					}
				}else
				{
					$total += floatval($row['item']->price);
				}
			}

			return [
				'total_amount' => $total,
				'total_items'  => $count
			];
		}

		public function getCart()
		{

			$this->bundle = model('ServiceBundleModel');
			$this->service = model('ServiceModel');

			$cart_items = parent::getAssoc('id' , [
				'session_token' => $this->getAndCreateToken()
			]);

			return $this->formatCartItems($cart_items);
		}

		public function formatCartItems( $cart_items )
		{
			$ret_val = [];

			foreach($cart_items as $key => $item)
			{
				if( isEqual($item->type , 'bundle') )
				{
					$bundle = $this->bundle->getWithItems($item->service_id);
					/*get bubndle*/
					$data = [
						'type' => 'bundle',
						'bundle' => $bundle,
						'items'  => $bundle->items
					];
				}else
				{
					$data = [
						'type' => 'single',
						'item' => $this->service->get($item->service_id)
					];
				}

				$ret_val[$key] = $data;
			}

			return $ret_val;
		}
	}