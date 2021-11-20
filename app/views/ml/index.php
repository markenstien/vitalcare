<?php build('content') ?>

<div class="row">
	<div class="col-md-7">
		<div class="card">
		    <div class="card-body">
		        <div class="row">
		        	<?php foreach($heroes as $hero) :?>
		                <div class="col-md-3 mt-3">
		                    <a href="<?php echo _route('mobile:show' , $hero['name'])?>">
		                        <img src="<?php echo $hero['image_src']?>" alt=""
		                        	style="width: 100%;">
		                    </a>
		                    <h4 class="card-title"><?php echo $hero['name']?></h4>
		                    <div class="card-text"><?php echo wWrapSpan($hero['type'])?></div>
		                </div>
		            <?php endforeach?>
		        </div>
		    </div>
		</div>
	</div>

	<div class="col-md-5">
		<div class="card">
		    <div class="card-body">
		    	<div class="table-responsive">
		        	<table class="table table-bordered">
		        		<thead>
		        			<th>#</th>
		        			<th>Name</th>
		        			<th>Win Rate</th>
		        		</thead>

		        		<tbody>
		        			<?php $counter = 0?>
		        			<?php foreach($popular_heroes as $pop_hero) :?>
		        				<tr class="clickable" data-url="<?php echo URL.DS._route('mobile:show' , $pop_hero->HeroName)?>">
		        					<td><?php echo ++$counter?></td>
		        					<td>
		        						<a href="<?php echo URL.DS._route('mobile:show' , $pop_hero->HeroName)?>"><?php echo $pop_hero->HeroName?></a>
		        					</td>
		        					<td><?php echo $pop_hero->winRatePercentage?></td>
		        				</tr>
		        			<?php endforeach?>
		        		</tbody>
		        	</table>
		        </div>
		    </div>
		</div>

		<div class="card-footer">
			<a href="<?php echo _route('mobileBalancer:index')?>"
				class="btn btn-success btn-lg"> Balance </a>
		</div>
	</div>
</div>
<?php endbuild()?>

<?php loadTo('tmp/base')?>