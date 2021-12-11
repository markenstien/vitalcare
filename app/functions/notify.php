<?php
	
	function _notify($message , $recipientIds , $attributes = [])
	{
		$db = Database::getInstance();

		if( !is_array($recipientIds) || empty($recipientIds) )
		{ echo die("Recipients must be array"); }

		$icon = $attributes['icon'] ?? '';
		$color = $attributes['color'] ?? '';
		$heading = $attributes['heading'] ?? '';
		$subtext = $attributes['subtext'] ?? '';
		$href = $attributes['href'] ?? '';


		$db->query(
			"INSERT INTO system_notifications(message , icon , color , heading , subtext , href)
				VALUES('{$message}' , '{$icon}' , '{$color}' , '{$heading}' , '{$subtext}' , '{$href}')"
		);

		$is_ok = $db->execute();

		if($is_ok)
		{
			$notification_id = $db->lastInsertId();

			$sql = " INSERT INTO system_notification_recipients(notification_id , recipient_id , is_read) VALUES ";

			foreach($recipientIds as $index => $id) 
			{
				if( $index > 0){
					$sql .= ' , ';
				}
				$sql .= "('{$notification_id}' , '{$id}' , false) ";
			}

			$db->query($sql);
			return $db->execute();
		}else{
			Flash::set("Error to save notification" , 'danger');
			return false;
		}
	}


	function _notify_operations($message , $attributes = [])
	{	
		/*
		*recipient id's must be changeable always
		*/

		$user_model = model('UserModel');

		$users = $user_model->getAll([
			'where' => [
				'user_type' => [
					'condition' => 'in',
					'value' => ['doctor' , 'admin']
				]
			]
		]);


		if($users) 
		{
			$recipientIds = [];
			foreach($users as $user){
				array_push($recipientIds , $user->id);
			}
			_notify( $message , $recipientIds , $attributes);
		}
		
	}


	function _notify_include_email( $message , $recipientIds , $emails  , $attributes = [])
	{
		__notify($message , $recipientIds , $attributes);

		$content = pull_view('tmp/emails/email_text_only_tmp' , [
			'text' => $message,
		]);


		foreach($emails as $email)
		{
			$email = trim($email);

			if( empty($email) )
				continue;
			
			_mail($email , "Vital Care" , $content);
		}
	}
?>