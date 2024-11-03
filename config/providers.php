<?php
return [
    'etranzact' => [
        'tid' => [
            'live' => env('ET_TID_LIVE'),
            'test' => env('ET_TID_TEST'),
        ],
        'pin_enc' => [
            'live' => env('ET_PIN_ENC_LIVE'),
            'test' => env('ET_PIN_ENC_TEST'),
        ],
        'url' => [
            'live' => env('ET_URL_LIVE'),
            'test' => env('ET_URL_TEST'),
        ]
    ],

                    'spout' => [
                        'token' => env('SPOUT_TOKEN'),
                        'key' => env('SPOUT_API_KEY'),
                        'hashed_key' => env('SPOUT_HASHED_KEY'),
                        'email' => 'andywabali@gmail.com',
                        'identifier' => env('SPOUT_IDENTIFIER'),
                        'pin' => env('SPOUT_PIN'),
                        'url' => [
                            'live' => env('SPOUT_URL_LIVE'),
                            'test' => env('SPOUT_URL_TEST'),
                        ]
                    ],

    'vtpass' => [
        'keys' => [
            'live' => [
                'api_key' => env('VTPASS_LIVE_API_KEY'),
                'public_key' => env('VTPASS_LIVE_PUBLIC_KEY'),
                'secret_key' => env('VTPASS_LIVE_SECRET_KEY')
            ],
            'test' => [
                'api_key' => env('VTPASS_API_KEY'),
                'public_key' => env('VTPASS_PUBLIC_KEY'),
                'secret_key' => env('VTPASS_SECRET_KEY')
            ]
        ],
        'url' => [
            'live' => env('VTPASS_URL_LIVE'),
            'test' => env('VTPASS_URL_TEST'),
        ]
    ],

    'viral' => [
        'url' => env('VIRAL_URL')
    ],

    'paygate' => [
        'url' => 'https://api.paygateplus.ng/v2',
        'api-key' => env('PAYGATE_API_KEY'),
        'sec-key' => env('PAYGATE_SEC_KEY')
    ],

    'vfd' => [
        'url' => [
            'test' => env('VFD_TEST_URL'),
            'live' => env('VFD_LIVE_URL')
        ],
        'credential' => [
            'test' => 'TGc2OURtRU82Nk5wWHBKZGFnYmJSWHZPQm9VYTpmbnFWZVI2a2IyMlFIcmZPY01TUDJoVFkwMThh',
            'live' => ''
        ],
    ],
    'virtual' => [
        'url' => [
            'test' => env('SPOUT_VIRTUAL_SERVICES_TEST'),
            'live' => env('SPOUT_VIRTUAL_SERVICES_LIVE')
        ],
    ]
];
