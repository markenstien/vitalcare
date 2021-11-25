<?php 	

	class AppointmentController extends Controller
	{

		public function __construct()
		{
			$this->service = model('ServiceModel');
			$this->service_bundle = model('ServiceBundleModel');
			$this->category = model('CategoryModel');
			$this->service_cart_model = model('ServiceCartModel');
			$this->model = model('AppointmentModel');
		}

		public function index()
		{
			/*
			*select service that you want
			*/
			$data = [
				'title' => 'Appointments',
				'appointments' => $this->model->getAssoc('id')
			];

			return $this->view('appointment/index' , $data);
		}


		public function createWithBill()
		{
			if( isSubmitted() )
			{
				$post = request()->posts();

				$res = $this->model->createWithBill( $post );

				if(!$res) 
				{
					Flash::set( $this->model->getErrorString()) ;
					return request()->return();
				}

				return redirect( _route('bill:show' , $this->model->bill_id) );
			}
		}

		public function create()
		{	
			if( isset($_GET['btn_filter']) )
			{	
				$rq  = request()->inputs();

				if( empty($rq['key_word']) && !isset($rq['categories']) )
				{
					Flash::set("Filter failed" , 'danger');
					return request()->return();
				}

				$services = $this->service->getByFilter( $rq );

				$service_bundles = $this->service_bundle->getByFilter($rq);

			}elseif(isset($_GET['category']))
			{
				$services = $this->service->getAll([
					'where' => [
						'category' => $_GET['category']
					]
				]);

				$service_bundles = $this->service_bundle->getAll([
					'where' => [
						'category' => $_GET['category']
					]
				]);
			}else
			{

				$services = $this->service->getAll([
					'where' => [
						'is_visible' => true
					]
				]);

				$service_bundles = $this->service_bundle->getAll([
					'where' => [
						'is_visible' => true
					]
				]);
			}

			$categories = $this->category->getAll([
				'cat_key' => 'SERVICES'
			]);


			$cart_summary = $this->service_cart_model->getCartSummary();

			$data = [
				'title' => 'Create An Appointment',
				'categories' => $categories,
				'service_bundles' => $service_bundles,
				'services'   => $services,
				'service_cart_model' => $this->service_cart_model,
				'cart_summary'  => $cart_summary
			];

			return $this->view('appointment/create' , $data);
		}


		public function show($id)
		{
			$appointment = $this->model->getComplete($id);

			$data = [
				'appointment' => $appointment,
				'title' => '#'.$appointment->reference. ' | Appointment',
			];
			
			return $this->view('appointment/show' , $data);
		}
	}