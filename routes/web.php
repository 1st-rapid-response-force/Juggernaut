<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
// Public Pages
Route::get('banned', 'Frontend\PageController@banned')->name('banned');

Route::get('/', 'Auth\SteamController@loginPage')->name('frontend.index');
Route::get('options', 'Auth\SteamController@loginPage')->name('frontend.index');

Route::group(['namespace' => 'Frontend','middleware' => ['web','forbid-banned-user']], function (){
    // Application
    Route::get('apply', 'ApplicationController@showApply')->name('frontend.apply');
    Route::group(['middleware' => ['auth']], function()
    {
        // Application
        Route::get('apply/completed', 'ApplicationController@successApplication')->name('frontend.apply.application.success');
        Route::get('apply/application', 'ApplicationController@showApplication')->name('frontend.apply.application');
        Route::post('apply', 'ApplicationController@postApplication')->name('frontend.apply.application.post');
    });

});

// Authentication Pages
Route::group(['namespace' => 'Auth','middleware' => ['web','forbid-banned-user']], function (){
    Route::get('auth/validate', 'SteamController@validateSteam')->name('auth.validate');
    Route::get('login', 'SteamController@loginPage')->name('auth.login');
    Route::post('register', 'SteamController@registerUser')->name('frontend.user.register.post');
    Route::get('auth/logout', 'SteamController@logout')->name('auth.logout');

});

// Authenticated Backend (Admin)
Route::group(['namespace' => 'Backend', 'middleware' => ['web','auth','admin','forbid-banned-user'], 'prefix' => 'admin'], function (){
    Route::get('/', ['as' => 'admin.index', 'uses' => 'DashboardController@index']);
    Route::get('/dashboard', ['as' => 'admin.dashboard', 'uses' => 'DashboardController@index']);

    Route::group(['namespace' => 'Unit\Application'], function (){
        Route::resource('applications', 'ApplicationController', ['as' => 'admin']);
        Route::get('applications/{id}/accept', 'ApplicationController@acceptApplicant')->name('admin.applications.accept');
        Route::get('applications/{id}/decline', 'ApplicationController@declineApplicant')->name('admin.applications.decline');
    });

    Route::group(['namespace' => 'Unit\Calendar'], function (){
        Route::resource('calendar', 'CalendarController', ['except' => ['show','create'], 'as' => 'admin']);
        Route::get('create/event', 'CalendarController@createEvent')->name('admin.calendar.create.event');
        Route::get('create/school', 'CalendarController@createSchool')->name('admin.calendar.create.school');
        Route::get('create/training', 'CalendarController@createTraining')->name('admin.calendar.create.training');
    });

    Route::group(['namespace' => 'Unit', 'prefix'=>'unit'], function (){
        Route::post('members/{id}/add-award', 'FileController@addAward')->name('admin.members.edit.add-award');
        Route::post('members/{id}/add-qualification', 'FileController@addQualification')->name('admin.members.edit.add-qualification');
        Route::post('members/{id}/add-training', 'FileController@addTraining')->name('admin.members.edit.add-training');
        Route::post('members/{id}/add-ribbon', 'FileController@addRibbon')->name('admin.members.edit.add-ribbon');
        Route::post('members/{id}/process-discharge', 'FileController@processDischarge')->name('admin.members.edit.process-discharge');
        Route::post('members/{id}/add-service-history', 'FileController@addServiceHistory')->name('admin.members.edit.add-service-history');
        Route::delete('members/{id}/service-history/{service}', 'FileController@deleteServiceHistory')->name('admin.members.edit.delete-service-history');
        Route::get('members/not-active', 'FileController@indexNotActive')->name('admin.members.index.notactive');
        Route::resource('members', 'FileController', ['as' => 'admin']);

        Route::get('promotions', 'PromotionController@index')->name('admin.promotions');


        Route::delete('programs/{program}/goals/{goal}/delete', 'ProgramController@deleteProgramGoal')->name('admin.programs.program-goals.delete');
        Route::get('programs/{id}/goals/{goal}', 'ProgramController@editProgramGoal')->name('admin.programs.program-goals.edit');
        Route::put('programs/{id}/goals/{goal}', 'ProgramController@updateProgramGoal')->name('admin.programs.program-goals.put');
        Route::get('programs/{id}/goals', 'ProgramController@viewProgramGoals')->name('admin.programs.program-goals');
        Route::post('programs/{id}/goals', 'ProgramController@storeProgramGoal')->name('admin.programs.program-goals.post');


        Route::delete('operations/{id}/attachment/{attachment_id}', 'OperationController@deleteAttachment')->name('admin.operations.attachment.destroy');
        Route::get('operations/{id}/frago/{frago}', 'OperationController@editFrago')->name('admin.operations.frago.edit');
        Route::post('operations/{id}/frago', 'OperationController@storeFrago')->name('admin.operations.frago.store');
        Route::put('operations/{id}/frago/{frago}', 'OperationController@updateFrago')->name('admin.operations.frago.update');
        Route::delete('operations/{id}/frago/{frago}', 'OperationController@deleteFrago')->name('admin.operations.frago.destroy');

        Route::resource('announcements', 'AnnouncementController', ['as' => 'admin']);
        Route::resource('perstat', 'PerstatController', ['as' => 'admin']);
        Route::resource('programs', 'ProgramController', ['as' => 'admin']);
        Route::resource('loadouts', 'LoadoutController', ['as' => 'admin']);
        Route::resource('operations', 'OperationController', ['as' => 'admin']);
        Route::resource('awards', 'AwardController', ['as' => 'admin']);
        Route::resource('ribbons', 'RibbonController', ['as' => 'admin']);
        Route::resource('qualifications', 'QualificationController', ['as' => 'admin']);
        Route::resource('paperwork', 'PaperworkController', ['as' => 'admin']);
        Route::resource('change-requests', 'ChangeController', ['as' => 'admin']);
        Route::resource('teams', 'TeamController', ['as' => 'admin']);
        Route::resource('missions', 'MissionController', ['as' => 'admin']);
        Route::resource('assignments', 'ChangeController', ['as' => 'admin']);
    });
});
