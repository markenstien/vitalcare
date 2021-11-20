<?php build('content') ?>
    <div class="statbox widget box box-shadow">
        <div class="widget-content widget-content-area">
            <small>Search Player</small>
            <?php
                Form::open([
                    'method' => 'get',
                    'action' => _route('leaguePlayer:search')
                ])
            ?>
                <div class="row">
                    <div class="col-md-8">
                        <?php
                            Form::text('key', '', [
                                'class' => 'form-control',
                                'placeholder' => 'Search Player Name',
                                'require' => true
                            ])
                        ?>
                    </div>

                    <div class="col-md-2">
                        <?php
                            Form::select('regions' , $regions , '' , [
                                'class' => 'form-control',
                                'require' => true
                            ]);
                        ?>
                    </div>

                    <div class="col-md-2">
                        <?php
                            Form::submit('' , 'Search' , [
                                'class' => 'btn btn-primary btn-lg'
                            ]);
                        ?>
                    </div>
                </div>
            <?php Form::close()?>
        </div>
    </div>

    <?php divider()?>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="w-img">
                            <img src="<?php echo "http://ddragon.leagueoflegends.com/cdn/11.22.1/img/profileicon/{$player->profileIconId}.png"?>" 
                            alt="avatar" style="width:100%">
                        </div>
                        <div class="media-body">
                            <h6><?php echo $player->name?></h6>
                        </div>
                    </div>

                    <?php divider()?>
                    <p>Stats For Recent 20 games</p>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <th>#</th>
                                <th>Hero</th>
                                <th>Remarks</th>
                            </thead>

                            <tbody>
                                <?php $counter = 0?>
                                <?php foreach($matches_with_remarks as $index => $matches_with_remark): ?>
                                    <?php
                                        $counter++;
                                        if( $counter > 5) break;
                                        $remarks = $matches_with_remark->remarks;
                                    ?>

                                    <tr>
                                        <td><?php echo $counter?></td>
                                        <td>
                                            <div class="media">
                                                <div class="w-img">
                                                    <img src="<?php echo $imgSrc.$index.'.png'?>" 
                                                    alt="avatar" style="width:100%">
                                                </div>
                                                <div class="media-body">
                                                    <h6><?php echo $index?></h6>
                                                </div>
                                            </div>
                                            <td>
                                                <?php
                                                    $lose = $remarks->total_matches - $remarks->wins;
                                                    echo ("
                                                        {$remarks->win_rate}% {$remarks->wins}W {$lose}L
                                                    ");
                                                ?>
                                            </td>
                                        </td>
                                    </tr>
                                <?php endforeach?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="table-responsive">
                <table class="table table-bordered dataTable">
                    <thead>
                        <th>#</th>
                        <th>HERO</th>
                        <th>KDA</th>
                    </thead>

                    <tbody>
                        <?php $counter = 0?>
                        <?php foreach($matches as $match):?>
                            <?php $counter++?>
                            <tr>
                                <td><?php echo $counter?></td>
                                <td>
                                    <div class="media">
                                        <div class="w-img">
                                            <img src="<?php echo $imgSrc.$match->name.'.png'?>" 
                                            alt="avatar" style="width:100%">
                                        </div>
                                        <div class="media-body">
                                            <h6><?php echo $match->name?></h6>
                                            <p class="meta-date-time">
                                                <?php if($match->win) :?>
                                                    <span class="badge badge-success">Win</span>
                                                <?php else:?>
                                                    <span class="badge badge-danger">Lose</span>
                                                <?php endif?>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <?php
                                        echo ("{$match->kills}/{$match->deaths}/{$match->assists}");
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endbuild()?>

<?php build('styles')?>
    <style>
        .media-body
        {
            margin-right: 15px;
        }
    </style>
<?php endbuild()?>

<?php loadTo('tmp/base')?>