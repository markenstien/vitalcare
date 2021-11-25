<?php 

	class ServiceCartController extends Controller
	{


		public function __construct()
		{
			$this->serviceCart = model('ServiceCartModel');
		}


		public function add( )
		{
			/*
			*expected-inputs
			*user_id , type[bundle , service ]
			*/

			$post = request()->posts();

			$res = $this->serviceCart->add( $post );

			if(!$res) {
				Flash::set( $this->serviceCart->getErrorString() , 'danger');
				return request()->return();
			}

			Flash::set( $this->serviceCart->getMessageString() );

			return redirect( _route('appointment:create') );
		}
	}