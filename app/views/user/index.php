<?php build('page-control')?>
	<a href="<?php echo _route('user:create')?>" 
		class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
    class="fas fa-user-plus fa-sm text-white-50"></i> Add User </a>
<?php endbuild()?>

<?php build('content')?>
	<div class="card">
		<?php Flash::show()?>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered dataTable">
					<thead>
						<th>#</th>
						<th>Ref</th>
						<th>Name</th>
						<th>Email</th>
						<th>Type</th>
						<th>Action</th>
					</thead>

					<tbody>
						<?php foreach($users as $key => $row) :?>
							<tr>
								<td><?php echo ++$key?></td>
								<td><?php echo $row->user_code?></td>
								<td><?php echo $row->first_name . ' ' .$row->last_name?></td>
								<td><?php echo $row->email?></td>
								<td><?php echo $row->user_type?></td>
								<td>
									<a href="#" class="btn btn-primary btn-sm">Show</a>
									<a href="<?php echo _route('user:edit' , $row->id)?>" class="btn btn-primary btn-sm">Edit</a>
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