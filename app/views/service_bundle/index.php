<?php build('page-control')?>
	<a href="<?php echo _route('service-bundle:create')?>" 
		class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
    class="fas fa-plus fa-sm text-white-50"></i> Add Bundle </a>
<?php endbuild()?>

<?php build('content')?>
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<th>#</th>
						<th>Code</th>
						<th>Name</th>
						<th>Price</th>
						<th>Discount</th>
						<th>Description</th>
						<th>Status</th>
						<th>Action</th>
					</thead>

					<tbody>
						<?php foreach($service_bundles as $key => $row) :?>
							<tr>
								<td><?php echo ++$key?></td>
								<td><?php echo $row->code?></td>
								<td><?php echo $row->name?></td>
								<td><?php echo $row->public_price?></td>
								<td><?php echo $row->discount?></td>
								<td><?php echo $row->description?></td>
								<td><?php echo $row->status?></td>
								<td>
									<a href="<?php echo _route('service-bundle:edit' , $row->id)?>">Edit</a>
									<a href="<?php echo _route('service-bundle:show' , $row->id)?>">Show</a>
								</td>
							</tr>
						<?php endforeach?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>