<?php build('page-control')?>
	<a href="<?php echo _route('category:create')?>" 
		class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
    class="fas fa-list fa-sm text-white-50"></i> Service Bundles </a>
<?php endbuild()?>

<?php build('content')?>
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Select Services to bundle</h4>
				</div>
				<div class="card-body">
					<div class="row">
					<?php foreach($services as $row) :?>	
						<div class="col-md-4">
							<div class="card">
								<div class="card-body">
									<p><?php echo $row->description?></p>
								</div>
								<div class="card-footer">
									<h6><?php echo $row->service?></h6>
									<div><a href="#"><small><?php echo $row->code?></small></a></div>
									<br>
									<label>PHP : <?php echo amountHTML($row->price ?? 0)?></label>

									<?php
										Form::open([
											'method' => 'post',
											'action' => _route('service-bundle-item:add' , $bundle_id)
										]);

										Form::hidden('service_id' , $row->id);
										Form::hidden('bundle_id' , $bundle_id);


										Form::submit('' , 'Add' , [
											'class' => 'btn btn-primary'
										]);
									?>

									<?php Form::close()?>
								</div>
							</div>
						</div>
					<?php endforeach?>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Items</h4>
				</div>
				<div class="card-body">
					<table class="table table-bordered">
						<?php foreach($bundle_items as $row) :?>
							<tr>
								<td>
									<a href="#"><?php echo $row->code?></a>
								</td>
								<td><a href="<?php echo _route('service-bundle-item:delete' , $row->id)?>">Delete</a></td>
							</tr>
						<?php endforeach?>
					</table>
				</div>
			</div>

			<div class="card mt-2">
				<div class="card-header">
					<h4 class="card-title">General</h4>

					<a href="<?php echo _route('service-bundle:show' , $bundle->id)?>">Back to Overview</a>
				</div>
				<div class="card-body">
					<table class="table table-bordered">
						<tr>
							<td>Bundle Name</td>
							<td><?php echo $bundle->name?></td>
						</tr>
						<tr>
							<td>Code</td>
							<td><?php echo $bundle->code?></td>
						</tr>
						<tr>
							<td>Price</td>
							<td><?php echo $bundle->public_price?></td>
						</tr>
						<tr>
							<td>Description</td>
							<td><?php echo $bundle->description?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>