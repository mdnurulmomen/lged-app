<?php

use App\Http\Controllers\AuditExecution\AuditExecutionArchiveApottiController;
use App\Http\Controllers\AuditExecution\AuditExecutionArchiveApottiReportController;
use App\Http\Controllers\AuditExecution\AuditExecutionAreaController;
use App\Http\Controllers\AuditFollowup\AuditFollowupController;
use App\Http\Controllers\AuditFollowup\BroadsheetReplyController;
use App\Http\Controllers\AuditPlan\AuditAnnualPlan\AuditAssessmentController;
use App\Http\Controllers\AuditPlan\AuditAnnualPlan\AuditAssessmentScoreController;
use App\Http\Controllers\AuditReport\AuditAIRReportController;
use App\Http\Controllers\AuditReport\AuditAIRReportMovementController;
use App\Http\Controllers\AuditReport\AuditQACAIRReportController;
use App\Http\Controllers\AuditReport\AuditQACOneReportController;
use App\Http\Controllers\AuditReport\AuditQACTwoReportController;
use App\Http\Controllers\QualityControl\QACController;
use App\Http\Controllers\Setting\XAuditAssessment\CriteriaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::group(['middleware' => ['jisf.auth', 'auth.bee']], function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard/referer/{type?}/{type_bn?}', [\App\Http\Controllers\DashboardController::class, 'index_referer'])->name('dashboard.index_referer');
    Route::get('/dashboard/index', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
    Route::post('/profile', [\App\Http\Controllers\DashboardController::class, 'getUserProfile'])->name('user_profile');

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

            Route::get('draft-plans', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\DraftPlanController::class, 'index'])->name('draft_plan.all');
            Route::post('draft-plan', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\DraftPlanController::class, 'show'])->name('draft_plan.single');
            Route::get('draft-plan/create', function () {
                return view('modules.audit_plan.strategic.draft_plan.strategic_plan_draft_create');
            })->name('draft_plan_create');

            //sp file upload
            Route::get('sp-file-list', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\FinalPlanController::class, 'index'])->name('sp_file_list');
            Route::get('file-upload', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\FinalPlanController::class, 'create'])->name('sp_file_upload');
            Route::post('file-store', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\FinalPlanController::class, 'store'])->name('sp_file_store');
            Route::get('final-plan-edit/{id}', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\FinalPlanController::class, 'edit'])->name('sp_file_edit');
            Route::post('file-update', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\FinalPlanController::class, 'update'])->name('sp_file_update');

            Route::post('is-document-exist', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\FinalPlanController::class, 'isDocumentExist'])->name('is_document_exist');


            //html view
            Route::get('setting-list', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\HTMLViewController::class, 'index'])->name('setting_list');

            Route::get('html-view-content', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\HTMLViewController::class, 'contentView'])->name('html_view_content');
            Route::get('html-view-content-create', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\HTMLViewController::class, 'createContent'])->name('html_view_content_create');
            Route::get('html-view-content-key-create', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\HTMLViewController::class, 'createKey'])->name('html_view_content_key_create');
            Route::post('html-view-content-key-store', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\HTMLViewController::class, 'storeKey'])->name('html_view_content_key_store');
            Route::get('html-view-content-title-duration-wise', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\HTMLViewController::class, 'loadParentDurationWiseSelect'])->name('html_view_content_title_duration_wise');

            Route::get('meetings', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\MeetingController::class, 'index'])->name('meeting.all');
            Route::post('meeting', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\MeetingController::class, 'show'])->name('meeting.single');

            Route::get('final-plans', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\FinalPlanController::class, 'index'])->name('final-plan.all');
            Route::post('final-plan', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\FinalPlanController::class, 'show'])->name('final-plan.single');

            Route::get('milestones', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\MilestoneController::class, 'index'])->name('milestone.all');
            Route::post('milestone', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\MilestoneController::class, 'show'])->name('milestone.single');

            Route::get('risks', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\RiskController::class, 'index'])->name('risk.all');
            Route::post('risk', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\RiskController::class, 'show'])->name('risk.single');

            Route::get('indicator/outcome', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\IndicatorOutcomeController::class, 'index'])->name('indicator.outcome');
            Route::get('indicator/outcome/create', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\IndicatorOutcomeController::class, 'create'])->name('indicator.outcome.create');
            Route::post('indicator/outcome/create', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\IndicatorOutcomeController::class, 'store'])->name('indicator.outcome.store');
            Route::get('indicator/outcome/edit/{id}', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\IndicatorOutcomeController::class, 'edit'])->name('indicator.outcome.edit');
            Route::post('indicator/outcome/update', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\IndicatorOutcomeController::class, 'update'])->name('indicator.outcome.update');
            Route::get('indicator/outcome/show/{id}', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\IndicatorOutcomeController::class, 'show'])->name('indicator.outcome.show');

            Route::get('indicator/outcome/all', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\IndicatorOutcomeController::class, 'outcomes'])->name('indicator.outcomes');

            Route::post('indicator/genYear', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\IndicatorOutcomeController::class, 'genYear'])->name('indicator.gen.year');


            Route::get('indicator/output', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\IndicatorOutputController::class, 'index'])->name('indicator.output');
            Route::post('indicator/output/create', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\IndicatorOutputController::class, 'store'])->name('indicator.output.store');
            Route::get('indicator/output/create', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\IndicatorOutputController::class, 'create'])->name('indicator.output.create');
            Route::get('indicator/output/edit/{id}', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\IndicatorOutputController::class, 'edit'])->name('indicator.output.edit');
            Route::post('indicator/output/update', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\IndicatorOutputController::class, 'update'])->name('indicator.output.update');
            Route::get('indicator/output/show/{id}', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\IndicatorOutputController::class, 'show'])->name('indicator.output.show');

            Route::get('indicator/output/all', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\IndicatorOutputController::class, 'outputs'])->name('indicator.outputs');


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
            Route::post('activity-select', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditActivityController::class, 'activitySelect'])->name('activity.select');
            Route::post('activity-wise-audit-plan', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditActivityController::class, 'activityWiseAuditPlan'])->name('activity.audit-plan');

            Route::post('activity', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditActivityController::class, 'show'])->name('activity.single');

            Route::post('edit-activity', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditActivityController::class, 'edit'])->name('activity.edit');

            Route::post('load-edit-output-activity', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditActivityController::class, 'loadEditOutputActivity'])->name('activity.edit.output.load');
            Route::post('load-edit-output-activity-milestone', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditActivityController::class, 'loadEditOutputActivityMilestone'])->name('activity.milestone.edit.output.load');
            Route::post('update-activity', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditActivityController::class, 'update'])->name('activity.update');
            Route::post('update-activity-milestone', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditActivityController::class, 'milestoneUpdate'])->name('activity.milestone.update');

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
            Route::get('file-list', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\FinalPlanController::class, 'index'])->name('file_list');
            Route::get('file-create', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\FinalPlanController::class, 'create'])->name('file_create');
            Route::post('file-store', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\FinalPlanController::class, 'store'])->name('file_store');
            Route::get('file-edit/{id}', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\FinalPlanController::class, 'edit'])->name('file_edit');
            Route::post('file-update', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\FinalPlanController::class, 'update'])->name('file_update');

            Route::post('is-document-exist', [\App\Http\Controllers\AuditPlan\AuditOperationalPlan\FinalPlanController::class, 'isDocumentExist'])->name('is_document_exist');
        });

        //annual plan
        Route::group(['as' => 'annual.', 'prefix' => 'annual/'], function () {
            Route::get('/', [\App\Http\Controllers\AuditPlan\AuditAnnualPlanController::class, 'index'])->name('index');
            Route::get('/dashboard', [\App\Http\Controllers\AuditPlan\AuditAnnualPlanController::class, 'showAnnualPlanDashboard'])->name('dashboard');

            Route::get('/plans', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanController::class, 'index'])->name('plan.all');

            Route::post('/load-annual-plan-lists', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanRevisedController::class, 'showAnnualPlanLists'])->name('plan.list.all');
            Route::get('/annual-plan-calender', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanRevisedController::class, 'annualPlanCalender'])->name('plan.annual-plan-calender');

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
            Route::post('/fiscal-year-wise-activity-select', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanRevisedController::class, 'fiscalYearWiseActivitySelect'])->name('plan.revised.fiscal-year-wise-activity-select');
            Route::post('/load-annual-entity-show', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanRevisedController::class, 'showAnnualPlanEntities'])->name('plan.revised.annual-entities-show');
            Route::post('/create-plan-info', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanRevisedController::class, 'addAnnualPlanInfo'])->name('plan.list.show.revised.create_plan_info');
            Route::post('/activity-wise-milestone-select', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanRevisedController::class, 'activityWiseMilestoneSelect'])->name('plan.list.show.revised.activity-wise-milestone-select');
            Route::post('/store-annual-plan', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanRevisedController::class, 'storeAnnualPlanInfo'])->name('plan.revised.store');
            Route::post('/edit-plan-info', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanRevisedController::class, 'editAnnualPlanInfo'])->name('plan.revised.edit_plan_info');
            Route::post('/show-plan-info', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanRevisedController::class, 'showAnnualPlanInfo'])->name('plan.revised.show_plan_info');
            Route::post('/delete-plan-info', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanRevisedController::class, 'deleteAnnualPlan'])->name('plan.revised.delete_annual_plan');
            Route::post('/load-rp-auditee-offices', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanRevisedController::class, 'showRPAuditeeOffices'])->name('plan.list.show.rp-auditee-offices');
            Route::post('/load-rp-auditee-offices-ministry-wise', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanRevisedController::class, 'showRPAuditeeOfficesMinistryWise'])->name('plan.list.show.rp-auditee-offices-ministry-wise');
            Route::post('/load-rp-auditee-child-offices', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanRevisedController::class, 'showRPChildAuditeeOffices'])->name('plan.list.show.rp-auditee-child-offices');
            Route::post('/load-rp-auditee-child-offices-list', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanRevisedController::class, 'showRPChildAuditeeOfficesList'])->name('plan.list.show.rp-auditee-child-offices-list');
            Route::post('/submit-audit-plan-to-ocag', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanRevisedController::class, 'submitPlanToOCAG'])->name('plan.list.submit.revised.plan-to-ocag');

            Route::get('/calendar', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualCalendarController::class, 'index'])->name('calendar');
            Route::post('/load-assessment-entity', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanRevisedController::class, 'loadAssessmentEntity'])->name('load-assessment-entity');

            Route::post('/load-annual-plan-edit-milestone', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanRevisedController::class, 'loadEditAnnualPlanMilestone'])->name('plan.list.load-edit-milestone');
            Route::post('/annual-plan-edit-milestone', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanRevisedController::class, 'editAnnualPlanMilestone'])->name('plan.list.edit-milestone');

            //audit assessment score
            Route::group(['as' => 'audit-assessment-score.', 'prefix' => 'audit-assessment-score/'], function () {
                Route::get('/', [AuditAssessmentScoreController::class, 'index']);
                Route::post('/list', [AuditAssessmentScoreController::class, 'list'])->name('list');
                Route::post('/create', [AuditAssessmentScoreController::class, 'create'])->name('create');
                Route::post('/load-ministry-wise-entity', [AuditAssessmentScoreController::class, 'loadMinistryWiseEntity'])->name('load-ministry-wise-entity');
                Route::post('/load-criteria-list', [AuditAssessmentScoreController::class, 'loadCategoryWiseCriteriaList'])->name('load-criteria-list');
                Route::post('/store', [AuditAssessmentScoreController::class, 'store'])->name('store');
                Route::post('/edit', [AuditAssessmentScoreController::class, 'edit'])->name('edit');
            });

            //audit assessment
            Route::group(['as' => 'audit-assessment.', 'prefix' => 'audit-assessment/'], function () {
                Route::get('/', [AuditAssessmentController::class, 'index']);
                Route::post('/list', [AuditAssessmentController::class, 'list'])->name('list');
                Route::post('/store', [AuditAssessmentController::class, 'store'])->name('store');
                Route::post('/store_annual_plan', [AuditAssessmentController::class, 'storeAnnualPlan'])->name('store_annual_plan');
            });

            Route::group(['as' => 'psr.', 'prefix' => 'psr/'], function () {
                Route::get('/', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\PreliminarySurveyReportController::class, 'index']);
                Route::post('load-psr', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\PreliminarySurveyReportController::class, 'loadPsr'])->name('load-psr');
                Route::post('create-psr', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\PreliminarySurveyReportController::class, 'create'])->name('create-psr');
                Route::post('store-psr', [\App\Http\Controllers\AuditPlan\AuditAnnualPlan\PreliminarySurveyReportController::class, 'store'])->name('store-psr');
            });
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
            Route::post('/entity-audit-plan/audit-team/previously-assigned-designations', [\App\Http\Controllers\AuditPlan\Plan\RevisedPlanController::class, 'getPreviouslyAssignedDesignations'])->name('revised.plan.previously-assigned-designations');
            Route::post('/update-entity-audit-plan', [\App\Http\Controllers\AuditPlan\Plan\RevisedPlanController::class, 'updateAuditPlan'])->name('revised.plan.update-entity-audit-plan');
            Route::post('/save-draft-entity-audit-plan', [\App\Http\Controllers\AuditPlan\Plan\RevisedPlanController::class, 'saveDraftEntityAuditPlan'])->name('revised.plan.save-draft-entity-audit-plan');
            Route::post('/book-audit-plan', [\App\Http\Controllers\AuditPlan\Plan\RevisedPlanController::class, 'auditPlanBook'])->name('revised.plan.book-audit-plan');

            Route::post('/get-team-info', [\App\Http\Controllers\AuditPlan\Plan\RevisedPlanController::class, 'getTeamInfo'])->name('revised.plan.get-team-info');
            Route::post('/load-officer-lists', [\App\Http\Controllers\AuditPlan\Plan\PlanEditorController::class, 'loadOfficeEmployeeList'])->name('revised.plan.load-officer-lists');
            Route::post('/store-audit-team', [\App\Http\Controllers\AuditPlan\Plan\RevisedPlanController::class, 'storeAuditTeam'])->name('revised.plan.store-audit-team');
            Route::post('/update-audit-team', [\App\Http\Controllers\AuditPlan\Plan\RevisedPlanController::class, 'updateAuditTeam'])->name('revised.plan.update-audit-team');
            Route::post('/store-audit-team-schedule', [\App\Http\Controllers\AuditPlan\Plan\RevisedPlanController::class, 'storeAuditTeamSchedule'])->name('revised.plan.store-audit-team-schedule');
            Route::post('/update-audit-team-schedule', [\App\Http\Controllers\AuditPlan\Plan\RevisedPlanController::class, 'updateAuditTeamSchedule'])->name('revised.plan.update-audit-team-schedule');
            Route::post('/get-audit-plan-wise-team-members', [\App\Http\Controllers\AuditPlan\Plan\RevisedPlanController::class, 'getPlanWiseTeamMembers'])->name('revised.plan.get-audit-plan-wise-team-members');
            Route::post('/get-audit-plan-wise-team-schedules', [\App\Http\Controllers\AuditPlan\Plan\RevisedPlanController::class, 'getPlanWiseTeamSchedules'])->name('revised.plan.get-audit-plan-wise-team-schedules');
            Route::post('/team-log-discard', [\App\Http\Controllers\AuditPlan\Plan\RevisedPlanController::class, 'teamLogDiscard'])->name('revised.plan.team-log-discard');

            Route::post('editor/load-audit-team-modal', [\App\Http\Controllers\AuditPlan\Plan\PlanEditorController::class, 'loadAuditTeamModal'])->name('editor.load-audit-team-modal');
            Route::post('editor/load-audit-team-schedule', [\App\Http\Controllers\AuditPlan\Plan\PlanEditorController::class, 'loadAuditTeamSchedule'])->name('editor.load-audit-team-schedule');
            Route::post('editor/add-audit-schedule-row', [\App\Http\Controllers\AuditPlan\Plan\PlanEditorController::class, 'addAuditScheduleRow'])->name('editor.add-audit-schedule-row');
            Route::post('editor/load-select-nominated-offices', [\App\Http\Controllers\AuditPlan\Plan\PlanEditorController::class, 'loadNominatedOfficesSelectView'])->name('editor.load-select-nominated-offices');
            Route::post('editor/load-select-nominated-office-option', [\App\Http\Controllers\AuditPlan\Plan\PlanEditorController::class, 'loadNominatedOfficesSelectOption'])->name('editor.load-select-nominated-office-option');
            Route::post('editor/load-risk-assessment-list', [\App\Http\Controllers\AuditPlan\Plan\RiskAssessmentController::class, 'loadRiskAssessment'])->name('editor.load-risk-assessment-list');
            Route::post('editor/load-risk-assessment-list-type-wise', [\App\Http\Controllers\AuditPlan\Plan\RiskAssessmentController::class, 'loadRiskAssessmentTypeWise'])->name('editor.load-risk-assessment-type-wise-list');
            Route::post('editor/store-risk-assessment', [\App\Http\Controllers\AuditPlan\Plan\RiskAssessmentController::class, 'store'])->name('editor.store-risk-assessment');
            Route::post('editor/update-risk-assessment', [\App\Http\Controllers\AuditPlan\Plan\RiskAssessmentController::class, 'update'])->name('editor.update-risk-assessment');
            Route::post('editor/risk-assessment-book', [\App\Http\Controllers\AuditPlan\Plan\RiskAssessmentController::class, 'book'])->name('editor.risk-assessment-book');

            //office order
            Route::get('/office-orders', [\App\Http\Controllers\AuditPlan\Plan\OfficeOrderController::class, 'index'])->name('office-orders.index');
            Route::post('/load-office-order-list', [\App\Http\Controllers\AuditPlan\Plan\OfficeOrderController::class, 'loadOfficeOrderList'])->name('office-orders.load-office-order-list');
            Route::post('/load-office-order-create', [\App\Http\Controllers\AuditPlan\Plan\OfficeOrderController::class, 'loadOfficeOrderCreate'])->name('office-orders.load-office-order-create');
            Route::post('/load-office-order-cc-create', [\App\Http\Controllers\AuditPlan\Plan\OfficeOrderController::class, 'loadOfficeOrderCCCreate'])->name('office-orders.load-office-order-cc-create');
            Route::post('/load-office-order-approval-authority', [\App\Http\Controllers\AuditPlan\Plan\OfficeOrderController::class, 'loadOfficeOrderApprovalAuthority'])->name('office-orders.load-office-order-approval-authority');
            Route::post('/store-office-order-approval-authority', [\App\Http\Controllers\AuditPlan\Plan\OfficeOrderController::class, 'storeOfficeOrderApprovalAuthority'])->name('office-orders.store-office-order-approval-authority');
            Route::post('/approve-office-order', [\App\Http\Controllers\AuditPlan\Plan\OfficeOrderController::class, 'approveOfficeOrder'])->name('office-orders.approve-office-order');
            Route::post('/generate-office-order', [\App\Http\Controllers\AuditPlan\Plan\OfficeOrderController::class, 'generateOfficeOrder'])->name('office-orders.generate-office-order');
            Route::post('/show-office-order', [\App\Http\Controllers\AuditPlan\Plan\OfficeOrderController::class, 'showOfficeOrder'])->name('office-orders.show-office-order');
            Route::post('/show-update-office-order', [\App\Http\Controllers\AuditPlan\Plan\OfficeOrderController::class, 'showUpdateOfficeOrder'])->name('office-orders.show-update-office-order');
            Route::post('/download-pdf', [\App\Http\Controllers\AuditPlan\Plan\OfficeOrderController::class, 'generateOfficeOrderPDF'])->name('office-orders.download-pdf');

            //data collection office order
            Route::get('/office-orders-dc', [\App\Http\Controllers\AuditPlan\Plan\DcOfficeOrderController::class, 'index'])->name('office-orders-dc.index');
            Route::post('/load-office-order-list-dc', [\App\Http\Controllers\AuditPlan\Plan\DcOfficeOrderController::class, 'loadOfficeOrderList'])->name('office-orders-dc.load-office-order-list');
            Route::post('/load-office-order-create-dc', [\App\Http\Controllers\AuditPlan\Plan\DcOfficeOrderController::class, 'loadOfficeOrderCreate'])->name('office-orders-dc.load-office-order-create');
            Route::post('/load-office-order-cc-create-dc', [\App\Http\Controllers\AuditPlan\Plan\DcOfficeOrderController::class, 'loadOfficeOrderCCCreate'])->name('office-orders-dc.load-office-order-cc-create');
            Route::post('/load-office-order-approval-authority-dc', [\App\Http\Controllers\AuditPlan\Plan\DcOfficeOrderController::class, 'loadOfficeOrderApprovalAuthority'])->name('office-orders-dc.load-office-order-approval-authority');
            Route::post('/store-office-order-approval-authority-dc', [\App\Http\Controllers\AuditPlan\Plan\DcOfficeOrderController::class, 'storeOfficeOrderApprovalAuthority'])->name('office-orders-dc.store-office-order-approval-authority');
            Route::post('/approve-office-order-dc', [\App\Http\Controllers\AuditPlan\Plan\DcOfficeOrderController::class, 'approveOfficeOrder'])->name('office-orders-dc.approve-office-order');
            Route::post('/generate-office-order-dc', [\App\Http\Controllers\AuditPlan\Plan\DcOfficeOrderController::class, 'generateOfficeOrder'])->name('office-orders-dc.generate-office-order');
            Route::post('/show-office-order-dc', [\App\Http\Controllers\AuditPlan\Plan\DcOfficeOrderController::class, 'showOfficeOrder'])->name('office-orders-dc.show-office-order');
            Route::post('/download-pdf-dc', [\App\Http\Controllers\AuditPlan\Plan\DcOfficeOrderController::class, 'generateOfficeOrderPDF'])->name('office-orders-dc.download-pdf');
        });
    });

    Route::group(['prefix' => 'calendar/'], function () {
        Route::post('load-teams-calender', [\App\Http\Controllers\AuditPlan\Calendar\TeamCalendarController::class, 'loadTeamCalendar'])->name('calendar.load-teams-calender');
        Route::post('load-teams-calender-filter', [\App\Http\Controllers\AuditPlan\Calendar\TeamCalendarController::class, 'loadTeamCalendarFilter'])->name('calendar.load-teams-calender-filter');
        Route::post('load-teams-select', [\App\Http\Controllers\AuditPlan\Calendar\TeamCalendarController::class, 'loadTeamsSelect'])->name('calendar.load-teams-select');
        Route::post('load-schedule-entity-fiscal-year-wise-select', [\App\Http\Controllers\AuditPlan\Calendar\TeamCalendarController::class, 'loadScheduleEntityFiscalYearWiseSelect'])->name('calendar.load-schedule-entity-fiscal-year-wise-select');
        Route::post('load-cost-center-directorate-fiscal-year-wise-select', [\App\Http\Controllers\AuditPlan\Calendar\TeamCalendarController::class, 'loadCostCenterDirectorateFiscalYearWiseSelect'])->name('calendar.load-cost-center-directorate-fiscal-year-wise-select');
        Route::get('teams', [\App\Http\Controllers\AuditPlan\Calendar\TeamCalendarController::class, 'index'])->name('calendar.teams');
        Route::post('update-visit-calender-status', [\App\Http\Controllers\AuditPlan\Calendar\TeamCalendarController::class, 'updateVisitCalenderStatus'])->name('calendar.update-visit-calender-status');
        Route::post('load-sub-team-select', [\App\Http\Controllers\AuditPlan\Calendar\TeamCalendarController::class, 'loadSubTeamSelect'])->name('calendar.load-sub-teams-select');
        Route::post('load-team-calendar-schedule-list', [\App\Http\Controllers\AuditPlan\Calendar\TeamCalendarController::class, 'loadTeamCalendarScheduleList'])->name('calendar.load-team-calendar-schedule-list');
        Route::post('get-total-query-and-memo-report', [\App\Http\Controllers\AuditPlan\Calendar\TeamCalendarController::class, 'getTotalQueryAndMemoReport'])->name('calendar.get-total-query-and-memo-report');
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
        Route::get('/', [\App\Http\Controllers\AuditExecution\AuditExecutionController::class, 'index']);

        Route::get('area', [\App\Http\Controllers\AuditExecution\AuditExecutionAreaController::class, 'index'])->name('area');

        //audit schedule
        Route::get('audit-schedule', [\App\Http\Controllers\AuditExecution\AuditExecutionScheduleController::class, 'auditSchedule'])->name('audit-schedule');
        Route::post('load-audit-schedule-list', [\App\Http\Controllers\AuditExecution\AuditExecutionScheduleController::class, 'loadAuditScheduleList'])->name('load-audit-schedule-list');

        //authority query list
        Route::get('authority-query-list', [\App\Http\Controllers\AuditExecution\AuditExecutionQueryController::class, 'authorityQueryList'])->name('authority-query-list');
        Route::post('load-authority-query-list', [\App\Http\Controllers\AuditExecution\AuditExecutionQueryController::class, 'loadAuthorityQueryList'])->name('load-authority-query-list');

        Route::group(['as' => 'query.', 'prefix' => 'query/'], function () {
            Route::post('index', [\App\Http\Controllers\AuditExecution\AuditExecutionQueryController::class, 'auditQuery'])->name('index');
            Route::post('load-list', [\App\Http\Controllers\AuditExecution\AuditExecutionQueryController::class, 'loadAuditQuery'])->name('load-list');
            Route::post('create', [\App\Http\Controllers\AuditExecution\AuditExecutionQueryController::class, 'auditQueryCreate'])->name('create');
            Route::post('store', [\App\Http\Controllers\AuditExecution\AuditExecutionQueryController::class, 'storeAuditQuery'])->name('store');
            Route::post('edit', [\App\Http\Controllers\AuditExecution\AuditExecutionQueryController::class, 'editAuditQuery'])->name('edit');
            Route::post('update', [\App\Http\Controllers\AuditExecution\AuditExecutionQueryController::class, 'updateAuditQuery'])->name('update');
            Route::post('view', [\App\Http\Controllers\AuditExecution\AuditExecutionQueryController::class, 'viewAuditQuery'])->name('view');
            Route::post('download', [\App\Http\Controllers\AuditExecution\AuditExecutionQueryController::class, 'downloadAuditQuery'])->name('download');
            Route::post('send-to-rpu', [\App\Http\Controllers\AuditExecution\AuditExecutionQueryController::class, 'sendAuditQuery'])->name('send-to-rpu');
            Route::post('received', [\App\Http\Controllers\AuditExecution\AuditExecutionQueryController::class, 'receivedAuditQuery'])->name('received');
        });
        Route::post('load-type-wise-audit-query', [\App\Http\Controllers\AuditExecution\AuditExecutionQueryController::class, 'loadTypeWiseAuditQuery'])->name('load-type-wise-audit-query');


        Route::post('load-reject-query-form', [\App\Http\Controllers\AuditExecution\AuditExecutionQueryController::class, 'loadRejectAuditQuery'])->name('load-reject-query-form');
        Route::post('reject-audit-query', [\App\Http\Controllers\AuditExecution\AuditExecutionQueryController::class, 'rejectAuditQuery'])->name('reject-audit-query');

        Route::get('discussion', [\App\Http\Controllers\AuditExecution\AuditExecutionDiscussionController::class, 'index'])->name('discussion');

        Route::get('review', [\App\Http\Controllers\AuditExecution\AuditExecutionReviewController::class, 'index'])->name('review');

        Route::group(['as' => 'memo.', 'prefix' => 'memo/'], function () {
            Route::post('index', [\App\Http\Controllers\AuditExecution\AuditExecutionMemoController::class, 'index'])->name('index');
            Route::post('create', [\App\Http\Controllers\AuditExecution\AuditExecutionMemoController::class, 'create'])->name('create');
            Route::post('store', [\App\Http\Controllers\AuditExecution\AuditExecutionMemoController::class, 'store'])->name('store');
            Route::post('edit', [\App\Http\Controllers\AuditExecution\AuditExecutionMemoController::class, 'edit'])->name('edit');
            Route::post('show', [\App\Http\Controllers\AuditExecution\AuditExecutionMemoController::class, 'show'])->name('show');
            Route::post('show-attachment', [\App\Http\Controllers\AuditExecution\AuditExecutionMemoController::class, 'showAttachment'])->name('show-attachment');
            Route::post('show-details', [\App\Http\Controllers\AuditExecution\AuditExecutionMemoController::class, 'showDetails'])->name('show-details');
            Route::post('download-pdf', [\App\Http\Controllers\AuditExecution\AuditExecutionMemoController::class, 'memoPDFDownload'])->name('download.pdf');
            Route::post('update', [\App\Http\Controllers\AuditExecution\AuditExecutionMemoController::class, 'update'])->name('update');
            Route::post('list', [\App\Http\Controllers\AuditExecution\AuditExecutionMemoController::class, 'list'])->name('list');
            Route::post('sent-to-rpu', [\App\Http\Controllers\AuditExecution\AuditExecutionMemoController::class, 'sentToRpu'])->name('sent-to-rpu');
            Route::get('authority-memo-list', [\App\Http\Controllers\AuditExecution\AuditExecutionMemoController::class, 'authorityMemoList'])->name('authority-memo-list');
            Route::post('load-authority-memo-list', [\App\Http\Controllers\AuditExecution\AuditExecutionMemoController::class, 'loadAuthorityMemoList'])->name('load-authority-memo-list');
            Route::post('audit-memo-recommendation', [\App\Http\Controllers\AuditExecution\AuditExecutionMemoController::class, 'auditMemoRecommendation'])->name('audit-memo-recommendation');
            Route::post('audit-memo-recommendation-store', [\App\Http\Controllers\AuditExecution\AuditExecutionMemoController::class, 'auditMemoRecommendationStore'])->name('audit-memo-recommendation-store');
            Route::post('audit-memo-log', [\App\Http\Controllers\AuditExecution\AuditExecutionMemoController::class, 'auditMemoLog'])->name('audit-memo-log');
            Route::post('audit-memo-log-show', [\App\Http\Controllers\AuditExecution\AuditExecutionMemoController::class, 'auditMemoShow'])->name('audit-memo-log-show');
            Route::post('send-memo-form', [\App\Http\Controllers\AuditExecution\AuditExecutionMemoController::class, 'sendMemoForm'])->name('send-memo-form');
            Route::post('delete-memo-attachment', [\App\Http\Controllers\AuditExecution\AuditExecutionMemoController::class, 'deleteMemoAttachment'])->name('delete-memo-attachment');
        });


        Route::group(['as' => 'apotti.', 'prefix' => 'apotti/'], function () {
            Route::get('/', [\App\Http\Controllers\AuditReport\AuditReportDashboardController::class, 'apottiPage'])->name('dashboard');

            Route::group(['as' => 'memo.', 'prefix' => 'memo/'], function () {
                Route::get('/', [\App\Http\Controllers\AuditExecution\AuditExecutionApottiMemoController::class, 'apottiMemoPage'])->name('dashboard');
                Route::get('index', [\App\Http\Controllers\AuditExecution\AuditExecutionApottiMemoController::class, 'index'])->name('index');
                Route::post('memo-list', [\App\Http\Controllers\AuditExecution\AuditExecutionApottiMemoController::class, 'loadMemoList'])->name('memo-list');
                Route::post('edit', [\App\Http\Controllers\AuditExecution\AuditExecutionApottiMemoController::class, 'edit'])->name('edit');
                Route::post('convert-memo-to-apotti', [\App\Http\Controllers\AuditExecution\AuditExecutionApottiMemoController::class, 'convertMemoToApotti'])->name('convert-memo-to-apotti');
            });

            Route::get('index', [\App\Http\Controllers\AuditExecution\AuditExecutionApottiController::class, 'index'])->name('index');
            Route::post('load-apotti-list', [\App\Http\Controllers\AuditExecution\AuditExecutionApottiController::class, 'loadApottiList'])->name('load-apotti-list');
            Route::post('onucched-merge', [\App\Http\Controllers\AuditExecution\AuditExecutionApottiController::class, 'onucchedMerge'])->name('onucched-merge');
            Route::post('onucched-unmerge', [\App\Http\Controllers\AuditExecution\AuditExecutionApottiController::class, 'onucchedUnMerge'])->name('onucched-unmerge');
            Route::post('onucched-rearrange', [\App\Http\Controllers\AuditExecution\AuditExecutionApottiController::class, 'onucchedReArrange'])->name('onucched-rearrange');
            Route::post('onucched-merge-form', [\App\Http\Controllers\AuditExecution\AuditExecutionApottiController::class, 'onucchedMergeForm'])->name('onucched-merge-form');
            Route::post('onucched-show', [\App\Http\Controllers\AuditExecution\AuditExecutionApottiController::class, 'onucchedShow'])->name('onucched-show');
            Route::post('edit-apotti', [\App\Http\Controllers\AuditExecution\AuditExecutionApottiController::class, 'editApotti'])->name('edit-apotti');
            Route::post('update-apotti', [\App\Http\Controllers\AuditExecution\AuditExecutionApottiController::class, 'updateApotti'])->name('update-apotti');
            Route::post('audit-plan-wise-entity', [\App\Http\Controllers\AuditExecution\AuditExecutionApottiController::class, 'auditPlanWiseEntitySelect'])->name('audit-plan-wise-entity-select');
            Route::post('audit-plan-type-wise-air', [\App\Http\Controllers\AuditExecution\AuditExecutionApottiController::class, 'auditPlanTypeWiseAir'])->name('audit-plan-type-wise-air');
            Route::post('apotti-item-info', [\App\Http\Controllers\AuditExecution\AuditExecutionApottiController::class, 'apottiItemInfo'])->name('apotti-item-info');
            Route::get('apotti-register/{any}', [\App\Http\Controllers\AuditExecution\AuditExecutionApottiController::class, 'apottiRegister'])->name('apotti-register');
            Route::post('load-apotti-register-list', [\App\Http\Controllers\AuditExecution\AuditExecutionApottiController::class, 'loadApottiRegisterList'])->name('load-apotti-register-list');
            Route::post('edit-register', [\App\Http\Controllers\AuditExecution\AuditExecutionApottiController::class, 'loadApottiRegisterEdit'])->name('edit-register');

            Route::group(['as' => 'register.', 'prefix' => 'register/'], function () {
                Route::post('get-approval-authority', [\App\Http\Controllers\AuditExecution\AuditExecutionApottiController::class, 'loadRegisterApprovalAuthority'])->name('get-approval-authority');
                Route::post('store-approval-authority', [\App\Http\Controllers\AuditExecution\AuditExecutionApottiController::class, 'storeRegisterApprovalAuthority'])->name('store-approval-authority');
                Route::post('update', [\App\Http\Controllers\AuditExecution\AuditExecutionApottiController::class, 'updateRegisterApotti'])->name('update');
            });


            Route::get('search-page', [\App\Http\Controllers\AuditExecution\AuditExecutionApottiSearchController::class, 'index'])->name('search-page');
            Route::post('search-list', [\App\Http\Controllers\AuditExecution\AuditExecutionApottiSearchController::class, 'list'])->name('search-list');
        });

        //archive apotti
        Route::group(['as' => 'archive-apotti.', 'prefix' => 'archive-apotti/'], function () {
            Route::get('/', [AuditExecutionArchiveApottiController::class, 'archivePage'])->name('archive-page');
            Route::get('index', [AuditExecutionArchiveApottiController::class, 'index'])->name('index');
            Route::post('create', [AuditExecutionArchiveApottiController::class, 'create'])->name('create');
            Route::post('edit', [AuditExecutionArchiveApottiController::class, 'edit'])->name('edit');
            Route::post('view', [AuditExecutionArchiveApottiController::class, 'view'])->name('view');
            Route::post('store', [AuditExecutionArchiveApottiController::class, 'store'])->name('store');
            Route::post('update', [AuditExecutionArchiveApottiController::class, 'update'])->name('update');
            Route::post('list', [AuditExecutionArchiveApottiController::class, 'list'])->name('list');

            Route::post('load-directorate-wise-ministry', [AuditExecutionArchiveApottiController::class, 'loadDirectorateWiseMinistry'])->name('load-directorate-wise-ministry');
            Route::post('load-ministry-wise-entity', [AuditExecutionArchiveApottiController::class, 'loadMinistryWiseEntity'])->name('load-ministry-wise-entity');
            Route::post('load-entity-wise-unit-group-office', [AuditExecutionArchiveApottiController::class, 'loadEntityWiseUnitGroupOffice'])->name('load-entity-wise-unit-group-office');
            Route::post('load-entity-or-unit-group-wise-cost-center', [AuditExecutionArchiveApottiController::class, 'loadEntityOrUnitGroupWiseCostCenter'])->name('load-entity-or-unit-group-wise-cost-center');

            Route::post('load-oniyomer-category-list', [AuditExecutionArchiveApottiController::class, 'loadOniyomerCategoryList'])->name('load-oniyomer-category-list');
            Route::post('load-oniyomer-sub-category-list', [AuditExecutionArchiveApottiController::class, 'loadOniyomerSubCategoryList'])->name('load-oniyomer-sub-category-list');

            Route::post('migrate-archive-apotti-to-amms', [AuditExecutionArchiveApottiController::class, 'migrateArchiveApottiToAmms'])->name('migrate-archive-apotti-to-amms');
        });

        //archive apotti report
        Route::group(['as' => 'archive-apotti-report.', 'prefix' => 'archive-apotti-report/'], function () {
            Route::get('index', [AuditExecutionArchiveApottiReportController::class, 'index'])->name('index');
            Route::post('create', [AuditExecutionArchiveApottiReportController::class, 'create'])->name('create');
            Route::post('view', [AuditExecutionArchiveApottiReportController::class, 'view'])->name('view');
            Route::post('store', [AuditExecutionArchiveApottiReportController::class, 'store'])->name('store');
            Route::post('list', [AuditExecutionArchiveApottiReportController::class, 'list'])->name('list');
            Route::post('apotti-upload-page', [AuditExecutionArchiveApottiReportController::class, 'apottiUploadPage'])->name('apotti-upload-page');
            Route::post('apotti-store', [AuditExecutionArchiveApottiReportController::class, 'apottiStore'])->name('apotti-store');
            Route::post('report-sync', [AuditExecutionArchiveApottiReportController::class, 'reportSync'])->name('report-sync');
        });
    });

    //Quality Control
    Route::group(['as' => 'audit.qac.', 'prefix' => 'audit-qac/'], function () {

        /*Route::get('/', function () {
            return redirect()->route('audit.qac.dashboard');
        });*/

        Route::get('/', [QACController::class, 'index'])->name('index');
        Route::get('dashboard', [\App\Http\Controllers\QualityControl\AuditQacDashboardController::class, 'index'])->name('dashboard');
        Route::get('qac/{any}', [\App\Http\Controllers\QualityControl\AuditQacController::class, 'index'])->name('qac');
        Route::post('qac-apotti-list', [\App\Http\Controllers\QualityControl\AuditQacController::class, 'loadApottiQacList'])->name('qac-apotti-list');
        Route::post('air-wise-apotti', [\App\Http\Controllers\QualityControl\AuditQacController::class, 'loadAirWiseApottiList'])->name('air-wise-apotti');
        Route::post('qac-apotti', [\App\Http\Controllers\QualityControl\AuditQacController::class, 'qacApotti'])->name('qac-apotti');
        Route::post('qac-apotti-submit', [\App\Http\Controllers\QualityControl\AuditQacController::class, 'qacApottiSubmit'])->name('qac-apotti-submit');
        Route::get('qac-committee/{any}', [\App\Http\Controllers\QualityControl\AuditQacController::class, 'qacCommittee'])->name('qac-committee');
        Route::post('get-qac-committee', [\App\Http\Controllers\QualityControl\AuditQacController::class, 'getQacCommitteeList'])->name('qac-committee-list');
        Route::post('create-qac-committee', [\App\Http\Controllers\QualityControl\AuditQacController::class, 'createQacCommittee'])->name('create-qac-committee');
        Route::post('store-qac-committee', [\App\Http\Controllers\QualityControl\AuditQacController::class, 'storeQacCommittee'])->name('store-qac-committee');
        Route::post('edit-qac-committee', [\App\Http\Controllers\QualityControl\AuditQacController::class, 'editQacCommittee'])->name('edit-qac-committee');
        Route::post('update-qac-committee', [\App\Http\Controllers\QualityControl\AuditQacController::class, 'updateQacCommittee'])->name('update-qac-committee');
        Route::post('delete-qac-committee', [\App\Http\Controllers\QualityControl\AuditQacController::class, 'deleteQacCommittee'])->name('delete-qac-committee');
        Route::post('select-qac-committee-form', [\App\Http\Controllers\QualityControl\AuditQacController::class, 'selectQacCommitteeForm'])->name('select-qac-committee-form');
        Route::post('get-qac-committee-wise-members', [\App\Http\Controllers\QualityControl\AuditQacController::class, 'getQacCommitteeWiseMembers'])->name('get-qac-committee-wise-members');
        Route::post('submit-air-wise-committee', [\App\Http\Controllers\QualityControl\AuditQacController::class, 'submitAirWiseCommittee'])->name('submit-air-wise-committee');
        Route::post('create-qac-report', [\App\Http\Controllers\QualityControl\AuditQacController::class, 'createQacReport'])->name('create-qac-report');
        Route::post('cqat-done-form', [\App\Http\Controllers\QualityControl\AuditQacController::class, 'cqatDoneForm'])->name('cqat-done-form');
        Route::post('cqat-done-submit', [\App\Http\Controllers\QualityControl\AuditQacController::class, 'cqatDoneSubmit'])->name('cqat-done-submit');
    });

    //Followup
    Route::group(['as' => 'audit.followup.', 'prefix' => 'audit-followup/'], function () {
        Route::get('/', [AuditFollowupController::class, 'index'])->name('index');

        Route::group(['as' => 'broadsheet.reply.', 'prefix' => 'broadsheet-reply/'], function () {
            Route::get('/', [BroadsheetReplyController::class, 'index'])->name('index');
            Route::post('/get-broad-sheet-list', [BroadsheetReplyController::class, 'getBroadSheetList'])->name('get-broad-sheet-list');
            Route::post('/load-broad-sheet-ministry-select', [BroadsheetReplyController::class, 'loadBroadSheeMinistrySelect'])->name('load-broad-sheet-ministry-select');
            Route::post('/load-broad-sheet-entity-select', [BroadsheetReplyController::class, 'loadBroadSheetEntitySelect'])->name('load-broad-sheet-entity-select');
            Route::post('/show_broad_sheet', [BroadsheetReplyController::class, 'showBroadSheet'])->name('show-braod-sheet');
            Route::post('/download-single-broadsheet', [BroadsheetReplyController::class, 'downloadSingleBroadsheet'])->name('download-single-broadsheet');
            Route::post('/edit-apottoi-item', [BroadsheetReplyController::class, 'editApottiItem'])->name('edit-apottoi-item');
            Route::post('/get-broad-sheet-approval-authority', [BroadsheetReplyController::class, 'getBroadSheetApprovalAuthority'])->name('get-broad-sheet-approval-authority');
            Route::post('/broad-sheet-movement', [BroadsheetReplyController::class, 'broadSheetMovement'])->name('broad-sheet-movement');
            Route::post('/laod-broad-sheet-item', [BroadsheetReplyController::class, 'getBroadSheetItem'])->name('laod-broad-sheet-item');
            Route::post('/get-apotti-decision-form', [BroadsheetReplyController::class, 'getApottiDecisionForm'])->name('get-apotti-decision-form');
            Route::post('/get-apotti-decision-submit', [BroadsheetReplyController::class, 'getApottiDecisionSubmit'])->name('get-apotti-decision-submit');
            Route::post('/approve-broad-sheet-apotti', [BroadsheetReplyController::class, 'approveBroadSheetApotti'])->name('approve-broad-sheet-apotti');
            Route::post('/store-broad-sheet-reply', [BroadsheetReplyController::class, 'storeBroadSheetReply'])->name('store-broad-sheet-reply');
            Route::post('/send-broad-sheet-reply-form', [BroadsheetReplyController::class, 'sendBroadSheetReplyFrom'])->name('send-broad-sheet-reply-form');
            Route::post('/send-broad-sheet-reply-to-rpu', [BroadsheetReplyController::class, 'sendBroadSheetReplyToRpu'])->name('send-broad-sheet-reply-to-rpu');
            Route::post('/show-sent-broad-sheet-reply', [BroadsheetReplyController::class, 'showSentBroadSheetReply'])->name('show-sent-broad-sheet-reply');
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

    Route::group(['as' => 'audit.final-report.', 'prefix' => 'final-audit-report/'], function () {
        Route::get('/', function () {
            return redirect()->route('audit.final-report.dashboard');
        });
        Route::get('dashboard', [\App\Http\Controllers\AuditReport\FinalAuditDashboardController::class, 'index'])->name('dashboard');
        Route::get('index', [\App\Http\Controllers\AuditReport\AuditFinalReportController::class, 'index'])->name('index');
        Route::post('get-audit-final-report', [\App\Http\Controllers\AuditReport\AuditFinalReportController::class, 'getAuditFinalReport'])->name('get-audit-final-report');
        Route::post('create-audit-final-report', [\App\Http\Controllers\AuditReport\AuditFinalReportController::class, 'editAuditFinalReport'])->name('edit-audit-final-report');
        Route::post('get-final-approval-authority', [\App\Http\Controllers\AuditReport\AuditFinalReportController::class, 'loadFinalApprovalAuthority'])->name('get-final-approval-authority');
        Route::post('submit-final-apporval', [\App\Http\Controllers\AuditReport\AuditFinalReportController::class, 'submitFinalApproval'])->name('submit-final-approval');
        Route::post('final-report-status-update', [\App\Http\Controllers\AuditReport\AuditFinalReportController::class, 'finalReportStatusUpdate'])->name('final-report-status-update');
    });

    Route::group(['as' => 'audit.air-report.', 'prefix' => 'audit-air-report/'], function () {
        Route::get('/', function () {
            return redirect()->route('audit.air-report.dashboard');
        });
        Route::get('dashboard', [\App\Http\Controllers\AuditReport\AuditAirDashboardController::class, 'index'])->name('dashboard');
        Route::get('authority-air-report', [\App\Http\Controllers\AuditReport\AuditAIRReportController::class, 'authorityAirReport'])->name('authority-air-report');
        Route::post('get-authority-air-report', [\App\Http\Controllers\AuditReport\AuditAIRReportController::class, 'getAuthorityAuditAirReport'])->name('get-authority-audit-air-report');
    });


    //Report
    Route::group(['as' => 'audit.report.', 'prefix' => 'audit-report/'], function () {
        Route::get('/', function () {
            return redirect()->route('audit.report.dashboard');
        });

        Route::get('dashboard', [\App\Http\Controllers\AuditReport\AuditReportDashboardController::class, 'index'])->name('dashboard');
        Route::get('draft-report', [\App\Http\Controllers\AuditReport\AuditDraftReportController::class, 'index'])->name('draft_report');
        Route::get('final-report', [\App\Http\Controllers\AuditReport\AuditFinalReportController::class, 'index'])->name('final_report');

        Route::group(['as' => 'air.', 'prefix' => 'air/'], function () {
            Route::get('/{any}', [AuditAIRReportController::class, 'index'])->name('index');
            Route::post('load-approved-plan-list', [AuditAIRReportController::class, 'loadApprovedAuditPlanList'])->name('load-approved-plan-list');

            Route::post('create', [AuditAIRReportController::class, 'create'])->name('create');
            Route::post('edit', [AuditAIRReportController::class, 'edit'])->name('edit');
            Route::post('show', [AuditAIRReportController::class, 'show'])->name('show');
            Route::post('store', [AuditAIRReportController::class, 'store'])->name('store');
            Route::post('download', [AuditAIRReportController::class, 'download'])->name('download');
            Route::post('preview', [AuditAIRReportController::class, 'preview'])->name('preview');

            Route::post('get-air-wise-content-key', [AuditAIRReportController::class, 'getAirWiseContentKey'])->name('get-air-wise-content-key');
            Route::post('get-audit-team', [AuditAIRReportController::class, 'getAuditTeam'])->name('get-audit-team');
            Route::post('get-audit-team-schedule', [AuditAIRReportController::class, 'getAuditTeamSchedule'])->name('get-audit-team-schedule');

            Route::post('get-plan-entity', [AuditAIRReportController::class, 'getPlanEntity'])->name('get-plan-entity');
            Route::post('get-audit-apotti-list', [AuditAIRReportController::class, 'getAuditApottiList'])->name('get-audit-apotti-list');
            Route::post('get-audit-apotti', [AuditAIRReportController::class, 'getAuditApotti'])->name('get-audit-apotti');
            Route::post('get-audit-apotti-wise-porisistos', [AuditAIRReportController::class, 'getAuditApottiWisePrisistos'])->name('get-audit-apotti-wise-porisistos');

            Route::post('get-approval-authority', [AuditAIRReportMovementController::class, 'loadApprovalAuthority'])->name('get-approval-authority');
            Route::post('get-cag-authority', [AuditAIRReportMovementController::class, 'loadCagAuthority'])->name('get-cag-authority');
            Route::post('get-cag-final-approval-form', [AuditAIRReportMovementController::class, 'getCagFinalApprovalForm'])->name('get-cag-final-approval-form');
            Route::post('store-air-movement', [AuditAIRReportMovementController::class, 'store'])->name('store-air-movement');

            //for qac01
            Route::group(['as' => 'qac.', 'prefix' => 'qac/'], function () {
                Route::post('edit-air-report', [AuditQACAIRReportController::class, 'editQACAirReport'])->name('edit-air-report');
                Route::post('update-air-report', [AuditQACAIRReportController::class, 'updateQACAirReport'])->name('update-air-report');
                Route::post('load-apotti-delete-view', [AuditQACAIRReportController::class, 'loadAirWiseApottiDeleteView'])->name('load-apotti-delete-view');
                Route::post('delete-air-report-wise-apotti', [AuditQACAIRReportController::class, 'softDeleteAirReportWiseApotti'])->name('delete-air-report-wise-apotti');
                Route::post('apotti-final-approval-status', [AuditQACAIRReportController::class, 'apottiFinalApprovalStatus'])->name('apotti-final-approval-status');
                Route::post('qac-report-date', [AuditQACAIRReportController::class, 'qacReportDate'])->name('qac-report-date');
                Route::post('get-air-wise-qac-apotti', [AuditQACAIRReportController::class, 'getAirWiseQACApotti'])->name('get-air-wise-qac-apotti');
                Route::post('get-air-and-apotti-type-wise-qac-apotti', [AuditQACAIRReportController::class, 'getAirAndApottiTypeWiseQACApotti'])->name('get-air-and-apotti-type-wise-qac-apotti');
                Route::post('get-air-wise-porisistos', [AuditQACAIRReportController::class, 'getAirWisePorisistos'])->name('get-air-wise-porisistos');
            });

            //qac1
            Route::group(['as' => 'qac1.', 'prefix' => 'qac1/'], function () {
                Route::post('download', [AuditQACOneReportController::class, 'downloadAuditReport'])->name('download');
                Route::post('preview', [AuditQACOneReportController::class, 'previewAuditReport'])->name('preview');
            });

            //qac2
            Route::group(['as' => 'qac2.', 'prefix' => 'qac2/'], function () {
                Route::post('download', [AuditQACTwoReportController::class, 'downloadAuditReport'])->name('download');
                Route::post('preview', [AuditQACTwoReportController::class, 'previewAuditReport'])->name('preview');
            });

            //final report
            Route::group(['as' => 'final-report.', 'prefix' => 'final-report/'], function () {
                Route::post('download', [AuditQACAIRReportController::class, 'downloadAuditReport'])->name('download');
                Route::post('preview', [AuditQACAIRReportController::class, 'previewAuditReport'])->name('preview');
            });

            Route::post('air-send-to-rpu', [\App\Http\Controllers\AuditReport\RpuAirReportController::class, 'airSendToRpu'])->name('air-send-to-rpu');
        });
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

    Route::group(['as' => 'pac.', 'prefix' => 'pac/'], function () {
        Route::get('/', [\App\Http\Controllers\PacController::class, 'index'])->name('index');
        Route::get('pac-meeting/{any}', [\App\Http\Controllers\PacController::class, 'pacMeeting'])->name('pac-meeting');
        Route::post('pac-meeting-list', [\App\Http\Controllers\PacController::class, 'pacMeetingList'])->name('pac-meeting-list');

        Route::group(['as' => 'meeting-worksheet-report.', 'prefix' => 'meeting-worksheet-report/'], function () {
            Route::post('create', [\App\Http\Controllers\PacController::class, 'pacMeetingWorksheetReportCreate'])->name('create');
            Route::post('get-audit-apotti', [\App\Http\Controllers\PacController::class, 'getAuditApotti'])->name('get-audit-apotti');
            Route::post('store', [\App\Http\Controllers\PacController::class, 'pacMeetingWorksheetReportStore'])->name('store');
            Route::post('preview', [\App\Http\Controllers\PacController::class, 'pacMeetingWorksheetReportPreview'])->name('preview');
            Route::post('download', [\App\Http\Controllers\PacController::class, 'pacMeetingWorksheetReportDownload'])->name('download');
        });

        Route::post('pac-meeting-create', [\App\Http\Controllers\PacController::class, 'pacMeetingCreate'])->name('pac-meeting-create');
        Route::post('pac-meeting-store', [\App\Http\Controllers\PacController::class, 'pacMeetingStore'])->name('pac-meeting-store');
        Route::post('pac-meeting-show', [\App\Http\Controllers\PacController::class, 'pacMeetingShow'])->name('pac-meeting-show');
        Route::post('sent-to-pac', [\App\Http\Controllers\PacController::class, 'sentToPac'])->name('sent-to-pac');
        Route::post('pac-meeting-minutes', [\App\Http\Controllers\PacController::class, 'pacMeetingMinutes'])->name('pac-meeting-minutes');
        Route::post('load-pac-member-list', [\App\Http\Controllers\PacController::class, 'loadPacMemberList'])->name('load-pac-member-list');
        Route::post('load-office-member-list', [\App\Http\Controllers\PacController::class, 'loadOfficeMemberList'])->name('load-office-member-list');
        Route::post('load-pac-final-report', [\App\Http\Controllers\PacController::class, 'loadPacFinalReport'])->name('load-pac-final-report');
        Route::post('load-air-wise-apotti', [\App\Http\Controllers\PacController::class, 'airWiseApotti'])->name('load-air-wise-apotti');
        Route::post('pac-apotti-decision-form', [\App\Http\Controllers\PacController::class, 'pacApottiDecisionForm'])->name('pac-apotti-decision-form');
        Route::post('pac-apotti-decision-store', [\App\Http\Controllers\PacController::class, 'pacApottiDecisionStore'])->name('pac-meeting-decision-store');
        Route::post('cag-and-directorate-decision', [\App\Http\Controllers\PacController::class, 'cagAndDirectorateDecision'])->name('cag-and-directorate-decision');
        Route::post('cag-and-directorate-decision-form', [\App\Http\Controllers\PacController::class, 'cagAndDirectorateDecisionForm'])->name('cag-and-directorate-decision-form');
        Route::post('get-apotti-item', [\App\Http\Controllers\PacController::class, 'getApottiItem'])->name('get-apotti-item');
    });



    Route::group(['as' => 'settings.', 'prefix' => 'settings/'], function () {
        Route::get('/', [\App\Http\Controllers\SettingController::class, 'index'])->name('index');
        Route::get('/dashboard', [\App\Http\Controllers\SettingController::class, 'showSettingsDashboard'])->name('dashboard');

        Route::post('/fiscal-years/lists', [\App\Http\Controllers\Setting\XFiscalYearController::class, 'getFiscalYearLists'])->name('fiscal-years.lists');
        Route::resource('/fiscal-years', \App\Http\Controllers\Setting\XFiscalYearController::class, ['except' => ['edit', 'create']]);

        Route::post('/audit-query/lists', [\App\Http\Controllers\Setting\XAuditQueryController::class, 'getAuditQueryLists'])->name('audit-query.lists');
        Route::post('/audit-query/edit', [\App\Http\Controllers\Setting\XAuditQueryController::class, 'auditQueryEdit'])->name('audit-query.edit');
        Route::resource('/audit-query', \App\Http\Controllers\Setting\XAuditQueryController::class, ['except' => ['edit', 'create']]);

        //risk assessment
        Route::post('/risk-assessment/lists', [\App\Http\Controllers\Setting\XRiskAssessmentController::class, 'getRiskAssessmentLists'])->name('risk-assessment.lists');
        Route::post('/risk-assessment/edit', [\App\Http\Controllers\Setting\XRiskAssessmentController::class, 'riskAssessmentEdit'])->name('risk-assessment.edit');
        Route::resource('/risk-assessment', \App\Http\Controllers\Setting\XRiskAssessmentController::class, ['except' => ['edit', 'create']]);

        Route::group(['as' => 'strategic-plan.', 'prefix' => 'strategic-plan/'], function () {
            Route::post('/duration/lists', [\App\Http\Controllers\Setting\XStrategicPlan\DurationController::class, 'getDurationLists'])->name('duration.lists');
            Route::resource('/duration', \App\Http\Controllers\Setting\XStrategicPlan\DurationController::class, ['except' => ['edit', 'create']]);

            Route::post('/outcome/lists', [\App\Http\Controllers\Setting\XStrategicPlan\OutcomeController::class, 'getOutcomeLists'])->name('outcome.lists');
            Route::resource('/outcome', \App\Http\Controllers\Setting\XStrategicPlan\OutcomeController::class, ['except' => ['edit', 'create']]);

            Route::post('/output/lists', [\App\Http\Controllers\Setting\XStrategicPlan\OutputController::class, 'getOutputLists'])->name('output.lists');
            Route::resource('/output', \App\Http\Controllers\Setting\XStrategicPlan\OutputController::class, ['except' => ['edit', 'create']]);
        });


        //for menu action
        Route::group(['as' => 'menu-actions.', 'prefix' => 'menu-actions/'], function () {
            Route::get('/{page}', [\App\Http\Controllers\Setting\PMenuActionController::class, 'index'])->name('index');

            Route::post('/create', [\App\Http\Controllers\Setting\PMenuActionController::class, 'create'])->name('create');
            Route::post('/store', [\App\Http\Controllers\Setting\PMenuActionController::class, 'store'])->name('store');
            Route::post('/edit', [\App\Http\Controllers\Setting\PMenuActionController::class, 'edit'])->name('edit');
            Route::post('/update', [\App\Http\Controllers\Setting\PMenuActionController::class, 'update'])->name('update');

            Route::post('/load-type-wise-menu-action', [\App\Http\Controllers\Setting\PMenuActionController::class, 'loadTypeWiseMenuActionData'])->name('load-type-wise-menu-action');
        });

        //for role
        Route::group(['as' => 'roles.', 'prefix' => 'roles/'], function () {
            Route::get('/', [\App\Http\Controllers\Setting\PRoleController::class, 'index'])->name('index');
            Route::post('/create', [\App\Http\Controllers\Setting\PRoleController::class, 'create'])->name('create');
            Route::post('/store', [\App\Http\Controllers\Setting\PRoleController::class, 'store'])->name('store');
            Route::post('/edit', [\App\Http\Controllers\Setting\PRoleController::class, 'edit'])->name('edit');
            Route::post('/update', [\App\Http\Controllers\Setting\PRoleController::class, 'update'])->name('update');
            Route::post('/lists', [\App\Http\Controllers\Setting\PRoleController::class, 'getRoles'])->name('lists');
            Route::post('/load-master-designation-role-map', [\App\Http\Controllers\Setting\PRoleController::class, 'loadMasterDesignationRoleMap'])->name('load-master-designation-role-map');
            Route::post('/assigned-master-designation-role-map', [\App\Http\Controllers\Setting\PRoleController::class, 'assignedMasterDesignationRoleMap'])->name('assigned-master-designation-role-map');
            Route::post('/store-master-designation-role-map', [\App\Http\Controllers\Setting\PRoleController::class, 'storeMasterDesignationRoleMap'])->name('store-master-designation-role-map');
        });

        //role permission
        Route::group(['as' => 'role-permissions.', 'prefix' => 'role-permissions/'], function () {
            Route::get('/', [\App\Http\Controllers\Setting\PermissionController::class, 'index'])->name('index');
            Route::get('/employee-permission', [\App\Http\Controllers\Setting\PermissionController::class, 'employeePermission'])->name('employee-permission');
            Route::post('/get-menu-module-lists', [\App\Http\Controllers\Setting\PermissionController::class, 'loadMenuModuleLists'])->name('get-menu-module-lists');
            Route::post('/get-role-wise-menu-module-lists', [\App\Http\Controllers\Setting\PermissionController::class, 'loadMenuModuleListsByRole'])->name('get-role-wise-menu-module-lists');
            Route::post('/get-roles-list', [\App\Http\Controllers\Setting\PermissionController::class, 'loadAllRoles'])->name('get-roles-list');
            Route::post('/assign-menus-to-role', [\App\Http\Controllers\Setting\PermissionController::class, 'assignMenuModuleToRole'])->name('assign-menus-to-role');
            Route::post('/assign-menus-to-employee', [\App\Http\Controllers\Setting\PermissionController::class, 'assignMenuModuleToEmployee'])->name('assign-menus-to-employee');
        });

        //audit assessment
        Route::group(['as' => 'audit-assessment.', 'prefix' => 'audit-assessment/'], function () {
            Route::group(['as' => 'criteria.', 'prefix' => 'criteria/'], function () {
                Route::get('/', [CriteriaController::class, 'index'])->name('index');
                Route::post('/list', [CriteriaController::class, 'list'])->name('list');
                Route::post('/create', [CriteriaController::class, 'create'])->name('create');
                Route::post('/store', [CriteriaController::class, 'store'])->name('store');
                Route::post('/edit', [CriteriaController::class, 'edit'])->name('edit');
                Route::post('/update', [CriteriaController::class, 'update'])->name('update');
            });
        });

        Route::group(['as' => 'movement.', 'prefix' => 'movement/'], function () {
            Route::post('store', [\App\Http\Controllers\Setting\XMovementController::class, 'store'])->name('store');
        });
    });



    //Miscellaneous
    Route::get('locale/{locale}', [App\Http\Controllers\ChangeController::class, 'changeLocale'])->name('change.locale');
    Route::get('change/office/{id}/{office_id}/{office_unit_id}/{designation_id}', [App\Http\Controllers\ChangeController::class, 'changeDesignation'])->name('change.office');

    //Generic Data Collection
    Route::group(['as' => 'generic.'], function () {
        Route::post('get-strategic-outcome-remarks', [\App\Http\Controllers\GenericIfoCollectController::class, 'getStrategicOutcomeRemarks'])->name('outcome.remarks');
        Route::post('get-strategic-output-by-outcome', [\App\Http\Controllers\GenericIfoCollectController::class, 'getStrategicOutputByOutcome'])->name('output.by.outcome');
        Route::post('designation-master-data', [\App\Http\Controllers\GenericIfoCollectController::class, 'getCagDoptorMasterDesignations'])->name('designation-master-data');
    });

    //Generic RPU Data Collection
    Route::group(['as' => 'rpu.'], function () {
        Route::post('get-ministries', [\App\Http\Controllers\GenericRPUController::class, 'getMinistries'])->name('ministries.all');
        Route::post('get-office-layer', [\App\Http\Controllers\GenericRPUController::class, 'getMinistryWiseOfficeLayer'])->name('office-layer.all');
        Route::post('get-rp-offices', [\App\Http\Controllers\GenericRPUController::class, 'getMinistryLayerWiseOffice'])->name('rp-offices.all');
        Route::post('get-ministry-wise-rp-entities', [\App\Http\Controllers\GenericRPUController::class, 'getMinistryWiseEntities'])->name('rp-offices.all');
    });

    Route::group(['as' => 'rpu-apotti.', 'prefix' => 'rpu-apotti/'], function () {
        Route::get('index', [\App\Http\Controllers\AuditFollowup\RpuApottiController::class, 'index']);
        Route::post('get-rpu-apotti-item', [\App\Http\Controllers\AuditFollowup\RpuApottiController::class, 'getRpuApottiItem'])->name('get-rpu-apotti-item');
        Route::post('get-ministry-wise-entity-select', [\App\Http\Controllers\AuditFollowup\RpuApottiController::class, 'getMinistryWiseApottiEntitySelect'])->name('get-ministry-wise-entity-select');
        Route::post('get-rpu-apotti-response-form', [\App\Http\Controllers\AuditFollowup\RpuApottiController::class, 'getRpuApottiResponseForm'])->name('get-rpu-apotti-response-form');
        Route::post('rpu-response-submit', [\App\Http\Controllers\AuditFollowup\RpuApottiController::class, 'rpuResponseSubmit'])->name('rpu-response-submit');
        Route::post('rpu-broad-sheet-form', [\App\Http\Controllers\AuditFollowup\RpuApottiController::class, 'rpuBroadSheetForm'])->name('rpu-broad-sheet-form');
        Route::post('rpu-broad-sheet-submit', [\App\Http\Controllers\AuditFollowup\RpuApottiController::class, 'rpuBroadSheetSubmit'])->name('rpu-broad-sheet-submit');
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


Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    Artisan::call('route:clear');
    return "Cache is cleared";
});

Route::get('/clear-log', function () {
    exec('rm -f ' . storage_path('logs/.log'));
    exec('rm -f ' . base_path('.log'));
    return "Log file deleted";
});
