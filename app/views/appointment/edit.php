<?php build('content')?>
<?php Flash::show()?>
<div class="row">
	<div class="col-md-5">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Appointment Details</h4>
				<p><?php echo $appointment->reference?></p>
			</div>
			<div class="card-body">
				<?php echo $form->getForm()?>
			</div>
		</div>	
	</div>

	<div class="col-md-7">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Services , Payments & Bills Attached</h4>
			</div>

			<div class="card-body">
				<section>
					<h4>Bill</h4>
					<ul>
						<li>#<?php __($bill->reference) ?></li>
						<li>Amount : <?php echo $bill->total_amount?></li>
						<li>Status : <?php echo $bill->payment_status?></li>
						<li>Method : <?php echo $bill->payment_method?></li>
						<li><?php echo anchor(_route('bill:show' , $bill->id) , 'view' , 'Show Bill')?></li>
					</ul>
				</section>

				<section>
					<h4>Bill Items</h4>
					<ul>
						<?php foreach($bill->items as $row) :?>
							<li><?php echo $row->name?></li>
						<?php endforeach?>
					</ul>
				</section>
			</div>
		</div>
	</div>
</div>
<?php endbuild()?>

<?php build('styles')?>
	<style type="text/css">
		div.bordered-form-element
		{
			border: 1px solid #000;
			margin-bottom: 2px;
			padding: 5px;
		}
	</style>
<?php endbuild()?>
<?php loadTo()?>