<?php build('content')?>
	
	<div class="col-md-5">
		<?php Flash::show()?>
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Total Games</h4>
			</div>
			<div class="card-body">
				<table class="table table-bordered">
					<tr>
						<td>Dota2</td>
						<td><?php echo $matches['dota']?></td>
					</tr>
					<tr>
						<td>League Of Legends</td>
						<td><?php echo $matches['league']?></td>
					</tr>
				</table>
			</div>

			<div class="card-footer">
				
				<a href="/PopulateGamesController" class="btn btn-primary">Fetch Games</a>
			</div>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo('tmp/base')?>