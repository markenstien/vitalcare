<?php
	
 	abstract class Model extends ModelCore
	 {

		private $_error = [];
		private static $instance = null;
		
		
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

		return $WHERE;
	}
 }
