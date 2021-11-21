<?php
	load(['ServiceForm'] , APPROOT.DS.'form');

	use Form\ServiceForm;

	class ServiceController extends Controller
	{

		public function __construct()
		{
			$this->_form = new ServiceForm();
			$this->service = model('ServiceModel');

		}

		public function index()
		{
			$services = $this->service->getAll();

			$data = [
				'title' => 'Services',
				'services' => $services,
				'form' => $this->_form
			];
			return $this->view('service/index' , $data);
		}


		public function create()
		{
			if( isSubmitted() )
			{
				$post = request()->posts();

				$res = $this->service->save($post);

				Flash::set( $this->service->getMessageString() );

				if(!$res){
					Flash::set( $this->service->getErrorString() , 'danger');
					return request()->return();
				}

				return redirect( _route('service:index') );
			}

			$data = [
				'title' => 'Create Service',
				'form'  => $this->_form
			];

			return $this->view('service/create' , $data);
		}

		public function save()
		{

		}
	}