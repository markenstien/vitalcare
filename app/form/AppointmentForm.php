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
			$this->addGuestName();
			$this->addGuestEmail();
			$this->addGuestPhoneNumber();
			$this->addType();
			$this->addStatus();
			
			$this->customSubmit('Reserve');
		}

		public function addDate()
		{
			$this->add([
				'type' => 'date',
				'name' => 'date',
				'class' => 'form-control',
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
						'pending', 'arrived', 'cancelled'
					]
				]
			]);
		}
	}