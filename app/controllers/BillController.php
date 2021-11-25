<?php 	

	class BillController extends Controller
	{

		public function __construct()
		{
			$this->bill_model = model('BillModel');
		}

		public function index()
		{
			$bills = $this->bill_model->getDesc('id');

			$data = [
				'bills' => $bills,
				'title' => 'Bills'
			];

			return $this->view('bill/index' , $data);
		}
		
		public function create()
		{

		}



		public function show($id)
		{
			$bill = $this->bill_model->getComplete($id);

			if( !$bill ){
				echo 'error no bill found';
				return;
			}

			$data = [
				'title' => 'Bills Payment #'.$bill->reference,
				'bill'  => $bill
			];

			return $this->view('bill/show' , $data);
		}


		public function fetchFrame($id)
		{
			$bill = $this->bill_model->getComplete($id);

			$data = [
				'title' => 'Bills Payment #'.$bill->reference,
				'bill'  => $bill
			];

			return $this->view('bill/frame' , $data);
		}


		public function pay($id)
		{
			if( isSubmitted() )
			{
				//create payment
			}



		}
	}