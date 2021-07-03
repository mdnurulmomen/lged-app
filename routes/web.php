<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Plan Route Start
*/
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

Route::get('/', function () {
    return view('loginPage');
});
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
Route::get('/dashboard', function () {
    return view('pages.aside');
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

// Route::get('/ajax-load', 'ajaxLoadPageController@getTemplate');
