<?php
	load(['UserForm' , 'DoctorForm' , 'DoctorSpecializationForm'] , APPROOT.DS.'form');
	use Form\UserForm;
	use Form\DoctorForm;
	use Form\DoctorSpecializationForm;


	class UserController extends Controller
	{
		private $_form;

		public function __construct()
		{
			$this->_form = new UserForm('form_user');

			$this->model = model('UserModel');
			$this->session = model('SessionModel');
			$this->appointment = model('AppointmentModel');
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

			$doc_form->setValue('license_number' , $user->license_number ?? 0);

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

				$doctor_specialization = model('DoctorSpecializationModel');

				$prefix = $user->gender == 'male' ? 'DR.' : 'DRA';

				$data['title']  = $prefix.'. '.$user->first_name . ' '.$user->last_name;

				$data['doctor'] = $doctor_model->getByUser($user->id);


			$data['doctor_specializations'] = $doctor_specialization->getByUser($user->id);

				$data['sessions'] = $this->session->getAll([
					'where' => [
						'doctor_id' => $user->id
					]
				]);

				return $this->view('user/doctor_view' , $data);
				break;

				case 'patient':
				
				$data['appointments'] = $this->appointment->getDesc('id' , ['user_id' => $user->id]);
				
				$data['sessions'] = $this->session->getAll([
					'where' => [
						'user_id' => $user->id
					]
				]);

				$this->view('user/patient_view' , $data);
				break;

				default:
					//admin
				$this->view('user/admin_view' , $data);
				break;
			}
		}

		public function sendAuth()
		{
			if( isSubmitted() )
			{
				$post = request()->posts();


				$user = $this->model->get( $post['user_id'] );

				$recipients = explode(',' , $post['recipients']);

				$content = pull_view('tmp/emails/user_auth_email_view_tmp' , [
					'user' => $user,
					'system_name' => COMPANY_NAME
				]);

				_mail($recipients , "User Auth" , $content);

				_notify_operations("Account details has been sent, recipients {$post['recipients']} ");

				Flash::set("Auth has been sent");

				return request()->return();
			}
		}
			
	}