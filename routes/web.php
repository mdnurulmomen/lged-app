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

Route::get('/', function () {
    return view('loginPage');
});
Route::get('/anual-operation', function () {
    return view('pages.anualOperation');
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
