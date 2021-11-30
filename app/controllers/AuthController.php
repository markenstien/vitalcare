<?php 
	
	load(['UserForm'] , APPROOT.DS.'form');

	use Form\UserForm;

	class AuthController extends Controller
	{	

		public function __construct()
		{
			$this->user = model('UserModel');
			$this->_form = new UserForm();
		}

		public function login()
		{
			if( isSubmitted() )
			{
				$post = request()->posts();

				$res = $this->user->authenticate($post['email'] , $post['password']);

				if(!$res) {
					Flash::set( $this->user->getErrorString() , 'danger');
					return request()->return();
				}else
				{
					Flash::set( "Welcome Back !" . auth('first_name'));
				}

				return redirect('DashboardController');
			}

			$form = $this->_form;

			$form->init([
				'url' => _route('auth:login')
			]);

			$form->customSubmit('Login');

			$data = [
				'title' => 'Login Page',
				'form'  => $form
			];

			return $this->view('auth/login' , $data);
		}

		public function logout()
		{
			session_destroy();

			
			Flash::set("Successfully logged-out");
			return redirect( _route('auth:login') );
		}
	}