<?php build('content')?>
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="<?php echo $imgSrc.$champion->name.'.png'?>" 
                                alt="<?php echo $champion->name?>"
                                style="width: 100%;">
                        </div>
                        <div class="col-md-8">
                            <h4 class="card-title"><?php echo $champion->name?></h4>
                            <?php echo wWrapSpan($champion->tags)?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Spells</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td>Name</td>
                                <td>Description</td>
                            </tr>
                            <?php foreach($champion->spells as $spell) :?>
                                <tr>
                                    <td>
                                         <div class="user-profile">
                                           <img src="https://ddragon.leagueoflegends.com/cdn/11.22.1/img/spell/<?php echo $spell->image->full?>">
                                            <div class="user-meta-info">
                                                <p class="user-name" data-name="<?php echo $spell->name?>"><?php echo $spell->name?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td width="500">
                                        <div><?php echo $spell->description?></div>
                                        <?php if( isset($spell->cooldown)) :?>
                                            <strong><span>Cool Down</span></strong>
                                            <table class="table">
                                                <?php foreach($spell->cooldown as $key => $cd) :?>
                                                <tr>
                                                    <td><?php echo $key?></td>
                                                    <td><?php echo $cd?></td>
                                                </tr>
                                                <?php endforeach?>
                                            </table>
                                        <?php endif?>
                                    </td>
                                </tr>
                            <?php endforeach?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endbuild()?>

<?php loadTo('tmp/base')?>