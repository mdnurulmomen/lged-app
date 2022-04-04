<?php
return [
    'auth' => [
        'client_login_url' => env('API_URL_PONJIKA', '') . '/client-login',
        'client_id' => env('PONJIKA_CLIENT_ID', ''),
        'client_pass' => env('PONJIKA_CLIENT_PASS', ''),
    ],

    'tasks' => [
        'list' => [
            'pending' => env('API_URL_PONJIKA', '') . '/tasks/pending',
            'all' => env('API_URL_PONJIKA', '') . '/tasks',
        ],
        'store' => env('API_URL_PONJIKA', '') . '/tasks/store',
        'update' => env('API_URL_PONJIKA', '') . '/tasks/update',
        'update_status' => env('API_URL_PONJIKA', '') . '/tasks/update/status',
        'users' => env('API_URL_PONJIKA', '') . '/tasks/users',
        'pending' => env('API_URL_PONJIKA', '') . '/tasks/pending',
    ],
];
