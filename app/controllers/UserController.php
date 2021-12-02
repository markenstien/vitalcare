<?php
	load(['UserForm' , 'DoctorForm'] , APPROOT.DS.'form');
	use Form\UserForm;
	use Form\DoctorForm;


	class UserController extends Controller
	{
		private $_form;

		public function __construct()
		{
			$this->_form = new UserForm('form_user');

			$this->model = model('UserModel');
		}

		public function index()
		{

			$data = [
				'users' => $this->model->getAll(),
				'title' => 'Users'
			];

			return $this->view('user/index' , $data);
		}

		public function create()
		{

			if( isSubmitted() )
			{
				$post = request()->posts();

				$res = $this->model->create($post , 'profile');

				Flash::set( $this->model->getMessageString());

				if(!$res) {
					Flash::set( $this->model->getErrorString() , 'danger');
					return request()->return();
				}

				return redirect(_route('user:index'));
			}

			$doc_form = new DoctorForm();



			$data = [
				'title' => 'Create User',
				'form'  => $this->_form,
				'doc_form' => $doc_form
			];

			return $this->view('user/create_edit' , $data);
		}


		public function edit($id)
		{

			if( isSubmitted() )
			{
				$post = request()->posts();

				$post['profile'] = 'profile';
				
				$res = $this->model->save($post , $id);

				if($res) {
					Flash::set( "User updated !");
					return redirect( _route('user:show' , $id));
				}else{
					Flash::set( $this->model->getErrorString() );
				}
			}

			$user = $this->model->get($id);

			$doc_form = new DoctorForm();

			$this->_form->setUrl(_route('user:edit' , $id));

			$this->_form->addId($id);

			$this->_form->setValueObject($user);

			$data = [
				'title' => 'Create User',
				'form'  => $this->_form,
				'doc_form' => $doc_form,
				'user'   => $user
			];


			return $this->view('user/create_edit' , $data);
		}

		public function show($id)
		{
			$user = $this->model->get($id);

			$data = [
				'user' => $user
			];

			switch( strtolower($user->user_type) )
			{
				case 'doctor':

				$doctor_model = model('DoctorModel');

				$prefix = $user->gender == 'male' ? 'DR.' : 'DRA';

				$data['title']  = $prefix.'. '.$user->first_name . ' '.$user->last_name;

				$data['doctor'] = $doctor_model->getByUser($user->id);

				$data['doctor_specializations'] = [];
				
				return $this->view('user/doctor_view' , $data);
				break;

				case 'patient':
					//patient
				$this->view('user/patient_view' , $data);
				break;

				default:
					//admin
				$this->view('user/admin_view' , $data);
				break;
			}
		}
		
	}