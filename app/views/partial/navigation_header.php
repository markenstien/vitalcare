<header class="header navbar navbar-expand-sm">
    <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
    stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12">
    </line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
    </a>

    <div class="nav-logo align-self-center">
        <a class="navbar-brand" href="<?php echo _route('home:index')?>">
            <span class="navbar-brand-name"><?php echo COMPANY_NAME?></span>
        </a>
    </div>

    <ul class="navbar-item flex-row mr-auto">
        
    </ul>

    <?php if( whoIs() ) :?>
        <ul class="navbar-item flex-row nav-dropdowns">
            <li class="nav-item dropdown user-profile-dropdown order-lg-0 order-1">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="user-profile-dropdown" 
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media">
                        <div class="media-body align-self-center">
                            <h6><span>Hi,</span> <?php echo whoIs('display_name')?></h6>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </a>
                <div class="dropdown-menu position-absolute animated fadeInUp" aria-labelledby="user-profile-dropdown">
                    <div class="">
                        <div class="dropdown-item">
                            <a class="" href="<?php echo _route('api:edit')?>"></line></svg> Edit API</a>
                        </div>

                        <div class="dropdown-item">
                            <a class="" href="<?php echo _route('login:destroy')?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> Sign Out</a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>

    <?php else:?>
        <ul class="navbar-item flex-row nav-dropdowns">
            <li class="nav-item dropdown user-profile-dropdown order-lg-0 order-1">
                <a href="<?php echo _route('login:index')?>" class="nav-link" 
                        aria-haspopup="true" aria-expanded="false">
                    <div class="media">
                        <div class="media-body align-self-center">
                            <h6>Login</h6>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    <?php endif?>
</header>