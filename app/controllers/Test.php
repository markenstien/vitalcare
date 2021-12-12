<?php 

	
	class Test extends Controller
	{

		public function index()
		{
			$res = send_sms("This is a test" , ['09063387451']);

			dd($res);
		}
	}