<?php 
	
	namespace Form;

	load(['Form'] , CORE);

	use Core\Form;

	class DoctorSpecializationForm extends Form
	{

		public function __construct()
		{
			parent::__construct();

			$this->url = _route('doc-special:create');

			$this->name = 'doc_specialization_form';

			$this->addDoctor();
			$this->addSpecialty();
			$this->addNotes();

			$this->customSubmit('Add Specialization');
		}


		public function addDoctor()
		{
			$doctor_model = model('DoctorModel');
			$doctors = $doctor_model->getAll();
			$doctors = arr_layout_keypair($doctors, ['user_id' , 'first_name@last_name']);

			$this->add([
				'type'  => 'select',
				'name'  => 'doctor_id',
				'options' => [
					'label' => 'Doctor',
					'option_values' => $doctors
				],
				'required' => true,
				'class' => 'form-control'
			]);
		}

		public function addSpecialty()
		{
			$specialty_model = model('SpecialtyModel');
			$specialties = $specialty_model->getAll();
			
			$specialties = arr_layout_keypair($specialties, ['id' , 'name']);

			$this->add([
				'type'  => 'select',
				'name'  => 'specialty_id',
				'options' => [
					'label' => 'Specialties',
					'option_values' => $specialties
				],
				'required' => true,
				'class' => 'form-control'
			]);
		}


		public function addNotes()
		{
			$this->add([
				'type'  => 'textarea',
				'name'  => 'notes',
				'options' => [
					'label' => 'Notes'
				],
				'required' => true,
				'class' => 'form-control'
			]);
		}
	}