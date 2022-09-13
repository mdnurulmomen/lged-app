<?php

use App\Http\Controllers\ApplicationAdministrationController;
use App\Http\Controllers\AuditeeEmployeeDatabaseController;
use App\Http\Controllers\AuditExecution\AuditExecutionApottiController;
use App\Http\Controllers\AuditExecution\AuditExecutionApottiMemoController;
use App\Http\Controllers\AuditExecution\AuditExecutionApottiSearchController;
use App\Http\Controllers\AuditExecution\AuditExecutionArchiveApottiController;
use App\Http\Controllers\AuditExecution\AuditExecutionArchiveApottiReportController;
use App\Http\Controllers\AuditExecution\AuditExecutionAreaController;
use App\Http\Controllers\AuditExecution\AuditExecutionController;
use App\Http\Controllers\AuditExecution\AuditExecutionDiscussionController;
use App\Http\Controllers\AuditExecution\AuditExecutionMemoController;
use App\Http\Controllers\AuditExecution\AuditExecutionQueryController;
use App\Http\Controllers\AuditExecution\AuditExecutionReviewController;
use App\Http\Controllers\AuditExecution\AuditExecutionScheduleController;
use App\Http\Controllers\AuditFollowup\AuditFollowupController;
use App\Http\Controllers\AuditFollowup\AuditFollowupDashboardController;
use App\Http\Controllers\AuditFollowup\AuditFollowupDueReportController;
use App\Http\Controllers\AuditFollowup\AuditFollowupObservationController;
use App\Http\Controllers\AuditFollowup\AuditFollowupRecordController;
use App\Http\Controllers\AuditFollowup\AuditFollowupReminderController;
use App\Http\Controllers\AuditFollowup\AuditFollowupSettlementReviewController;
use App\Http\Controllers\AuditFollowup\BroadsheetReplyController;
use App\Http\Controllers\AuditFollowup\RpuApottiController;
use App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualCalendarController;
use App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanController;
use App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanRevisedController;
use App\Http\Controllers\AuditPlan\AuditAnnualPlan\AuditAssessmentController;
use App\Http\Controllers\AuditPlan\AuditAnnualPlan\AuditAssessmentScoreController;
use App\Http\Controllers\AuditPlan\AuditAnnualPlan\PreliminarySurveyReportController;
use App\Http\Controllers\AuditPlan\AuditAnnualPlanController;
use App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditActivityController;
use App\Http\Controllers\AuditPlan\AuditOperationalPlan\AuditCalendarController;
use App\Http\Controllers\AuditPlan\AuditOperationalPlan\OperationalPlanController;
use App\Http\Controllers\AuditPlan\AuditOperationalPlanController;
use App\Http\Controllers\AuditPlan\AuditPlanController;
use App\Http\Controllers\AuditPlan\AuditPlanDashboardController;
use App\Http\Controllers\AuditPlan\AuditStrategicPlan\DraftPlanController;
use App\Http\Controllers\AuditPlan\AuditStrategicPlan\FinalPlanController;
use App\Http\Controllers\AuditPlan\AuditStrategicPlan\HTMLViewController;
use App\Http\Controllers\AuditPlan\AuditStrategicPlan\IndicatorOutcomeController;
use App\Http\Controllers\AuditPlan\AuditStrategicPlan\IndicatorOutputController;
use App\Http\Controllers\AuditPlan\AuditStrategicPlan\MeetingController;
use App\Http\Controllers\AuditPlan\AuditStrategicPlan\MilestoneController;
use App\Http\Controllers\AuditPlan\AuditStrategicPlan\RiskController;
use App\Http\Controllers\AuditPlan\AuditStrategicPlanController;
use App\Http\Controllers\AuditPlan\Calendar\TeamCalendarController;
use App\Http\Controllers\AuditPlan\Plan\DcOfficeOrderController;
use App\Http\Controllers\AuditPlan\Plan\OfficeOrderController;
use App\Http\Controllers\AuditPlan\Plan\PlanEditorController;
use App\Http\Controllers\AuditPlan\Plan\RevisedPlanController;
use App\Http\Controllers\AuditPlan\Plan\RiskAssessmentController;
use App\Http\Controllers\AuditPrepare\AuditPrepareActivityController;
use App\Http\Controllers\AuditPrepare\AuditPrepareDashboardController;
use App\Http\Controllers\AuditPrepare\AuditPrepareDataAnalysisController;
use App\Http\Controllers\AuditPrepare\AuditPrepareSamplingController;
use App\Http\Controllers\AuditReport\AuditAirDashboardController;
use App\Http\Controllers\AuditReport\AuditAIRReportController;
use App\Http\Controllers\AuditReport\AuditAIRReportMovementController;
use App\Http\Controllers\AuditReport\AuditDraftReportController;
use App\Http\Controllers\AuditReport\AuditFinalReportController;
use App\Http\Controllers\AuditReport\AuditQACAIRReportController;
use App\Http\Controllers\AuditReport\AuditQACOneReportController;
use App\Http\Controllers\AuditReport\AuditQACTwoReportController;
use App\Http\Controllers\AuditReport\AuditReportDashboardController;
use App\Http\Controllers\AuditReport\FinalAuditDashboardController;
use App\Http\Controllers\AuditReport\RpuAirReportController;
use App\Http\Controllers\AuditReport\ObservationsReportController;
use App\Http\Controllers\CommunicationManagementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentManagementController;
use App\Http\Controllers\GenericIfoCollectController;
use App\Http\Controllers\GenericRPUController;
use App\Http\Controllers\GrievanceManagementController;
use App\Http\Controllers\KnowledgeManagementController;
use App\Http\Controllers\LegacyDataManagementController;
use App\Http\Controllers\MISAndDashboardController;
use App\Http\Controllers\PacController;
use App\Http\Controllers\QualityControl\AuditQacController;
use App\Http\Controllers\QualityControl\AuditQacDashboardController;
use App\Http\Controllers\QualityControl\QACController;
use App\Http\Controllers\Setting\PermissionController;
use App\Http\Controllers\Setting\PMenuActionController;
use App\Http\Controllers\Setting\PRoleController;
use App\Http\Controllers\Setting\XAuditAssessment\CriteriaController;
use App\Http\Controllers\Setting\XAuditQueryController;
use App\Http\Controllers\Setting\XFiscalYearController;
use App\Http\Controllers\Setting\XMovementController;
use App\Http\Controllers\Setting\XRiskAssessmentController;
use App\Http\Controllers\Setting\XStrategicPlan\DurationController;
use App\Http\Controllers\Setting\XStrategicPlan\OutcomeController;
use App\Http\Controllers\Setting\XStrategicPlan\OutputController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AuditPlan\AuditAnnualPlan\AnnualPlanPSRController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::group(['middleware' => ['jisf.auth', 'auth.bee']], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard/referer/{type?}/{type_bn?}', [DashboardController::class, 'index_referer'])->name('dashboard.index_referer');
    Route::get('/dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::post('/profile', [DashboardController::class, 'getUserProfile'])->name('user_profile');

    // Plan Route Start
    Route::group(['as' => 'audit.plan.', 'prefix' => 'audit-plan/'], function () {
        Route::get('/', function () {
            return redirect()->route('audit.plan.dashboard');
        });
        Route::get('/dashboard', [AuditPlanDashboardController::class, 'index'])->name('dashboard');

        //strategic plan
        Route::group(['as' => 'strategy.', 'prefix' => 'strategy/'], function () {

            Route::get('/', [AuditStrategicPlanController::class, 'index'])->name('index');

            Route::get('/dashboard', [AuditStrategicPlanController::class, 'showAuditStrategicPlanDashboard'])->name('dashboard');

            Route::get('draft-plans', [DraftPlanController::class, 'index'])->name('draft_plan.all');
            Route::post('draft-plan', [DraftPlanController::class, 'show'])->name('draft_plan.single');
            Route::get('draft-plan/create', function () {
                return view('modules.audit_plan.strategic.draft_plan.strategic_plan_draft_create');
            })->name('draft_plan_create');

            //sp file upload
            Route::get('sp-file-list', [FinalPlanController::class, 'index'])->name('sp_file_list');
            Route::get('file-upload', [FinalPlanController::class, 'create'])->name('sp_file_upload');
            Route::post('file-store', [FinalPlanController::class, 'store'])->name('sp_file_store');
            Route::get('final-plan-edit/{id}', [FinalPlanController::class, 'edit'])->name('sp_file_edit');
            Route::post('file-update', [FinalPlanController::class, 'update'])->name('sp_file_update');

            Route::post('is-document-exist', [FinalPlanController::class, 'isDocumentExist'])->name('is_document_exist');


            //html view
            Route::get('setting-list', [HTMLViewController::class, 'index'])->name('setting_list');

            Route::get('html-view-content', [HTMLViewController::class, 'contentView'])->name('html_view_content');
            Route::get('html-view-content-create', [HTMLViewController::class, 'createContent'])->name('html_view_content_create');
            Route::get('html-view-content-key-create', [HTMLViewController::class, 'createKey'])->name('html_view_content_key_create');
            Route::post('html-view-content-key-store', [HTMLViewController::class, 'storeKey'])->name('html_view_content_key_store');
            Route::get('html-view-content-title-duration-wise', [HTMLViewController::class, 'loadParentDurationWiseSelect'])->name('html_view_content_title_duration_wise');

            Route::get('meetings', [MeetingController::class, 'index'])->name('meeting.all');
            Route::post('meeting', [MeetingController::class, 'show'])->name('meeting.single');

            Route::get('final-plans', [FinalPlanController::class, 'index'])->name('final-plan.all');
            Route::post('final-plan', [FinalPlanController::class, 'show'])->name('final-plan.single');

            Route::get('milestones', [MilestoneController::class, 'index'])->name('milestone.all');
            Route::post('milestone', [MilestoneController::class, 'show'])->name('milestone.single');

            Route::get('risks', [RiskController::class, 'index'])->name('risk.all');
            Route::post('risk', [RiskController::class, 'show'])->name('risk.single');

            Route::get('indicator/outcome', [IndicatorOutcomeController::class, 'index'])->name('indicator.outcome');
            Route::get('indicator/outcome/create', [IndicatorOutcomeController::class, 'create'])->name('indicator.outcome.create');
            Route::post('indicator/outcome/create', [IndicatorOutcomeController::class, 'store'])->name('indicator.outcome.store');
            Route::get('indicator/outcome/edit/{id}', [IndicatorOutcomeController::class, 'edit'])->name('indicator.outcome.edit');
            Route::post('indicator/outcome/update', [IndicatorOutcomeController::class, 'update'])->name('indicator.outcome.update');
            Route::get('indicator/outcome/show/{id}', [IndicatorOutcomeController::class, 'show'])->name('indicator.outcome.show');

            Route::get('indicator/outcome/all', [IndicatorOutcomeController::class, 'outcomes'])->name('indicator.outcomes');

            Route::post('indicator/genYear', [IndicatorOutcomeController::class, 'genYear'])->name('indicator.gen.year');


            Route::get('indicator/output', [IndicatorOutputController::class, 'index'])->name('indicator.output');
            Route::post('indicator/output/create', [IndicatorOutputController::class, 'store'])->name('indicator.output.store');
            Route::get('indicator/output/create', [IndicatorOutputController::class, 'create'])->name('indicator.output.create');
            Route::get('indicator/output/edit/{id}', [IndicatorOutputController::class, 'edit'])->name('indicator.output.edit');
            Route::post('indicator/output/update', [IndicatorOutputController::class, 'update'])->name('indicator.output.update');
            Route::get('indicator/output/show/{id}', [IndicatorOutputController::class, 'show'])->name('indicator.output.show');

            Route::get('indicator/output/all', [IndicatorOutputController::class, 'outputs'])->name('indicator.outputs');


            Route::get('/final-plan-add', function () {
                return view('modules.audit_plan.strategic.meeting.strategic_plan_meeting_add');
            })->name('plan');
        });

        //operational plan
        Route::group(['as' => 'operational.', 'prefix' => 'operational/'], function () {
            Route::get('/', [AuditOperationalPlanController::class, 'index'])->name('index');

            Route::get('/dashboard', [AuditOperationalPlanController::class, 'showOperationalPlanDashboard'])->name('dashboard');

            //activity
            Route::get('activities', [AuditActivityController::class, 'index'])->name('activity.all');

            Route::get('create-activity', [AuditActivityController::class, 'create'])->name('activity.create');
            Route::post('store-activity', [AuditActivityController::class, 'store'])->name('activity.store');
            Route::post('store-activity-milestone', [AuditActivityController::class, 'storeMilestone'])->name('activity.milestone.store');
            Route::post('load-outputs-by-outcome', [AuditActivityController::class, 'loadOutputsByOutcome'])->name('activity.load.outputs.by.outcome');
            Route::post('load-create-output-activity-tree', [AuditActivityController::class, 'loadCreateOutputActivityTree'])->name('activity.create.output.tree.load');
            Route::post('load-edit-activity-tree', [AuditActivityController::class, 'loadEditActivityTree'])->name('activity.edit.tree.load');
            Route::post('activity-select', [AuditActivityController::class, 'activitySelect'])->name('activity.select');
            Route::post('activity-wise-audit-plan', [AuditActivityController::class, 'activityWiseAuditPlan'])->name('activity.audit-plan');

            Route::post('activity', [AuditActivityController::class, 'show'])->name('activity.single');

            Route::post('edit-activity', [AuditActivityController::class, 'edit'])->name('activity.edit');

            Route::post('load-edit-output-activity', [AuditActivityController::class, 'loadEditOutputActivity'])->name('activity.edit.output.load');
            Route::post('load-edit-output-activity-milestone', [AuditActivityController::class, 'loadEditOutputActivityMilestone'])->name('activity.milestone.edit.output.load');
            Route::post('update-activity', [AuditActivityController::class, 'update'])->name('activity.update');
            Route::post('update-activity-milestone', [AuditActivityController::class, 'milestoneUpdate'])->name('activity.milestone.update');

            //calendar
            Route::get('calendars', [AuditCalendarController::class, 'index'])->name('calendars.index');

            Route::post('create-calendar', [AuditCalendarController::class, 'create'])->name('calendars.create');
            Route::post('store-calendar', [AuditCalendarController::class, 'store'])->name('calendars.store');

            Route::post('view-calendar', [AuditCalendarController::class, 'show'])->name('calendars.show');
            Route::post('edit-calendar', [AuditCalendarController::class, 'edit'])->name('calendars.edit');

            Route::post('calendar/show-forward-modal', [AuditCalendarController::class, 'showForwardAuditCalendarModal'])->name('calendar.forward_modal');
            Route::post('calendar/forward', [AuditCalendarController::class, 'forwardAuditCalendar'])->name('calendar.forward');

            Route::post('calendar/movement/history', [AuditCalendarController::class, 'movementHistory'])->name('calendar.movement.history');
            Route::post('calendar/change-status', [AuditCalendarController::class, 'changeStatus'])->name('calendar.change-status');

            Route::post('calendar/show-pending-event-to-publish', [AuditCalendarController::class, 'showPublishAuditCalendar'])->name('calendar.pending-event-to-publish');
            Route::post('calendar/publish', [AuditCalendarController::class, 'publishAuditCalendar'])->name('calendar.publish');

            Route::post('load-schedule-milestones', [AuditCalendarController::class, 'showScheduleMilestoneByFiscalYear'])->name('calendar.milestone.load');
            Route::post('update-schedule-milestones-date', [AuditCalendarController::class, 'updateMilestoneTargetDate'])->name('calendar.milestone.date.update');
            Route::post('create-responsible', [AuditCalendarController::class, 'createActivityResponsible'])->name('calendar.responsible.create');
            Route::post('activity-comment/update', [AuditCalendarController::class, 'updateActivityComment'])->name('calendar.comment.update');
            Route::post('load-audit-calendar-view', [AuditCalendarController::class, 'showAuditCalendarView'])->name('calendar.view.load');

            Route::post('load-audit-calendar-print-view', [AuditCalendarController::class, 'showAuditCalendarPrintView'])->name('calendar.print.view.load');
            Route::get('load-audit-calendar-pdf-view', [AuditCalendarController::class, 'showAuditCalendarPdfView'])->name('calendar.pdf.view.load');

            //plan approve
            Route::get('approve-annual-plan', [OperationalPlanController::class, 'approveAnnualPlan'])->name('plan.approve-annual-plan');
            Route::post('load-op-yearly-event-list', [OperationalPlanController::class, 'loadOpYearlyEventList'])->name('plan.load-op-yearly-event-list');
            Route::post('load-op-yearly-event-approval-form', [OperationalPlanController::class, 'loadOpYearlyEventApprovalForm'])->name('plan.load-op-yearly-event-approval-form');
            Route::post('load-directorate-wise-annual-plan', [OperationalPlanController::class, 'loadDirectorateWiseAnnualPlan'])->name('plan.load-directorate-wise-annual-plan');
            Route::post('send-annual-plan-receiver-to-sender', [OperationalPlanController::class, 'sendAnnualPlanReceiverToSender'])->name('plan.send-annual-plan-receiver-to-sender');

            //plans
            Route::get('plans', [OperationalPlanController::class, 'index'])->name('plan.all');

            Route::post('load-operational-plan-lists', [OperationalPlanController::class, 'showOperationalPlanLists'])->name('plan.list.all');
            Route::post('load-assigned-staff-details', [OperationalPlanController::class, 'showOperationalPlanStaffAndDetailsModal'])->name('plan.assigned-details.modal');

            Route::post('load-operational-plan-staff-assigned', [OperationalPlanController::class, 'showOperationalPlanStaffs'])->name('plan.assigned.staff');
            Route::post('load-activity-wise-team', [OperationalPlanController::class, 'showActivityWiseTeam'])->name('plan.load-activity-wise-team');

            //op final file upload
            Route::get('file-list', [FinalPlanController::class, 'index'])->name('file_list');
            Route::get('file-create', [FinalPlanController::class, 'create'])->name('file_create');
            Route::post('file-store', [FinalPlanController::class, 'store'])->name('file_store');
            Route::get('file-edit/{id}', [FinalPlanController::class, 'edit'])->name('file_edit');
            Route::post('file-update', [FinalPlanController::class, 'update'])->name('file_update');

            Route::post('is-document-exist', [FinalPlanController::class, 'isDocumentExist'])->name('is_document_exist');
        });

        //annual plan
        Route::group(['as' => 'annual.', 'prefix' => 'annual/'], function () {
            Route::get('/', [AuditAnnualPlanController::class, 'index'])->name('index');
            Route::get('/dashboard', [AuditAnnualPlanController::class, 'showAnnualPlanDashboard'])->name('dashboard');

            Route::get('/plans', [AnnualPlanController::class, 'index'])->name('plan.all');

            Route::post('/load-annual-plan-lists', [AnnualPlanRevisedController::class, 'showAnnualPlanLists'])->name('plan.list.all');
            Route::get('/annual-plan-calender', [AnnualPlanRevisedController::class, 'annualPlanCalender'])->name('plan.annual-plan-calender');
            Route::post('/update-request', [AnnualPlanRevisedController::class, 'annualPlanUpdateRequest'])->name('plan.update-request');

            Route::post('/load-annual-entity-selection', [AnnualPlanController::class, 'showEntitySelection'])->name('plan.list.show.entity-selection');

            //            Route::post('/load-selected-auditees', [AnnualPlanController::class, 'showSelectedAuditeeEntities'])->name('plan.list.show.selected-entity');
            //            Route::post('/store-selected-auditees', [AnnualPlanController::class, 'storeSelectedAuditeeEntities'])->name('plan.list.store.selected-entity');
            //            Route::post('/load-submission-hr-modal', [AnnualPlanController::class, 'showAnnualSubmissionHRModal'])->name('plan.list.show.hr-modal');
            //            Route::post('/store-submission-hr-modal', [AnnualPlanController::class, 'storeAnnualSubmissionHR'])->name('plan.list.store.hr-modal');
            //            Route::post('/load-rp-auditee-offices', [AnnualPlanController::class, 'showRPAuditeeOffices'])->name('plan.list.show.rp-auditee-offices');
            //            Route::post('/submit-audit-plan-to-ocag', [AnnualPlanController::class, 'submitPlanToOCAG'])->name('plan.list.submit.plan-to-ocag');

            Route::get('/annual-plan-revised', [AnnualPlanRevisedController::class, 'index'])->name('plan.revised.all');
            Route::post('/annual-plan-book', [AnnualPlanRevisedController::class, 'exportAnnualPlanBook'])->name('plan.revised.book');
            Route::post('/load-annual-plan-revised-lists', [AnnualPlanRevisedController::class, 'showAnnualPlanLists'])->name('plan.revised.list.all');

            Route::post('/load-annual-plan-revised-approval-authority', [AnnualPlanRevisedController::class, 'loadAnnualPlanApprovalAuthority'])->name('plan.revised.load-annual-plan-approval-authority');
            Route::post('/send-annual-plan-sender-to-receiver', [AnnualPlanRevisedController::class, 'sendAnnualPlanSenderToReceiver'])->name('plan.revised.send-annual-plan-sender-to-receiver');
            Route::post('/movement-history-annual-plan-revised', [AnnualPlanRevisedController::class, 'movementHistoryAnnualPlan'])->name('plan.revised.movement-history-annual-plan');

            Route::post('/load-staff-assign-list', [AnnualPlanRevisedController::class, 'showStaffAssignList'])->name('plan.revised.list.staff');
            Route::post('/fiscal-year-wise-activity-select', [AnnualPlanRevisedController::class, 'fiscalYearWiseActivitySelect'])->name('plan.revised.fiscal-year-wise-activity-select');
            Route::post('/load-annual-entity-show', [AnnualPlanRevisedController::class, 'showAnnualPlanEntities'])->name('plan.revised.annual-entities-show');
            Route::post('/create-plan-info', [AnnualPlanRevisedController::class, 'addAnnualPlanInfo'])->name('plan.list.show.revised.create_plan_info');
            Route::post('/activity-wise-milestone-select', [AnnualPlanRevisedController::class, 'activityWiseMilestoneSelect'])->name('plan.list.show.revised.activity-wise-milestone-select');
            Route::post('/store-annual-plan', [AnnualPlanRevisedController::class, 'storeAnnualPlanInfo'])->name('plan.revised.store');
            Route::post('/edit-plan-info', [AnnualPlanRevisedController::class, 'editAnnualPlanInfo'])->name('plan.revised.edit_plan_info');
            Route::post('/show-plan-info', [AnnualPlanRevisedController::class, 'showAnnualPlanInfo'])->name('plan.revised.show_plan_info');
            Route::post('/delete-plan-info', [AnnualPlanRevisedController::class, 'deleteAnnualPlan'])->name('plan.revised.delete_annual_plan');
            Route::post('/load-rp-auditee-offices', [AnnualPlanRevisedController::class, 'showRPAuditeeOffices'])->name('plan.list.show.rp-auditee-offices');
            Route::post('/load-rp-auditee-offices-ministry-wise', [AnnualPlanRevisedController::class, 'showRPAuditeeOfficesMinistryWise'])->name('plan.list.show.rp-auditee-offices-ministry-wise');
            Route::post('/load-rp-auditee-child-offices', [AnnualPlanRevisedController::class, 'showRPChildAuditeeOffices'])->name('plan.list.show.rp-auditee-child-offices');
            Route::post('/load-rp-auditee-child-offices-list', [AnnualPlanRevisedController::class, 'showRPChildAuditeeOfficesList'])->name('plan.list.show.rp-auditee-child-offices-list');
            Route::post('/submit-audit-plan-to-ocag', [AnnualPlanRevisedController::class, 'submitPlanToOCAG'])->name('plan.list.submit.revised.plan-to-ocag');

            Route::get('/calendar', [AnnualCalendarController::class, 'index'])->name('calendar');
            Route::post('/load-assessment-entity', [AnnualPlanRevisedController::class, 'loadAssessmentEntity'])->name('load-assessment-entity');

            Route::post('/load-annual-plan-edit-milestone', [AnnualPlanRevisedController::class, 'loadEditAnnualPlanMilestone'])->name('plan.list.load-edit-milestone');
            Route::post('/annual-plan-edit-milestone', [AnnualPlanRevisedController::class, 'editAnnualPlanMilestone'])->name('plan.list.edit-milestone');

            // PSR
            Route::group(['as' => 'psr.', 'prefix' => 'psr/'], function () {
                Route::get('/', [AnnualPlanPSRController::class, 'index']);
                Route::post('/create', [AnnualPlanPSRController::class, 'create'])->name('create');
                Route::post('/load-ministry-wise-entity', [AnnualPlanPSRController::class, 'loadMinistryWiseEntity'])->name('load-ministry-wise-entity');
                Route::post('/load-criteria-list', [AuditAssessmentScoreController::class, 'loadCategoryWiseCriteriaList'])->name('load-criteria-list');
                Route::post('/store', [AnnualPlanPSRController::class, 'store'])->name('store');
                Route::post('/psrview', [AnnualPlanPSRController::class, 'preview'])->name('psrview');
                Route::post('/PSRBook', [AnnualPlanPSRController::class, 'PSRBook'])->name('PSRBook');
                Route::post('/update', [AnnualPlanPSRController::class, 'update'])->name('update');
            });

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

            // Route::group(['as' => 'psr.', 'prefix' => 'psr/'], function () {
            //     Route::get('/', [PreliminarySurveyReportController::class, 'index']);
            //     Route::post('load-psr', [PreliminarySurveyReportController::class, 'loadPsr'])->name('load-psr');
            //     Route::post('create-psr', [PreliminarySurveyReportController::class, 'create'])->name('create-psr');
            //     Route::post('store-psr', [PreliminarySurveyReportController::class, 'store'])->name('store-psr');
            // });
        });

        //audit Plan
        Route::group(['as' => 'audit.', 'prefix' => 'audit/'], function () {
            Route::get('/', [AuditPlanController::class, 'index'])->name('index');
            Route::get('/dashboard', [AuditPlanController::class, 'showAuditPlanDashboard'])->name('dashboard');

            //            Route::get('/plans', [PlanController::class, 'index'])->name('plan.all');
            //            Route::post('/load-auditable-plan-lists', [PlanController::class, 'showAuditablePlanLists'])->name('plan.load-all-lists');
            //            Route::post('/make-entity-audit-plan', [PlanController::class, 'create'])->name('plan.make-entity-audit-plan');
            //            Route::post('/save-draft-entity-audit-plan', [PlanController::class, 'saveDraftEntityAuditPlan'])->name('plan.save-draft-entity-audit-plan');
            //            Route::post('/generate-audit-plan-pdf', [PlanController::class, 'generatePlanPDF'])->name('plan.generate-audit-plan-pdf');

            Route::get('/plans', [RevisedPlanController::class, 'index'])->name('plan.all');
            Route::post('/load-auditable-plan-lists', [RevisedPlanController::class, 'showAuditablePlanLists'])->name('revised.plan.load-all-lists');
            Route::post('/create-entity-audit-plan', [RevisedPlanController::class, 'createAuditPlan'])->name('revised.plan.create-entity-audit-plan');
            Route::post('/entity-audit-plan/audit-team/previously-assigned-designations', [RevisedPlanController::class, 'getPreviouslyAssignedDesignations'])->name('revised.plan.previously-assigned-designations');
            Route::post('/update-entity-audit-plan', [RevisedPlanController::class, 'updateAuditPlan'])->name('revised.plan.update-entity-audit-plan');
            Route::post('/save-draft-entity-audit-plan', [RevisedPlanController::class, 'saveDraftEntityAuditPlan'])->name('revised.plan.save-draft-entity-audit-plan');
            Route::post('/book-audit-plan', [RevisedPlanController::class, 'auditPlanBook'])->name('revised.plan.book-audit-plan');

            Route::post('/get-team-info', [RevisedPlanController::class, 'getTeamInfo'])->name('revised.plan.get-team-info');
            Route::post('/load-officer-lists', [PlanEditorController::class, 'loadOfficeEmployeeList'])->name('revised.plan.load-officer-lists');
            Route::post('/store-audit-team', [RevisedPlanController::class, 'storeAuditTeam'])->name('revised.plan.store-audit-team');
            Route::post('/update-audit-team', [RevisedPlanController::class, 'updateAuditTeam'])->name('revised.plan.update-audit-team');
            Route::post('/store-audit-team-schedule', [RevisedPlanController::class, 'storeAuditTeamSchedule'])->name('revised.plan.store-audit-team-schedule');
            Route::post('/update-audit-team-schedule', [RevisedPlanController::class, 'updateAuditTeamSchedule'])->name('revised.plan.update-audit-team-schedule');
            Route::post('/get-audit-plan-wise-team-members', [RevisedPlanController::class, 'getPlanWiseTeamMembers'])->name('revised.plan.get-audit-plan-wise-team-members');
            Route::post('/get-audit-plan-wise-team-schedules', [RevisedPlanController::class, 'getPlanWiseTeamSchedules'])->name('revised.plan.get-audit-plan-wise-team-schedules');
            Route::post('/team-log-discard', [RevisedPlanController::class, 'teamLogDiscard'])->name('revised.plan.team-log-discard');

            Route::post('editor/load-audit-team-modal', [PlanEditorController::class, 'loadAuditTeamModal'])->name('editor.load-audit-team-modal');
            Route::post('editor/load-audit-team-schedule', [PlanEditorController::class, 'loadAuditTeamSchedule'])->name('editor.load-audit-team-schedule');
            Route::post('editor/add-audit-schedule-row', [PlanEditorController::class, 'addAuditScheduleRow'])->name('editor.add-audit-schedule-row');
            Route::post('editor/load-select-nominated-offices', [PlanEditorController::class, 'loadNominatedOfficesSelectView'])->name('editor.load-select-nominated-offices');
            Route::post('editor/get-entity-wise-cos-center-autocomplete', [PlanEditorController::class, 'getEntityWiseCosCenterAutoComplete'])->name('editor.get-entity-wise-cos-center-autocomplete');
            Route::post('editor/load-select-nominated-office-option', [PlanEditorController::class, 'loadNominatedOfficesSelectOption'])->name('editor.load-select-nominated-office-option');
            Route::post('editor/load-risk-assessment-list', [RiskAssessmentController::class, 'loadRiskAssessment'])->name('editor.load-risk-assessment-list');
            Route::post('editor/load-risk-assessment-list-type-wise', [RiskAssessmentController::class, 'loadRiskAssessmentTypeWise'])->name('editor.load-risk-assessment-type-wise-list');
            Route::post('editor/store-risk-assessment', [RiskAssessmentController::class, 'store'])->name('editor.store-risk-assessment');
            Route::post('editor/update-risk-assessment', [RiskAssessmentController::class, 'update'])->name('editor.update-risk-assessment');
            Route::post('editor/risk-assessment-book', [RiskAssessmentController::class, 'book'])->name('editor.risk-assessment-book');

            //office order
            Route::get('/office-orders', [OfficeOrderController::class, 'index'])->name('office-orders.index');
            Route::post('/load-office-order-list', [OfficeOrderController::class, 'loadOfficeOrderList'])->name('office-orders.load-office-order-list');
            Route::post('/load-office-order-create', [OfficeOrderController::class, 'loadOfficeOrderCreate'])->name('office-orders.load-office-order-create');
            Route::post('/load-office-order-cc-create', [OfficeOrderController::class, 'loadOfficeOrderCCCreate'])->name('office-orders.load-office-order-cc-create');
            Route::post('/load-office-order-approval-authority', [OfficeOrderController::class, 'loadOfficeOrderApprovalAuthority'])->name('office-orders.load-office-order-approval-authority');
            Route::post('/store-office-order-approval-authority', [OfficeOrderController::class, 'storeOfficeOrderApprovalAuthority'])->name('office-orders.store-office-order-approval-authority');
            Route::post('/approve-office-order', [OfficeOrderController::class, 'approveOfficeOrder'])->name('office-orders.approve-office-order');
            Route::post('/generate-office-order', [OfficeOrderController::class, 'generateOfficeOrder'])->name('office-orders.generate-office-order');
            Route::post('/show-office-order', [OfficeOrderController::class, 'showOfficeOrder'])->name('office-orders.show-office-order');
            Route::post('/show-update-office-order', [OfficeOrderController::class, 'showUpdateOfficeOrder'])->name('office-orders.show-update-office-order');
            Route::post('/download-pdf', [OfficeOrderController::class, 'generateOfficeOrderPDF'])->name('office-orders.download-pdf');

            //data collection office order
            Route::get('/office-orders-dc', [DcOfficeOrderController::class, 'index'])->name('office-orders-dc.index');
            Route::post('/load-office-order-list-dc', [DcOfficeOrderController::class, 'loadOfficeOrderList'])->name('office-orders-dc.load-office-order-list');
            Route::post('/load-office-order-create-dc', [DcOfficeOrderController::class, 'loadOfficeOrderCreate'])->name('office-orders-dc.load-office-order-create');
            Route::post('/load-office-order-cc-create-dc', [DcOfficeOrderController::class, 'loadOfficeOrderCCCreate'])->name('office-orders-dc.load-office-order-cc-create');
            Route::post('/load-office-order-approval-authority-dc', [DcOfficeOrderController::class, 'loadOfficeOrderApprovalAuthority'])->name('office-orders-dc.load-office-order-approval-authority');
            Route::post('/store-office-order-approval-authority-dc', [DcOfficeOrderController::class, 'storeOfficeOrderApprovalAuthority'])->name('office-orders-dc.store-office-order-approval-authority');
            Route::post('/approve-office-order-dc', [DcOfficeOrderController::class, 'approveOfficeOrder'])->name('office-orders-dc.approve-office-order');
            Route::post('/generate-office-order-dc', [DcOfficeOrderController::class, 'generateOfficeOrder'])->name('office-orders-dc.generate-office-order');
            Route::post('/show-office-order-dc', [DcOfficeOrderController::class, 'showOfficeOrder'])->name('office-orders-dc.show-office-order');
            Route::post('/download-pdf-dc', [DcOfficeOrderController::class, 'generateOfficeOrderPDF'])->name('office-orders-dc.download-pdf');
        });
    });

    Route::group(['prefix' => 'calendar/'], function () {
        Route::post('load-teams-calender', [TeamCalendarController::class, 'loadTeamCalendar'])->name('calendar.load-teams-calender');
        Route::post('load-teams-calender-filter', [TeamCalendarController::class, 'loadTeamCalendarFilter'])->name('calendar.load-teams-calender-filter');
        Route::post('load-teams-select', [TeamCalendarController::class, 'loadTeamsSelect'])->name('calendar.load-teams-select');
        Route::post('load-team-schedule', [TeamCalendarController::class, 'loadTeamSchedule'])->name('calendar.load-team-schedule');
        Route::post('load-schedule-entity-fiscal-year-wise-select', [TeamCalendarController::class, 'loadScheduleEntityFiscalYearWiseSelect'])->name('calendar.load-schedule-entity-fiscal-year-wise-select');
        Route::post('load-cost-center-directorate-fiscal-year-wise-select', [TeamCalendarController::class, 'loadCostCenterDirectorateFiscalYearWiseSelect'])->name('calendar.load-cost-center-directorate-fiscal-year-wise-select');
        Route::get('teams', [TeamCalendarController::class, 'index'])->name('calendar.teams');
        Route::post('update-visit-calender-status', [TeamCalendarController::class, 'updateVisitCalenderStatus'])->name('calendar.update-visit-calender-status');
        Route::post('load-sub-team-select', [TeamCalendarController::class, 'loadSubTeamSelect'])->name('calendar.load-sub-teams-select');
        Route::post('load-team-calendar-schedule-list', [TeamCalendarController::class, 'loadTeamCalendarScheduleList'])->name('calendar.load-team-calendar-schedule-list');
        Route::post('get-total-query-and-memo-report', [TeamCalendarController::class, 'getTotalQueryAndMemoReport'])->name('calendar.get-total-query-and-memo-report');
    });

    //Prepare
    Route::group(['as' => 'audit.preparation.', 'prefix' => 'audit-preparation/'], function () {
        Route::get('/', function () {
            return redirect()->route('audit.preparation.dashboard');
        });

        Route::get('dashboard', [AuditPrepareDashboardController::class, 'index'])->name('dashboard');

        Route::get('sampling', [AuditPrepareSamplingController::class, 'index'])->name('sampling');

        Route::get('data-analysis', [AuditPrepareDataAnalysisController::class, 'index'])->name('data_analysis');

        Route::get('activities', [AuditPrepareActivityController::class, 'index'])->name('activities');
    });

    //Execute
    Route::group(['as' => 'audit.execution.', 'prefix' => 'audit-conducting/'], function () {
        Route::get('/', [AuditExecutionController::class, 'index']);

        Route::get('area', [AuditExecutionAreaController::class, 'index'])->name('area');

        //audit schedule
        Route::get('audit-schedule', [AuditExecutionScheduleController::class, 'auditSchedule'])->name('audit-schedule');
        Route::post('load-audit-schedule-list', [AuditExecutionScheduleController::class, 'loadAuditScheduleList'])->name('load-audit-schedule-list');

        //authority query list
        Route::get('authority-query-list', [AuditExecutionQueryController::class, 'authorityQueryList'])->name('authority-query-list');
        Route::post('load-authority-query-list', [AuditExecutionQueryController::class, 'loadAuthorityQueryList'])->name('load-authority-query-list');

        Route::group(['as' => 'query.', 'prefix' => 'query/'], function () {
            Route::post('index', [AuditExecutionQueryController::class, 'auditQuery'])->name('index');
            Route::post('load-list', [AuditExecutionQueryController::class, 'loadAuditQuery'])->name('load-list');
            Route::post('create', [AuditExecutionQueryController::class, 'auditQueryCreate'])->name('create');
            Route::post('store', [AuditExecutionQueryController::class, 'storeAuditQuery'])->name('store');
            Route::post('edit', [AuditExecutionQueryController::class, 'editAuditQuery'])->name('edit');
            Route::post('update', [AuditExecutionQueryController::class, 'updateAuditQuery'])->name('update');
            Route::post('view', [AuditExecutionQueryController::class, 'viewAuditQuery'])->name('view');
            Route::post('download', [AuditExecutionQueryController::class, 'downloadAuditQuery'])->name('download');
            Route::post('send-to-rpu', [AuditExecutionQueryController::class, 'sendAuditQuery'])->name('send-to-rpu');
            Route::post('received', [AuditExecutionQueryController::class, 'receivedAuditQuery'])->name('received');
        });
        Route::post('load-type-wise-audit-query', [AuditExecutionQueryController::class, 'loadTypeWiseAuditQuery'])->name('load-type-wise-audit-query');


        Route::post('load-reject-query-form', [AuditExecutionQueryController::class, 'loadRejectAuditQuery'])->name('load-reject-query-form');
        Route::post('reject-audit-query', [AuditExecutionQueryController::class, 'rejectAuditQuery'])->name('reject-audit-query');

        Route::get('discussion', [AuditExecutionDiscussionController::class, 'index'])->name('discussion');

        Route::get('review', [AuditExecutionReviewController::class, 'index'])->name('review');

        Route::group(['as' => 'memo.', 'prefix' => 'memo/'], function () {
            Route::post('index', [AuditExecutionMemoController::class, 'index'])->name('index');
            Route::post('create', [AuditExecutionMemoController::class, 'create'])->name('create');
            Route::post('store', [AuditExecutionMemoController::class, 'store'])->name('store');
            Route::post('edit', [AuditExecutionMemoController::class, 'edit'])->name('edit');
            Route::post('show', [AuditExecutionMemoController::class, 'show'])->name('show');
            Route::post('show-attachment', [AuditExecutionMemoController::class, 'showAttachment'])->name('show-attachment');
            Route::post('show-details', [AuditExecutionMemoController::class, 'showDetails'])->name('show-details');
            Route::post('download', [AuditExecutionMemoController::class, 'memoPDFDownload'])->name('download');
            Route::post('update', [AuditExecutionMemoController::class, 'update'])->name('update');
            Route::post('list', [AuditExecutionMemoController::class, 'list'])->name('list');
            Route::post('sent-to-rpu', [AuditExecutionMemoController::class, 'sentToRpu'])->name('sent-to-rpu');
            Route::get('authority-memo-list', [AuditExecutionMemoController::class, 'authorityMemoList'])->name('authority-memo-list');
            Route::post('load-authority-memo-list', [AuditExecutionMemoController::class, 'loadAuthorityMemoList'])->name('load-authority-memo-list');
            Route::post('audit-memo-recommendation', [AuditExecutionMemoController::class, 'auditMemoRecommendation'])->name('audit-memo-recommendation');
            Route::post('audit-memo-recommendation-store', [AuditExecutionMemoController::class, 'auditMemoRecommendationStore'])->name('audit-memo-recommendation-store');
            Route::post('audit-memo-log', [AuditExecutionMemoController::class, 'auditMemoLog'])->name('audit-memo-log');
            Route::post('audit-memo-log-show', [AuditExecutionMemoController::class, 'auditMemoShow'])->name('audit-memo-log-show');
            Route::post('send-memo-form', [AuditExecutionMemoController::class, 'sendMemoForm'])->name('send-memo-form');
            Route::post('delete-memo-attachment', [AuditExecutionMemoController::class, 'deleteMemoAttachment'])->name('delete-memo-attachment');
            Route::post('get-audit-memo-finder', [AuditExecutionMemoController::class, 'getAuditMemoFinderSelect'])->name('get-audit-memo-finder');
        });


        Route::group(['as' => 'apotti.', 'prefix' => 'apotti/'], function () {
            Route::get('/', [AuditReportDashboardController::class, 'apottiPage'])->name('dashboard');

            Route::group(['as' => 'memo.', 'prefix' => 'memo/'], function () {
                Route::get('/', [AuditExecutionApottiMemoController::class, 'apottiMemoPage'])->name('dashboard');
                Route::get('index', [AuditExecutionApottiMemoController::class, 'index'])->name('index');
                Route::post('memo-list', [AuditExecutionApottiMemoController::class, 'loadMemoList'])->name('memo-list');
                Route::post('edit', [AuditExecutionApottiMemoController::class, 'edit'])->name('edit');
                Route::post('convert-memo-to-apotti', [AuditExecutionApottiMemoController::class, 'convertMemoToApotti'])->name('convert-memo-to-apotti');
            });

            Route::get('index', [AuditExecutionApottiController::class, 'index'])->name('index');
            Route::post('load-apotti-list', [AuditExecutionApottiController::class, 'loadApottiList'])->name('load-apotti-list');
            Route::post('onucched-merge', [AuditExecutionApottiController::class, 'onucchedMerge'])->name('onucched-merge');
            Route::post('onucched-unmerge', [AuditExecutionApottiController::class, 'onucchedUnMerge'])->name('onucched-unmerge');
            Route::post('onucched-rearrange', [AuditExecutionApottiController::class, 'onucchedReArrange'])->name('onucched-rearrange');
            Route::post('onucched-merge-form', [AuditExecutionApottiController::class, 'onucchedMergeForm'])->name('onucched-merge-form');
            Route::post('onucched-show', [AuditExecutionApottiController::class, 'onucchedShow'])->name('onucched-show');
            Route::post('edit-apotti', [AuditExecutionApottiController::class, 'editApotti'])->name('edit-apotti');
            Route::post('update-apotti', [AuditExecutionApottiController::class, 'updateApotti'])->name('update-apotti');
            Route::post('delete-apotti-porisisto', [AuditExecutionApottiController::class, 'apottiPorisistoDelete'])->name('delete-apotti-porisisto');
            Route::post('audit-plan-wise-entity', [AuditExecutionApottiController::class, 'auditPlanWiseEntitySelect'])->name('audit-plan-wise-entity-select');
            Route::post('audit-plan-type-wise-air', [AuditExecutionApottiController::class, 'auditPlanTypeWiseAir'])->name('audit-plan-type-wise-air');
            Route::post('apotti-item-info', [AuditExecutionApottiController::class, 'apottiItemInfo'])->name('apotti-item-info');
            Route::get('apotti-register/{any}', [AuditExecutionApottiController::class, 'apottiRegister'])->name('apotti-register');
            Route::post('load-apotti-register-list', [AuditExecutionApottiController::class, 'loadApottiRegisterList'])->name('load-apotti-register-list');
            Route::post('edit-register', [AuditExecutionApottiController::class, 'loadApottiRegisterEdit'])->name('edit-register');

            Route::get('apotti-uplaod', [\App\Http\Controllers\AuditExecution\AuditExecutionApottiController::class, 'uploadedApottiView'])->name('apotti-uplaod');
            Route::get('uploaded-apotti', [\App\Http\Controllers\AuditExecution\AuditExecutionApottiController::class, 'apottiUpload'])->name('uploaded-apotti');

            Route::group(['as' => 'register.', 'prefix' => 'register/'], function () {
                Route::post('get-approval-authority', [AuditExecutionApottiController::class, 'loadRegisterApprovalAuthority'])->name('get-approval-authority');
                Route::post('store-approval-authority', [AuditExecutionApottiController::class, 'storeRegisterApprovalAuthority'])->name('store-approval-authority');
                Route::post('update', [AuditExecutionApottiController::class, 'updateRegisterApotti'])->name('update');
            });


            Route::get('search-page', [AuditExecutionApottiSearchController::class, 'index'])->name('search-page');
            Route::post('search-list', [AuditExecutionApottiSearchController::class, 'list'])->name('search-list');
            Route::post('search-view', [AuditExecutionApottiSearchController::class, 'view'])->name('search-view');
            Route::post('search-edit', [AuditExecutionApottiSearchController::class, 'edit'])->name('search-edit');
            Route::post('search-edit-submit', [AuditExecutionApottiSearchController::class, 'editSubmit'])->name('search-edit-submit');
            Route::post('get-doner-wise-project', [AuditExecutionApottiSearchController::class, 'getDonerWiseProject'])->name('get-doner-wise-project');
            Route::post('get-ministry-wise-project-and-doner', [AuditExecutionApottiSearchController::class, 'getMinistryWiseProjectAndDoner'])->name('get-ministry-wise-project-and-doner');
            Route::post('get-ministry-wise-project', [AuditExecutionApottiSearchController::class, 'getMinistryWiseProject'])->name('get-ministry-wise-project');
        });

        //archive apotti
        Route::group(['as' => 'archive-apotti.', 'prefix' => 'archive-apotti/'], function () {
            Route::get('/', [AuditExecutionArchiveApottiController::class, 'archivePage'])->name('archive-page');
            Route::get('index', [AuditExecutionArchiveApottiController::class, 'index'])->name('index');
            Route::post('create', [AuditExecutionArchiveApottiController::class, 'create'])->name('create');
            Route::post('edit', [AuditExecutionArchiveApottiController::class, 'edit'])->name('edit');
            Route::post('view', [AuditExecutionArchiveApottiController::class, 'view'])->name('view');
            Route::post('store', [AuditExecutionArchiveApottiController::class, 'store'])->name('store');
            Route::post('store-new-attachment', [AuditExecutionArchiveApottiController::class, 'storeNewAttachment'])->name('store-new-attachment');
            Route::post('delete-attachment', [AuditExecutionArchiveApottiController::class, 'deleteAttachment'])->name('delete-attachment');
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
            Route::post('report-details', [AuditExecutionArchiveApottiReportController::class, 'reportDetails'])->name('report-details');
            Route::post('report-apotti-delete', [AuditExecutionArchiveApottiReportController::class, 'reportApottiDelete'])->name('report-apotti-delete');
            Route::post('report-apotti-edit-form', [AuditExecutionArchiveApottiReportController::class, 'reportApottiEditForm'])->name('report-apotti-edit-form');
        });
    });

    //Quality Control
    Route::group(['as' => 'audit.qac.', 'prefix' => 'audit-qac/'], function () {

        /*Route::get('/', function () {
            return redirect()->route('audit.qac.dashboard');
        });*/

        Route::get('/', [QACController::class, 'index'])->name('index');
        Route::get('dashboard', [AuditQacDashboardController::class, 'index'])->name('dashboard');
        Route::get('qac/{any}', [AuditQacController::class, 'index'])->name('qac');
        Route::post('qac-apotti-list', [AuditQacController::class, 'loadApottiQacList'])->name('qac-apotti-list');
        Route::post('air-wise-apotti', [AuditQacController::class, 'loadAirWiseApottiList'])->name('air-wise-apotti');
        Route::post('qac-apotti', [AuditQacController::class, 'qacApotti'])->name('qac-apotti');
        Route::post('qac-apotti-submit', [AuditQacController::class, 'qacApottiSubmit'])->name('qac-apotti-submit');
        Route::get('qac-committee/{any}', [AuditQacController::class, 'qacCommittee'])->name('qac-committee');
        Route::post('get-qac-committee', [AuditQacController::class, 'getQacCommitteeList'])->name('qac-committee-list');
        Route::post('create-qac-committee', [AuditQacController::class, 'createQacCommittee'])->name('create-qac-committee');
        Route::post('store-qac-committee', [AuditQacController::class, 'storeQacCommittee'])->name('store-qac-committee');
        Route::post('edit-qac-committee', [AuditQacController::class, 'editQacCommittee'])->name('edit-qac-committee');
        Route::post('update-qac-committee', [AuditQacController::class, 'updateQacCommittee'])->name('update-qac-committee');
        Route::post('delete-qac-committee', [AuditQacController::class, 'deleteQacCommittee'])->name('delete-qac-committee');
        Route::post('select-qac-committee-form', [AuditQacController::class, 'selectQacCommitteeForm'])->name('select-qac-committee-form');
        Route::post('get-qac-committee-wise-members', [AuditQacController::class, 'getQacCommitteeWiseMembers'])->name('get-qac-committee-wise-members');
        Route::post('submit-air-wise-committee', [AuditQacController::class, 'submitAirWiseCommittee'])->name('submit-air-wise-committee');
        Route::post('create-qac-report', [AuditQacController::class, 'createQacReport'])->name('create-qac-report');
        Route::post('cqat-done-form', [AuditQacController::class, 'cqatDoneForm'])->name('cqat-done-form');
        Route::post('cqat-done-submit', [AuditQacController::class, 'cqatDoneSubmit'])->name('cqat-done-submit');
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

        Route::get('dashboard', [AuditFollowupDashboardController::class, 'index'])->name('dashboard');

        Route::get('observation', [AuditFollowupObservationController::class, 'index'])->name('observation');

        Route::get('observation/lists', [AuditFollowupObservationController::class, 'lists'])->name('observation.lists');
        Route::get('observation/communications', [AuditFollowupObservationController::class, 'communications'])->name('observation.communications');

        Route::get('observation/create', [AuditFollowupObservationController::class, 'create'])->name('observation.create');
        Route::get('observation/follow-up/{id}', [AuditFollowupObservationController::class, 'followUp'])->name('observation.follow-up');
        Route::post('observation/follow-up', [AuditFollowupObservationController::class, 'followUpSubmit'])->name('observation.follow-up.sent');
        Route::get('observation/view/{id?}', [AuditFollowupObservationController::class, 'show'])->name('observation.show');
        Route::get('observation/edit/{id?}', [AuditFollowupObservationController::class, 'edit'])->name('observation.edit');
        Route::post('observation/store', [AuditFollowupObservationController::class, 'store'])->name('observation.store');
        Route::post('observation/update', [AuditFollowupObservationController::class, 'update'])->name('observation.update');
        Route::post('observation/search', [AuditFollowupObservationController::class, 'search'])->name('observation.search');
        Route::get('observation/delete/{id}', [AuditFollowupObservationController::class, 'destroy'])->name('observation.delete');
        Route::get('observation/image/delete/{id}', [AuditFollowupObservationController::class, 'imageDestroy'])->name('observation.image.delete');

        Route::post('observation/get_audit_plan', [AuditFollowupObservationController::class, 'getAuditPlan'])->name('observation.get.audit.plan');

        Route::get('due-report', [AuditFollowupDueReportController::class, 'index'])->name('due_report');

        Route::get('reminder', [AuditFollowupReminderController::class, 'index'])->name('reminder');

        Route::get('record', [AuditFollowupRecordController::class, 'index'])->name('record');

        Route::get('settlement-review', [AuditFollowupSettlementReviewController::class, 'index'])->name('settlement_review');
    });

    Route::group(['as' => 'audit.final-report.', 'prefix' => 'final-audit-report/'], function () {
        Route::get('/', function () {
            return redirect()->route('audit.final-report.dashboard');
        });
        Route::get('dashboard', [FinalAuditDashboardController::class, 'index'])->name('dashboard');
        Route::get('index', [AuditFinalReportController::class, 'index'])->name('index');
        Route::post('get-audit-final-report', [AuditFinalReportController::class, 'getAuditFinalReport'])->name('get-audit-final-report');
        Route::post('create-audit-final-report', [AuditFinalReportController::class, 'editAuditFinalReport'])->name('edit-audit-final-report');
        Route::post('get-final-approval-authority', [AuditFinalReportController::class, 'loadFinalApprovalAuthority'])->name('get-final-approval-authority');
        Route::post('submit-final-apporval', [AuditFinalReportController::class, 'submitFinalApproval'])->name('submit-final-approval');
        Route::post('final-report-status-update', [AuditFinalReportController::class, 'finalReportStatusUpdate'])->name('final-report-status-update');
        Route::get('final-report-search', [AuditFinalReportController::class, 'finalReportSearch'])->name('final-report-search');
        Route::post('get-final-report-search-list', [AuditFinalReportController::class, 'getFinalReportSearchList'])->name('get-final-report-search-list');
        Route::post('final-report-details', [AuditFinalReportController::class, 'finalReportDetails'])->name('get-final-report-details');

        Route::get('final-report-apotti-map', [AuditFinalReportController::class, 'finalReportApottiMap'])->name('final-report-apotti-map');
        Route::post('get-directorate-wise-final-report', [AuditFinalReportController::class, 'getDirectorateWiseFinalReport'])->name('get-directorate-wise-final-report');
        Route::post('get-archive-final-report-apotti', [AuditFinalReportController::class, 'getArchiveFinalReportApotti'])->name('get-archive-final-report-apotti');
        Route::post('map-archive-final-report-apotti', [AuditFinalReportController::class, 'mapArchiveFinalReportApotti'])->name('map-archive-final-report-apotti');
    });

    Route::group(['as' => 'audit.air-report.', 'prefix' => 'audit-air-report/'], function () {
        Route::get('/', function () {
            return redirect()->route('audit.air-report.dashboard');
        });
        Route::get('dashboard', [AuditAirDashboardController::class, 'index'])->name('dashboard');
        Route::get('authority-air-report', [AuditAIRReportController::class, 'authorityAirReport'])->name('authority-air-report');
        Route::post('get-authority-air-report', [AuditAIRReportController::class, 'getAuthorityAuditAirReport'])->name('get-authority-audit-air-report');
    });


    //Report
    Route::group(['as' => 'audit.report.', 'prefix' => 'audit-report/'], function () {
        Route::get('/', function () {
            return redirect()->route('audit.report.dashboard');
        });

        Route::get('dashboard', [AuditReportDashboardController::class, 'index'])->name('dashboard');
        Route::get('draft-report', [AuditDraftReportController::class, 'index'])->name('draft_report');
        Route::get('final-report', [AuditFinalReportController::class, 'index'])->name('final_report');

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
                Route::post('download', [AuditQACAIRReportController::class, 'download'])->name('download');
                Route::post('preview', [AuditQACAIRReportController::class, 'previewAuditReport'])->name('preview');
            });

            Route::post('air-send-to-rpu', [RpuAirReportController::class, 'airSendToRpu'])->name('air-send-to-rpu');
        });

        //observation report
        Route::group(['as' => 'observations.', 'prefix' => 'observations/'], function () {
            Route::group(['as' => 'get-status-wise.', 'prefix' => 'get-status-wise/'], function () {
                Route::get('/{any}', [ObservationsReportController::class, 'index']);
                Route::post('list', [ObservationsReportController::class, 'list'])->name('list');
                Route::post('download', [ObservationsReportController::class, 'download'])->name('download');
            });

            Route::get('directorate-wise-ministry-total-observation', [ObservationsReportController::class, 'directorateWiseMinistryTotalObservation'])->name('directorate-wise-ministry-total-observation');
            Route::post('get-directorate-wise-ministry-total-observation', [ObservationsReportController::class, 'getDirectorateWiseMinistryTotalObservation'])->name('get-directorate-wise-ministry-total-observation');
            Route::post('get-directorate-wise-ministry-total-observation-download', [ObservationsReportController::class, 'getDirectorateWiseMinistryTotalObservationDownload'])->name('get-directorate-wise-ministry-total-observation-download');
        });
    });

    //Sub Modules
    Route::get('/grievance-management', [GrievanceManagementController::class, 'index'])->name('grievance_management');

    Route::get('/application-administration', [ApplicationAdministrationController::class, 'index'])->name('application_administration');

    Route::get('/auditee-employee-database', [AuditeeEmployeeDatabaseController::class, 'index'])->name('auditee_employee_database');

    Route::get('/communication-management', [CommunicationManagementController::class, 'index'])->name('communication_management');

    Route::get('/document-management', [DocumentManagementController::class, 'index'])->name('document_management');

    Route::group(['as' => 'mis_and_dashboard.', 'prefix' => 'mis-and-dashboard/'], function () {
        Route::get('/', [MISAndDashboardController::class, 'index'])->name('index');

        Route::get('/rpu-list', [MISAndDashboardController::class, 'rpuListIndex'])->name('rpu_list.index');
        Route::post('/load-rpu-lists', [MISAndDashboardController::class, 'loadRpuLists'])->name('rpu_list.load-lists');
        Route::post('/directorate_wise_ministry', [MISAndDashboardController::class, 'directorateWiseMinistry'])->name('directorate_wise_ministry');

        Route::get('/team-list', [MISAndDashboardController::class, 'teamListIndex'])->name('team_list.index');
        Route::post('/load-team-lists', [MISAndDashboardController::class, 'loadTeamLists'])->name('team_list.load-lists');
        Route::post('/load-fiscal-year-wise-team', [MISAndDashboardController::class, 'loadFiscalYearWiseTeam'])->name('team_list.load-fiscal-year-wise-team');
    });

    Route::get('/knowledge-management', [KnowledgeManagementController::class, 'index'])->name('knowledge_management');

    Route::get('/legacy-data-management', [LegacyDataManagementController::class, 'index'])->name('legacy_data_management');

    Route::group(['as' => 'pac.', 'prefix' => 'pac/'], function () {
        Route::get('/', [PacController::class, 'index'])->name('index');
        Route::get('pac-meeting/{any}', [PacController::class, 'pacMeeting'])->name('pac-meeting');
        Route::post('pac-meeting-list', [PacController::class, 'pacMeetingList'])->name('pac-meeting-list');

        Route::group(['as' => 'meeting-worksheet-report.', 'prefix' => 'meeting-worksheet-report/'], function () {
            Route::post('create', [PacController::class, 'pacMeetingWorksheetReportCreate'])->name('create');
            Route::post('get-audit-apotti', [PacController::class, 'getAuditApotti'])->name('get-audit-apotti');
            Route::post('store', [PacController::class, 'pacMeetingWorksheetReportStore'])->name('store');
            Route::post('preview', [PacController::class, 'pacMeetingWorksheetReportPreview'])->name('preview');
            Route::post('download', [PacController::class, 'pacMeetingWorksheetReportDownload'])->name('download');
        });

        Route::post('pac-meeting-create', [PacController::class, 'pacMeetingCreate'])->name('pac-meeting-create');
        Route::post('pac-meeting-store', [PacController::class, 'pacMeetingStore'])->name('pac-meeting-store');
        Route::post('pac-meeting-show', [PacController::class, 'pacMeetingShow'])->name('pac-meeting-show');
        Route::post('sent-to-pac', [PacController::class, 'sentToPac'])->name('sent-to-pac');
        Route::post('pac-meeting-minutes', [PacController::class, 'pacMeetingMinutes'])->name('pac-meeting-minutes');
        Route::post('load-pac-member-list', [PacController::class, 'loadPacMemberList'])->name('load-pac-member-list');
        Route::post('load-office-member-list', [PacController::class, 'loadOfficeMemberList'])->name('load-office-member-list');
        Route::post('load-pac-final-report', [PacController::class, 'loadPacFinalReport'])->name('load-pac-final-report');
        Route::post('load-air-wise-apotti', [PacController::class, 'airWiseApotti'])->name('load-air-wise-apotti');
        Route::post('pac-apotti-decision-form', [PacController::class, 'pacApottiDecisionForm'])->name('pac-apotti-decision-form');
        Route::post('pac-apotti-decision-store', [PacController::class, 'pacApottiDecisionStore'])->name('pac-meeting-decision-store');
        Route::post('cag-and-directorate-decision', [PacController::class, 'cagAndDirectorateDecision'])->name('cag-and-directorate-decision');
        Route::post('cag-and-directorate-decision-form', [PacController::class, 'cagAndDirectorateDecisionForm'])->name('cag-and-directorate-decision-form');
        Route::post('get-apotti-item', [PacController::class, 'getApottiItem'])->name('get-apotti-item');
    });


    Route::group(['as' => 'settings.', 'prefix' => 'settings/'], function () {
        Route::get('/', [SettingController::class, 'index'])->name('index');
        Route::get('/dashboard', [SettingController::class, 'showSettingsDashboard'])->name('dashboard');

        Route::post('/fiscal-years/lists', [XFiscalYearController::class, 'getFiscalYearLists'])->name('fiscal-years.lists');
        Route::resource('/fiscal-years', XFiscalYearController::class, ['except' => ['edit', 'create']]);

        Route::post('/audit-query/lists', [XAuditQueryController::class, 'getAuditQueryLists'])->name('audit-query.lists');
        Route::post('/audit-query/edit', [XAuditQueryController::class, 'auditQueryEdit'])->name('audit-query.edit');
        Route::resource('/audit-query', XAuditQueryController::class, ['except' => ['edit', 'create']]);

        //risk assessment
        Route::post('/risk-assessment/lists', [XRiskAssessmentController::class, 'getRiskAssessmentLists'])->name('risk-assessment.lists');
        Route::post('/risk-assessment/edit', [XRiskAssessmentController::class, 'riskAssessmentEdit'])->name('risk-assessment.edit');
        Route::resource('/risk-assessment', XRiskAssessmentController::class, ['except' => ['edit', 'create']]);

        Route::group(['as' => 'strategic-plan.', 'prefix' => 'strategic-plan/'], function () {
            Route::post('/duration/lists', [DurationController::class, 'getDurationLists'])->name('duration.lists');
            Route::resource('/duration', DurationController::class, ['except' => ['edit', 'create']]);

            Route::post('/outcome/lists', [OutcomeController::class, 'getOutcomeLists'])->name('outcome.lists');
            Route::resource('/outcome', OutcomeController::class, ['except' => ['edit', 'create']]);

            Route::post('/output/lists', [OutputController::class, 'getOutputLists'])->name('output.lists');
            Route::resource('/output', OutputController::class, ['except' => ['edit', 'create']]);
        });


        //for menu action
        Route::group(['as' => 'menu-actions.', 'prefix' => 'menu-actions/'], function () {
            Route::get('/{page}', [PMenuActionController::class, 'index'])->name('index');

            Route::post('/create', [PMenuActionController::class, 'create'])->name('create');
            Route::post('/store', [PMenuActionController::class, 'store'])->name('store');
            Route::post('/edit', [PMenuActionController::class, 'edit'])->name('edit');
            Route::post('/update', [PMenuActionController::class, 'update'])->name('update');

            Route::post('/load-type-wise-menu-action', [PMenuActionController::class, 'loadTypeWiseMenuActionData'])->name('load-type-wise-menu-action');
        });

        //for role
        Route::group(['as' => 'roles.', 'prefix' => 'roles/'], function () {
            Route::get('/', [PRoleController::class, 'index'])->name('index');
            Route::post('/create', [PRoleController::class, 'create'])->name('create');
            Route::post('/store', [PRoleController::class, 'store'])->name('store');
            Route::post('/edit', [PRoleController::class, 'edit'])->name('edit');
            Route::post('/update', [PRoleController::class, 'update'])->name('update');
            Route::post('/lists', [PRoleController::class, 'getRoles'])->name('lists');
            Route::post('/load-master-designation-role-map', [PRoleController::class, 'loadMasterDesignationRoleMap'])->name('load-master-designation-role-map');
            Route::post('/assigned-master-designation-role-map', [PRoleController::class, 'assignedMasterDesignationRoleMap'])->name('assigned-master-designation-role-map');
            Route::post('/store-master-designation-role-map', [PRoleController::class, 'storeMasterDesignationRoleMap'])->name('store-master-designation-role-map');
        });

        //role permission
        Route::group(['as' => 'role-permissions.', 'prefix' => 'role-permissions/'], function () {
            Route::get('/', [PermissionController::class, 'index'])->name('index');
            Route::get('/employee-permission', [PermissionController::class, 'employeePermission'])->name('employee-permission');
            Route::post('/get-menu-module-lists', [PermissionController::class, 'loadMenuModuleLists'])->name('get-menu-module-lists');
            Route::post('/get-role-wise-menu-module-lists', [PermissionController::class, 'loadMenuModuleListsByRole'])->name('get-role-wise-menu-module-lists');
            Route::post('/get-roles-list', [PermissionController::class, 'loadAllRoles'])->name('get-roles-list');
            Route::post('/assign-menus-to-role', [PermissionController::class, 'assignMenuModuleToRole'])->name('assign-menus-to-role');
            Route::post('/assign-menus-to-employee', [PermissionController::class, 'assignMenuModuleToEmployee'])->name('assign-menus-to-employee');
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
            Route::post('store', [XMovementController::class, 'store'])->name('store');
        });
    });


    //Miscellaneous
    Route::get('locale/{locale}', [App\Http\Controllers\ChangeController::class, 'changeLocale'])->name('change.locale');
    Route::get('change/office/{id}/{office_id}/{office_unit_id}/{designation_id}', [App\Http\Controllers\ChangeController::class, 'changeDesignation'])->name('change.office');

    //Generic Data Collection
    Route::group(['as' => 'generic.'], function () {
        Route::post('get-strategic-outcome-remarks', [GenericIfoCollectController::class, 'getStrategicOutcomeRemarks'])->name('outcome.remarks');
        Route::post('get-strategic-output-by-outcome', [GenericIfoCollectController::class, 'getStrategicOutputByOutcome'])->name('output.by.outcome');
        Route::post('designation-master-data', [GenericIfoCollectController::class, 'getCagDoptorMasterDesignations'])->name('designation-master-data');
    });

    //Generic RPU Data Collection
    Route::group(['as' => 'rpu.'], function () {
        Route::post('get-ministries', [GenericRPUController::class, 'getMinistries'])->name('ministries.all');
        Route::post('get-office-layer', [GenericRPUController::class, 'getMinistryWiseOfficeLayer'])->name('office-layer.all');
        Route::post('get-rp-offices', [GenericRPUController::class, 'getMinistryLayerWiseOffice'])->name('rp-offices.all');
        Route::post('get-ministry-wise-rp-entities', [GenericRPUController::class, 'getMinistryWiseEntities'])->name('rp-offices.all');
        Route::post('get-all-projects', [GenericRPUController::class, 'getAllProjects'])->name('rp-projects.all');
    });

    Route::group(['as' => 'rpu-apotti.', 'prefix' => 'rpu-apotti/'], function () {
        Route::get('index', [RpuApottiController::class, 'index']);
        Route::post('get-rpu-apotti-item', [RpuApottiController::class, 'getRpuApottiItem'])->name('get-rpu-apotti-item');
        Route::post('get-ministry-wise-entity-select', [RpuApottiController::class, 'getMinistryWiseApottiEntitySelect'])->name('get-ministry-wise-entity-select');
        Route::post('get-rpu-apotti-response-form', [RpuApottiController::class, 'getRpuApottiResponseForm'])->name('get-rpu-apotti-response-form');
        Route::post('rpu-response-submit', [RpuApottiController::class, 'rpuResponseSubmit'])->name('rpu-response-submit');
        Route::post('rpu-broad-sheet-form', [RpuApottiController::class, 'rpuBroadSheetForm'])->name('rpu-broad-sheet-form');
        Route::post('rpu-broad-sheet-submit', [RpuApottiController::class, 'rpuBroadSheetSubmit'])->name('rpu-broad-sheet-submit');
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
