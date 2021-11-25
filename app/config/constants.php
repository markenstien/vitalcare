<?php

    #################################################
	##             THIRD-PARTY APPS                ##
    #################################################

    define('DEFAULT_REPLY_TO' , '');

    const MAILER_AUTH = [
        // 'username' => '',
        // 'password' => '',
        // 'host'     => '',
        // 'name'     => '',
        // 'replyTo'  => '',
        // 'replyToName' => ''
    ];

    const ITEXMO = [
        'key' => '',
        'pwd' => ''
    ];

    #################################################
	##             EXTENDED APPS                   ##
	#################################################
	const APP_EXTENSIONS = [
		'cxbook' => [
			'base_controller' => 'Accounts',
			'base_method'     => 'index'
        ]
    ];

    define('APP_EXTENSIONS_PATH' , APPROOT.DS.'softwares');

	#################################################
	##             SYSTEM CONFIG                ##
    #################################################


    define('GLOBALS' , APPROOT.DS.'classes/globals');

    define('SITE_NAME' , 'vitalcare.sbs');

    define('COMPANY_NAME' , 'VITAL CARE');

    define('KEY_WORDS' , '#############');


    define('DESCRIPTION' , '#############');

    define('AUTHOR' , SITE_NAME);


    
?>