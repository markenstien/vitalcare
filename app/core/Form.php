<?php
	namespace Core;

	load(['FormBuilder'], CORE);

	abstract class Form
	{
		private $_form = null;

		private $_form_param = [];

		private $_method = 'post';
		private $_url = '';

		private $_form_head = [];

		private $_items = [];
		protected $name = 'CORE_FORM';


		public function __construct()
		{
			$this->_form = new FormBuilder();
		}


		public function init($params = [])
		{
		    $form_param = [];

			$form_param['method'] = strtoupper($params['method'] ?? $this->_method);
			$form_param['url'] = strtoupper($params['url'] ?? $this->_url);

			if( isset($params['enctype']))
				$form_param['enctype'] = 'multipart/form-data';


			if( isset($params['attributes']) )
				$form_param = array_merge( $form_param , $params['attributes']);

			$this->_form_param = $form_param;
		}

		public function start()
		{
			return $this->_form->open( $this->_form_param );
		}

		public function end()
		{
			return $this->_form->close();
		}

		public function add($params = [])
		{
			
			$type = strtolower(trim($params['type']));
			$name = $params['name'];
			$value = $params['value'] ?? '';
			$classAndAddtributes = $this->mergeAddtributeAndClass($params);
			$option_values = $params['options']['option_values'] ?? [];
			$label = $params['options']['label'] ?? null;

			//for password only
			$preserve = $params['preserve'] ?? false;

			$this->_items[$name] = [
				'name' => $name,
				'type' => $type,
				'value' => $value,
				'attributes' => $classAndAddtributes,
				'option_values' => $option_values,
				'label'  => $label
			];
		}

		public function getRaw($name)
		{
			$item = $this->_items[$name];

			if(!$item) 
				echo die("Form $this->name input {$name} does not exists!!");

			return $item;
		}

		public function getFormRaw()
		{
			return [
				'form' => $this->_form_param,
				'inputs' => $this->_items
			];
		}

		public function get($name)
		{
			$item = $this->getRaw($name);

			switch( $item['type'] )
			{
				case 'text':
				case 'hidden':
				case 'checkbox':
				case 'radio':
				case 'textarea':
				case 'submit':
				case 'number':
				case 'date':
				case 'time':
					return $this->_form->call( $item['type'] , $item['name'], $item['value'] , $item['attributes'] );
				break;

				case 'password':
					return Form::password($item['name'], $item['value'] , $item['attributes'] , $item['preserve']);
				break;

				case 'file':
					return Form::file($item['name'], $item['attributes']);
				break;
			}
		}

		/**
		 * labelname and input row format*/
		public function getCol($name)
		{
			$item = $this->getRaw($name);
			if(!isset($item['label']))
				echo die("Cannot create Column {$name} , No Label specified");

			$form_label = $this->_form->label($item['label'] , $item['attributes']['id'] ?? '#');
			$form_input = $this->get($name);
			return <<<EOF
				{$form_label}
				{$form_input}
			EOF;
		}

		/**
		 * labelname and input row format*/
		public function getRow($name)
		{
			$item = $this->getRaw($name);
			if(!isset($item['label']))
				echo die("Cannot create Column {$name} , No Label specified");

			$form_label = $this->_form->label($item['label'] , $item['attributes']['id'] ?? '#');
			$form_input = $this->get($name);
			
			return <<<EOF
				<div class='row'>
					<div class='col-md-4'>{$form_label}</div>
					<div class='col-md-8'>{$form_input}</div>
				</div>
			EOF;
		}

		public function rebuild($name , $params = [])
		{

		}



		private function mergeAddtributeAndClass( $params )
		{
			$valid_array_param = [];

			if( isset($params['attributes']) )
				$valid_array_param = array_merge($valid_array_param , $params['attributes']);

			if( isset($params['class']))
				$valid_array_param['class'] = $params['class'];

			if( isset($params['required']))
				$valid_array_param = array_merge($valid_array_param , $params['required']);


			return $valid_array_param;
		}

	} 
