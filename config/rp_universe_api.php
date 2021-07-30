<?php
return [
    'auth' => [
        'client_login_url' => env('API_URL_RP', '') . '/client/login',
        'client_id' => env('RP_CLIENT_ID', ''),
        'client_pass' => env('RP_CLIENT_PASS', ''),
    ],

    'offices' => env('API_URL_RP', '') . '/offices',
    'office_unit_designation_map' => env('API_URL_RP', '') . '/office/unit-designation-map',
    'office_unit_designation_employee_map' => env('API_URL_RP', '') . '/office/unit-designation-employee-map',

];
