<?php build('content')?>
	<div class="statbox widget box box-shadow">
		<div class="widget-content widget-content-area">
			<small>Search Player</small>
			<?php
				Form::open([
					'method' => 'get',
					'action' => _route('leaguePlayer:search')
				])
			?>
				<div class="row">
					<div class="col-md-8">
						<?php
							Form::text('key', '', [
								'class' => 'form-control',
								'placeholder' => 'Search Player Name',
								'require' => true
							])
						?>
					</div>

					<div class="col-md-2">
						<?php
							Form::select('regions' , $regions , '' , [
								'class' => 'form-control',
								'require' => true
							]);
						?>
					</div>

					<div class="col-md-2">
						<?php
							Form::submit('' , 'Search' , [
								'class' => 'btn btn-primary btn-lg'
							]);
						?>
					</div>
				</div>
			<?php Form::close()?>
		</div>
	</div>
	<?php divider()?>

	<?php Flash::show()?>
	
	<div class="row">
		<div class="col-md-7">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Heroes</h4>
				</div>

				<div class="card-body">
					<?php grab('lol/partial/champions' , ['champions' => $champions ?? [] , 'imgSrc' => $imageSrc])?>
				</div>
			</div>
		</div>

		<div class="col-md-5">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Top Ten</h4>
				</div>

				<div class="card-body">
					<?php $counter = 1?>
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<th>#</th>
								<th>Hero</th>
								<th>Pick Rate</th>
								<th>Win Rate</th>
								<th>Lose Rate</th>
							</thead>

							<tbody>
								<?php foreach($topFivePopular as $key => $row) :?>
									<tr>
										<td><?php echo $counter++?></td>
										<td><?php echo $key?></td>
										<td><?php echo $row->pickRate .'%'?></td>
										<td><?php echo $row->winLoseRate->win .'%'?></td>
										<td><?php echo $row->winLoseRate->lose .'%'?></td>
									</tr>
								<?php endforeach?>
							</tbody>
						</table>
					</div>

					<a href="<?php echo _route('leagueBalancer:index')?>" class="btn btn-primary btn-lg">Balance</a>
				</div>
			</div>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo('tmp/base')?>