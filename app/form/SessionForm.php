<?php 
	namespace Form;
	load(['Form'] , CORE);
	use Core\Form;

	class SessionForm extends Form
	{

		public function __construct()
		{
			parent::__construct();

			$this->name = 'session_form';


			$this->addDoctor();
			$this->addDate();
			$this->addName();
			$this->addGender();
			$this->addPhoneNumber();
			$this->addEmail();
			$this->addAddress();

			$this->customSubmit();
		}


		/*
		*auto select attending doctor
		*/
		public function addDoctor()
		{
			$doctor_model = model('DoctorModel');

			$doctors = $doctor_model->getAll();

			$doctors = arr_layout_keypair($doctors , ['user_id' , 'first_name@last_name']);

			$this->add([
				'type' => 'select',
				'name' => 'doctor_id',
				'options' => [
					'label' => ' Attending Doctor ',
					'option_values' => $doctors
				],
				'class' => 'form-control',
				'required' => true,
				'attributes' => [
					'id' => 'id_doctor_id'
				]
			]);
		}	

		public function addDate()
		{
			$this->add([
				'type' => 'date',
				'name' => 'date_created',
				'class' => 'form-control',
				'required' => true,
				'options' => [
					'label' => 'Date'
				],
				'value' => date('Y-m-d'),
				'attributes' => [
					'id' => 'id_date',
					'placeholder' => 'eg. Date'
				]
			]);
		}

		public function addName()
		{
			$this->add([
				'type' => 'text',
				'name' => 'guest_name',
				'class' => 'form-control',
				'required' => true,
				'options' => [
					'label' => 'Patient Name'
				],

				'attributes' => [
					'id' => 'id_guest_name',
					'placeholder' => 'eg. Firstname Lastname'
				]
			]);
		}

		public function addGender()
		{
			$this->add([
				'type' => 'select',
				'name' => 'guest_genders',
				'class' => 'form-control',
				'required' => true,
				'options' => [
					'label' => 'Gender',
					'option_values' => ['male' , 'female']
				],
			]);
		}


		public function addPhoneNumber()
		{
			$this->add([
				'type' => 'text',
				'name' => 'guest_phone',
				'class' => 'form-control',
				'required' => true,
				'options' => [
					'label' => 'Contact Number'
				],

				'attributes' => [
					'id' => 'id_phone',
					'placeholder' => 'eg. 09xxxxxxxxx'
				]
			]);
		}

		public function addEmail()
		{
			$this->add([
				'type' => 'email',
				'name' => 'guest_email',
				'class' => 'form-control',
				'options' => [
					'label' => 'Email'
				],

				'attributes' => [
					'id' => 'id_email',
					'placeholder' => 'eg. email@email.com'
				]
			]);
		}

		public function addAddress()
		{
			$this->add([
				'type' => 'textarea',
				'name' => 'guest_address',
				'class' => 'form-control',
				'options' => [
					'label' => 'Email'
				],

				'attributes' => [
					'id' => 'id_email',
					'placeholder' => 'home address',
					'rows' => 3
				]
			]);
		}


		public function addRemarks()
		{
			$this->add([
				'type' => 'textarea',
				'name' => 'remarks',
				'class' => 'form-control',
				'options' => [
					'label' => 'Remarks'
				],

				'attributes' => [
					'id' => 'id_remarks',
					'placeholder' => 'tell something about the patient',
					'rows' => 3
				]
			]);
		}

		public function addAppointment($id)
		{
			$this->add([
				'type' => 'hidden',
				'name' => 'appointment_id'
			]);
		}


		public function addDoctorRecommendation()
		{
			$this->add([
				'name' => 'doctor_recommendations',
				'type' => 'textarea',
				'class' => 'form-control',
				'options' => [
					'label' => 'Doctors Recommendation'
				]
			]);
		}
		

		public function addUser($id)
		{
			$this->add([
				'type' => 'hidden',
				'name' => 'user_id'
			]);
		}
		
	}