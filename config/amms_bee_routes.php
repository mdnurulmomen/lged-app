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
        'strategic_plan_outcome_remarks' => env('API_URL_BEE', '') . '/x-strategic-plan/outcome/remarks',
        'strategic_plan_outcome_create' => env('API_URL_BEE', '') . '/x-strategic-plan/outcome/create',
        'strategic_plan_outcome_show' => env('API_URL_BEE', '') . '/x-strategic-plan/outcome/show',
        'strategic_plan_outcome_update' => env('API_URL_BEE', '') . '/x-strategic-plan/outcome/update',
        'strategic_plan_outcome_delete' => env('API_URL_BEE', '') . '/x-strategic-plan/outcome/delete',

        'strategic_plan_output_lists' => env('API_URL_BEE', '') . '/x-strategic-plan/output',
        'strategic_plan_output_by_outcome' => env('API_URL_BEE', '') . '/x-strategic-plan/output/by-outcome',
        'strategic_plan_output_create' => env('API_URL_BEE', '') . '/x-strategic-plan/output/create',
        'strategic_plan_output_show' => env('API_URL_BEE', '') . '/x-strategic-plan/output/show',
        'strategic_plan_output_update' => env('API_URL_BEE', '') . '/x-strategic-plan/output/update',
        'strategic_plan_output_delete' => env('API_URL_BEE', '') . '/x-strategic-plan/output/delete',

        'responsible_offices_lists' => env('API_URL_BEE', '') . '/responsible-offices',
        'responsible_offices_create' => env('API_URL_BEE', '') . '/responsible-offices/create',
        'responsible_offices_show' => env('API_URL_BEE', '') . '/responsible-offices/show',
        'responsible_offices_update' => env('API_URL_BEE', '') . '/responsible-offices/update',
        'responsible_offices_delete' => env('API_URL_BEE', '') . '/responsible-offices/delete',
    ],
    'audit_operational_plan' => [
        'op_activity_lists' => env('API_URL_BEE', '') . '/operational-plan/activity',
        'op_activity_find' => env('API_URL_BEE', '') . '/operational-plan/activity/find',
        'op_activity_create' => env('API_URL_BEE', '') . '/operational-plan/activity/create',
        'op_activity_show' => env('API_URL_BEE', '') . '/operational-plan/activity/show',
        'op_activity_update' => env('API_URL_BEE', '') . '/operational-plan/activity/update',
        'op_activity_delete' => env('API_URL_BEE', '') . '/operational-plan/activity/delete',

        'op_activity_milestone_lists' => env('API_URL_BEE', '') . '/operational-plan/activity-milestone',
        'op_activity_milestone_create' => env('API_URL_BEE', '') . '/operational-plan/activity-milestone/create',
        'op_activity_milestone_show' => env('API_URL_BEE', '') . '/operational-plan/activity-milestone/show',
        'op_activity_milestone_update' => env('API_URL_BEE', '') . '/operational-plan/activity-milestone/update',
        'op_activity_milestone_delete' => env('API_URL_BEE', '') . '/operational-plan/activity-milestone/delete',

        'op_yearly_audit_calendar_lists' => env('API_URL_BEE', '') . '/operational-plan/yearly-audit-calendar',
        'op_yearly_audit_calendar_movement_history' => env('API_URL_BEE', '') . '/operational-plan/audit-calendar/movement/history',
        'op_yearly_audit_calendar_movement_create' => env('API_URL_BEE', '') . '/operational-plan/audit-calendar/movement/create',
        'op_yearly_audit_calendar_change_status' => env('API_URL_BEE', '') . '/operational-plan/audit-calendar/change-status',
        'op_calendar_all_lists' => env('API_URL_BEE', '') . '/operational-plan/audit-calendar/calendar-activities',
        'op_calendar_milestone_target_date_update' => env('API_URL_BEE', '') . '/operational-plan/audit-calendar/milestones/date/update',
        'op_calendar_responsible_assign' => env('API_URL_BEE', '') . '/operational-plan/audit-calendar/responsible/create',
        'op_calendar_comment_update' => env('API_URL_BEE', '') . '/operational-plan/audit-calendar/comment/update',
        'op_calendar_pending_events' => env('API_URL_BEE', '') . '/operational-plan/audit-calendar/pending-events-for-publish',

        'load_operational_plan_lists' => env('API_URL_BEE', '') . '/operational-plan/list',
        'load-operational-plan-details' => env('API_URL_BEE', '') . '/operational-plan/details',

    ],
];
