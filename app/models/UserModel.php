<?php 

	class UserModel extends Model
	{

		public $table = 'users';

		protected $_fillables = [
			'id',
			'user_code' ,
			'first_name',
			'middle_name',
			'last_name',
			'birthdate',
			'gender',
			'address',
			'phone_number',
			'email',
			'username',
			'password',
			'created_at',
			'created_by',
			'user_type',
			'profile',
			'updated_at'
		];


		public function save($user_data , $id = null)
		{
			$fillable_datas = $this->getFillablesOnly($user_data);

			$validated = $this->validate($fillable_datas , $id );

			if(!$validated) return false;
				

			if( !is_null($id) )
			{
				return parent::update($fillable_datas , $id);
			}else{
				$fillable_datas['user_code'] = $this->generateCode($user_data['user_type']);
				return parent::store($fillable_datas);
			}
		}


		private function validate($user_data , $id = null)
		{
			if(isset($user_data['email']))
			{
				$is_exist = $this->getByKey('email' , $user_data['email'])[0] ?? '';

				if( $is_exist && !isEqual($is_exist->id , $id) ){
					$this->addError("Email {$user_data['email']} already used");
					return false;
				}
			}

			if(isset($user_data['username']))
			{
				$is_exist = $this->getByKey('username' , $user_data['username'])[0] ?? '';

				if( $is_exist && !isEqual($is_exist->id , $id) ){
					$this->addError("Username {$user_data['email']} already used");
					return false;
				}
			}

			if(isset($user_data['phone_number']))
			{
				$is_exist = $this->getByKey('phone_number' , $user_data['phone_number'])[0] ?? '';

				if( $is_exist && !isEqual($is_exist->id , $id) ){
					$this->addError("Phonne Number {$user_data['email']} already used");
					return false;
				}
			}

			return true;
		}

		public function create($user_data)
		{
			$res = $this->save($user_data);

			if(!$res) {
				$this->addError("Unable to create user");
				return false;
			}

			$this->addMessage("User {$user_data['first_name']} Created");

			return $res;
		}

		public function update($user_data , $id)
		{
			$res = $this->save($user_data , $id);

			if(!$res) {
				$this->addError("Unable to create user");
				return false;
			}

			$this->addMessage("User {$user_data['first_name']} has been updated!");

			return true;
		}

		public function getByKey($column , $key , $order = null)
		{
			if( is_null($order) )
				$order = $column;

			return parent::getAssoc($column , [
				$column => "{$key}"
			]);
		}


		public function getAll($params = [] )
		{
			return parent::getAssoc('first_name' ,);
		}

		public function generateCode($user_type)
		{
			$pfix = null;

			switch(strtolower($user_type))
			{
				case 'admin':
					$pfix = 'ADMN';
				break;

				case 'patient':
					$pfix = 'CX';
				break;

				case 'doctor':
					$pfix = 'DOC';
				break;
			}

			$last_id = $this->last()->id ?? 000;

			return $pfix.get_token_random_char(4).$last_id;
			
		}
	}