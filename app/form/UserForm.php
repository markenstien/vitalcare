<?php

	namespace Form;

	load(['Form'], CORE);

	use Core\Form;

	class UserForm extends Form
	{

		public function __construct( $name = null)
		{
			parent::__construct();

			$this->name = $name ?? 'form_user';

			$this->initCreate();

			$this->addAddress();
			$this->addPhoneNumber();
			$this->addEmal();
			$this->addUsername();
			$this->addPassword();
			$this->addUserType();
			$this->addProfile();
			$this->addFirstName();
			$this->addLastName();
			$this->addMiddleName();
			$this->addBirthDay();
			$this->addGender();

			$this->addSubmit('');
		}

		public function initCreate()
		{
			$this->init([
				'url' => _route('user:create'),
				'enctype' => ''
			]);
		}
		
		public function addFirstName()
		{
			$this->add([
				'type' => 'text',
				'name' => 'first_name',
				'class' => 'form-control',
				'required' => true,
				'options' => [
					'label' => 'First Name'
				],

				'attributes' => [
					'id' => 'id_first_name',
					'placeholder' => 'Enter Last Name'
				]
			]);
		}


		public function addLastName()
		{
			$this->add([
				'type' => 'text',
				'name' => 'last_name',
				'class' => 'form-control',
				'required' => true,
				'options' => [
					'label' => 'Last Name'
				],

				'attributes' => [
					'id' => 'id_lastname',
					'placeholder' => 'Enter Last Name'
				]
			]);
		}

		public function addMiddleName()
		{
			$this->add([
				'type' => 'text',
				'name' => 'middle_name',
				'class' => 'form-control',
				'options' => [
					'label' => 'Middle Name'
				],

				'attributes' => [
					'id' => 'id_middle_name',
					'placeholder' => 'Enter Middle Name'
				]
			]);
		}

		public function addBirthDay()
		{
			$this->add([
				'type' => 'date',
				'name' => 'birthdate',
				'class' => 'form-control',
				'options' => [
					'label' => 'Birth Day'
				],

				'attributes' => [
					'id' => 'id_birthday',
				]
			]);
		}

		public function addGender()
		{
			$this->add([
				'type' => 'select',
				'name' => 'gender',
				'class' => 'form-control',
				'options' => [
					'label' => 'Gender',
					'option_values' => [
						'Male' , 'Female'
					]
				],

				'attributes' => [
					'id' => 'id_gender',
				]
			]);
		}

		public function addAddress()
		{
			$this->add([
				'type' => 'textarea',
				'name' => 'address',
				'class' => 'form-control',
				'options' => [
					'label' => 'Address',
				],

				'attributes' => [
					'id' => 'id_address',
					'rows' => 3
				]
			]);
		}

		public function addPhoneNumber()
		{
			$this->add([
				'type' => 'text',
				'name' => 'phone_number',
				'class' => 'form-control',
				'options' => [
					'label' => 'Phone Number',
				],

				'attributes' => [
					'id' => 'id_phone_number',
					'placeholder' => 'Eg. 09xxxxxxxxx'
				]
			]);
		}

		public function addEmal()
		{
			$this->add([
				'type' => 'email',
				'name' => 'email',
				'class' => 'form-control',
				'options' => [
					'label' => 'Email',
				],

				'attributes' => [
					'id' => 'id_email',
					'placeholder' => 'Enter Valid Email'
				]
			]);
		}

		public function addUsername()
		{
			$this->add([
				'type' => 'text',
				'name' => 'username',
				'class' => 'form-control',
				'required' => '',
				'options' => [
					'label' => 'Username',
				],

				'attributes' => [
					'id' => 'id_username'
				]
			]);
		}

		public function addPassword()
		{
			$this->add([
				'type' => 'password',
				'name' => 'password',
				'class' => 'form-control',
				'required' => '',
				'options' => [
					'label' => 'Password',
				],

				'attributes' => [
					'id' => 'id_password'
				]
			]);
		}

		public function addUserType()
		{
			$this->add([
				'type' => 'select',
				'name' => 'user_type',
				'class' => 'form-control',
				'required' => '',
				'options' => [
					'label' => 'User Type',
					'option_values' => [
						'admin','patient','doctor'
					]
				],

				'attributes' => [
					'id' => 'id_user_type'
				]
			]);
		}

		public function addProfile()
		{
			$this->add([
				'type' => 'file',
				'name' => 'profile',
				'class' => 'form-control',
				'options' => [
					'label' => 'Profile',
				],

				'attributes' => [
					'id' => 'id_profile'
				]
			]);
		}

		public function addSubmit()
		{
			$this->add([
				'type' => 'submit',
				'name' => 'submit',
				'class' => 'btn btn-primary',
				'attributes' => [
					'id' => 'id_submit'
				],

				'value' => 'Save user'
			]);
		}
	}