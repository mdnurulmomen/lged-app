<?php
return [
    'secret_key' => env('SECRET_KEY', ''),
    'office_domain_redirection' => env('OFFICE_DOMAIN_REDIRECTION', 'false'),
    'visit_calendar_status' => [
        '0' => 'done',
        '1' =>'reject',
        '2' =>'pending',
        '3' =>'in-progress'
    ],
    'ocag_office_id' => 1
];
