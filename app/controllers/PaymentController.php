<?php 

	class PaymentController extends Controller
	{	
		public function __construct()
		{
			$this->payment = model('PaymentModel');
		}

		public function index()
		{	
			$auth = auth();


			$payments = $this->payment->getDesc('id');
			$data = [
				'title' => 'Payments',
				'payments' => $payments
			];

			return $this->view('payment/index' , $data);
		}


		public function confirmation()
		{
			echo ' payment-confirmed ';
		}
	}