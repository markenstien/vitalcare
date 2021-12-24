<?php 
	class AddressModel extends Model
	{
		public $table = 'address';

		protected $_fillables = [
			'block_house_number',
			'street',
			'city',
			'barangay',
			'zip'
		];

		public function createOrUpdate($address_data , $id = null)
		{
			$_fillables = $this->getFillablesOnly($address_data);
			//create
			if( is_null($id) )
			{
				return parent::store( $_fillables );
			}else{
				return parent::update( $_fillables , $id );
			}
		}

		public function getConcat($id)
		{
			$address = parent::get($id);

			return "{$address->block_house_number} , {$address->street} {$address->barangay} {$address->city} {$address->zip} zip code.";
		}
	}