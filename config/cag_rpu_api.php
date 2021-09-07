<?php
return [
    'auth' => [
        'client_login_url' => env('API_URL_RPU', '') . '/client-login',
        'client_id' => env('RPU_CLIENT_ID', ''),
        'client_pass' => env('RPU_CLIENT_PASS', ''),
    ],

    'get-office-ministry-list' => env('API_URL_RPU', '') . '/get-office-ministry-list',
    'get-office-layer-ministry-wise' => env('API_URL_RPU', '') . '/get-office-layer-ministry-wise',
    'get-rp-office-ministry-and-layer-wise' => env('API_URL_RPU', '') . '/get-office-ministry-and-layer-wise',
];