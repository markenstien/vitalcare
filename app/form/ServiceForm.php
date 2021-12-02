<?php
	namespace Form;
	loadTo(['Form'] , CORE);
	use Core\Form;

	class ServiceForm extends Form 
	{

		public function __construct()
		{
			parent::__construct();

			$this->name = 'service_form';

			$this->init([
				'url' => _route('service:create')
			]);

			$this->addService();
			$this->addPrice();
			$this->addStatus();
			$this->addDescription();
			$this->addCategory();
			$this->addVisible();


			$this->addSubmit();
		}

		public function addService()
		{
			$this->add([
				'type' => 'text',
				'name' => 'service',
				'class' => 'form-control',
				'required' => true,

				'options' => [
					'label' => 'Service Name'
				],

				'attributes' => [
					'class' => 'form-control'
				]
			]);
		}

		public function addPrice()
		{
			$this->add([
				'type' => 'number',
				'name' => 'price',
				'class' => 'form-control',
				'required' => true,
				'options' => [
					'label' => 'Price'
				],
				'attributes' => [
					'class' => 'form-control'
				]
			]);
		}

		public function addStatus()
		{
			$this->add([
				'type' => 'select',
				'name' => 'status',
				'class' => 'form-control',
				'required' => true,
				'options' => [
					'label' => 'Status',
					'option_values' => [
						'available' , 'not-available'
					]
				],
				'attributes' => [
					'class' => 'form-control'
				]
			]);
		}

		public function addDescription()
		{
			$this->add([
				'type' => 'textarea',
				'name' => 'description',
				'class' => 'form-control',
				'required' => true,
				'options' => [
					'label' => 'Description'
				],
				'attributes' => [
					'class' => 'form-control',
					'rows'  => 3
				]
			]);
		}

		public function addCategory()
		{
			$category_model = model('CategoryModel');

			$option_values = $category_model->getAll([
				'order' => 'category',
				'where' => [
					'cat_key' => 'SERVICES'
				]
			]);

			$option_values = arr_layout_keypair($option_values, ['id' , 'category']);

			$this->add([
				'type' => 'select',
				'name' => 'category_id',
				'required' => true,

				'options' => [
					'label' => 'Service Category',
					'option_values' => $option_values
				],

				'class' => 'form-control'
			]);
		}

		public function addVisible()
		{
			$this->add([
				'type' => 'select',
				'name' => 'status',
				'class' => 'form-control',
				'required' => true,
				'options' => [
					'label' => 'Visible',
					'option_values' => [
						0 => 'Visible',
						1 => 'Not Visible'
 					]
				],
				'attributes' => [
					'class' => 'form-control'
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
				'value' => 'Save'
			]);
		}

	}