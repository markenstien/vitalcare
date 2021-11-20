<?php
    
    $config = [
        // Location where to redirect users once they authenticate with a provider
        'callback' => 'https://corefounders.com/socialController/index',

        // Providers specifics
        'providers' => [
            'Facebook' => ['enabled' => true, 'keys' => ['id' => '543688486853367', 'secret' => 'b9134b5e8f8278cc0b6ace6ff6160ae4']], // To populate in a similar way to 
            'Google' => [
                'enabled' => true,
                'keys' => [
                        'id' => '500012604499-i1c3ee5ko2l4esu8oc8gfiee1bmqceud.apps.googleusercontent.com', 
                        'secret' => 'Kat1HXCaRapMSMZz7VgmDjsd'
                    ]
                ]  // And so on
        ]
    ];

    return $config;
?>