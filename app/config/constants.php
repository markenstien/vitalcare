<?php

    #################################################
	##             THIRD-PARTY APPS                ##
    #################################################

    define('DEFAULT_REPLY_TO' , '');

    const MAILER_AUTH = [
        'username' => 'super@vitalcare.sbs',
        'password' => 'c;6*CBlLMFFz',
        'host'     => 'vitalcare.sbs',
        'name'     => 'vitalcare',
        'replyTo'  => 'super@vitalcare.sbs',
        'replyToName' => 'vitalcare'
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

    define('KEY_WORDS' , 'VITALCARE,DIAGNOSTIC');


    define('DESCRIPTION' , 'VITALCARE,DIAGNOSTIC');

    define('AUTHOR' , SITE_NAME);
?>