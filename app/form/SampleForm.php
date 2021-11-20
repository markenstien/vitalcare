<?php
	namespace Form;
	load(['Form'] , CORE);

	use Core\Form;

	class SampleForm extends Form
	{
		
		public function __construct()
		{
			parent::__construct();


			$this->name = 'doctor_form';

			$this->addFirstName();

		}

		public function addFirstName()
		{

			$this->add([
				'name' => 'first_name',
				'type' => 'text',
				'class' => 'form-control',
				'options' => [
					'label' => 'First Name'
				],
				'value' => 'abcd',

				'attributes' => [
					'data-name' => 'asdasd',
					'placeholder' => 'aasdasd',
					'id'  => 'id_first_name'
				]
			]);
		}

	}