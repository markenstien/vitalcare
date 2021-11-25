<?php build('page-control')?>
	<a href="<?php echo _route('category:create')?>" 
		class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
    class="fas fa-plus fa-sm text-white-50"></i> Add Category</a>
<?php endbuild()?>

<?php build('content')?>
	
	<div class="card">
		<div class="card-body">
			<div class="table">
				 <table class="table table-bordered">
				 	<thead>
				 		<th>Code</th>
				 		<th>Name</th>
				 		<th>Price</th>
				 		<th>Discount</th>
				 		<th>Description</th>
				 	</thead>

				 	<tbody>
				 		<tr>
				 			<td><?php echo $service_bundle->code?></td>
				 			<td><?php echo $service_bundle->name?></td>
				 			<td><?php echo $service_bundle->public_price?></td>
				 			<td><?php echo $service_bundle->discount?></td>
				 			<td><?php echo $service_bundle->description?></td>
				 		</tr>
				 	</tbody>
				 </table>
			</div>
			<a href="<?php echo _route('service-bundle-item:add' , $service_bundle->id)?>">Add Items</a>
			<a href="<?php echo _route('service-bundle:edit' , $service_bundle->id)?>">Edit</a>
		</div>
	</div>

	<?php divider()?>

	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Items</h4>
		</div>

		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered dataTable">
					<thead>
						<th>#</th>
						<th>Ref</th>
						<th>Service</th>
						<th>Price</th>
						<th>Category</th>
						<th>Descriotion</th>
						<th>Status</th>
						<th>Action</th>
					</thead>

					<tbody>
						<?php $total = 0?>
						<?php foreach($services as $key => $row) :?>
							<?php $total += $row->price?>
							<tr>
								<td><?php echo ++$key?></td>
								<td><?php echo $row->code?></td>
								<td><?php echo $row->service?></td>
								<td><?php echo $row->price?></td>
								<td><?php echo $row->category?></td>
								<td><?php echo $row->description?></td>
								<td><?php echo $row->status?></td>
								<td>
									<?php
										__([
											btnDelete(_route('service-bundle-item:delete' , $row->id))
										])
									?>
								</td>
							</tr>
						<?php endforeach?>
					</tbody>
				</table>
			</div>
			<h5>Total Services Amount : <?php echo amountHTML($total)?></h5>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>