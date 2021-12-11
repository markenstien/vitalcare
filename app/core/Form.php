<?php
	namespace Core;

	load(['FormBuilder'], CORE);

	abstract class Form
	{

		protected $_type = 'crud';

		protected $_form = null;

		protected $_form_param = [];

		protected $_method = 'post';
		protected $_url = '';

		protected $_form_head = [];

		protected $_items = [];
		protected $name = 'CORE_FORM';


		public function __construct()
		{
			$this->_form = new FormBuilder();
		}


		public function init($params = [])
		{
		    $form_param = [];

			$form_param['method'] = strtoupper($params['method'] ?? $this->_method);
			$form_param['url'] = $params['url'] ?? $this->_url;
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

		public function remove($name)
		{
			$items = $this->_items;

			foreach( $items as $key => $item )
			{
				if( $item['name'] == $name ){
					unset($items[$key]);
				}
			}

			$this->_items = $items;
		}

		public function add($params = [])
		{
			
			$type = strtolower(trim($params['type']));
			$name = $params['name'];
			$value = $params['value'] ?? '';
			$classAndAddtributes = $this->mergeAddtributeAndClass($params);
			$option_values = $params['options']['option_values'] ?? [];

			//for password only
			$preserve = $params['preserve'] ?? false;

			$label   = $params['options']['label'] ?? '';

			$item = [
				'name' => $name,
				'type' => $type,
				'value' => $value,
				'attributes' => $classAndAddtributes,
				'option_values' => $option_values,
				'preserve' => $preserve
			];

			if( isset($params['required']) )
			{
				if( $params['required'] === FALSE) 
				{
					unset($params['required']);
				}else
				{
					if( isset($params['options']['label'])){
						$label .= " * ";
					}
					
					$item['required'] = TRUE;
				}
					
			}

			$item['label'] = $label;

			$this->_items[$name] = $item;
		}

		public function addAfter($after_key , $item)
		{
			$this->add($item);

			$key_to_move = $item['name'];

			//get items
			$array = $this->_items;
			//get item keys
			$array_keys = array_keys($array);
			//key_to_move_position
			$key_to_move_position = array_search($key_to_move , $array_keys);
			//get after key position
			$key_after_position = array_search($after_key , $array_keys);
			//unset to move key to avoid duplication
			unset($array_keys[$key_to_move_position]);
			//key to move , put after the after key index
			array_splice($array_keys , ($key_after_position + 1) , 0 , [$key_to_move]);
			//reorder
			$new_order = [];

			foreach($array_keys as $pos => $key)
			{
				$new_order[$key] = $array[$key];
			}

			$this->_items = $new_order;
		}

		public function checkField($name)
		{
			return $this->_items[$name] ?? false;
		}

		public function getRaw($name , $attributes = [])
		{
			$item = $this->_items[$name] ?? false;

			if(!$item){
				echo die("Form $this->name input {$name} does not exists!!");
				return false;
			}

			if( isset($attributes['input']) )
				$item = $this->overwriteParams($item , $attributes['input']);

			return $item;
		}

		public function getFormRaw()
		{
			return [
				'form' => $this->_form_param,
				'inputs' => $this->_items
			];
		}

		/*
		*add attributes
		*/
		public function get($name , $attributes = [])
		{	
			$item = $this->getRaw($name);

			/*
			*so we can overwrite the input attrivutes
			*temporary to strictly apply required atrribute
			*/
			if( empty($attributes) )
				$attributes = $item['attributes'];

			$item = $this->overwriteParams($item , $attributes);
			switch( $item['type'] )
			{
				case 'text':
				case 'email':
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
					return $this->_form->password($item['name'], $item['value'] , $item['attributes'] , $item['preserve']);
				break;

				case 'file':
					return $this->_form->file($item['name'], $item['attributes']);
				break;

				case 'select':
					return $this->_form->select($item['name'] , $item['option_values'] , $item['value'] , $item['attributes']);
				break;
			}
		}

		/**
		 * labelname and input row format*/
		public function getCol($name , $attributes = [])
		{
			$item = $this->getRaw($name);
			
			if( !isEqual($item['type']  , ['hidden' , 'submit']) && !isset($item['label'])){
				echo die("Cannot create Column {$name} , No Label specified");
			}

			$form_label = $this->_form->label($item['label'] , $item['attributes']['id'] ?? '#');
			$form_input = $this->get($name ,$attributes);
			return <<<EOF
				<div> 
					{$form_label}
					{$form_input}
				</div>
			EOF;
		}


		public function label($name)
		{
			$item = $this->getRaw($name);
			$form_label = $this->_form->label($item['label'] , $item['attributes']['id'] ?? '#');
			return $form_label;
		}

		/**
		 * labelname and input row format*/
		public function getRow($name , $attributes = [])
		{
			$item = $this->getRaw($name);

			if( !isEqual($item['type']  , ['hidden' , 'submit']) && !isset($item['label'])){
				echo die("Cannot create Column {$name} , No Label specified");
			}

			$form_label = $this->_form->label($item['label'] , $item['attributes']['id'] ?? '#');

			$form_input = $this->get($name ,$attributes);
			
			return <<<EOF
				<div class='row mb-2'>
					<div class='col-md-3'>{$form_label}</div>
					<div class='col-md-9'>{$form_input}</div>
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

			return $valid_array_param;
		}

		private function overwriteParams($attributes , $new_attributes)
		{

			
			foreach($new_attributes as $new_attr_key => $new_attr)
			{
				if( $new_attr_key == 'required')
				{
					if( $new_attr_key === FALSE){
						unset($new_attributes['required']);
						unset($attributes['required']);
					}else{
						$attributes['requried'] = TRUE;
					}
				}

				$isset = isset($attributes[$new_attr_key]);

				if( isset($isset) && is_array($new_attr) )
				{
					foreach($new_attr as $new_attr_attr_key => $new_attr_attr){
						$attributes[$new_attr_key][$new_attr_attr_key] = $new_attr_attr;
					}
				}else
				{
					$attributes[$new_attr_key] = $new_attr;
				}
			}

			if( isset($attributes['required']) )
			{
				//add required to attributes as item
				$attributes['attributes']['required'] = $attributes['required'];
				unset($attributes['required']);
			}
			
			return $attributes;
		}


		public function setType( $type )
		{
			$this->_type = $type;
		}

		public function setValue($name , $value)
		{
			$this->_items[$name]['value'] = $value;
		}


		public function setValueObject($object)
		{
			$return = [];

			$items = $this->_items;

			foreach($items as $key => $item) 
			{
				$name = trim($item['name']);//column_name equivalent

				if( isset($object->$name) )
					$items[$key]['value'] = $object->$name;
			}

			$this->_items = $items;

			return $items;
		}

		public function setUrl($url)
		{
			$this->_form_param['url'] = $url;
		}

		public function addId($id)
		{
			$this->add([
				'type' => 'hidden',
				'value' => $id,
				'name'  => 'id'
			]);
		}

		public function getId()
		{
			$id = $this->getRaw('id');

			if(!$id){
				echo die("Form {$this->name} input Id field not found");
				return false;
			}
			return $this->get('id');
		}


		public function getForm($inputType = 'row')
		{
			$html = '';

			$html .= $this->start();

			$items = $this->_items;

			foreach($items as $item) 
			{
				if( isEqual($item['type'] , ['submit' , 'hidden']) )
				{
					$btn = $this->get($item['name']);

					$html .= <<<EOF
						<div>
							{$btn}
						</div>
					EOF;

				}else
				{
					$label_input_bundle = $this->getRow($item['name']);

					$html .= <<<EOF
						<div class='form-group mb-2'>
							{$label_input_bundle}
						</div>
					EOF;
				}
			}

			$html .= $this->end();

			return $html;
		}

		final public function customSubmit($value = null , $name = null, $attributes = null)
		{
			$this->add([
				'type' => 'submit',
				'name' => $name ?? 'submit',
				'value' => $value ?? 'save',
				'attributes' => $attributes ?? [],
				'class' => 'btn btn-primary'
			]);
		}
	} 