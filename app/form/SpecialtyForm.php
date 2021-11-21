<?php 
	namespace Form;

	load(['Form'] , CORE);
	use Core\Form;

	class SpecialtyForm extends Form
	{
		public function __construct()
		{
			parent::__construct();

			$this->name = 'specialty_form';

			$this->init([
				'url' => _route('specialty:create'),
			]);

			$this->addName();
			$this->addDescription();
			$this->addCategory();

			$this->customSubmit('Save');
		}


		public function addName()
		{
			$this->add([
				'name' => 'name',
				'type' => 'text',
				'requried' => '',
				'options' => [
					'label' => 'Field Specialty Name'
				],
				'class' => 'form-control',
			]);
		}

		public function addDescription()
		{
			$this->add([
				'name' => 'description',
				'type' => 'textarea',
				'requried' => '',
				'options' => [
					'label' => 'Description',
				],
				'attributes' => [
					'placeholder' => 'Describe Your Specialty'
				],
				'class' => 'form-control',
			]);
		}

		public function addCategory()
		{
			$category_model = model('CategoryModel');

			$categories = $category_model->getAll([
				'order' => 'category',
				'where' => [
					'cat_key' => 'SPECIALTIES'
				]
			]);

			$categories = arr_layout_keypair($categories , ['id' , 'category']);

			$this->add([
				'name' => 'category_id',
				'type' => 'select',
				'requried' => '',
				'options' => [
					'label' => 'Category Id',
					'option_values' => $categories
				],
				'class' => 'form-control',
			]);
		}
	}