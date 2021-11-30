<?php 

	class DashboardController extends Controller
	{

		public function index()
		{
			$data = [
				'title' => 'Dashboard ' . auth('first_name'),
			];
			return $this->view('dashboard/index' , $data);
		}
	}