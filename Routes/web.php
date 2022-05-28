<?php

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

Route::prefix('employees')->middleware(['auth', 'module:employees'])->group(function() {

    // Home Route
    Route::get('/', 'HomeController@index')->name('employees.home');

    // Registration
    Route::get('staff/create', 'StaffController@create')->name('staff.create');
    Route::get('staff/create/finish', 'StaffController@finish')->name('staff.finish');
    Route::get('staff/create/cancel', 'StaffController@cancel')->name('staff.cancel');
    
    // Staff
    Route::get('staff/index', 'StaffController@index')->name('staff.index');
    Route::get('staff/search', 'StaffController@search')->name('staff.search');
    Route::get('staff/{staff}', 'StaffController@show')->name('staff.show');
    Route::get('staff/{staff}/delete', 'StaffController@destroy')->name('staff.destroy');

    // Identity
    Route::get('identity/search', 'IdentityController@search')->name('identity.search');
    Route::get('identity/{staff}', 'IdentityController@show')->name('identity.show');
    Route::get('identity/{staff}/get-card', 'IdentityController@card')->name('identity.card');

    // Employment
    Route::get('job/promotion', 'EmploymentController@promotion')->name('job.promotion');
    Route::get('job/confirmation', 'EmploymentController@confirmation')->name('job.confirmation');
    Route::get('job/renewal', 'EmploymentController@contractRenewal')->name('job.renewal');

    Route::get('staff/{staff}/promote', 'EmploymentController@promote')->name('staff.promote');
    Route::get('staff/{staff}/confirm', 'EmploymentController@confirm')->name('staff.confirm');
    Route::get('staff/{staff}/contract', 'EmploymentController@contract')->name('staff.contract');

    // Exporter
    Route::get('staff/{staff}/export', 'StaffController@export')->name('staff.export');

    // Importer
    Route::get('importer/template', 'ImporterController@template')->name('staff.template');
    Route::get('importer/import', 'ImporterController@import')->name('staff.import');

    // Appointment
    Route::get('appointment/index', 'AppointmentController@index')->name('appointment.index');
    Route::get('appointment/add', 'AppointmentController@add')->name('appointment.add');
    Route::get('appointment/{staff}/create', 'AppointmentController@create')->name('appointment.create');

    // Deanship
    Route::get('deanship/index', 'DeanshipController@index')->name('deanship.index');
    Route::get('deanship/search', 'DeanshipController@search')->name('deanship.search');
    Route::get('deanship/{staff}/assign', 'DeanshipController@assign')->name('deanship.assign');

    // Headship
    Route::get('headship/index', 'HeadshipController@index')->name('headship.index');
    Route::get('headship/search', 'HeadshipController@search')->name('headship.search');
    Route::get('headship/{staff}/assign', 'HeadshipController@assign')->name('headship.assign');

    // Manager
    Route::get('manager/index', 'ManagerController@index')->name('manager.index');
    Route::get('manager/search', 'ManagerController@search')->name('manager.search');
    Route::get('manager/{staff}/assign', 'ManagerController@assign')->name('manager.assign');

    // Report
	Route::get('report/create', 'ReportController@create')->name('report.create');
    Route::get('report/result', 'ReportController@result')->name('report.result');

    // Settings
    Route::get('settings', 'SettingsController@index')->name('settings.index');

});
