<?php

    #################################################
	##             THIRD-PARTY APPS                ##
    #################################################

    define('DEFAULT_REPLY_TO' , '');

    const MAILER_AUTH = [
        'username' => 'super@vitalcare.sbs',
        'password' => 'c;6*CBlLMFFz',
        'host'     => 'vitalcare.sbs',
        'name'     => 'VitalCare',
        'replyTo'  => 'super@vitalcare.sbs',
        'replyToName' => 'VitalCare'
    ];


    const ITEXMO = [
        'key' => 'ST-MARKG387451_V6YZ8',
        'pwd' => '(7]8bu4]ja'
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

    define('COMPANY_NAME' , 'M_THESIS');

    define('KEY_WORDS' , 'M_THESIS_RSV_BLLING');


    define('DESCRIPTION' , 'M_THESIS_RSV_BLLING');

    define('AUTHOR' , SITE_NAME);
?>