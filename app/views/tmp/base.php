<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>NEW META</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <link href="<?php echo _path_tmp('assets/css/loader.css')?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo _path_tmp('assets/js/loader.js')?>"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="<?php echo _path_tmp('bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo _path_tmp('assets/css/plugins.css')?>" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="<?php echo _path_tmp('plugins/apex/apexcharts.css')?>" rel="stylesheet" type="text/css">
    <link href="<?php echo _path_tmp('assets/css/dashboard/dash_2.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo _path_tmp('assets/css/components/custom-media_object.css')?>" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="<?php echo _path_tmp('plugins/table/datatable/datatables.css')?>">
    <link rel="stylesheet" type="text/css" href="<?php echo _path_tmp('plugins/table/datatable/dt-global_style.css')?>">

    <style>
        #id_reset_countdown{
            box-sizing: border-box;
            /* background-color: #1b55e2; */
            color: #fff;
            text-align: center;
            font-weight: bold;
            font-size: 1.3em;
            
            padding: 5px 0px;
        }
    </style>
    <?php produce('headers')?>
    <?php produce('styles')?>
    <!-- END PAGE LEVEL STYLES -->

</head>
<body class="alt-menu sidebar-noneoverflow">
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <div class="header-container">
        <?php grab('partial/navigation_header')?>
        <?php $recent_reset_date = date(getRecentGameResetDate())?> 
        <div class="container">
        <div id="id_reset_countdown">
            <h5>Countdown before reset <span id="id_reset_countdown_counter"><?php echo $recent_reset_date?></span></h5>
            <input type="hidden" value="<?php echo $recent_reset_date?>" id="recent_reset_date">
        </div>
        </div>
        <?php grab('partial/navigation_main')?>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN TOPBAR  -->
        <?php produce('navigation') ?>
        <!--  END TOPBAR  -->
        
        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <?php if( isset($pageTitle)):?>
                <div class="page-header">
                    <div class="page-title">
                        <h3><?php echo $pageTitle?></h3>
                    </div>
                </div>
                <?php endif?>

                <div class="layout-top-spacing">
                    <?php produce('content')?>
                </div>

                <div class="footer-wrapper">
                    <div class="footer-section f-section-1">
                        <p class="">Copyright © 2021 <?php echo COMPANY_NAME?></p>
                    </div>
                </div>

            </div>
        </div>
        <!--  END CONTENT PART  -->

    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="<?php echo _path_tmp('assets/js/libs/jquery-3.1.1.min.js')?>"></script>

    <script>
        $( document ).ready( function() {
            
            var $recent_reset_date = $("#recent_reset_date");

            var countDownDate = new Date($recent_reset_date.val())

            countDownDate.setDate( countDownDate.getDate() + 12 );

            // Update the count down every 1 second
            var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();
                
            // Find the distance between now and the count down date
            var distance = countDownDate - now;
            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                
            // Output the result in an element with id="demo"
            document.getElementById("id_reset_countdown_counter").innerHTML = days + "d " + hours + "h "
            + minutes + "m " + seconds + "s ";
                
            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("id_reset_countdown_counter").innerHTML = "EXPIRED";
            }
            }, 1000);
        });
    </script>

    <script src="<?php echo _path_tmp('bootstrap/js/popper.min.js')?>"></script>
    <script src="<?php echo _path_tmp('bootstrap/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo _path_tmp('plugins/perfect-scrollbar/perfect-scrollbar.min.js')?>"></script>
    <script src="<?php echo _path_tmp('assets/js/app.js')?>"></script>
    <script src="<?php echo _path_tmp('plugins/table/datatable/datatables.js')?>"></script>
    <script>
        $(document).ready(function() {
            App.init();

            $('.dataTable').DataTable({
                "oLanguage": {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [7, 10, 20, 50],
                "pageLength": 7 
            });
        });
        
    </script>
    <script src="<?php echo _path_tmp('assets/js/custom.js')?>"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="<?php echo _path_tmp('plugins/apex/apexcharts.min.js')?>"></script>
    <script src="<?php echo _path_tmp('assets/js/dashboard/dash_2.js')?>"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <?php produce('scripts')?>

    
</body>
</html>