<?php

	class BillItemModel extends Model
	{

		public $table = 'bill_items';

		private $_prepared_items = [];

		private $_bill_id = null;


		public function getByDate($start_date , $end_date)
		{	
			$this->db->query(
				"SELECT * FROM {$this->table}
					WHERE date(created_at)
						between '{$start_date}' and '{$end_date}' "
			);

			return $this->db->resultSet();
		}

		public function getItemsByBill($bill_id)
		{
			return parent::getAssoc('name' , [
				'bill_id' => $bill_id
			]);
		}

		public function setBillId($bill_id)
		{
			$this->_bill_id = $bill_id;
		}

		public function prepareItem( $name , $description , $price)
		{
			array_push($this->_prepared_items , compact(['name' , 'description' , 'price']));
		}

		public function addItem($item)
		{
			if( isset($item['name'] , $item['description'] , $item['price']))
				array_push( $this->_prepared_items , $item);
		}

		public function saveItems()
		{
			foreach( $this->getItems() as $item )
			{	
				$item['bill_id'] = $this->_bill_id;
				parent::store($item);
			}

			return true;
		}

		public function getItems()
		{
			$items = $this->_prepared_items;

			return $items;
		}
	}