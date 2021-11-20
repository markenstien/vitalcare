<?php build('content') ?>
<div class="col-md-5">
	<?php Flash::show()?>
	<div class="card">
		<div class="card-body">
			<?php
				Form::open([
					'method' => 'post',
					'action' => _route('api:edit')
				]);
			?>

			<div class="form-group">
				<?php
					Form::label('API');
					Form::select('api' , $apis , '' , [
						'class' => 'form-control'
					])
				?>
			</div>

			<div class="form-group">
				<?php
					Form::label('Key');
					Form::text('api_key' , '' , [
						'class' => 'form-control'
					])
				?>
			</div>

			<div class="form-group">
				<?php
					Form::label('Secret');
					Form::text('api_secret' , '' , [
						'class' => 'form-control'
					])
				?>
			</div>

			<?php Form::submit('' , 'Update Api')?>

			<?php Form::close()?>
		</div>
	</div>
</div>
<?php endbuild()?>
<?php loadTo('tmp/base')?>