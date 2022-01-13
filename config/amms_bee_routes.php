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
        'directorate_lists' => env('API_URL_BEE', '') . '/directorates/all',
        'responsible_offices_create' => env('API_URL_BEE', '') . '/responsible-offices/create',
        'responsible_offices_show' => env('API_URL_BEE', '') . '/responsible-offices/show',
        'responsible_offices_update' => env('API_URL_BEE', '') . '/responsible-offices/update',
        'responsible_offices_delete' => env('API_URL_BEE', '') . '/responsible-offices/delete',

        'audit_query_lists' => env('API_URL_BEE', '') . '/audit-query',
        'audit_query_create' => env('API_URL_BEE', '') . '/audit-query/create',
        'audit_query_show' => env('API_URL_BEE', '') . '/audit-query/show',
        'audit_query_update' => env('API_URL_BEE', '') . '/audit-query/update',
        'audit_query_delete' => env('API_URL_BEE', '') . '/audit-query/delete',

        'risk_assessment_lists' => env('API_URL_BEE', '') . '/risk-assessment',
        'risk_assessment_create' => env('API_URL_BEE', '') . '/risk-assessment/create',
        'risk_assessment_show' => env('API_URL_BEE', '') . '/risk-assessment/show',
        'risk_assessment_update' => env('API_URL_BEE', '') . '/risk-assessment/update',
        'risk_assessment_delete' => env('API_URL_BEE', '') . '/risk-assessment/delete',

        'cost_center_type_lists' => env('API_URL_BEE', '') . '/cost-center-type',

        'menu_action_list' => env('API_URL_BEE', '') . '/menu-actions',
        'menu_action_store' => env('API_URL_BEE', '') . '/menu-actions/create',
        'menu_action_show' => env('API_URL_BEE', '') . '/menu-actions/show',
        'menu_action_update' => env('API_URL_BEE', '') . '/menu-actions/update',

        'role_list' => env('API_URL_BEE', '') . '/roles',
        'role_store' => env('API_URL_BEE', '') . '/roles/create',
        'role_show' => env('API_URL_BEE', '') . '/roles/show',
        'role_update' => env('API_URL_BEE', '') . '/roles/update',
        'assign_master_designation_to_role' => env('API_URL_BEE', '') . '/roles/assign-master-designations-to-role',
        'assigned_master_designation_to_role' => env('API_URL_BEE', '') . '/roles/assigned-master-designations-to-role',

        'audit_assessment' => [
            'criteria' => [
                'lists' => env('API_URL_BEE', '') . '/audit-assessment-criteria',
                'create' => env('API_URL_BEE', '') . '/audit-assessment-criteria/create',
                'show' => env('API_URL_BEE', '') . '/audit-assessment-criteria/show',
                'update' => env('API_URL_BEE', '') . '/audit-assessment-criteria/update',
                'delete' => env('API_URL_BEE', '') . '/audit-assessment-criteria/delete',
                'list-category-wise' => env('API_URL_BEE', '') . '/audit-assessment-criteria/list-category-wise',
            ]
        ]

    ],

    'audit_operational_plan' => [
        'op_activity_lists' => env('API_URL_BEE', '') . '/planning/operational-plan/activity',
        'get_all_op_activity' => env('API_URL_BEE', '') . '/planning/operational-plan/activity/get-all-activity',
        'op_activity_find' => env('API_URL_BEE', '') . '/planning/operational-plan/activity/find',
        'op_activity_by_fiscal_year' => env('API_URL_BEE', '') . '/planning/operational-plan/activity/all-by-fiscal-year',
        'op_activity_milestones_load' => env('API_URL_BEE', '') . '/planning/operational-plan/activity/milestones',
        'op_activity_create' => env('API_URL_BEE', '') . '/planning/operational-plan/activity/create',
        'op_activity_show' => env('API_URL_BEE', '') . '/planning/operational-plan/activity/show',
        'op_activity_update' => env('API_URL_BEE', '') . '/planning/operational-plan/activity/update',
        'op_activity_delete' => env('API_URL_BEE', '') . '/planning/operational-plan/activity/delete',
        'activity_wise_audit_plan' => env('API_URL_BEE', '') . '/planning/operational-plan/activity/activity-wise-audit-plan',

        'op_activity_milestone_lists' => env('API_URL_BEE', '') . '/planning/operational-plan/activity-milestone',
        'op_activity_milestone_create' => env('API_URL_BEE', '') . '/planning/operational-plan/activity-milestone/create',
        'op_activity_milestone_show' => env('API_URL_BEE', '') . '/planning/operational-plan/activity-milestone/show',
        'op_activity_milestone_update' => env('API_URL_BEE', '') . '/planning/operational-plan/activity-milestone/update',
        'op_activity_milestone_delete' => env('API_URL_BEE', '') . '/planning/operational-plan/activity-milestone/delete',

        'op_yearly_event_lists' => env('API_URL_BEE', '') . '/planning/operational-plan/audit-calendar/yearly-event-list',
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

        'send_annual_plan_receiver_to_sender' => env('API_URL_BEE', '') . '/planning/operational-plan/send-annual-plan-receiver-to-sender',

    ],

    'audit_annual_plan' => [
        'ap_yearly_plan_lists' => env('API_URL_BEE', '') . '/planning/annual-plan/all',
        'ap_yearly_plan_submission' => env('API_URL_BEE', '') . '/planning/annual-plan/plan-submission/create',
        'ap_yearly_plan_selected_rp_lists' => env('API_URL_BEE', '') . '/planning/annual-plan/rp-entities/all-added',
        'ap_yearly_plan_selected_rp_store' => env('API_URL_BEE', '') . '/planning/annual-plan/rp-entities/store',
        'ap_submit_plan_to_ocag' => env('API_URL_BEE', '') . '/planning/annual-plan/submit-plan-to-ocag',

        'audit_assessment' => [
            'list' => env('API_URL_BEE', '') . '/audit-assessment/list',
            'store' => env('API_URL_BEE', '') . '/audit-assessment/store',
            'get_assessment_entity' => env('API_URL_BEE', '') . '/audit-assessment/get-assessment-entity',
            'store_annual_plan' => env('API_URL_BEE', '') . '/audit-assessment/store-annual-plan',
            'score' => [
                'list' => env('API_URL_BEE', '') . '/audit-assessment-score/list',
                'store' => env('API_URL_BEE', '') . '/audit-assessment-score/store',
                'edit' => env('API_URL_BEE', '') . '/audit-assessment-score/edit',
            ],
        ]
    ],

    'audit_annual_plan_revised' => [
        'ap_yearly_plan_lists' => env('API_URL_BEE', '') . '/planning/annual-plan/all',
        'ap_yearly_plan_list_show' => env('API_URL_BEE', '') . '/planning/annual-plan/show',
        'ap_yearly_plan_entities_list_show' => env('API_URL_BEE', '') . '/planning/annual-plan/show-entities',
        'ap_yearly_plan_submission' => env('API_URL_BEE', '') . '/planning/annual-plan/create',
        'ap_yearly_plan_update' => env('API_URL_BEE', '') . '/planning/annual-plan/update',
        'get_annual_plan_info' => env('API_URL_BEE', '') . '/planning/annual-plan/get-annual-plan-info',
        'delete_annual_plan' => env('API_URL_BEE', '') . '/planning/annual-plan/delete-annual-plan',
        'ap_yearly_plan_book' => env('API_URL_BEE', '') . '/planning/annual-plan/book',
        'ap_submit_plan_to_ocag' => env('API_URL_BEE', '') . '/planning/annual-plan/submit-plan-to-ocag',
        'ap_nominated_offices' => env('API_URL_BEE', '') . '/planning/annual-plan/get-nominated-offices',
        'send_annual_plan_sender_to_receiver' => env('API_URL_BEE', '') . '/planning/annual-plan/send-annual-plan-sender-to-receiver',
        'get_movement_histories' => env('API_URL_BEE', '') . '/planning/annual-plan/get-movement-histories',
        'get_current_desk_approval_authority' => env('API_URL_BEE', '') . '/planning/annual-plan/get-current-desk-approval-authority',
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
        'previously_assigned_designations' => env('API_URL_BEE', '') . '/planning/audit-plan/entity-audit-plan/audit-team/previously-assigned-designations',
        'get_team_info' => env('API_URL_BEE', '') . '/planning/audit-plan/entity-audit-plan/get-team-info',
        'get_audit_plan_wise_team' => env('API_URL_BEE', '') . '/planning/audit-plan/entity-audit-plan/get-audit-plan-wise-team',
        'ap_risk_assessment_store' => env('API_URL_BEE', '') . '/planning/audit-plan/risk-assessment/store',
        'ap_risk_assessment_update' => env('API_URL_BEE', '') . '/planning/audit-plan/risk-assessment/update',
        'ap_risk_assessment_list' => env('API_URL_BEE', '') . '/planning/audit-plan/risk-assessment/ap-risk-assessment-list',
        'risk_assessment_type_wise_item' => env('API_URL_BEE', '') . '/planning/audit-plan/risk-assessment/type-wise-item-list',
        'ap_office_order' => [
            'audit_plan_list' => env('API_URL_BEE', '') . '/planning/audit-plan/office-order/audit-plan-list',
            'generate_office_order' => env('API_URL_BEE', '') . '/planning/audit-plan/office-order/generate',
            'show_office_order' => env('API_URL_BEE', '') . '/planning/audit-plan/office-order/show',
            'store_approval_authority' => env('API_URL_BEE', '') . '/planning/audit-plan/office-order/store-approval-authority',
            'approve_office_order' => env('API_URL_BEE', '') . '/planning/audit-plan/office-order/approve',
        ],

        'ap_office_order_dc' => [
            'annual_plan_list' => env('API_URL_BEE', '') . '/planning/audit-plan/office-order-dc/annual-plan-list',
            'generate_office_order' => env('API_URL_BEE', '') . '/planning/audit-plan/office-order-dc/generate',
            'show_office_order' => env('API_URL_BEE', '') . '/planning/audit-plan/office-order-dc/show',
            'store_approval_authority' => env('API_URL_BEE', '') . '/planning/audit-plan/office-order-dc/store-approval-authority',
            'approve_office_order' => env('API_URL_BEE', '') . '/planning/audit-plan/office-order-dc/approve',
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
        'team_calendar_list' => env('API_URL_BEE', '') . '/planning/calendar/teams',
        'update_visit_calender_status' => env('API_URL_BEE', '') . '/planning/calendar/update-visit-calender-status',
        'team_calender_filter' => env('API_URL_BEE', '') . '/planning/calendar/team-filter',
        'get_fiscal_year_wise_team' => env('API_URL_BEE', '') . '/planning/calendar/load-fiscal-year-wise-team',
        'get_fiscal_year_cost_center_wise_team' => env('API_URL_BEE', '') . '/planning/calendar/load-fiscal-year-cost-center-wise-team',
        'get_sub_team' => env('API_URL_BEE', '') . '/planning/calendar/get-sub-tam',
        'get_schedule_entity_fiscal_year_wise' => env('API_URL_BEE', '') . '/planning/calendar/load-schedule-entity-fiscal-year-wise',
        'get_cost_center_directorate_fiscal_year_wise' => env('API_URL_BEE', '') . '/planning/calendar/load-cost-center-directorate-fiscal-year-wise',
        'team_calender_schedule_list' => env('API_URL_BEE', '') . '/planning/calendar/team-calender-schedule-list',
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

    'audit_conduct_query' => [
        'get_query_schedule_list' => env('API_URL_BEE', '') . '/audit-conduct-query/audit-query-schedule-list',
        'get_cost_center_type_wise_query' => env('API_URL_BEE', '') . '/cost-center-type-wise-query',
        'send_audit_query' => env('API_URL_BEE', '') . '/audit-conduct-query/send-audit-query',
        'received_audit_query' => env('API_URL_BEE', '') . '/audit-conduct-query/received-audit-query',
        'load_audit_query' => env('API_URL_BEE', '') . '/audit-conduct-query/load-audit-query',
        'load_type_wise_audit_query' => env('API_URL_BEE', '') . '/audit-conduct-query/load-type-wise-audit-query',
        'store_audit_query' => env('API_URL_BEE', '') . '/audit-conduct-query/store-audit-query',
        'view_audit_query' => env('API_URL_BEE', '') . '/audit-conduct-query/view-audit-query',
        'update_audit_query' => env('API_URL_BEE', '') . '/audit-conduct-query/update-audit-query',
        'rejected_audit_query' => env('API_URL_BEE', '') . '/audit-conduct-query/rejected-audit-query',
        'rpu-send-query-list' => env('API_URL_BEE', '') . '/audit-conduct-query/rpu-send-query-list',
        'authority_query_list' => env('API_URL_BEE', '') . '/audit-conduct-query/authority-query-list',
        'memo' => [
            'store' => env('API_URL_BEE', '') . '/audit-conduct-memo/audit-memo-store',
            'list' => env('API_URL_BEE', '') . '/audit-conduct-memo/audit-memo-list',
            'edit' => env('API_URL_BEE', '') . '/audit-conduct-memo/audit-memo-edit',
            'update' => env('API_URL_BEE', '') . '/audit-conduct-memo/audit-memo-update',
            'attachment_list' => env('API_URL_BEE', '') . '/audit-conduct-memo/attachment-list',
            'send_to_rpu' => env('API_URL_BEE', '') . '/audit-conduct-memo/send-audit-memo-to-rpu',
            'authority_memo_list' => env('API_URL_BEE', '') . '/audit-conduct-memo/authority-memo-list',
            'audit_memo_recommendation_store' => env('API_URL_BEE', '') . '/audit-conduct-memo/audit-memo-recommendation-store',
            'audit_memo_recommendation_list' => env('API_URL_BEE', '') . '/audit-conduct-memo/audit-memo-recommendation-list',
            'audit_memo_log_list' => env('API_URL_BEE', '') . '/audit-conduct-memo/audit-memo-log-list',
        ],

        'apotti' => [
            'list' => env('API_URL_BEE', '') . '/audit-conduct-apotti/get-apotti-list',
            'onucched_merge' => env('API_URL_BEE', '') . '/audit-conduct-apotti/onucched-merge',
            'onucched_unmerge' => env('API_URL_BEE', '') . '/audit-conduct-apotti/onucched-unmerge',
            'onucched_rearrange' => env('API_URL_BEE', '') . '/audit-conduct-apotti/onucched-rearrange',
            'get_apotti_info' => env('API_URL_BEE', '') . '/audit-conduct-apotti/get-apotti-info',
            'apotti_wise_all_tiem' => env('API_URL_BEE', '') . '/audit-conduct-apotti/apotti-wise-all-tiem',
            'get_apotti_item_info' => env('API_URL_BEE', '') . '/audit-conduct-apotti/get-apotti-item-info',
            'update_apotti' => env('API_URL_BEE', '') . '/audit-conduct-apotti/update-apotti',
        ],
    ],

    'audit_quality_control' => [
        'qac' => [
            'qac_apotti_submit' => env('API_URL_BEE', '') . '/audit-quality-control/qac-apotti',
            'get_qac_apotti_status' => env('API_URL_BEE', '') . '/audit-quality-control/get-qac-apotti-status',
        ],
    ],

    'audit_report' => [
        'air' => [
            'create_air_report' => env('API_URL_BEE', '') . '/audit-report/air/create-air-report',
            'edit_air_report' => env('API_URL_BEE', '') . '/audit-report/air/edit-air-report',
            'load_approve_plan_list' => env('API_URL_BEE', '') . '/audit-report/air/load-approve-plan-list',
            'store_air_report' => env('API_URL_BEE', '') . '/audit-report/air/store-air-report',
            'update_qac_air_report' => env('API_URL_BEE', '') . '/audit-report/air/update-qac-air-report',
            'get_audit_team' => env('API_URL_BEE', '') . '/audit-report/air/get-audit-team',
            'get_audit_team_schedule' => env('API_URL_BEE', '') . '/audit-report/air/get-audit-team-schedule',
            'get_audit_apotti_list' => env('API_URL_BEE', '') . '/audit-report/air/get-audit-apotti-list',
            'get_air_wise_qac_apotti' => env('API_URL_BEE', '') . '/audit-report/air/get-air-wise-qac-apotti',
            'get_air_wise_audit_apotti_list' => env('API_URL_BEE', '') . '/audit-report/air/get-air-wise-audit-apotti-list',
            'get_audit_apotti' => env('API_URL_BEE', '') . '/audit-report/air/get-audit-apotti',
            'store_air_movement' => env('API_URL_BEE', '') . '/audit-report/air/store-air-movement',
            'get_air_last_movement' => env('API_URL_BEE', '') . '/audit-report/air/get-air-last-movement',
            'get_approve_preliminary_air' => env('API_URL_BEE', '') . '/audit-report/air/get-approve-preliminary-air',
            'delete_air_report_wise_apotti' => env('API_URL_BEE', '') . '/audit-report/air/delete-air-report-wise-apotti',
        ],
    ],

    'final_plan_file' => [
        'list' => env('API_URL_BEE', '') . '/final-plan-file/list',
        'store' => env('API_URL_BEE', '') . '/final-plan-file/store',
        'edit' => env('API_URL_BEE', '') . '/final-plan-file/edit',
        'update' => env('API_URL_BEE', '') . '/final-plan-file/update',
    ],

    'role-and-permissions' => [
        'get-module-menu-lists' => env('API_URL_BEE', '') . '/role-and-permissions/get-module-menu-lists',
        'get-module-menu-actions-role-wise' => env('API_URL_BEE', '') . '/role-and-permissions/get-module-menu-actions-role-wise',
        'assign-menus-to-role' => env('API_URL_BEE', '') . '/role-and-permissions/assign-menu-actions-to-role',
        'assign-menus-to-employee' => env('API_URL_BEE', '') . '/role-and-permissions/assign-menu-actions-to-employee',
        'modules' => env('API_URL_BEE', '') . '/role-and-permissions/modules',
        'other-modules' => env('API_URL_BEE', '') . '/role-and-permissions/modules/other',
        'menus' => env('API_URL_BEE', '') . '/role-and-permissions/module/menus',
    ],

    'document_is_exist' => env('API_URL_BEE', '') . '/document-is-exist',

    'audit_template_show' => env('API_URL_BEE', '') . '/audit-template/show',

    'login_in_cag_bee' => env('API_URL_BEE', '') . '/login-in-amms',
];
