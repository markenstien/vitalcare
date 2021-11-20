<?php build('content')?>
<?php $info = $hero->info?>
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="<?php echo $heroImage?>" style="width: 100%;">
                        </div>
                        <div class="col-md-8">
                            <h4 class="card-title"><?php echo $hero->localized_name?></h4>
                            <?php echo wWrapSpan($info->roles)?>
                        </div>
                    </div>
                    Attack Type : <?php echo $info->attack_type?>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Abilities</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td>Behavior</td>
                                    <td>Damage</td>
                                    <td>Bkb Pierce</td>
                                    <td>Description</td>
                                </tr>
                            </tbody>

                            <tbody>
                                <?php foreach($abilities as $ability) : ?>
                                    <?php if(!isset($ability->dname)) continue?>
                                    <tr>
                                        <td>
                                            <div class="user-profile">
                                                <img src="<?php echo 'https://api.opendota.com'.$ability->img?>" alt="avatar">
                                                <div class="user-meta-info">
                                                    <p class="user-name" data-name="Linda Nelson"><?php echo $ability->dname?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <?php if( is_array($ability->behavior) ) :?>
                                                <?php echo implode(',', $ability->behavior)?>
                                            <?php else:?>
                                                <?php echo $ability->behavior?>
                                            <?php endif?>
                                        </td>
                                        <td><?php echo !isset($ability->dmg_type) ? 'No Damage' : $ability->dmg_type?></td>
                                        <td><?php echo $ability->bkbpierce ?? 'N/A'?></td>
                                        <td><?php echo $ability->desc?></td>
                                    </tr>
                                    <tr>
                                     
                                    </tr>
                                <?php endforeach?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

             <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Attributes</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <td><img src="https://cdn.cloudflare.steamstatic.com/apps/dota2/images/dota_react/icons/hero_strength.png"></td>
                                    <td><span title="Base Str"><?php echo $info->base_str?></span></td>
                                    <td>+<span title="Str Gain"><?php echo $info->str_gain?></span></td>
                                </tr>

                                <tr>
                                    <td><img src="https://cdn.cloudflare.steamstatic.com/apps/dota2/images/dota_react/icons/hero_agility.png"></td>
                                    <td><span title="Base Agility"><?php echo $info->base_agi?></span></td>
                                    <td>+<span title="Agility Gain"><?php echo $info->agi_gain?></span></td>
                                </tr>

                                <tr>
                                    <td><img src="https://cdn.cloudflare.steamstatic.com/apps/dota2/images/dota_react/icons/hero_intelligence.png"></td>
                                    <td><span title="Base Int"><?php echo $info->base_int?></span></td>
                                    <td>+<span title="Int Gain"><?php echo $info->int_gain?></span></td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <td><img src="https://cdn.cloudflare.steamstatic.com/apps/dota2/images/dota_react//heroes/stats/icon_movement_speed.png"></td>
                                    <td>
                                        <span title="Movement Speed">
                                            <?php echo $info->move_speed?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="https://cdn.cloudflare.steamstatic.com/apps/dota2/images/dota_react//heroes/stats/icon_damage.png"></td>
                                    <td>
                                        <span title="Attack Range">
                                            <?php echo $info->attack_range?>
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endbuild()?>

<?php loadTo('tmp/base')?>