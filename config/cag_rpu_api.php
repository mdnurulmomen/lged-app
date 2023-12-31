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
    'get-office-by-parent-office-autoselect' => env('API_URL_RPU', '') . '/get-office-by-parent-office-autoselect',
    'get-office-layer-ministry-wise' => env('API_URL_RPU', '') . '/get-office-layer-ministry-wise',
    'get-rp-office-ministry-and-layer-wise' => env('API_URL_RPU', '') . '/get-office-ministry-and-layer-wise',
    'get-rp-office-ministry-wise' => env('API_URL_RPU', '') . '/get-entity-office-ministry-wise',
    'get-ministry-parent-wise-child-office' => env('API_URL_RPU', '') . '/get-ministry-parent-wise-child-office',
    'get-office-other-info' => env('API_URL_RPU', '') . '/get-office-other-info',
    'get-directorate-wise-ministry-list' => env('API_URL_RPU', '') . '/get-directorate-wise-ministry-list',
    'get-rpu-list-mis' => env('API_URL_RPU', '') . '/get-rpu-list-mis',
    'office-ministry-wise-entity' => env('API_URL_RPU', '') . '/office-ministry-wise-entity',
    'get-user-list' => env('API_URL_RPU', '') . '/get-user-list',

    'get-entity-wise-unit-group-office' => env('API_URL_RPU', '') . '/get-entity-wise-unit-group-office',
    'get-entity-or-unit-group-wise-cost-center' => env('API_URL_RPU', '') . '/get-entity-or-unit-group-wise-cost-center',

    'get-all-projects' => env('API_URL_RPU', '') . '/projects/list',
    'update-projects' => env('API_URL_RPU', '') . '/projects/update',

    'get-project-wise-entity' => env('API_URL_RPU', '') . '/cost_center_project_map/project-wise-entity-list',
    'get-project-wise-cost-center' => env('API_URL_RPU', '') . '/cost_center_project_map/project-wise-cost-center-list',
    'get-project-wise-nominated-cost-center-list' => env('API_URL_RPU', '') . '/cost_center_project_map/project-map-nominated-cost-center-list',
    'get-project-map-cos-center-autoselect' => env('API_URL_RPU', '') . '/cost-center-sector-map/get-project-map-cos-center-autoselect',
    'get-project-wise-doner' => env('API_URL_RPU', '') . '/project/get-project-wise-doner',

    //rpu apotti
    'get-rpu-apotti-item' => env('API_URL_RPU', '') . '/apotti/get-apotti-item',
    'apotti-response-submit' => env('API_URL_RPU', '') . '/apotti/apotti-response-submit',
    'store-rpu-broad-sheet' => env('API_URL_RPU', '') . '/apotti/store-rpu-broad-sheet',
    'get-ministry-wise-apotti-entity' => env('API_URL_RPU', '') . '/apotti/get-ministry-wise-apotti-entity',
    'get-directorate-wise-ministry-total-observation' => env('API_URL_RPU', '') . '/apotti/get-directorate-wise-ministry-total-observation',


    'get-all-doner' => env('API_URL_RPU', '') . '/doner-agency/list',
    'get-doner-wise-project' => env('API_URL_RPU', '') . '/doner-agency/get-doner-wise-project',

    'functions' => [
        'list' => env('API_URL_RPU', '') . '/functions/list',
        'update' => env('API_URL_RPU', '') . '/functions/update',
    ],

    'master_units' => [
        'list' => env('API_URL_RPU', '') . '/master-units/list',
        'update' => env('API_URL_RPU', '') . '/master-units/update',
    ],

    'cost-center-sector-map' => [
        'cost-centers' => env('API_URL_RPU', '') . '/cost-center-sector-map/cost-centers',
    ],

    'areas' =>env('API_URL_RPU', '') . '/audit-areas',
];
