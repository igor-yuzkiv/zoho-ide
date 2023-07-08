<?php
return [
    'client_id'  => env('ZOHO_CONNECT_CLIENT_ID', ''),
    'client_secret'  => env('ZOHO_CONNECT_CLIENT_SECRET', ''),
    'default_data_center' => "us",
    'data_center'         => [
        'us' => [
            'title'    => 'United States',
            'domain'   => '.com',
            'location' => 'us',
        ],
        'eu' => [
            'title'    => 'Europe',
            'domain'   => '.eu',
            'location' => 'eu',
        ],
        'in' => [
            'title'    => 'India',
            'domain'   => '.in',
            'location' => 'in',
        ],
        'au' => [
            'title'    => 'Australia',
            'domain'   => '.com.au',
            'location' => 'au',
        ],
        'jp' => [
            'title'    => 'Japan',
            'domain'   => '.jp',
            'location' => 'jp',
        ],
    ],
];
