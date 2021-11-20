<?php build('content')?>
	<div class="row">
		<div class="col-md-7">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Heroes</h4>
				</div>

				<div class="card-body">
					<?php grab('dota/partial/heroes' , ['heroes' => $heroes ?? []])?>
				</div>
			</div>
		</div>

		<div class="col-md-5">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Top Ten</h4>
				</div>
				<div class="card-body">
					<div class="table table-responsive">
						<table class="table table-bordered">
							<thead>
								<th>Picture</th>
								<th>Name</th>
								<th>Pick Rate</th>
								<th>Win</th>
								<th>Lose</th>
							</thead>

							<tbody>
								<?php $counter = 0?>
								<?php foreach($matches as $key => $match) : ?>
									<tr>
										<td><?php echo ++$counter?></td>
										<td><?php echo $match->hero_detail->localized_name?></td>
										<td><?php echo $match->pickRate?>%</td>
										<td><?php echo $match->winLoseRate->win?>%</td>
										<td><?php echo $match->winLoseRate->lose?>%</td>
									</tr>
								<?php endforeach?>
							</tbody>
						</table>
					</div>	
					<hr>
					<a href="<?php echo _route('dotaBalancer:index')?>"
						class="btn btn-success btn-lg"> Balance </a>
				</div>
			</div>	
		</div>
	</div>
<?php endbuild()?>
<?php loadTo('tmp/base')?>