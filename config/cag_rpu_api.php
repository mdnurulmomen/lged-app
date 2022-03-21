<?php
return [
    'auth' => [
        'client_login_url' => env('API_URL_RPU', '') . '/client-login',
        'client_id' => env('RPU_CLIENT_ID', ''),
        'client_pass' => env('RPU_CLIENT_PASS', ''),
    ],

    'get-office-category-types' => env('API_URL_RPU', '') . '/get-all-office-category-types',
    'get-office-ministry-list' => env('API_URL_RPU', '') . '/get-office-ministry-list',
    'get-parent-wise-child-office' => env('API_URL_RPU', '') . '/get-parent-wise-child-office',
    'get-parent-with-child-office' => env('API_URL_RPU', '') . '/get-parent-with-child-office',
    'get-office-layer-ministry-wise' => env('API_URL_RPU', '') . '/get-office-layer-ministry-wise',
    'get-rp-office-ministry-and-layer-wise' => env('API_URL_RPU', '') . '/get-office-ministry-and-layer-wise',
    'get-rp-office-ministry-wise' => env('API_URL_RPU', '') . '/get-entity-office-ministry-wise',
    'get-ministry-parent-wise-child-office' => env('API_URL_RPU', '') . '/get-ministry-parent-wise-child-office',
    'get-office-other-info' => env('API_URL_RPU', '') . '/get-office-other-info',
    'get-directorate-wise-ministry-list' => env('API_URL_RPU', '') . '/get-directorate-wise-ministry-list',
    'get-rpu-list-mis' => env('API_URL_RPU', '') . '/get-rpu-list-mis',
    'office-ministry-wise-entity' => env('API_URL_RPU', '') . '/office-ministry-wise-entity',
    'get-user-list' => env('API_URL_RPU', '') . '/get-user-list',
];
