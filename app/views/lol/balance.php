<?php build('content')?>
<div class="container">
	<div class="col-md-10 mx-auto">
		<?php foreach($balances as $counter => $row) :?>
		<?php 
			if(is_null($row)) continue;
			
			$isRevamped = isset($row->revamp);
			
			if($isRevamped)
			$revampKeys = array_keys((array) $row->revamp->stats );
		?>
		<div class="card mb-5">
			<div class="card-header">
				<h4 class="card-title">#<?php echo ++$counter?> <?php echo $row->championName?></h4>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-4">
						<div class="user-profile">
							<a href="<?php echo _route('league:show' , $row->championName)?>">
								<img src="http://ddragon.leagueoflegends.com/cdn/11.21.1/img/champion/<?php echo $row->championName?>.png">
							</a>
							<div class="user-meta-info">
								<p class="user-name" data-name="<?php echo $row->championName?>"><?php echo $row->championName?>	</p>
							</div>
						</div>
					</div>

					<div class="col-md-8">
						<?php echo wWrapSpan($row->tags)?>
						<div class="table-responsive">
							<table class="table table-bordered">
								<tr>
									<td>Pick Rate</td>
									<td>Win Rate</td>
									<td>Lose Rate</td>
								</tr>
								<tr>
									<td><?php echo round($row->pickRate , 2) .'%'?></td>
									<td><?php echo round($row->winLoseRate->win , 2) .'%'?></td>
									<td><?php echo round($row->winLoseRate->lose , 2) .'%'?></td>
								</tr>
							</table>
						</div>
						<section class="mb-2">
							<h4 class="card-title">Attribute changes</h4>
							<div class="row">
								
								<div class="col">
									<?php foreach($revampKeys as $rVampKey => $rVampValue):?>
										<li><?php echo "[{$rVampValue}] = {$row->stats->$rVampValue}";?></li>
									<?php endforeach?>
								</div>
								<div class="col">
									<?php if( $isRevamped ) :?>
									<ul class="list-unstyled">
										<?php foreach($revampKeys as $rVampKey => $rVampValue):?>
											<li>
												<?php echo "[{$rVampValue}] = {$row->revamp->stats->$rVampValue}";?>
											</li>
										<?php endforeach?>
									</ul>
									<span class="badge badge-<?php echo isEqual($row->revamp->type , 'nerf') ? 'danger':'primary' ?>">
										<?php echo $row->revamp->type?>
									</span>
									<?php else:?>
										<p>Un touched</p>
									<?php endif?>
								</div>
							</div>
						</section>

						<section>
							<?php $skills_revamp = $row->skill_revamp?>
							<h4 class="card-title">Skill Changes</h4>
								<?php foreach($skills_revamp as $skill_index => $skill_revamp) :?>
									<h6><?php echo $skill_revamp->name?></h6>
									<table class="table">
										<tr>
											<td>Cooldown</td>
											<td><?php echo implode(',' , $skill_revamp->cooldown)?></td>
											<td><?php echo implode(',' , $skill_revamp->cooldown_revamp)?></td>
										</tr>

										<tr>
											<td>Cost</td>
											<td><?php echo implode(',' , $skill_revamp->cost)?></td>
											<td><?php echo implode(',' , $skill_revamp->cost_revamp)?></td>
										</tr>

										<tr>
											<td>Effect</td>
											<td><?php echo implode(',' , $skill_revamp->effect[1])?></td>
											<td><?php echo implode(',' , $skill_revamp->effect_revamp)?></td>
										</tr>
									</table>
								<?php endforeach?>
							</table>
						</section>
					</div>
				</div>
			</div>
		</div>
		<?php endforeach?>
	</div>
</div>
<?php endbuild()?>
<?php loadTo('tmp/base')?>