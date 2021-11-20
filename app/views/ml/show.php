<?php build('content')?>
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="<?php echo $hero['image_src']?>" 
                                alt="<?php echo $hero['name']?>" style="width: 100%;">
                        </div>
                        <div class="col-md-8">
                            <h4 class="card-title"><?php echo $hero['name']?></h4>
                            <?php echo wWrapSpan($hero['type'])?>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Primary -->
                        <?php $progress_value =  floatval($hero_stats->durability) * 100 ?>
                        <div class="progress br-30">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $progress_value?>%" 
                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-title"><span>Durability</span> 
                                    <span><?php echo $progress_value?>%</span>
                                </div>
                            </div>
                        </div>

                        <?php $progress_value =  floatval($hero_stats->offense) * 100 ?>
                        <div class="progress br-30">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $progress_value?>%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-title"><span>Offense</span> 
                                    <span><?php echo $progress_value?>%</span>
                                </div>
                            </div>
                        </div>

                        <?php $progress_value =  floatval($hero_stats->skillEffects) * 100 ?>
                        <div class="progress br-30">
                            <div class="progress-bar bg-info" role="progressbar" 
                            style="width: <?php echo $progress_value?>%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-title"><span>Skill Effects</span> 
                                    <span><?php echo $progress_value?>%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endbuild()?>

<?php loadTo('tmp/base')?>