<?php
    /**
     * CORE CONSTANT OF THE TEMPLATE
    */
    define('DS', DIRECTORY_SEPARATOR);
    //application root
	define('APPROOT' , dirname(dirname(__FILE__)));
	//core root
    define('CORE' , APPROOT.DS.'core');
    //
	define('CLASSES' , APPROOT.DS.'classes');
	//
	define('BASE_DIR', dirname(dirname(dirname(__FILE__))));
	//models
	define('MODELS' , APPROOT.DS.'models');
	//controllers
    define('CNTLRS' , APPROOT.DS.'controllers');

	define('CONFIG' , APPROOT.DS.'config');
	//controllers
	define('API' , APPROOT.DS.'api');
	//helpers root
	define('HELPERS', APPROOT.DS.'helpers');
	//library
	define('LIBS' , APPROOT.DS.'libraries');
	//funtions
    define('FNCTNS' ,  APPROOT.DS.'functions');

	define('VIEWS' , APPROOT.DS.'views');
    ##########################################################################################

    /**
     * SYSTEM MODES
     * UP(UP AND RUNNING) , DOWN(MAINTENANCE) , DEV(DEVELOPMENT TEST DABATASE) , LOCAL (LOCAL MODE)
     */
    $system['mode']  = 'local';

    /**
     * SYSTEM SITE NAME
     */
    $system['site_name'] = 'MVC';

    /**
     * TIMEZONE
     */
    $system['time_zone'] = 'Asia/Manila';


    /** VERSION */

    $system['version']  = 'N/A';


    $system['app_name'] = 'NEXT META';

    $ui = [
        'vendor' => 'cork'
    ];



    date_default_timezone_set($system['time_zone']);