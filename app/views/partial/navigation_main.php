<div class="topbar-nav header navbar" role="banner">
        <nav id="topbar">
            <ul class="navbar-nav theme-brand flex-row  text-center">
                <li class="nav-item theme-text">
                    <a href="<?php echo _route('home:index')?>" class="nav-link"> New Meta </a>
                </li>
            </ul>

            <ul class="list-unstyled menu-categories" id="topAccordion">

                <li class="menu single-menu">
                    <a href="<?php echo _route('home:index')?>">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                            stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            <span>Home</span>
                        </div>
                    </a>
                </li>


                <li class="menu single-menu">
                    <a href="<?php echo _route('dota:index')?>">
                        <div class="">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKgQ3sJMWoEDO3xFjul1viQgK16zqQxQCuErE4HQmsyCZcUMuWAHZItewv6g8M6soaYJo&usqp=CAU"
                                    style="width:30px">
                            <span>DOTA 2</span>
                        </div>
                    </a>
                </li>

                <li class="menu single-menu">
                    <a href="<?php echo _route('league:index')?>">
                        <div class="">
                            <img src=" https://i.pinimg.com/originals/b8/3e/6f/b83e6fea403a390bd06ae17c187408e3.png"
                                    style="width:30px">
                            <span>League Of Legends</span>
                        </div>
                    </a>
                </li>

                <li class="menu single-menu">
                    <a href="<?php echo _route('mobile:index')?>">
                        <div class="">
                            <img src="https://upload.wikimedia.org/wikipedia/en/9/9e/Mobilelegends.png" style="width:30px">
                            <span>Mobile Legends</span>
                        </div>
                    </a>
                </li>

                <?php if( whoIs() ) : ?>
                    <li class="menu single-menu">
                        <a href="<?php echo _route('match:index')?>">
                            <div class="">
                                <img src="https://cdn.dribbble.com/users/1014040/screenshots/5343178/gamepad-za-dribbble.png?compress=1&resize=400x300"
                                    style="width:30px">
                                <span>Matches</span>
                            </div>
                        </a>
                    </li>
                <?php endif?>
            </ul>
        </nav>
    </div>