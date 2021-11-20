<?php
	
	load(['DoctorForm'], APPROOT.DS.'form');

	use Form\DoctorForm;

	class HomeController extends Controller
	{

		public function index()
		{	
			$doctormForm = new DoctorForm();

			$doctormForm->init([
				'method' => 'post',
				'url'    => 'asdasd',
				'name'   => 'doctor_form',
				'attributes' => [
					'id' => '123123',
					'style' => 'asdasd : asdasd',
					'data-id' => '3123123'
				]
			]);
		}
	}