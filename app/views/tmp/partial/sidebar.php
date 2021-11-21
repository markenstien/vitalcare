
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><?php echo COMPANY_NAME?></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Main
    </div>

    <li class="nav-item">
        <a class="nav-link" href="<?php echo _route('user:index')?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>User</span></a>
    </li>   

    <li class="nav-item">
        <a class="nav-link" href="<?php echo _route('category:index')?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Categories</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Services</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Modules</h6>
                <a class="collapse-item" href="<?php echo _route('service:index')?>">Service</a>
                <a class="collapse-item" href="<?php echo _route('service-bundle:index')?>">Bundles</a>
            </div>
        </div>
    </li>
    
    
    <li class="nav-item">
        <a class="nav-link" href="<?php echo _route('specialty:index')?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Specialties</span></a>
    </li>
</ul>