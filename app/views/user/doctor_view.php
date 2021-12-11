<?php build('content') ?>
	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered">
							<tr>
								<td colspan="2">
									<?php __(anchor(_route('user:edit' , $user->id) , 'edit')) ?>
									<?php __(anchor(_route('user:delete' , $user->id , ['route' => seal(_route('user:index')) ]) , 'delete' , 'Delete User' , 'danger')) ?>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<?php if($doctor->profile) :?>
									<img src="<?php echo $doctor->profile?>" style="width: 100%;">
									<?php else:?>
										<label>No Profile Picture</label>
									<?php endif?>
								</td>
							</tr>
							<tr>
								<td>Lincense Number</td>
								<td><?php echo $doctor->license_number?></td>
							</tr>
							<tr>
								<td>User Code</td>
								<td><?php echo $user->user_code?></td>
							</tr>

							<tr>
								<td>First Name</td>
								<td><?php echo $user->first_name?></td>
							</tr>

							<tr>
								<td>Last Name</td>
								<td><?php echo $user->last_name?></td>
							</tr>

							<tr>
								<td>Gender</td>
								<td><?php echo $user->gender?></td>
							</tr>

							<tr>
								<td>Birth Date</td>
								<td><?php echo $user->birthdate?></td>
							</tr>

							<tr>
								<td colspan="2">Contact & Address</td>
							</tr>

							<tr>
								<td>Phone Number</td>
								<td><?php echo $user->phone_number?></td>
							</tr>

							<tr>
								<td>Email</td>
								<td><?php echo $user->email?></td>
							</tr>

							<tr>
								<td>Address</td>
								<td><?php echo $user->address?></td>
							</tr>

							<tr>
								<td colspan="2"> Auth</td>
							</tr>

							<tr>
								<td>Auth</td>
								<td><?php echo $user->username?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Specialties</h4>
					<?php echo anchor(_route('doc-special:create' , $user->id) , 'Create' , 'Create')?>
				</div>

				<div class="card-body">
					<?php foreach($doctor_specializations as $row):?>
						<details>
						  <summary><?php echo $row->name?></summary>
						  <p>Skill Description : <?php echo $row->description?></p>
						  <p>Doctor Notes : <?php echo $row->notes?></p>
						</details>
						<?php echo anchor(_route('doc-special:edit' , $row->id))?>
						<?php echo anchor(_route('doc-special:delete' , $row->id) , 'delete')?>
					<?php endforeach?>
				</div>
			</div>

			<?php divider()?>

			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Sessions</h4>
					<?php echo anchor(_route('session:create' , $user->id) , 'Create' , 'Create')?>
				</div>

				<div class="card-body">
					<table class="table table-bordered dataTable">
						<thead>
							<th>Doctor</th>
							<th>Guest</th>
							<th>Date</th>
							<th>Action</th>
						</thead>
						<tbody>
							<?php foreach($sessions as $row):?>
								<tr>
									<td><?php echo $row->first_name . ' '.$row->last_name?></td>
									<td><?php echo $row->guest_name?></td>
									<td><?php echo $row->date_created?></td>
									<td><?php echo anchor( _route('session:show' , $row->id), 'view' , 'show')?></td>
								</tr>
							<?php endforeach?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>

