<?php 

	class ServiceBundleItemController extends Controller
	{
		public function __construct()
		{
			$this->bundle = model('ServiceBundleModel');
			$this->service = model('ServiceModel');
			$this->model = model('ServiceBundleItemModel');
		}	


		public function delete($id)
		{
			 $this->model->delete($id);

			 return request()->return();
		}


		public function add($bundle_id)
		{
			if( isSubmitted() )
			{
				$post = request()->posts();

				$res = $this->model->add($post['service_id'] , $post['bundle_id']);

				Flash::set("Service added to bundle");

				if(!$res) 
					Flash::set( $this->model->getErrorString() , 'danger');

				return request()->return();

			}

			$bundle = $this->bundle->get($bundle_id);

			$bundle_items = $this->model->getByBundle($bundle_id);

			$services = $this->service->getAll();

			$data = [
				'title' => "{$bundle->name} | Service Bundles",
				'services' => $services,
				'bundle_id' => $bundle_id,
				'bundle_items' => $bundle_items,
				'bundle' => $bundle
			];

			return $this->view('service_bundle/add_item' , $data);
		}
	}