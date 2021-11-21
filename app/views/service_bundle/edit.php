<?php build('page-control')?>
	<a href="<?php echo _route('service-bundle:index')?>" 
		class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
    class="fas fa-list fa-sm text-white-50"></i> Back to <?php echo $service_bundle->name?> </a>
<?php endbuild()?>

<?php build('content')?>
	<div class="col-md-7">
		<div class="card">
			<div class="card-body">
				<?php __( $form->getForm() )?>
			<div>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>