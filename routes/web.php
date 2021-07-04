<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::group(['middleware' => 'jisf.auth'], function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // Plan Route Start
    Route::group(['as' => 'audit.plan.', 'prefix' => 'audit-plan/'], function () {
        Route::get('/', function () {
            return redirect()->route('audit.plan.dashboard');
        });
        Route::get('/dashboard', [\App\Http\Controllers\AuditPlan\AuditPlanDashboardController::class, 'index'])->name('dashboard');

        //strategic plan
        Route::group(['as' => 'strategy.', 'prefix' => 'strategy/'], function () {

            Route::get('/', [\App\Http\Controllers\AuditPlan\AuditStrategicPlanController::class, 'index'])
                ->name('index');

            Route::get('/dashboard', [\App\Http\Controllers\AuditPlan\AuditStrategicPlanController::class, 'showAuditStrategicPlanDashboard'])
                ->name('dashboard');

            Route::get('draft-plans', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\DraftPlanController
            ::class, 'index'])->name('draft_plan.all');
            Route::post('draft-plan', [\App\Http\Controllers\AuditPlan\AuditStrategicPlan\DraftPlanController
            ::class, 'show'])->name('draft_plan.single');

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

        });
        //strategic plan
        Route::group(['as' => 'operational.', 'prefix' => 'operational/'], function () {
            Route::get('/', [\App\Http\Controllers\AuditPlan\AuditOperationalPlanController::class, 'index'])
                ->name('index');

            Route::get('/dashboard', [\App\Http\Controllers\AuditPlan\AuditOperationalPlanController::class, 'showOperationalPlanDashboard'])
                ->name('dashboard');
        });
        Route::get('/operational-plan', [\App\Http\Controllers\AuditPlan\AuditOperationalPlanController::class, 'index'])->name('operational');

        Route::get('/annual-plan', [\App\Http\Controllers\AuditPlan\AuditAnnualPlanController::class, 'index'])->name('annual');
    });

    //Prepare
    Route::group(['as' => 'audit.preparation.', 'prefix' => 'audit-preparation/'], function () {
        Route::get('/', function () {
            return redirect()->route('audit.preparation.dashboard');
        });

        Route::get('dashboard', [\App\Http\Controllers\AuditPrepare\AuditPrepareDashboardController::class, 'index'])->name('dashboard');

        Route::get('sampling', [\App\Http\Controllers\AuditPrepare\AuditPrepareSamplingController::class, 'index'])->name('sampling');

        Route::get('data-analysis', [\App\Http\Controllers\AuditPrepare\AuditPrepareDataAnalysisController::class, 'index'])->name('data_analysis');

        Route::get('activities', [\App\Http\Controllers\AuditPrepare\AuditPrepareActivitiesController::class, 'index'])->name('activities');

    });

    //Execute
    Route::group(['as' => 'audit.execution.', 'prefix' => 'audit-execution/'], function () {
        Route::get('/', function () {
            return redirect()->route('audit.execution.dashboard');
        });
        Route::get('dashboard', [\App\Http\Controllers\AuditExecution\AuditExecutionDashboardController::class, 'index'])->name('dashboard');

        Route::get('area', [\App\Http\Controllers\AuditExecution\AuditExecutionAreaController::class, 'index'])->name('area');

        Route::get('query', [\App\Http\Controllers\AuditExecution\AuditExecutionQueryController::class, 'index'])->name('query');

        Route::get('discussion', [\App\Http\Controllers\AuditExecution\AuditExecutionDiscussionController::class, 'index'])->name('discussion');

        Route::get('review', [\App\Http\Controllers\AuditExecution\AuditExecutionReviewController::class, 'index'])->name('review');

    });

    //Followup
    Route::group(['as' => 'audit.followup.', 'prefix' => 'audit-followup/'], function () {
        Route::get('/', function () {
            return redirect()->route('audit.followup.dashboard');
        });
        Route::get('dashboard', [\App\Http\Controllers\AuditFollowup\AuditFollowupDashboardController::class, 'index'])->name('dashboard');

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

    Route::get('/communication-management', [\App\Http\Controllers\CommunicationManagementController::class, 'index'])->name
    ('communication_management');

    Route::get('/document-management', [\App\Http\Controllers\DocumentManagementController::class, 'index'])->name('document_management');

    Route::get('/mis-and-dashboard', [\App\Http\Controllers\MISAndDashboardController::class, 'index'])->name('mis_and_dashboard');

    Route::get('/knowledge-management', [\App\Http\Controllers\KnowledgeManagementController::class, 'index'])->name('knowledge_management');

    Route::get('/legacy-data-management', [\App\Http\Controllers\LegacyDataManagementController::class, 'index'])->name('legacy_data_management');

    Route::get('/pac', [\App\Http\Controllers\PacController::class, 'index'])->name('pac');

    //Miscellaneous
    Route::get('locale/{locale}', [App\Http\Controllers\ChangeController::class, 'changeLocale'])->name('change.locale');
    Route::get('change/office/{office_id}/{office_unit_id}/{designation_id}',
        [App\Http\Controllers\ChangeController::class, 'changeDesignation']
    )->name('change.office');

    Route::post('render-hor-menu', [\App\Http\Controllers\UtilityController::class, 'renderHorMenu']);
    Route::post('render-ver-menu', [\App\Http\Controllers\UtilityController::class, 'renderVerMenu']);

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
        */
// Route::get('/anual-operation', function () {
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
