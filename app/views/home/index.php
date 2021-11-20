<?php build('content')?>
    <div class="row">
        <div class="col-md-4">
            <div class="card component-card_2">
                <img src="https://www.gametutorials.com/wp-content/uploads/2020/08/dota-cover-pic-1170x600.jpg" class="card-img-top" alt="widget-card-2">
                <div class="card-body">
                    <h5 class="card-title">Dota2</h5>
                    <p class="card-text">
                        Dota 2 is a multiplayer online battle arena (MOBA) video game developed and published by Valve
                    </p>
                    <a href="<?php echo _route('dota:index')?>" class="btn btn-primary">Explore More</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card component-card_2">
                <img src="https://pm1.narvii.com/6613/c7fc27bc88e8a4836cff2e51ce8a0b3b9bf8879c_hq.jpg" class="card-img-top" alt="widget-card-2">
                <div class="card-body">
                    <h5 class="card-title">League of Legends</h5>
                    <p class="card-text">
                    League of Legends, commonly referred to as League, is a 2009 multiplayer online battle arena video game developed and published by Riot Games
                    </p>
                    <a href="<?php echo _route('league:index')?>" class="btn btn-primary">Explore More</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card component-card_2">
                <img src="https://gamerbraves.sgp1.cdn.digitaloceanspaces.com/2020/06/mobile-legends-bang-bang.jpg" class="card-img-top" alt="widget-card-2">
                <div class="card-body">
                    <h5 class="card-title">Mobile Legends</h5>
                    <p class="card-text">
                    Mobile Legends: Bang Bang is a mobile multiplayer online battle arena developed and published by Moonton, a subsidiary of ByteDance
                    </p>
                    <a href="<?php echo _route('mobile:index')?>" class="btn btn-primary">Explore More</a>
                </div>
            </div>
        </div>
    </div>
    <p class="text-center">
        Get to know heroes better
    </p>
    

    
<?php endbuild()?>


<?php loadTo('tmp/base')?>