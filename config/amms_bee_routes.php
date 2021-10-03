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
        'op_activity_lists' => env('API_URL_BEE', '') . '/planning/operational-plan/activity',
        'op_activity_find' => env('API_URL_BEE', '') . '/planning/operational-plan/activity/find',
        'op_activity_by_fiscal_year' => env('API_URL_BEE', '') . '/planning/operational-plan/activity/all-by-fiscal-year',
        'op_activity_milestones_load' => env('API_URL_BEE', '') . '/planning/operational-plan/activity/milestones',
        'op_activity_create' => env('API_URL_BEE', '') . '/planning/operational-plan/activity/create',
        'op_activity_show' => env('API_URL_BEE', '') . '/planning/operational-plan/activity/show',
        'op_activity_update' => env('API_URL_BEE', '') . '/planning/operational-plan/activity/update',
        'op_activity_delete' => env('API_URL_BEE', '') . '/planning/operational-plan/activity/delete',

        'op_activity_milestone_lists' => env('API_URL_BEE', '') . '/planning/operational-plan/activity-milestone',
        'op_activity_milestone_create' => env('API_URL_BEE', '') . '/planning/operational-plan/activity-milestone/create',
        'op_activity_milestone_show' => env('API_URL_BEE', '') . '/planning/operational-plan/activity-milestone/show',
        'op_activity_milestone_update' => env('API_URL_BEE', '') . '/planning/operational-plan/activity-milestone/update',
        'op_activity_milestone_delete' => env('API_URL_BEE', '') . '/planning/operational-plan/activity-milestone/delete',

        'op_yearly_audit_calendar_lists' => env('API_URL_BEE', '') . '/planning/operational-plan/audit-calendar',
        'op_yearly_audit_calendar_years' => env('API_URL_BEE', '') . '/planning/operational-plan/audit-calendar/years-to-create',
        'op_yearly_audit_calendar_create' => env('API_URL_BEE', '') . '/planning/operational-plan/audit-calendar/create',
        'op_yearly_audit_calendar_movement_history' => env('API_URL_BEE', '') . '/planning/operational-plan/audit-calendar/movement/history',
        'op_yearly_audit_calendar_movement_create' => env('API_URL_BEE', '') . '/planning/operational-plan/audit-calendar/movement/create',
        'op_yearly_audit_calendar_change_status' => env('API_URL_BEE', '') . '/planning/operational-plan/audit-calendar/change-status',
        'op_calendar_all_lists' => env('API_URL_BEE', '') . '/planning/operational-plan/audit-calendar/calendar-activities',
        'op_calendar_milestone_target_date_update' => env('API_URL_BEE', '') . '/planning/operational-plan/audit-calendar/milestones/date/update',
        'op_calendar_responsible_assign' => env('API_URL_BEE', '') . '/planning/operational-plan/audit-calendar/responsible/create',
        'op_calendar_comment_update' => env('API_URL_BEE', '') . '/planning/operational-plan/audit-calendar/comment/update',

        'op_calendar_pending_events' => env('API_URL_BEE', '') . '/planning/operational-plan/audit-calendar/pending-events-for-publish',
        'op_calendar_publish_events_as_calendars' => env('API_URL_BEE', '') . '/planning/operational-plan/audit-calendar/publish-event-as-calendar',

        'load_operational_plan_lists' => env('API_URL_BEE', '') . '/planning/operational-plan/list',
        'load_operational_plan_details' => env('API_URL_BEE', '') . '/planning/operational-plan/details',
    ],

    'audit_annual_plan' => [
        'ap_yearly_plan_lists' => env('API_URL_BEE', '') . '/planning/annual-plan/all',
        'ap_yearly_plan_submission' => env('API_URL_BEE', '') . '/planning/annual-plan/plan-submission/create',
        'ap_yearly_plan_selected_rp_lists' => env('API_URL_BEE', '') . '/planning/annual-plan/rp-entities/all-added',
        'ap_yearly_plan_selected_rp_store' => env('API_URL_BEE', '') . '/planning/annual-plan/rp-entities/store',
        'ap_submit_plan_to_ocag' => env('API_URL_BEE', '') . '/planning/annual-plan/submit-plan-to-ocag',
    ],

    'audit_annual_plan_revised' => [
        'ap_yearly_plan_lists' => env('API_URL_BEE', '') . '/planning/annual-plan/all',
        'ap_yearly_plan_list_show' => env('API_URL_BEE', '') . '/planning/annual-plan/show',
        'ap_yearly_plan_entities_list_show' => env('API_URL_BEE', '') . '/planning/annual-plan/show-entities',
        'ap_yearly_plan_submission' => env('API_URL_BEE', '') . '/planning/annual-plan/create',
        'ap_yearly_plan_book' => env('API_URL_BEE', '') . '/planning/annual-plan/book',
        'ap_submit_plan_to_ocag' => env('API_URL_BEE', '') . '/planning/annual-plan/submit-plan-to-ocag',
        'ap_nominated_offices' => env('API_URL_BEE', '') . '/planning/annual-plan/get-nominated-offices',
    ],

    'audit_entity_plan' => [
        'ap_entity_lists' => env('API_URL_BEE', '') . '/planning/audit-plan/entity-audit-plan',
        'ap_entity_plan_create_draft' => env('API_URL_BEE', '') . '/planning/audit-plan/entity-audit-plan/new',
        'ap_entity_plan_edit_draft' => env('API_URL_BEE', '') . '/planning/audit-plan/entity-audit-plan/edit',
        'ap_entity_plan_make_draft' => env('API_URL_BEE', '') . '/planning/audit-plan/entity-audit-plan/update',
        'ap_entity_plan_draft_show' => env('API_URL_BEE', '') . '/planning/audit-plan/entity-audit-plan/show',
        'store_audit_team' => env('API_URL_BEE', '') . '/planning/audit-plan/entity-audit-plan/audit-team/store',
        'update_audit_team' => env('API_URL_BEE', '') . '/planning/audit-plan/entity-audit-plan/audit-team/update',
        'store_audit_team_schedule' => env('API_URL_BEE', '') . '/planning/audit-plan/entity-audit-plan/audit-team/store-team-schedule',
        'update_audit_team_schedule' => env('API_URL_BEE', '') . '/planning/audit-plan/entity-audit-plan/audit-team/update-team-schedule',
        'get_sub_team' => env('API_URL_BEE', '') . '/planning/audit-plan/entity-audit-plan/get-sub-tam',
        'get_team_info' => env('API_URL_BEE', '') . '/planning/audit-plan/entity-audit-plan/get-team-info',
        'get_audit_plan_wise_team' => env('API_URL_BEE', '') . '/planning/audit-plan/entity-audit-plan/get-audit-plan-wise-team',
        'ap_office_order' => [
            'audit_plan_list' => env('API_URL_BEE', '') . '/planning/audit-plan/office-order/audit-plan-list',
            'generate_office_order' => env('API_URL_BEE', '') . '/planning/audit-plan/office-order/generate',
            'show_office_order' => env('API_URL_BEE', '') . '/planning/audit-plan/office-order/show',
            'store_approval_authority' => env('API_URL_BEE', '') . '/planning/audit-plan/office-order/store-approval-authority',
            'approve_office_order' => env('API_URL_BEE', '') . '/planning/audit-plan/office-order/approve',
        ],
    ],

    'audit_strategic_plan' => [
        'outcome_indicators' => env('API_URL_BEE', '') . '/planning/strategic-plan/outcome-indicators',
        'outcome_indicator_create' => env('API_URL_BEE', '') . '/planning/strategic-plan/outcome-indicators/create',
        'outcome_indicator_update' => env('API_URL_BEE', '') . '/planning/strategic-plan/outcome-indicators/update',
        'outcome_indicator_show' => env('API_URL_BEE', '') . '/planning/strategic-plan/outcome-indicators/show',
        'outcome_indicator_delete' => env('API_URL_BEE', '') . '/planning/strategic-plan/outcome-indicators/delete',
        'outcome_indicator_all' => env('API_URL_BEE', '') . '/planning/strategic-plan/outcome-indicators/all',
        'output_indicators' => env('API_URL_BEE', '') . '/planning/strategic-plan/output-indicators',
        'output_indicator_create' => env('API_URL_BEE', '') . '/planning/strategic-plan/output-indicators/create',
        'output_indicator_update' => env('API_URL_BEE', '') . '/planning/strategic-plan/output-indicators/update',
        'output_indicator_show' => env('API_URL_BEE', '') . '/planning/strategic-plan/output-indicators/show',
        'output_indicator_delete' => env('API_URL_BEE', '') . '/planning/strategic-plan/output-indicators/delete',
        'output_indicator_all' => env('API_URL_BEE', '') . '/planning/strategic-plan/output-indicators/all',

        'sp_setting_store' => env('API_URL_BEE', '') . '/sp-setting-store',
        'sp_setting_list' => env('API_URL_BEE', '') . '/sp-setting-list',

        'html_view_content_title_store' => env('API_URL_BEE', '') . '/html-view-content-title-store',
        'html_view_content_title_duration_wise' => env('API_URL_BEE', '') . '/html-view-content-title-duration-wise',
    ],

    'audit_visit_plan_calendar' => [
        'individual_calendar_list' => env('API_URL_BEE', '') . '/planning/calendar/individual',
        'individual_calendar_create' => env('API_URL_BEE', '') . '/planning/calendar/individual/create',
        'update_visit_calender_status' => env('API_URL_BEE', '') . '/planning/calendar/individual/update-visit-calender-status',
    ],

    'follow_up' => [
        'audit_observations' => env('API_URL_BEE', '') . '/follow-up/audit-observations',
        'audit_observation_create' => env('API_URL_BEE', '') . '/follow-up/audit-observations/create',
        'audit_observation_update' => env('API_URL_BEE', '') . '/follow-up/audit-observations/update',
        'audit_observation_show' => env('API_URL_BEE', '') . '/follow-up/audit-observations/show',
        'audit_observation_delete' => env('API_URL_BEE', '') . '/follow-up/audit-observations/delete',
        'audit_observation_search' => env('API_URL_BEE', '') . '/follow-up/audit-observation/search',
        'audit_observation_get_audit_plan' => env('API_URL_BEE', '') . '/follow-up/audit-observation/get_audit_plan',
        'audit_observation_removeAttachment' => env('API_URL_BEE', '') . '/follow-up/audit-observation/remove_attachment',
        'audit_observation_communication' => env('API_URL_BEE', '') . '/follow-up/audit-observation/observation_communication',
        'audit_observation_communication_lists' => env('API_URL_BEE', '') . '/follow-up/audit-observation/observation_communication_lists',
    ],

    'mis_and_dashboard' => [
        'all_team_lists' => env('API_URL_BEE', '') . '/mis-and-dashboard/load-all-team-lists',
    ],

    'final_plan_file_list' => env('API_URL_BEE', '') . '/final-plan-file-list',
    'final_plan_file_upload' => env('API_URL_BEE', '') . '/final-plan-file-upload',
    'final_plan_file_edit' => env('API_URL_BEE', '') . '/final-plan-file-edit',
    'final_plan_file_update' => env('API_URL_BEE', '') . '/final-plan-file-update',
    'final_plan_document_is_exist' => env('API_URL_BEE', '') . '/final-plan-document-is-exist',

    'audit_template_show' => env('API_URL_BEE', '') . '/audit-template/show',

    'login_in_cag_bee' => env('API_URL_BEE', '') . '/login-in-amms',
];
