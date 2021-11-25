<?php build('content')?>
	<div class="row">
		<div class="col-md-7">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Appointment</h4>
					<label><?php echo $appointment->type?></label>
				</div>

				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered">
							<tr>
								<td>Date</td>
								<td><?php echo $appointment->date?></td>
							</tr>


							<tr>
								<td>Status</td>
								<td><?php echo $appointment->date?></td>
							</tr>


							<tr>
								<td>Guest</td>
								<td><?php echo $appointment->guest_name?></td>
							</tr>

							<tr>
								<td>Email</td>
								<td><?php echo $appointment->guest_email?></td>
							</tr>

							<tr>
								<td>Mobile</td>
								<td><?php echo $appointment->guest_phone?></td>
							</tr>

						</table>
					</div>
				</div>

				<!-- cash payment -->
				<?php if($appointment->bill) :?>
					<div class="card-body">
						<h4>Bill</h4>

						<p> ALLOW TO PAY IN CASH </p>
					</div>
				<?php endif?>
			</div>
		</div>
		<?php if($appointment->bill) :?>
		<div class="col-md-5">
			<iframe src="<?php echo _route('bill:fetchFrame' , $appointment->bill->id)?>"
					style="width: 100%; height: 100vh"></iframe>
		</div>
		<?php endif?>
	</div>
<?php endbuild()?>
<?php loadTo()?>