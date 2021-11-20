<?php
    extract($data);
?>
<?php if( isset($heroes) && !empty($heroes)) :?>
    <?php foreach($heroes as $hero) :?>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <a href="<?php echo _route('dota:show' , $hero->name)?>">
                            <img src="<?php echo $hero->image_src?>" 
                            alt="<?php echo $hero->image_src?>" style="width: 100%;">
                        </a>
                        <h4 class="card-title"><?php echo $hero->localized_name?></h4>
                        
                    </div>

                    <div class="col-md-6">
                        <div class="card-text"><?php echo wWrapSpan($hero->roles)?></div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach?>
<?php endif?>