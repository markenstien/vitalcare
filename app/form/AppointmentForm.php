<?php 

	namespace Form;
	load(['Form'] , CORE);

	use Core\Form;
	
	class AppointmentForm extends Form
	{

		public function __construct()
		{	
			parent::__construct();

			$this->init([
				'url' => _route('appointment:createWithBill')
			]);

			$this->addDate();
			$this->addStartTime();
			$this->addGuestName();
			$this->addGuestEmail();
			$this->addGuestPhoneNumber();
			$this->addType();

			if( isEqual(auth('user_type') , ['admin' , 'doctor']))
				$this->addStatus();
			
			$this->customSubmit('Reserve');
		}

		public function addDate()
		{
			$this->add([
				'type' => 'date',
				'name' => 'date',
				'class' => 'form-control',
				'required' => true,
				'options' => [
					'label' => 'Date'
				]
			]);
		}

		public function addGuestName()
		{
			$this->add([
				'type' => 'text',
				'name' => 'guest_name',
				'class' => 'form-control',
				'required' => true,
				'options' => [
					'label' => 'Full Name'
				]
			]);
		}

		public function addGuestEmail()
		{
			$this->add([
				'type' => 'email',
				'name' => 'guest_email',
				'class' => 'form-control',
				'required' => true,
				'options' => [
					'label' => 'Email'
				]
			]);
		}

		public function addGuestPhoneNumber()
		{
			$this->add([
				'type' => 'number',
				'name' => 'guest_phone',
				'class' => 'form-control',
				'required' => true,
				'options' => [
					'label' => 'Phone Number'
				]
			]);
		}

		public function addType()
		{
			$this->add([
				'type' => 'select',
				'name' => 'type',
				'class' => 'form-control',
				'options' => [
					'label' => 'Type',
					'option_values' => [
						'online' , 'walk-in'
					]
				]
			]);
		}

		public function addStartTime()
		{
			$this->add([
				'type' => 'time',
				'name' => 'start_time',
				'class' => 'form-control',
				'required' => true,
				'options' => [
					'label' => 'Time of Arrival'
				]
			]);
		}

		public function addStatus( $value = 'pending')
		{
			$this->add([
				'type' => 'select',
				'name' => 'status',
				'class' => 'form-control',
				'value' => $value,
				'options' => [
					'label' => 'Status',
					'option_values' => [
						'pending', 'arrived', 'cancelled','scheduled'
					]
				]
			]);
		}
	}