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
	</div>
<?php endbuild()?>
<?php loadTo()?>