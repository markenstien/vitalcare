<?php
	namespace Form;
	load(['Form'] , CORE);

	use Core\Form;

	class DoctorForm extends Form
	{
		
		public function __construct()
		{
			parent::__construct();


			$this->name = 'doctor_form';

			$this->addLicense();

		}

		public function addUserId()
		{
			$this->add([
				'name' => 'user_id',
				'type' => 'int',
				'required' => '',
				'attributes' => [
					'id'  => 'id_user_id'
				]
			]);
		}

		public function addLicense()
		{

			$this->add([
				'name' => 'license_number',
				'type' => 'text',
				'class' => 'form-control',
				'required' => '',
				'options' => [
					'label' => 'License Number'
				],
				'attributes' => [
					'id'  => 'id_license_number'
				]
			]);
		}

	}