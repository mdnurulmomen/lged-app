<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::group(['middleware' => ['jisf.auth', 'auth.bee']], function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // Plan Route Start
    Route::group(['as' => 'audit.plan.', 'prefix' => 'audit-plan/'], function () {
        Route::get('/', function () {
            return redirect()->route('audit.plan.dashboard');
        });
        Route::get('/dashboard', [\App\Http\Controllers\AuditPlan\AuditPlanDashboardController::class, 'index'])->name('dashboard');

        //strategic plan
        Route::group(['as' => 'strategy.', 'prefix' => 'strategy/'], function () {

            Route::get('/', [\App\Http\Controllers\AuditPlan\AuditStrategicPlanController::class, 'index'])->name('index');

            Route::get('/dashboard', [\App\Http\Controllers\AuditPlan\AuditStrategicPlanController::class, 'showAuditStrategicPlanDashboard'])->name('dashboard');

            Route::get('draft-plans', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\DraftPlanController
            ::class, 'index'])->name('draft_plan.all');
            Route::post('draft-plan', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\DraftPlanController
            ::class, 'show'])->name('draft_plan.single');
            Route::get('draft-plan/create', function () {
                return view('modules.audit_plan.strategic.draft_plan.strategic_plan_draft_create');
            })->name('draft_plan_create');

            //sp file upload
            Route::get('sp-file-list', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\FinalPlanController
            ::class, 'index'])->name('sp_file_list');
            Route::get('file-upload', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\FinalPlanController
            ::class, 'create'])->name('sp_file_upload');
            Route::post('file-store', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\FinalPlanController
            ::class, 'store'])->name('sp_file_store');
            Route::get('final-plan-edit/{id}', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\FinalPlanController
            ::class, 'edit'])->name('sp_file_edit');
            Route::post('file-update', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\FinalPlanController
            ::class, 'update'])->name('sp_file_update');

            Route::post('is-document-exist', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\FinalPlanController
            ::class, 'isDocumentExist'])->name('is_document_exist');


            //html view
            Route::get('setting-list', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\HTMLViewController
            ::class, 'index'])->name('setting_list');

            Route::get('html-view-content', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\HTMLViewController
            ::class, 'contentView'])->name('html_view_content');
            Route::get('html-view-content-create', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\HTMLViewController
            ::class, 'createContent'])->name('html_view_content_create');
            Route::get('html-view-content-key-create', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\HTMLViewController
            ::class, 'createKey'])->name('html_view_content_key_create');
            Route::post('html-view-content-key-store', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\HTMLViewController
            ::class, 'storeKey'])->name('html_view_content_key_store');
            Route::get('html-view-content-title-duration-wise', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\HTMLViewController
            ::class, 'loadParentDurationWiseSelect'])->name('html_view_content_title_duration_wise');

            Route::get('meetings', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\MeetingController
            ::class, 'index'])->name('meeting.all');
            Route::post('meeting', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\MeetingController
            ::class, 'show'])->name('meeting.single');

            Route::get('final-plans', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\FinalPlanController
            ::class, 'index'])->name('final-plan.all');
            Route::post('final-plan', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\FinalPlanController
            ::class, 'show'])->name('final-plan.single');

            Route::get('milestones', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\MilestoneController
            ::class, 'index'])->name('milestone.all');
            Route::post('milestone', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\MilestoneController
            ::class, 'show'])->name('milestone.single');

            Route::get('risks', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\RiskController
            ::class, 'index'])->name('risk.all');
            Route::post('risk', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\RiskController
            ::class, 'show'])->name('risk.single');

            Route::get('indicator/outcome', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\IndicatorOutcomeController
            ::class, 'index'])->name('indicator.outcome');
            Route::get('indicator/outcome/create', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\IndicatorOutcomeController
            ::class, 'create'])->name('indicator.outcome.create');
            Route::post('indicator/outcome/create', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\IndicatorOutcomeController
            ::class, 'store'])->name('indicator.outcome.store');
            Route::get('indicator/outcome/edit/{id}', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\IndicatorOutcomeController
            ::class, 'edit'])->name('indicator.outcome.edit');
            Route::post('indicator/outcome/update', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\IndicatorOutcomeController
            ::class, 'update'])->name('indicator.outcome.update');
            Route::get('indicator/outcome/show/{id}', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\IndicatorOutcomeController
            ::class, 'show'])->name('indicator.outcome.show');

            Route::get('indicator/outcome/all', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\IndicatorOutcomeController
            ::class, 'outcomes'])->name('indicator.outcomes');

            Route::get('indicator/genYear/{year?}', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\IndicatorOutcomeController
            ::class, 'genYear'])->name('indicator.gen.year');


            Route::get('indicator/output', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\IndicatorOutputController
            ::class, 'index'])->name('indicator.output');
            Route::post('indicator/output/create', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\IndicatorOutputController
            ::class, 'store'])->name('indicator.output.store');
            Route::get('indicator/output/create', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\IndicatorOutputController
            ::class, 'create'])->name('indicator.output.create');
            Route::get('indicator/output/edit/{id}', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\IndicatorOutputController
            ::class, 'edit'])->name('indicator.output.edit');
            Route::post('indicator/output/update', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\IndicatorOutputController
            ::class, 'update'])->name('indicator.output.update');
            Route::get('indicator/output/show/{id}', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\IndicatorOutputController
            ::class, 'show'])->name('indicator.output.show');

            Route::get('indicator/output/all', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\IndicatorOutputController
            ::class, 'outputs'])->name('indicator.outputs');


            Route::get('/final-plan-add', function () {
                return view('modules.audit_plan.strategic.meeting.strategic_plan_meeting_add');
            })->name('plan');
        });

        //operational plan
        Route::group(['as' => 'operational.', 'prefix' => 'operational/'], function () {
            Route::get('/', [\App\Http\Controllers\AuditPlan\AuditOperationalPlanController::class, 'index'])->name('index');

            Route::get('/dashboard', [\App\Http\Controllers\AuditPlan\AuditOperationalPlanController::class, 'showOperationalPlanDashboard'])->name('dashboard');

            //activity
            Route::get('activities', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditActivityController::class, 'index'])->name('activity.all');

            Route::get('create-activity', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditActivityController::class, 'create'])->name('activity.create');
            Route::post('store-activity', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditActivityController::class, 'store'])->name('activity.store');
            Route::post('store-activity-milestone', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditActivityController::class, 'storeMilestone'])->name('activity.milestone.store');
            Route::post('load-outputs-by-outcome', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditActivityController::class, 'loadOutputsByOutcome'])->name('activity.load.outputs.by.outcome');
            Route::post('load-create-output-activity-tree', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditActivityController::class, 'loadCreateOutputActivityTree'])->name('activity.create.output.tree.load');
            Route::post('load-edit-activity-tree', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditActivityController::class, 'loadEditActivityTree'])->name('activity.edit.tree.load');

            Route::post('activity', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditActivityController::class, 'show'])->name('activity.single');

            Route::post('edit-activity', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditActivityController::class, 'edit'])->name('activity.edit');

            //calendar
            Route::get('calendars', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditCalendarController::class, 'index'])->name('calendars.index');

            Route::post('create-calendar', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditCalendarController::class, 'create'])->name('calendars.create');
            Route::post('store-calendar', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditCalendarController::class, 'store'])->name('calendars.store');

            Route::post('view-calendar', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditCalendarController::class, 'show'])->name('calendars.show');
            Route::post('edit-calendar', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditCalendarController::class, 'edit'])->name('calendars.edit');

            Route::post('calendar/show-forward-modal', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditCalendarController::class, 'showForwardAuditCalendarModal'])->name('calendar.forward_modal');
            Route::post('calendar/forward', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditCalendarController::class, 'forwardAuditCalendar'])->name('calendar.forward');

            Route::post('calendar/movement/history', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditCalendarController::class, 'movementHistory'])->name('calendar.movement.history');
            Route::post('calendar/change-status', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditCalendarController::class, 'changeStatus'])->name('calendar.change-status');

            Route::post('calendar/show-pending-event-to-publish', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditCalendarController::class, 'showPublishAuditCalendar'])->name('calendar.pending-event-to-publish');
            Route::post('calendar/publish', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditCalendarController::class, 'publishAuditCalendar'])->name('calendar.publish');

            Route::post('load-schedule-milestones', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditCalendarController::class, 'showScheduleMilestoneByFiscalYear'])->name('calendar.milestone.load');
            Route::post('update-schedule-milestones-date', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditCalendarController::class, 'updateMilestoneTargetDate'])->name('calendar.milestone.date.update');
            Route::post('create-responsible', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditCalendarController::class, 'createActivityResponsible'])->name('calendar.responsible.create');
            Route::post('activity-comment/update', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditCalendarController::class, 'updateActivityComment'])->name('calendar.comment.update');
            Route::post('load-audit-calendar-view', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditCalendarController::class, 'showAuditCalendarView'])->name('calendar.view.load');

            Route::post('load-audit-calendar-print-view', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditCalendarController::class, 'showAuditCalendarPrintView'])->name('calendar.print.view.load');
            Route::get('load-audit-calendar-pdf-view', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditCalendarController::class, 'showAuditCalendarPdfView'])->name('calendar.pdf.view.load');

            //plan approve
            Route::get('approve-annual-plan', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\OperationalPlanController::class, 'approveAnnualPlan'])->name('plan.approve-annual-plan');
            Route::post('load-op-yearly-event-list', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\OperationalPlanController::class, 'loadOpYearlyEventList'])->name('plan.load-op-yearly-event-list');
            Route::post('load-op-yearly-event-approval-form', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\OperationalPlanController::class, 'loadOpYearlyEventApprovalForm'])->name('plan.load-op-yearly-event-approval-form');
            Route::post('load-directorate-wise-annual-plan', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\OperationalPlanController::class, 'loadDirectorateWiseAnnualPlan'])->name('plan.load-directorate-wise-annual-plan');
            Route::post('send-annual-plan-receiver-to-sender', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\OperationalPlanController::class, 'sendAnnualPlanReceiverToSender'])->name('plan.send-annual-plan-receiver-to-sender');

            //plans
            Route::get('plans', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\OperationalPlanController::class, 'index'])->name('plan.all');

            Route::post('load-operational-plan-lists', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\OperationalPlanController::class, 'showOperationalPlanLists'])->name('plan.list.all');
            Route::post('load-assigned-staff-details', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\OperationalPlanController::class, 'showOperationalPlanStaffAndDetailsModal'])->name('plan.assigned-details.modal');

            Route::post('load-operational-plan-staff-assigned', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\OperationalPlanController::class, 'showOperationalPlanStaffs'])->name('plan.assigned.staff');
            Route::post('load-activity-wise-team', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\OperationalPlanController::class, 'showActivityWiseTeam'])->name('plan.load-activity-wise-team');

            //op final file upload
            Route::get('file-list', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\FinalPlanController
            ::class, 'index'])->name('file_list');
            Route::get('file-create', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\FinalPlanController
            ::class, 'create'])->name('file_create');
            Route::post('file-store', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\FinalPlanController
            ::class, 'store'])->name('file_store');
            Route::get('file-edit/{id}', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\FinalPlanController
            ::class, 'edit'])->name('file_edit');
            Route::post('file-update', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\FinalPlanController
            ::class, 'update'])->name('file_update');

            Route::post('is-document-exist', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\FinalPlanController
            ::class, 'isDocumentExist'])->name('is_document_exist');
        });

        //annual plan
        Route::group(['as' => 'annual.', 'prefix' => 'annual/'], function () {
            Route::get('/', [\App\Http\Controllers\AuditPlan\AuditAnnualPlanController::class, 'index'])->name('index');
            Route::get('/dashboard', [\App\Http\Controllers\AuditPlan\AuditAnnualPlanController::class, 'showAnnualPlanDashboard'])->name('dashboard');

            Route::get('/plans', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanController::class, 'index'])->name('plan.all');

            Route::post('/load-annual-plan-lists', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanController::class, 'showAnnualPlanLists'])->name('plan.list.all');

            Route::post('/load-annual-entity-selection', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanController::class, 'showEntitySelection'])->name('plan.list.show.entity-selection');

//            Route::post('/load-selected-auditees', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanController::class, 'showSelectedAuditeeEntities'])->name('plan.list.show.selected-entity');
//            Route::post('/store-selected-auditees', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanController::class, 'storeSelectedAuditeeEntities'])->name('plan.list.store.selected-entity');
//            Route::post('/load-submission-hr-modal', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanController::class, 'showAnnualSubmissionHRModal'])->name('plan.list.show.hr-modal');
//            Route::post('/store-submission-hr-modal', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanController::class, 'storeAnnualSubmissionHR'])->name('plan.list.store.hr-modal');
//            Route::post('/load-rp-auditee-offices', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanController::class, 'showRPAuditeeOffices'])->name('plan.list.show.rp-auditee-offices');
//            Route::post('/submit-audit-plan-to-ocag', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanController::class, 'submitPlanToOCAG'])->name('plan.list.submit.plan-to-ocag');

            Route::get('/annual-plan-revised', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanRevisedController::class, 'index'])->name('plan.revised.all');
            Route::post('/annual-plan-book', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanRevisedController::class, 'exportAnnualPlanBook'])->name('plan.revised.book');
            Route::post('/load-annual-plan-revised-lists', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanRevisedController::class, 'showAnnualPlanLists'])->name('plan.revised.list.all');

            Route::post('/load-annual-plan-revised-approval-authority', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanRevisedController::class, 'loadAnnualPlanApprovalAuthority'])->name('plan.revised.load-annual-plan-approval-authority');
            Route::post('/send-annual-plan-sender-to-receiver', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanRevisedController::class, 'sendAnnualPlanSenderToReceiver'])->name('plan.revised.send-annual-plan-sender-to-receiver');
            Route::post('/movement-history-annual-plan-revised', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanRevisedController::class, 'movementHistoryAnnualPlan'])->name('plan.revised.movement-history-annual-plan');

            Route::post('/load-staff-assign-list', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanRevisedController::class, 'showStaffAssignList'])->name('plan.revised.list.staff');
            Route::post('/load-annual-entity-show', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanRevisedController::class, 'showAnnualPlanEntities'])->name('plan.revised.annual-entities-show');
            Route::post('/crate-plan-info', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanRevisedController::class, 'addAnnualPlanInfo'])->name('plan.list.show.revised.create_plan_info');
            Route::post('/store-annual-plan', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanRevisedController::class, 'storeAnnualPlanInfo'])->name('plan.revised.store');
            Route::post('/load-rp-auditee-offices', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanRevisedController::class, 'showRPAuditeeOffices'])->name('plan.list.show.rp-auditee-offices');
            Route::post('/load-rp-auditee-child-offices', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanRevisedController::class, 'showRPChildAuditeeOffices'])->name('plan.list.show.rp-auditee-child-offices');
            Route::post('/submit-audit-plan-to-ocag', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanRevisedController::class, 'submitPlanToOCAG'])->name('plan.list.submit.revised.plan-to-ocag');

            Route::get('/calendar', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualCalendarController::class, 'index'])->name('calendar');

            Route::get('/entity-calendar', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualCalendar\EntityCalendarController
            ::class, 'index'])->name('calendar.entity');

            Route::get('/staff-calendar', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualCalendar\StaffCalendarController
            ::class, 'index'])->name('calendar.staff');
        });

        //audit Plan
        Route::group(['as' => 'audit.', 'prefix' => 'audit/'], function () {
            Route::get('/', [\App\Http\Controllers\AuditPlan\AuditPlanController::class, 'index'])->name('index');
            Route::get('/dashboard', [\App\Http\Controllers\AuditPlan\AuditPlanController::class, 'showAuditPlanDashboard'])->name('dashboard');

//            Route::get('/plans', [\App\Http\Controllers\AuditPlan\Plan\PlanController::class, 'index'])->name('plan.all');
//            Route::post('/load-auditable-plan-lists', [\App\Http\Controllers\AuditPlan\Plan\PlanController::class, 'showAuditablePlanLists'])->name('plan.load-all-lists');
//            Route::post('/make-entity-audit-plan', [\App\Http\Controllers\AuditPlan\Plan\PlanController::class, 'create'])->name('plan.make-entity-audit-plan');
//            Route::post('/save-draft-entity-audit-plan', [\App\Http\Controllers\AuditPlan\Plan\PlanController::class, 'saveDraftEntityAuditPlan'])->name('plan.save-draft-entity-audit-plan');
//            Route::post('/generate-audit-plan-pdf', [\App\Http\Controllers\AuditPlan\Plan\PlanController::class, 'generatePlanPDF'])->name('plan.generate-audit-plan-pdf');

            Route::get('/plans', [\App\Http\Controllers\AuditPlan\Plan\RevisedPlanController::class, 'index'])->name('plan.all');
            Route::post('/load-auditable-plan-lists', [\App\Http\Controllers\AuditPlan\Plan\RevisedPlanController::class, 'showAuditablePlanLists'])->name('revised.plan.load-all-lists');
            Route::post('/create-entity-audit-plan', [\App\Http\Controllers\AuditPlan\Plan\RevisedPlanController::class, 'createAuditPlan'])->name('revised.plan.create-entity-audit-plan');
            Route::post('/update-entity-audit-plan', [\App\Http\Controllers\AuditPlan\Plan\RevisedPlanController::class, 'updateAuditPlan'])->name('revised.plan.update-entity-audit-plan');
            Route::post('/save-draft-entity-audit-plan', [\App\Http\Controllers\AuditPlan\Plan\RevisedPlanController::class, 'saveDraftEntityAuditPlan'])->name('revised.plan.save-draft-entity-audit-plan');
            Route::post('/generate-audit-plan-pdf', [\App\Http\Controllers\AuditPlan\Plan\RevisedPlanController::class, 'generatePlanPDF'])->name('revised.plan.generate-audit-plan-pdf');
            Route::post('/print-audit-plan', [\App\Http\Controllers\AuditPlan\Plan\RevisedPlanController::class, 'printAuditPlan'])->name('revised.plan.print-audit-plan');
            Route::post('/get-team-info', [\App\Http\Controllers\AuditPlan\Plan\RevisedPlanController::class, 'getTeamInfo'])->name('revised.plan.get-team-info');
            Route::post('editor/load-audit-team-modal', [\App\Http\Controllers\AuditPlan\Plan\PlanEditorController::class, 'loadAuditTeamModal'])->name('editor.load-audit-team-modal');
            Route::post('editor/load-audit-team-schedule', [\App\Http\Controllers\AuditPlan\Plan\PlanEditorController::class, 'loadAuditTeamSchedule'])->name('editor.load-audit-team-schedule');
            Route::post('/load-officer-lists', [\App\Http\Controllers\AuditPlan\Plan\PlanEditorController::class, 'loadOfficeEmployeeList'])->name('revised.plan.load-officer-lists');
            Route::post('/store-audit-team', [\App\Http\Controllers\AuditPlan\Plan\RevisedPlanController::class, 'storeAuditTeam'])->name('revised.plan.store-audit-team');
            Route::post('/update-audit-team', [\App\Http\Controllers\AuditPlan\Plan\RevisedPlanController::class, 'updateAuditTeam'])->name('revised.plan.update-audit-team');
            Route::post('/store-audit-team-schedule', [\App\Http\Controllers\AuditPlan\Plan\RevisedPlanController::class, 'storeAuditTeamSchedule'])->name('revised.plan.store-audit-team-schedule');
            Route::post('/update-audit-team-schedule', [\App\Http\Controllers\AuditPlan\Plan\RevisedPlanController::class, 'updateAuditTeamSchedule'])->name('revised.plan.update-audit-team-schedule');

            //office order
            Route::get('/office-orders', [\App\Http\Controllers\AuditPlan\Plan\OfficeOrderController::class, 'index'])->name('office-orders.index');
            Route::post('/load-office-order-list', [\App\Http\Controllers\AuditPlan\Plan\OfficeOrderController::class, 'loadOfficeOrderList'])->name('office-orders.load-office-order-list');
            Route::post('/load-office-order-generate-modal', [\App\Http\Controllers\AuditPlan\Plan\OfficeOrderController::class, 'loadOfficeOrderGenerateModal'])->name('office-orders.load-office-order-generate-modal');
            Route::post('/load-office-order-approval-authority', [\App\Http\Controllers\AuditPlan\Plan\OfficeOrderController::class, 'loadOfficeOrderApprovalAuthority'])->name('office-orders.load-office-order-approval-authority');
            Route::post('/store-office-order-approval-authority', [\App\Http\Controllers\AuditPlan\Plan\OfficeOrderController::class, 'storeOfficeOrderApprovalAuthority'])->name('office-orders.store-office-order-approval-authority');
            Route::post('/approve-office-order', [\App\Http\Controllers\AuditPlan\Plan\OfficeOrderController::class, 'approveOfficeOrder'])->name('office-orders.approve-office-order');
            Route::post('/generate-office-order', [\App\Http\Controllers\AuditPlan\Plan\OfficeOrderController::class, 'generateOfficeOrder'])->name('office-orders.generate-office-order');
            Route::post('/show-office-order', [\App\Http\Controllers\AuditPlan\Plan\OfficeOrderController::class, 'showOfficeOrder'])->name('office-orders.show-office-order');
            Route::post('/download-pdf', [\App\Http\Controllers\AuditPlan\Plan\OfficeOrderController::class, 'generateOfficeOrderPDF'])->name('office-orders.download-pdf');
        });
    });

    Route::group(['prefix' => 'calendar/'], function () {
        Route::post('load-teams-calender', [\App\Http\Controllers\AuditPlan\Calendar\TeamCalendarController::class, 'loadTeamCalendar'])->name('calendar.load-teams-calender');
        Route::post('load-teams-calender-filter', [\App\Http\Controllers\AuditPlan\Calendar\TeamCalendarController::class, 'loadTeamCalendarFilter'])->name('calendar.load-teams-calender-filter');
        Route::post('load-teams-select', [\App\Http\Controllers\AuditPlan\Calendar\TeamCalendarController::class, 'loadTeamsSelect'])->name('calendar.load-teams-select');
        Route::post('load-cost-center-directorate-fiscal-year-wise-select', [\App\Http\Controllers\AuditPlan\Calendar\TeamCalendarController::class, 'loadCostCenterDirectorateFiscalYearWiseSelect'])->name('calendar.load-cost-center-directorate-fiscal-year-wise-select');
        Route::get('teams', [\App\Http\Controllers\AuditPlan\Calendar\TeamCalendarController::class, 'index'])->name('calendar.teams');
        Route::post('update-visit-calender-status', [\App\Http\Controllers\AuditPlan\Calendar\TeamCalendarController::class, 'updateVisitCalenderStatus'])->name('calendar.update-visit-calender-status');
        Route::post('load-sub-team-select', [\App\Http\Controllers\AuditPlan\Calendar\TeamCalendarController::class, 'loadSubTeamSelect'])->name('calendar.load-sub-teams-select');
        Route::post('load-team-calendar-schedule-list', [\App\Http\Controllers\AuditPlan\Calendar\TeamCalendarController::class, 'loadTeamCalendarScheduleList'])->name('calendar.load-team-calendar-schedule-list');
    });

    //Prepare
    Route::group(['as' => 'audit.preparation.', 'prefix' => 'audit-preparation/'], function () {
        Route::get('/', function () {
            return redirect()->route('audit.preparation.dashboard');
        });

        Route::get('dashboard', [\App\Http\Controllers\AuditPrepare\AuditPrepareDashboardController::class, 'index'])->name('dashboard');

        Route::get('sampling', [\App\Http\Controllers\AuditPrepare\AuditPrepareSamplingController::class, 'index'])->name('sampling');

        Route::get('data-analysis', [\App\Http\Controllers\AuditPrepare\AuditPrepareDataAnalysisController::class, 'index'])->name('data_analysis');

        Route::get('activities', [\App\Http\Controllers\AuditPrepare\AuditPrepareActivityController::class, 'index'])->name('activities');
    });

    //Execute
    Route::group(['as' => 'audit.execution.', 'prefix' => 'audit-conducting/'], function () {
        Route::get('/', function () {
            return redirect()->route('audit.execution.dashboard');
        });
        Route::get('dashboard', [\App\Http\Controllers\AuditExecution\AuditExecutionDashboardController::class, 'index'])->name('dashboard');

        Route::get('area', [\App\Http\Controllers\AuditExecution\AuditExecutionAreaController::class, 'index'])->name('area');

        Route::get('query', [\App\Http\Controllers\AuditExecution\AuditExecutionQueryController::class, 'index'])->name('query');

        Route::get('schedule-list', [\App\Http\Controllers\AuditExecution\AuditExecutionQueryController::class, 'queryScheduleList'])->name('query-schedule-list');
        Route::get('load-query-schedule-lists', [\App\Http\Controllers\AuditExecution\AuditExecutionQueryController::class, 'loadQueryScheduleList'])->name('load-query-schedule-lists');
        Route::get('select-audit-query', [\App\Http\Controllers\AuditExecution\AuditExecutionQueryController::class, 'selectAuditQuery'])->name('select-audit-query');
        Route::post('cost-center-type-wise-query', [\App\Http\Controllers\AuditExecution\AuditExecutionQueryController::class, 'costCenterTypeWiseQuery'])->name('cost-center-type-wise-query');

        Route::get('discussion', [\App\Http\Controllers\AuditExecution\AuditExecutionDiscussionController::class, 'index'])->name('discussion');

        Route::get('review', [\App\Http\Controllers\AuditExecution\AuditExecutionReviewController::class, 'index'])->name('review');
    });

    //Followup
    Route::group(['as' => 'audit.followup.', 'prefix' => 'audit-followup/'], function () {
        Route::get('/', function () {
            return redirect()->route('audit.followup.dashboard');
        });
        Route::get('dashboard', [\App\Http\Controllers\AuditFollowup\AuditFollowupDashboardController::class, 'index'])->name('dashboard');

        Route::get('observation', [\App\Http\Controllers\AuditFollowup\AuditFollowupObservationController::class, 'index'])->name('observation');

        Route::get('observation/lists', [\App\Http\Controllers\AuditFollowup\AuditFollowupObservationController::class, 'lists'])->name('observation.lists');
        Route::get('observation/communications', [\App\Http\Controllers\AuditFollowup\AuditFollowupObservationController::class, 'communications'])->name('observation.communications');

        Route::get('observation/create', [\App\Http\Controllers\AuditFollowup\AuditFollowupObservationController::class, 'create'])->name('observation.create');
        Route::get('observation/follow-up/{id}', [\App\Http\Controllers\AuditFollowup\AuditFollowupObservationController::class, 'followUp'])->name('observation.follow-up');
        Route::post('observation/follow-up', [\App\Http\Controllers\AuditFollowup\AuditFollowupObservationController::class, 'followUpSubmit'])->name('observation.follow-up.sent');
        Route::get('observation/view/{id?}', [\App\Http\Controllers\AuditFollowup\AuditFollowupObservationController::class, 'show'])->name('observation.show');
        Route::get('observation/edit/{id?}', [\App\Http\Controllers\AuditFollowup\AuditFollowupObservationController::class, 'edit'])->name('observation.edit');
        Route::post('observation/store', [\App\Http\Controllers\AuditFollowup\AuditFollowupObservationController::class, 'store'])->name('observation.store');
        Route::post('observation/update', [\App\Http\Controllers\AuditFollowup\AuditFollowupObservationController::class, 'update'])->name('observation.update');
        Route::post('observation/search', [\App\Http\Controllers\AuditFollowup\AuditFollowupObservationController::class, 'search'])->name('observation.search');
        Route::get('observation/delete/{id}', [\App\Http\Controllers\AuditFollowup\AuditFollowupObservationController::class, 'destroy'])->name('observation.delete');
        Route::get('observation/image/delete/{id}', [\App\Http\Controllers\AuditFollowup\AuditFollowupObservationController::class, 'imageDestroy'])->name('observation.image.delete');

        Route::post('observation/get_audit_plan', [\App\Http\Controllers\AuditFollowup\AuditFollowupObservationController::class, 'getAuditPlan'])->name('observation.get.audit.plan');

        Route::get('due-report', [\App\Http\Controllers\AuditFollowup\AuditFollowupDueReportController::class, 'index'])->name('due_report');

        Route::get('reminder', [\App\Http\Controllers\AuditFollowup\AuditFollowupReminderController::class, 'index'])->name('reminder');

        Route::get('record', [\App\Http\Controllers\AuditFollowup\AuditFollowupRecordController::class, 'index'])->name('record');

        Route::get('settlement-review', [\App\Http\Controllers\AuditFollowup\AuditFollowupSettlementReviewController::class, 'index'])->name('settlement_review');
    });

    //Report
    Route::group(['as' => 'audit.report.', 'prefix' => 'audit-report/'], function () {
        Route::get('/', function () {
            return redirect()->route('audit.report.dashboard');
        });

        Route::get('dashboard', [\App\Http\Controllers\AuditReport\AuditReportDashboardController::class, 'index'])->name('dashboard');

        Route::get('draft-report', [\App\Http\Controllers\AuditReport\AuditDraftReportController::class, 'index'])->name('draft_report');

        Route::get('final-report', [\App\Http\Controllers\AuditReport\AuditFinalReportController::class, 'index'])->name('final_report');

        Route::get('qc', [\App\Http\Controllers\AuditReport\AuditQCReportController::class, 'index'])->name('qc');
    });

    //Sub Modules
    Route::get('/grievance-management', [\App\Http\Controllers\GrievanceManagementController::class, 'index'])->name('grievance_management');

    Route::get('/application-administration', [\App\Http\Controllers\ApplicationAdministrationController::class, 'index'])->name('application_administration');

    Route::get('/auditee-employee-database', [\App\Http\Controllers\AuditeeEmployeeDatabaseController::class, 'index'])->name('auditee_employee_database');

    Route::get('/communication-management', [\App\Http\Controllers\CommunicationManagementController::class, 'index'])->name('communication_management');

    Route::get('/document-management', [\App\Http\Controllers\DocumentManagementController::class, 'index'])->name('document_management');

    Route::group(['as' => 'mis_and_dashboard.', 'prefix' => 'mis-and-dashboard/'], function () {
        Route::get('/', [\App\Http\Controllers\MISAndDashboardController::class, 'index'])->name('index');

        Route::get('/rpu-list', [\App\Http\Controllers\MISAndDashboardController::class, 'rpuListIndex'])->name('rpu_list.index');
        Route::post('/load-rpu-lists', [\App\Http\Controllers\MISAndDashboardController::class, 'loadRpuLists'])->name('rpu_list.load-lists');
        Route::post('/directorate_wise_ministry', [\App\Http\Controllers\MISAndDashboardController::class, 'derictorateWiseMinistry'])->name('derictorate_wise_ministry');

        Route::get('/team-list', [\App\Http\Controllers\MISAndDashboardController::class, 'teamListIndex'])->name('team_list.index');
        Route::post('/load-team-lists', [\App\Http\Controllers\MISAndDashboardController::class, 'loadTeamLists'])->name('team_list.load-lists');
        Route::post('/load-fiscal-year-wise-team', [\App\Http\Controllers\MISAndDashboardController::class, 'loadFiscalYearWiseTeam'])->name('team_list.load-fiscal-year-wise-team');
    });

    Route::get('/knowledge-management', [\App\Http\Controllers\KnowledgeManagementController::class, 'index'])->name('knowledge_management');

    Route::get('/legacy-data-management', [\App\Http\Controllers\LegacyDataManagementController::class, 'index'])->name('legacy_data_management');

    Route::get('/pac', [\App\Http\Controllers\PacController::class, 'index'])->name('pac');

    Route::group(['as' => 'settings.', 'prefix' => 'settings/'], function () {
        Route::get('/', [\App\Http\Controllers\SettingController::class, 'index'])->name('index');
        Route::get('/dashboard', [\App\Http\Controllers\SettingController::class, 'showSettingsDashboard'])->name('dashboard');

        Route::post('/fiscal-years/lists', [\App\Http\Controllers\Setting\XFiscalYearController::class, 'getFiscalYearLists'])->name('fiscal-years.lists');
        Route::resource('/fiscal-years', \App\Http\Controllers\Setting\XFiscalYearController::class, ['except' => ['edit', 'create']]);

        Route::post('/audit-query/lists', [\App\Http\Controllers\Setting\XAuditQueryController::class, 'getAuditQueryLists'])->name('audit-query.lists');
        Route::resource('/audit-query', \App\Http\Controllers\Setting\XAuditQueryController::class, ['except' => ['edit', 'create']]);

        Route::group(['as' => 'strategic-plan.', 'prefix' => 'strategic-plan/'], function () {
            Route::post('/duration/lists', [\App\Http\Controllers\Setting\XStrategicPlan\DurationController::class, 'getDurationLists'])->name('duration.lists');
            Route::resource('/duration', \App\Http\Controllers\Setting\XStrategicPlan\DurationController::class, ['except' => ['edit', 'create']]);

            Route::post('/outcome/lists', [\App\Http\Controllers\Setting\XStrategicPlan\OutcomeController::class, 'getOutcomeLists'])->name('outcome.lists');
            Route::resource('/outcome', \App\Http\Controllers\Setting\XStrategicPlan\OutcomeController::class, ['except' => ['edit', 'create']]);

            Route::post('/output/lists', [\App\Http\Controllers\Setting\XStrategicPlan\OutputController::class, 'getOutputLists'])->name('output.lists');
            Route::resource('/output', \App\Http\Controllers\Setting\XStrategicPlan\OutputController::class, ['except' => ['edit', 'create']]);
        });
    });

    //Miscellaneous
    Route::get('locale/{locale}', [App\Http\Controllers\ChangeController::class, 'changeLocale'])->name('change.locale');
    Route::get('change/office/{id}/{office_id}/{office_unit_id}/{designation_id}', [App\Http\Controllers\ChangeController::class, 'changeDesignation'])->name('change.office');

    //Generic Data Collection
    Route::group(['as' => 'generic.'], function () {
        Route::post('get-strategic-outcome-remarks', [\App\Http\Controllers\GenericIfoCollectController::class, 'getStrategicOutcomeRemarks'])->name('outcome.remarks');
        Route::post('get-strategic-output-by-outcome', [\App\Http\Controllers\GenericIfoCollectController::class, 'getStrategicOutputByOutcome'])->name('output.by.outcome');
    });

    //Generic RPU Data Collection
    Route::group(['as' => 'rpu.'], function () {
        Route::post('get-ministries', [\App\Http\Controllers\GenericRPUController::class, 'getMinistries'])->name('ministries.all');
        Route::post('get-office-layer', [\App\Http\Controllers\GenericRPUController::class, 'getMinistryWiseOfficeLayer'])->name('office-layer.all');
        Route::post('get-rp-offices', [\App\Http\Controllers\GenericRPUController::class, 'getMinistryLayerWiseOffice'])->name('rp-offices.all');
    });

    /*
    Plan Route Start
    */

    Route::group(['prefix' => '/m/'], function () {
        Route::get('/plan-dashboard', function () {
            return view('pages.plan.dashboard');
        })->name('plan');

        Route::get('/strategic-plan', function () {
            return view('pages.plan.strategic.strategicPlan');
        })->name('strategic');

        Route::get('/operational-plan', function () {
            return view('pages.plan.operational.operationalPlan');
        })->name('operational');

        Route::get('/anual-plan', function () {
            return view('pages.plan.anual.anualPlan');
        })->name('anual');

        Route::get('/create-anual-audit-activites', function () {
            return view('pages.plan.operational.createAnualAuditActivites');
        })->name('createAnualAuditActivites');
        Route::get('/create-anual-audit-calender', function () {
            return view('pages.plan.operational.createAnualAuditCalender');
        })->name('createAnualAuditCalender');
        Route::get('/operational-plan-view', function () {
            return view('pages.plan.operational.operationalPlanView');
        })->name('operationalPlanView');
        /*
        Plan Route End
        */

        /*
        Execution Route Start
        */
        Route::get('/execution-dashboard', function () {
            return view('pages.execution.dashboard');
        })->name('execution');
        /*
        Execution Route End
        */

        /*
        Execution Route Start
        */
        Route::get('/follow-up-dashboard', function () {
            return view('pages.followUp.dashboard');
        })->name('followUp');
        /*
        Execution Route End
        */
        /*
        Execution Route Start
        */
        Route::get('/report-dashboard', function () {
            return view('pages.report.dashboard');
        })->name('report');

        /*
        Execution Route End
        */ // Route::get('/anual-operation', function () {
        //     return view('pages.anualOperation');
        // });
        Route::get('/create-strategic-operation', function () {
            return view('pages.createOperation');
        });
        Route::get('/audit-plan', function () {
            return view('pages.auditPlanList');
        });
        Route::get('/new-audit', function () {
            return view('pages.auditPlanCreate');
        });

        Route::get('/list-view', function () {
            return view('pages.listView');
        });
        Route::get('/full-width', function () {
            return view('pages.fullWidth');
        });
        Route::get('/profile', function () {
            return view('pages.profile.profileInformation');
        });
        Route::get('/change-password', function () {
            return view('pages.profile.changePassword');
        });
        Route::get('/work-history', function () {
            return view('pages.profile.workHistory');
        });
        Route::get('/change-profile-image', function () {
            return view('pages.profile.changeProfileImage');
        });
        Route::get('/change-signature', function () {
            return view('pages.profile.changeSignature');
        });
        Route::get('/notification-config', function () {
            return view('pages.profile.notification');
        });

        Route::get('/list-view', function () {
            return view('pages.listView');
        });

        Route::get('/buttons', function () {
            return view('pages.buttons');
        });

        Route::get('/file-upload', function () {
            return view('pages.fileUpload');
        });

        Route::get('/image-crop', function () {
            return view('pages.imageCrop');
        });

        Route::get('/tree-view', function () {
            return view('pages.treeView');
        });

        Route::get('/drug-and-drop', function () {
            return view('pages.dragAndDrop');
        });

        Route::get('/forms', function () {
            return view('pages.forms');
        });

        Route::get('/ajax-load', function () {
            return 'এজাক্স লোড ডাটা';
        });
    });
});

// Route::get('/ajax-load', 'ajaxLoadPageController@getTemplate');
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    Artisan::call('route:clear');
    return "Cache is cleared";
});
