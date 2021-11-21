<?php 

	class ServiceBundleItemController extends Controller
	{
		public function __construct()
		{
			$this->bundle = model('ServiceBundleModel');
			$this->service = model('ServiceModel');
			$this->bundle_item = model('ServiceBundleItemModel');
		}	


		public function delete($id)
		{
			 $this->bundle_item->delete($id);

			 return request()->return();
		}


		public function add($bundle_id)
		{
			if( isSubmitted() )
			{
				$post = request()->posts();

				$res = $this->bundle_item->add($post['service_id'] , $post['bundle_id']);

				Flash::set("Service added to bundle");

				if(!$res) 
					Flash::set( $this->bundle_item->getErrorString() , 'danger');

				return request()->return();

			}

			$bundle = $this->bundle->get($bundle_id);

			$bundle_items = $this->bundle_item->getByBundle($bundle_id);

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