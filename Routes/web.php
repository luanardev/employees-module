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
    Route::get('staff/create', 'EmployeeController@create')->name('employee.create');
    Route::get('staff/create/finish', 'EmployeeController@finish')->name('employee.finish');
    Route::get('staff/create/cancel', 'EmployeeController@cancel')->name('employee.cancel');
    
    // Staff
    Route::get('staff/index', 'EmployeeController@index')->name('employee.index');
    Route::get('staff/search', 'EmployeeController@search')->name('employee.search');
    Route::get('staff/{employee}', 'EmployeeController@show')->name('employee.show');
    Route::get('staff/{employee}/delete', 'EmployeeController@destroy')->name('employee.destroy');

    // Identity
    Route::get('identity/search', 'IdentityController@search')->name('identity.search');
    Route::get('identity/{employee}', 'IdentityController@show')->name('identity.show');
    Route::get('identity/{employee}/get-card', 'IdentityController@card')->name('identity.card');

    // Employment
    Route::get('staff/{employee}/promote', 'EmploymentController@promote')->name('employee.promote');
    Route::get('staff/{employee}/confirm', 'EmploymentController@confirm')->name('employee.confirm');
    Route::get('staff/{employee}/contract', 'EmploymentController@contract')->name('employee.contract');

    // Exporter
    Route::get('staff/{employee}/export', 'EmployeeController@export')->name('employee.export');

    // Importer
    Route::get('importer/template', 'ImporterController@template')->name('employee.template');
    Route::get('importer/import', 'ImporterController@import')->name('employee.import');

    // Appointment
    Route::get('appointment/index', 'AppointmentController@index')->name('appointment.index');
    Route::get('appointment/search', 'AppointmentController@search')->name('appointment.search');
    Route::get('appointment/{employee}/create', 'AppointmentController@create')->name('appointment.create');

     // Report
	Route::get('report/create', 'ReportController@create')->name('report.create');
    Route::get('report/result', 'ReportController@result')->name('report.result');

    // Settings
    Route::get('settings', 'SettingsController@index')->name('settings.index');

});
