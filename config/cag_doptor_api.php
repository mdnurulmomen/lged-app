<?php
return [
    'auth' => [
        'client_login_url' => env('API_URL_DOPTOR', '') . '/client/login',
        'client_id' => env('DOPTOR_CLIENT_ID', ''),
        'client_pass' => env('DOPTOR_CLIENT_PASS', ''),
    ],
    'offices' => env('API_URL_DOPTOR', '') . '/offices',
    'office_unit_designation_map' => env('API_URL_DOPTOR', '') . '/office/unit-designation-map',
    'office_unit_designation_employee_map' => env('API_URL_DOPTOR', '') . '/office/unit-designation-employee-map',
];