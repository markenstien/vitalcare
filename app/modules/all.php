<?php   
    $module = [];
    /**
     * COMPANY MODULE
     */

    $module['apis'] = [
        'lol' => [
            'key' => getMLAPI(),
            'secret' => ''
        ]
    ];

    $module['games'] = [
        'dota'  => 'dota_2',
        'ml'    => 'mobile_legends',
        'lol'   => 'league_of_legends'
    ];


    $module['endpoints'] = [
        'dota' => [],
        'lol'  => [
            'avatars' => 'http://ddragon.leagueoflegends.com/cdn/11.21.1/data/en_US/champion.json',
        ]
    ];

    $module['dota'] = [
        'matchIds' => [
            "6223446359",
            "6223390469",
            "6221491372",
            "6221412840",
            "6219755267",
            "6219661981",
            "6216665747",
            "6216584699",
            "6183908492",
            "6166213028",
            "956982544",
            "959197504",
            "1024222805",
            "1091350353"
        ]
    ];
    $module['lol'] =  [
        'divisions' => [
            'I',
            'II',
            'III',
            'IV',
        ],

        'tiers' => [
            'Diamond',
            'Platinum',
            'Gold',
            'Silver',
            'Bronze',
            'Iron'
        ],

        'queues' => [
            'RANKED_SOLO_5x5',
            'RANKED_FLEX_SR',
            'RANKED_FLEX_IT'
        ],

        'pu_ids' => [
            'LaGQMlldopoFjhVN4aTPOU63wn1jGroNvkUmwHGj1vs1pMy2bwHn5GMiZfqlSRW6a6g7rt_CHRyB1Q',
            'eq8GnOP_VHYpAmZTbq8KrCCzjy3lc-AqaXiYu__xMsf-IJiMGBMp0-pLbDX3v0gV0iEMWovSBFvKug',
            '_or6qjcA3zUF2tKlzACI0-x3rlAjyOCZmFOOK4xNUzlYqFLJ2vA9qIQXbcT9SiFNyed8PlI8uOuZqA',
            'ZfOvXGWcwqtuH4s_qtlBY1SAx8voDopNr6GiScX37i5PJJWQlSDqm_UbMKYoULBVcTbR_wV7XuUXCw'
        ],

        'matchIds' => [
            "KR_5537154819",
            "KR_5535539435",
            "KR_5532949218",
            "KR_5529998080",
            "KR_5528711182",
            "KR_5526938429",
            "KR_5526896973",
            "KR_5524235060",
            "KR_5524162540",
            "KR_5522939558",
            "KR_5512087783",
            "KR_5512095780",
            "KR_5507416529",
            "KR_5506581473",
            "KR_5498306382",
            "KR_5496797919",
            "KR_5496777228",
            "KR_5487905937",
            "KR_5487894039",
            "KR_5485864952",
            "KR_5539671398",
            "KR_5538127997",
            "KR_5521895534",
            "KR_5521093957",
            "KR_5521037345",
            "KR_5517279607",
            "KR_5517258946",
            "KR_5517298063",
            "KR_5517297747",
            "KR_5515059844",
            "KR_5515114593",
            "KR_5515052465",
            "KR_5515020290",
            "KR_5513208080",
            "KR_5513245946",
            "KR_5513176834",
            "KR_5513166313",
            "KR_5513253316",
            "KR_5513222163",
            "KR_5513191425"
        ]
    ];
    
    return $module;