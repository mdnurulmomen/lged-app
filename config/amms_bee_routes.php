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

        'strategic_plan_outcome_lists' => env('API_URL_BEE', '') . '/x-strategic-plan/outcome',
        'strategic_plan_outcome_create' => env('API_URL_BEE', '') . '/x-strategic-plan/outcome/create',
        'strategic_plan_outcome_show' => env('API_URL_BEE', '') . '/x-strategic-plan/outcome/show',
        'strategic_plan_outcome_update' => env('API_URL_BEE', '') . '/x-strategic-plan/outcome/update',
        'strategic_plan_outcome_delete' => env('API_URL_BEE', '') . '/x-strategic-plan/outcome/delete',

        'strategic_plan_output_lists' => env('API_URL_BEE', '') . '/x-strategic-plan/output',
        'strategic_plan_output_create' => env('API_URL_BEE', '') . '/x-strategic-plan/output/create',
        'strategic_plan_output_show' => env('API_URL_BEE', '') . '/x-strategic-plan/output/show',
        'strategic_plan_output_update' => env('API_URL_BEE', '') . '/x-strategic-plan/output/update',
        'strategic_plan_output_delete' => env('API_URL_BEE', '') . '/x-strategic-plan/output/delete',

        'op_yearly_lists' => env('API_URL_BEE', '') . '/x-operational-plan/yearly',
        'op_yearly_create' => env('API_URL_BEE', '') . '/x-operational-plan/yearly/create',
        'op_yearly_show' => env('API_URL_BEE', '') . '/x-operational-plan/yearly/show',
        'op_yearly_update' => env('API_URL_BEE', '') . '/x-operational-plan/yearly/update',
        'op_yearly_delete' => env('API_URL_BEE', '') . '/x-operational-plan/yearly/delete',

        'op_activity_lists' => env('API_URL_BEE', '') . '/x-operational-plan/activity',
        'op_activity_create' => env('API_URL_BEE', '') . '/x-operational-plan/activity/create',
        'op_activity_show' => env('API_URL_BEE', '') . '/x-operational-plan/activity/show',
        'op_activity_update' => env('API_URL_BEE', '') . '/x-operational-plan/activity/update',
        'op_activity_delete' => env('API_URL_BEE', '') . '/x-operational-plan/activity/delete',
    ],
    'audit_operational_plan' => [
        'op_yearly_lists' => env('API_URL_BEE', '') . '/x-operational-plan/yearly',
        'op_yearly_create' => env('API_URL_BEE', '') . '/x-operational-plan/yearly/create',
        'op_yearly_show' => env('API_URL_BEE', '') . '/x-operational-plan/yearly/show',
        'op_yearly_update' => env('API_URL_BEE', '') . '/x-operational-plan/yearly/update',
        'op_yearly_delete' => env('API_URL_BEE', '') . '/x-operational-plan/yearly/delete',

        'op_activity_lists' => env('API_URL_BEE', '') . '/x-operational-plan/activity',
        'op_activity_create' => env('API_URL_BEE', '') . '/x-operational-plan/activity/create',
        'op_activity_show' => env('API_URL_BEE', '') . '/x-operational-plan/activity/show',
        'op_activity_update' => env('API_URL_BEE', '') . '/x-operational-plan/activity/update',
        'op_activity_delete' => env('API_URL_BEE', '') . '/x-operational-plan/activity/delete',

        'op_activity_milestone_lists' => env('API_URL_BEE', '') . '/x-operational-plan/activity-milestone',
        'op_activity_milestone_create' => env('API_URL_BEE', '') . '/x-operational-plan/activity-milestone/create',
        'op_activity_milestone_show' => env('API_URL_BEE', '') . '/x-operational-plan/activity-milestone/show',
        'op_activity_milestone_update' => env('API_URL_BEE', '') . '/x-operational-plan/activity-milestone/update',
        'op_activity_milestone_delete' => env('API_URL_BEE', '') . '/x-operational-plan/activity-milestone/delete',
    ],
];
