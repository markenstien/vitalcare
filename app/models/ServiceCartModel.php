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
			if( whoIs() )
			{
				$curCartSession = parent::single([
					'user_id' => whoIs('id')
				], '*' , ' id desc');
				
				Session::set('service-appointment-token' ,$curCartSession->session_token ?? get_token_random_char(20));
			}

			if(!Session::get('service-appointment-token') )
				Session::set('service-appointment-token' , get_token_random_char(20));

			return Session::get('service-appointment-token');
		}

		public function getToken()
		{
			return Session::get('service-appointment-token');
		}

		public function killToken()
		{
			Session::remove('service-appointment-token');
		}


		public function destroyCart()
		{
			$token = $this->getToken();
			
			$this->killToken();

			return parent::deleteByKey([
				'session_token' => $token
			]);
		}
		public function getCartSummary( $cart_items = null)
		{

			if( is_null($cart_items) )
				$cart_items = $this->getCart();
			
			$count = count($cart_items);
			$bundle_total = 0;
			$single_total = 0;
			foreach($cart_items as $row)
			{
				if( isEqual($row['type'] , 'bundle') )
				{
					$bundle_total += $row['price'];
				}else
				{
					$single_total += floatval($row['item']->price);
				}
			}

			return [
				'total_amount' => $bundle_total + $single_total,
				'total_items'  => $count
			];
		}

		public function getCart( $cart_session = null )
		{

			if( is_null($cart_session) )
				$cart_session = $this->getAndCreateToken();

			$this->bundle = model('ServiceBundleModel');
			$this->service = model('ServiceModel');

			$cart_items = parent::getAssoc('id' , [
				'session_token' => $cart_session
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
						'id'   => $item->id,
						'type' => 'bundle',
						'bundle' => $bundle,
						'items'  => $bundle->items,
						'price'  => $bundle->public_price
					];
				}else
				{
					$product = $this->service->get($item->service_id);
					$data = [
						'id'   => $item->id,
						'type' => 'single',
						'item' => $product,
						'price' => $product->price
					];
				}

				$ret_val[$key] = $data;
			}

			return $ret_val;
		}
	}