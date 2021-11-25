<?php 
	
	namespace Form;
	use Core\Form;

	load(['Form'] , CORE);

	class ServiceBundleForm extends Form
	{
		public function __construct()
		{
			parent::__construct();

			$this->name = 'service_bundle_form';

			// $this->init();

			$this->addName();
			$this->addCategory();
			$this->addDescription();
			$this->addPriceCustom();
			$this->addDiscount();
			$this->addStatus();
			$this->addVisiblity();
			$this->customSubmit('Save');
		}

		public function addName()
		{
			$this->add([
				'type' => 'text',
				'name' => 'name',
				'required' => true,
				'class' => 'form-control',

				'options' => [
					'label' => 'Bundle Name'
				]
			]);
		}


		public function addDescription()
		{
			$this->add([
				'type' => 'textarea',
				'name' => 'description',
				'required' => true,
				'class' => 'form-control',

				'options' => [
					'label' => 'Description'
				],
				'attributes' => [
					'rows' => 3
				]
			]);
		}

		public function addPriceCustom()
		{
			$this->add([
				'type' => 'text',
				'name' => 'price_custom',
				'class' => 'form-control',

				'options' => [
					'label' => 'Custom Price'
				]
			]);
		}

		public function addDiscount()
		{
			$this->add([
				'type' => 'text',
				'name' => 'discount',
				'class' => 'form-control',

				'options' => [
					'label' => 'Discount'
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
				'value' => 'available',
				'options' => [
					'label' => 'Status',
					'option_values' => [
						'available', 'unavailable'
					]
				]
			]);
		}

		public function addVisiblity()
		{
			$this->add([
				'type' => 'select',
				'name' => 'is_visible',
				'class' => 'form-control',
				'required' => true,
				'value' => 1,
				'options' => [
					'label' => 'Visible to public',
					'option_values' => [
						1 => 'Visible',
						0 => 'Not Visible' ,
					]
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
				'class' => 'form-control',
				'required' => true,
				'value' => 'available',
				'options' => [
					'label' => 'Category',
					'option_values' => $option_values
				]
			]);
		}
	}