<?php
    extract($data);
    
?>
<?php if( isset($champions) && !empty($champions)) :?>
<?php foreach($champions as $champion) :?>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <a href="<?php echo _route('league:show' , $champion->name)?>">
                        <img src="<?php echo $imgSrc.$champion->name.'.png'?>" alt="">
                    </a>
                    <h4 class="card-title"><?php echo $champion->name?></h4>
                </div>

                <div class="col-md-6">
                    <div class="card-text"><?php echo wWrapSpan($champion->tags)?></div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach?>
<?php endif?>