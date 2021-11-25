<?php build('content')?>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Service Items</h4>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<th>Service</th>
									<th>Amount</th>
									<th>Action</th>
								</thead>

								<tbody>
									<?php
										$lastItem = 'bundle';
									?>
									<?php foreach( $cart_items as $key => $cart) :?>
										<?php
											if( isEqual($cart['type'] , 'bundle'))
											{
												?> 
													<tr style="background: green; color: #fff;">
														<td><?php echo $cart['bundle']->name?></td>
														<td><?php echo $cart['bundle']->public_price?></td>
														<td>
															<a href="#" style="color:#fff"> <i class="fa fa-trash"></i> Remove Item</a>
														</td>
													</tr>
												<?php
												$lastItem = 'bundle';
												foreach($cart['items'] as $cartKey => $cartI) 
												{
													?> 
													<tr>
														<td><?php echo $cartI->service?></td>
														<td>---</td>
														<td>---</td>
													</tr>
													<?php
												}
											}else
											{
												if( $lastItem == 'bundle' ) 
												{
													?>
														<tr>
															<td colspan="3"></td>
														</tr>
													<?php
												}
												?>
													<tr>
														<td><?php echo $cart['item']->service?></td>
														<td><?php echo $cart['item']->price?></td>
														<td>
															<a href="#"> 
															<i class="fa fa-trash"></i> Remove Item</a>
														</td>
													</tr>
												<?php
												$lastItem = 'service';
											}
										?>
									<?php endforeach?>
								</tbody>
							</table>

							<h5>Total : <?php echo amountHTML($cart_item_summary['total_amount'])?></h5>
						</div>	
					</div>
				</div>
			</div>


			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Checkout Page</h4>
					</div>

					<div class="card-body">
						<?php __( $form->getForm() )?>
					</div>
				</div>
			</div>
		</div>		
	</div>
<?php endbuild()?>
<?php loadTo('tmp/base')?>