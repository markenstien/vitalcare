<?php build('content')?>
<div class="container">
	<?php $counter = 1?>
	<div class="col-md-12 mx-auto">
		<?php foreach($balances as $key => $row) :?>
			<?php if(is_null($row)) continue?>
	        <?php 
				$isRevamped = isset($row->revamp);
				
				if($isRevamped)
					$revampKeys = array_keys((array) $row->revamp->stats );
			?>
			<div class="card  mb-3">
				<div class="card-header">
					<h4 class="card-title"><?php echo $row->championName?> #<?php echo $counter++?></h4>
				</div>

				<div class="card-body">
					<a href="<?php echo _route('dota:show' , $row->other->name)?>">
						<div>
							<img src="https://api.opendota.com<?php echo $row->other->img?>"
								style="width: 100%;">
						</div>
					</a>

					<div><?php echo wWrapSpan($row->tags)?></div>

					<div class="table-responsive">
						<table class="table">
							<tr>
								<td>Pick Rate</td>
								<td>Win Rate</td>
								<td>Lose Rate</td>
							</tr>
							<tr>
								<td><?php echo $row->pickRate .'%'?></td>
								<td><?php echo $row->winLoseRate->win .'%'?></td>
								<td><?php echo $row->winLoseRate->lose .'%'?></td>
							</tr>
						</table>
					</div>
				</div>

				<div class="card-footer">
					<section class="mb-4">
						<h4 class="card-title">Attribute Changes</h4>
							<div class="row">
								<div class="col-md-6">
									<ul class="list-unstyled">
				                        <?php foreach($revampKeys as $rVampKey => $rVampValue):?>
				                            <li><?php echo "[{$rVampValue}] = {$row->stats->$rVampValue}";?></li>
				                        <?php endforeach?>
			                        </ul>
								</div>
								<div class="col-md-6">
									<?php if( $isRevamped ) :?>
				                        <ul class="list-unstyled">
				                            <?php foreach($revampKeys as $rVampKey => $rVampValue):?>
				                                <li>
													<?php echo "[{$rVampValue}] = {$row->revamp->stats->$rVampValue}";?>
												</li>
				                            <?php endforeach?>
				                        </ul>
				                        <span class="badge badge-<?php echo isEqual($row->revamp->type ?? '' , 'nerf') ? 'danger':'primary' ?>">
											<?php echo $row->revamp->type ?? ''?>
										</span>
									<?php else:?>
										<p>Un touched</p>
									<?php endif?>
								</div>
							</div>
					</section>

					<?php if( isset( $row->ability_changes )):?>
						<section>
							<h4 class="card-title">Ability Changes</h4>
								<?php $abilities = $row->ability_changes;?>

								<table class="table">
									<?php foreach($abilities as $index => $ability) :?>
										<?php
											$attributes = $ability->attrib;
											foreach($attributes as $attribute)
											{
												if( !isset($attribute->revamp) ) continue;
												if( is_array($attribute->value)) 
												{
													?> 
													<tr>
														<td><?php echo $attribute->key?></td>
														<td><?php echo $ability->dname?></td>
														<td><?php echo implode('/', $attribute->value)?></td>
														<td><?php echo implode('/', $attribute->revamp)?></td>
													</tr>
													<?php
												}else
												{
													?> 
														<tr>
															<td><?php echo $attribute->key?></td>
															<td><?php echo $ability->dname?></td>
															<td><?php echo $attribute->value?></td>
															<td><?php echo $attribute->revamp?></td>
														</tr>
													<?php
												}
											}
										?>
										<tr>
											<?php if(isset($ability->mc)):?>
												<?php
													if( is_array($ability->mc)) 
													{
														?> 
														<tr>
															<td>Mana Cost</td>
															<td><?Php echo $ability->dname?></td>
															<td><?php echo implode('/', $ability->mc)?></td>
															<td><?php echo implode('/', $ability->mc_revamp)?></td>
														</tr>
														<?php
													}else
													{
														?>
														<tr>
															<td>Mana Cost</td>
															<td><?Php echo $ability->dname?></td>
															<td><?php echo $ability->mc?></td>
															<td><?php echo $ability->mc_revamp?></td>
														</tr>
														<?php
													}
												?>
											<?php endif?>
										</tr>

										<tr>
											<?php if(isset($ability->cd)):?>
												<?php
													if( is_array($ability->cd)) 
													{
														?> 
														<tr>
															<td>Cool Down</td>
															<td><?Php echo $ability->dname?></td>
															<td><?php echo implode('/', $ability->cd)?></td>
															<td><?php echo implode('/', $ability->cd_revamp)?></td>
														</tr>
														<?php
													}else
													{
														?>
														<tr>
															<td>Cool Down</td>
															<td><?Php echo $ability->dname?></td>
															<td><?php echo $ability->cd?></td>
															<td><?php echo $ability->cd_revamp?></td>
														</tr>
														<?php
													}
												?>
											<?php endif?>
										</tr>

										<tr>
											<?php if(isset($ability->dmg)):?>
												<?php
													if( is_array($ability->dmg)) 
													{
														?> 
														<tr>
															<td>Mana Cost</td>
															<td><?Php echo $ability->dname?></td>
															<td><?php echo implode('/', $ability->dmg)?></td>
															<td><?php echo implode('/', $ability->dmg_revamp)?></td>
														</tr>
														<?php
													}else
													{
														?>
														<tr>
															<td>Mana Cost</td>
															<td><?Php echo $ability->dname?></td>
															<td><?php echo $ability->dmg?></td>
															<td><?php echo $ability->dmg_revamp?></td>
														</tr>
														<?php
													}
												?>
											<?php endif?>
										</tr>
									<?php endforeach?>
								</table>
						</section>
					<?php endif?>
				</div>
			</div>
		<?php endforeach?>
	</div>
</div>
<?php endbuild()?>
<?php loadTo('tmp/base')?>