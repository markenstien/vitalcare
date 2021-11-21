<?php 

	class ServiceBundleItemModel extends Model 
	{
		public $table = 'service_bundle_items';

		public function add($service_id , $bundle_id)
		{
			if( parent::single(['service_id' => $service_id , 'bundle_id' => $bundle_id]) )
			{
				$this->addError("Service is already in the bundle");
				return false;
			}

			$res = parent::store([
				'service_id' => $service_id,
				'bundle_id'  => $bundle_id
			]);

			$this->reloadBundlePrice($bundle_id);
			//re-load service-bundle price
			return $res;
		}


		public function delete($id)
		{
			$instance = parent::get($id);
			$res = parent::delete($id);;

			$this->reloadBundlePrice($instance->bundle_id);
			return $res; 
		}

		public function reloadBundlePrice($bundle_id)
		{
			$items = $this->getByBundle($bundle_id);

			$total = 0;

			foreach($items as $item) {
				$total += $item->price;
			}

			$service_bundle = model('ServiceBundleModel');

			$res = $service_bundle->update([
				'price' => $total
			] , $bundle_id);
		}

		public function getByBundle($bundle_id)
		{
			$this->db->query(
				"SELECT sbi.* , ss.service , ss.code , 
					ss.price , ss.is_visible,
					ss.created_by ,cat.category, 
					cat.description as cat_description,
					sbi.id as id

					FROM {$this->table} as sbi

					LEFT JOIN services as ss
					ON sbi.service_id = ss.id

					LEFT JOIN categories as cat 
					ON cat.id = ss.category_id

					WHERE sbi.bundle_id = '{$bundle_id}'

					ORDER BY ss.service asc"
			);

			$results = $this->db->resultSet();

			return $results;
		}
	}