<?php
	load(['ServiceForm'] , APPROOT.DS.'form');

	use Form\ServiceForm;

	class ServiceController extends Controller
	{

		public function __construct()
		{
			$this->_form = new ServiceForm();
			$this->model = model('ServiceModel');

		}

		public function index()
		{
			$services = $this->model->getAll();

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

				$res = $this->model->save($post);

				Flash::set( $this->model->getMessageString() );

				if(!$res){
					Flash::set( $this->model->getErrorString() , 'danger');
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


		public function edit($id)
		{
			if( isSubmitted() )
			{
				$post = request()->posts();

				$res = $this->model->save($post , $post['id']);

				Flash::set( $this->model->getMessageString() );

				if(!$res){
					Flash::set( $this->model->getErrorString() , 'danger');
					return request()->return();
				}

				return redirect( _route('service:index') );
			}

			$service = $this->model->get($id);

			$this->_form->init([
				'url' => _route('service:edit' , $service->id)
			]);

			$this->_form->addId( $service->id );

			$this->_form->setValueObject( $service );

			$data = [
				'title' => 'Create Service',
				'form'  => $this->_form
			];

			return $this->view('service/edit' , $data);
		}
	}