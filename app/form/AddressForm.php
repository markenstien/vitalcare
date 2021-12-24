<?php
	namespace Form;

	use Core\Form;
	load(['Form'] , CORE);

	class AddressForm extends Form
	{

		public function __construct()
		{
			parent::__construct();

			$this->name = 'address_form';

			$this->addBlockHouseNumber();
			$this->addStreet();
			$this->addBarangay();
			$this->addCity();
			$this->addZip();

			$this->customSubmit('Save Address');
		}

		public function addBlockHouseNumber()
		{
			$this->add([
				'type' => 'text',
				'name' => 'block_house_number',
				'required' => true,
				'options' => [
					'label' => 'Block and house number'
				],
				'class' => 'form-control'
			]);
		}

		public function addStreet()
		{
			$this->add([
				'type' => 'text',
				'name' => 'street',
				'required' => true,
				'options' => [
					'label' => 'Street'
				],
				'class' => 'form-control'
			]);
		}

		public function addCity()
		{
			$this->add([
				'type' => 'text',
				'name' => 'city',
				'required' => true,
				'options' => [
					'label' => 'City'
				],
				'class' => 'form-control'
			]);
		}

		public function addBarangay()
		{
			$this->add([
				'type' => 'text',
				'name' => 'barangay',
				'required' => true,
				'options' => [
					'label' => 'Barangay'
				],
				'class' => 'form-control'
			]);
		}

		public function addZip()
		{
			$this->add([
				'type' => 'text',
				'name' => 'zip',
				'required' => true,
				'options' => [
					'label' => 'Zip'
				],
				'class' => 'form-control'
			]);
		}


		public function addModule($module)
		{
			$this->add([
				'type' => 'hidden',
				'name' => 'module_key',
				'value' => $module,
			]);
		}

		public function addModuleId($module_id)
		{
			$this->add([
				'type' => 'hidden',
				'name' => 'module_id',
				'value' => $module_id
			]);
		}

		public function addRedirecTo($redirectTo)
		{
			$this->add([
				'type' => 'hidden',
				'name' => 'redirectTo',
				'value'=> $redirectTo
			]);
		}

		public function addAddressId($address_id)
		{
			$this->add([
				'type' => 'hidden',
				'name' => 'address_id',
				'value' => $address_id
			]);
		}
	}