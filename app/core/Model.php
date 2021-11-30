<?php
	
 	abstract class Model extends ModelCore
	 {

		private $_error = [];
		private static $instance = null;

		protected static $MESSAGE_UPDATE_SUCCESS = "UPDATED SUCCESFULLY";
		protected static $MESSAGE_CREATE_SUCCESS = "CREATED SUCCESFULLY";
		protected static $MESSAGE_DELETE_SUCCESS = "DELETED SUCCESFULLY";
		
		
		public function getFillablesOnly($datas)
		{
			$return = [];

			foreach($datas as $key => $row) {
				if( isEqual($key, $this->_fillables) )
					$return[$key] = $row;
			}
			return $return;
		}

 		public function __construct()
 		{

 			$this->db = new Database(DBVENDOR , DBHOST , DBNAME , DBUSER , DBPASS);


 			$this->dbHelper = new DatabaseHelper( Database::getInstance() );


 			$this->prefix  = DB_PREFIX;
		 }

		public function store($values)
		{
			$data = [
				$this->table,
				$values
			];

			return $this->saveId($this->dbHelper->insert(...$data));
		}

		public function update($values , $id)
		{
			$data = [
				$this->table,
				$values,
				"id = '{$id}'"
			];

			return $this->dbHelper->update(...$data);
		}

		public function delete($id)
		{
			$data = [
				$this->table,
				"id = '{$id}'"
			];

			return $this->dbHelper->delete(...$data);
		}
		
		public function deleteByKey($keyValuePair = [])
		{
			if( empty($keyValuePair) )
				return false;

			$WHERE = null;

			$counter = 0;

			foreach($keyValuePair as $key => $value)
			{
				if( $counter > 0)
					$WHERE .= " AND ";

				$WHERE .= "{$key} = '{$value}'";

				$counter++;
			}

			$data = [
				$this->table,
				$WHERE
			];

			return $this->dbHelper->delete(...$data);
		}

		public function get($id)
		{
			$data = [
				$this->table ,
				'*',
				"id = '{$id}'"
			];

			return $this->dbHelper->single(...$data);
		}

		public function all($where = null , $order_by = null , $limit = null)
		{

			if(!is_null($where))
			{
				if(is_array($where)) {
					$where = $this->conditionEqual($where);
				}
			}

			$data = [
				$this->table ,
				'*',
				$where,
				$order_by,
				$limit
			];
			return $this->dbHelper->resultSet(...$data);
		}


		public function single(array $where, $fields = '*' , $orderBy = null)
		{
			$whereString = $this->conditionEqual($where);

			$data = [
				$this->table ,
				$fields, 
				$whereString,
				$orderBy
			];
			
			return $this->dbHelper->single(...$data);
		}

		public function getAssoc($field , $where = null)
	    {
			if(is_array($where))
			$where = $this->conditionEqual($where);

			$data = [
				$this->table,
				'*',
				$where,
				"$field ASC"
			];

	      return $this->dbHelper->resultSet(...$data);
	    }

	    public function getDesc($field , $where = null)
	    {
		  if(is_array($where))
			$where = $this->conditionEqual($where);

	      $data = [
	        $this->table,
	        '*',
	        $where,
	        "$field DESC"
	      ];

	      return $this->dbHelper->resultSet(...$data);
	    }

		public function first()
		{
			$data = [
				$this->table ,
				'*',
				null,
				'id asc',
				'1'
			];
			
			return $this->dbHelper->single(...$data);
		}

		public function last()
		{
			$data = [
				$this->table ,
				'*',
				null,
				'id desc',
				'1'
			];
			
			return $this->dbHelper->single(...$data);
		}

    final public function dbData($data)
    {
      $this->data = $data;
    }

    final public function getdbData($property = null)
    {
      if(is_null($property))
        return $this->data;

      return $this->data->$property;
    }


	public function filter($filters)
	{
		$filterCondition = '';

		$counter = 0;

		$fields = array_keys($filters);
		foreach($fields as $key => $val)
		{
			if($counter < $key) {

				$filterCondition .= " AND ";
				$counter++;
			}

			$filterCondition .= " {$val} like '%{$filters[$val]}%'";
		}

		return $filterCondition;
	}

	final public function add_model($varname , $instance)
	{
		$this->$varname = $instance;
	}


	final protected function saveId($id)
	{
		$this->database['id'] = $id;
		return $id;
	}

	final public function getId()
	{
		if(isset($this->database['id']))
			return $this->database['id'];
		return die("Saved Id Not Found");
	}


	final public function conditionEqual($params)
	{
		$WHERE = '';

		if( is_array($params) )
		{
			$counter = 0;
			$increment = 0;

			foreach($params as $key => $row) 
			{
				if($counter < $increment){
					$WHERE .= ' AND ';
					$counter++;
				}

				$WHERE .= " $key = '{$row}'";

				$increment++;
			}

		}else
		{
			$WHERE = $params;
		}

		return $WHERE;
	}

	public function conditionConvert($params , $defaultCondition = '=')
		{
			$WHERE = '';
			$counter = 0;

			$errors = [];

			/*
			*convert-where default concatinator is and
			*add concat on param values to use it
			*/
			$condition_operation_concatinator = 'AND';

			foreach($params as $key => $param_value) 
			{	
				if( $counter > 0)
					$WHERE .= " {$condition_operation_concatinator} "; //add space

				/*should have a condition*/
				if( is_array($param_value) && isset($param_value['condition']) ) 
				{
					$condition_operation_concatinator = $param_value['concatinator'] ?? $condition_operation_concatinator;

					//check for what condition operation
					$condition = $param_value['condition'];
					$condition_values = $param_value['value'];

					if( isEqual($condition , ['between' , 'not between']))
					{
						if( !is_array($condition_values) )
							return _error(["Invalid query" , $params]);
						if( count($condition_values) < 2 )
							return _error("Incorrect between condition");

						$condition = strtoupper($condition);

						list($valueA, $valueB) = $condition_values;
							$WHERE .= " {$key} {$condition} '{$valueA}' AND '{$valueB}'";
					}

					if( isEqual($condition , ['equal' , 'not equal' , 'in']) )
					{
						$conditionKeySign = '=';

						if( isEqual($condition , 'not equal') )
							$conditionKeySign = '!=';

						if( isEqual( $condition , 'in'))
							$conditionKeySign = ' IN ';

						if( is_array($condition_values) )
						{
							$WHERE .= "{$key} $conditionKeySign ('".implode("','",$condition_values)."') ";
							// $WHERE .= "{$key} {$conditionKeySign} '".implode("','",$condition_values)."'";
						}else
						{
							$WHERE .= "{$key} {$conditionKeySign} '{$condition_values}' ";
						}
					}

					/*
					*if using like
					*add '%' on value 
					*/
					if( isEqual($condition , 'like') )
					{
						$conditionKeySign = 'like';
						$WHERE .= "{$key} {$conditionKeySign} '{$condition_values}'";
					}

					$counter++;

					continue;
				}

				if( isEqual($defaultCondition , 'like')) 
					$WHERE .= " $key {$defaultCondition} '%{$param_value}%'";

				if( isEqual($defaultCondition , '=')) 
				{
					$isNotCondition = substr( $param_value , 0 ,1); //get exlamation
					$isNotCondition = stripos($isNotCondition , '!');

					if( $isNotCondition === FALSE )
					{
						$WHERE .= " $key = '{$param_value}'";
					}else{
						
						$cleanRow = substr($param_value , 1);

						$WHERE .= " $key != '{$cleanRow}'";
					}
				}

				$counter++;
			}

			// dump($WHERE);


			return $WHERE;
		}
		
 }
