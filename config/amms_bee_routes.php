<?php
return [
    'settings' => [
        'fiscal_year_lists' => env('API_URL_BEE', '') . '/fiscal-year',
        'fiscal_year_create' => env('API_URL_BEE', '') . '/fiscal-year/create',
        'fiscal_year_show' => env('API_URL_BEE', '') . '/fiscal-year/show',
        'fiscal_year_update' => env('API_URL_BEE', '') . '/fiscal-year/update',
        'fiscal_year_delete' => env('API_URL_BEE', '') . '/fiscal-year/delete',

        'strategic_plan_duration_lists' => env('API_URL_BEE', '') . '/x-strategic-plan/duration',
        'strategic_plan_duration_create' => env('API_URL_BEE', '') . '/x-strategic-plan/duration/create',
        'strategic_plan_duration_show' => env('API_URL_BEE', '') . '/x-strategic-plan/duration/show',
        'strategic_plan_duration_update' => env('API_URL_BEE', '') . '/x-strategic-plan/duration/update',
        'strategic_plan_duration_delete' => env('API_URL_BEE', '') . '/x-strategic-plan/duration/delete',
    ]
];
