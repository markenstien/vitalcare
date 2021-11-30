<?php 

	class PaymentController extends Controller
	{	
		public function __construct()
		{
			$this->payment = model('PaymentModel');
		}

		public function index()
		{
			$data = [
				'title' => 'Payments',
				'payments' => $this->payment->getDesc('id')
			];

			return $this->view('payment/index' , $data);
		}


		public function confirmation()
		{
			echo ' payment-confirmed ';
		}
	}