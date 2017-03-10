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
Route::group(['namespace' => 'Frontend','middleware' => 'web'], function (){
    Route::get('/', 'PageController@home')->name('frontend.index');

    // Team
    Route::get('team/{team}', 'PageController@team')->name('frontend.team');
    Route::get('team/{team}/members', 'Unit\TeamController@members')->name('frontend.team.members');
    Route::get('team/{team}/videos', 'Unit\TeamController@videos')->name('frontend.team.videos');
    Route::get('team/{team}/videos/{video}', 'Unit\TeamController@viewVideo')->name('frontend.team.videos.view');
    Route::get('team/{team}/leader', 'Unit\TeamController@leader')->name('frontend.team.leader');
    Route::get('team/{team}/leader/add-video', 'Unit\TeamController@addVideo')->name('frontend.team.leader.add-video');
    Route::get('team/{team}/leader/video/{video_id}/edit-video', 'Unit\TeamController@editVideo')->name('frontend.team.leader.edit-video');
    Route::post('team/{team}/leader/update-header', 'Unit\TeamController@updateTeamHeader')->name('frontend.team.leader.update-header');
    Route::post('team/{team}/leader/new-timeline-event', 'Unit\TeamController@newEvent')->name('frontend.team.leader.new-timeline-event');
    Route::post('team/{team}/leader/add-video', 'Unit\TeamController@addVideoPost')->name('frontend.team.leader.add-video.post');
    Route::delete('team/{team}/leader/timeline/{timeline_id}/delete', 'Unit\TeamController@deleteTimelineEvent')->name('frontend.team.leader.delete-timeline-event');
    Route::post('team/{team}/leader/video/{video_id}/edit-video', 'Unit\TeamController@editVideoPost')->name('frontend.team.leader.edit-video.post');

    // File
    Route::get('files/my-file', 'Unit\FileController@getMyFile')->name('frontend.files.my-file');
    Route::get('files/my-face', 'Unit\FileController@showFaces')->name('frontend.files.faces');
    Route::post('files/my-face', 'Unit\FileController@saveFace')->name('frontend.files.faces.post');
    Route::get('files/{id}', 'Unit\FileController@getFile')->name('frontend.files.file');

    Route::get('our-mission', 'PageController@mission')->name('frontend.mission');
    Route::get('our-history', 'PageController@history')->name('frontend.history');
    Route::get('our-process', 'PageController@process')->name('frontend.process');
    Route::get('infil', 'PageController@infil')->name('frontend.infil');

    // Application
    Route::get('apply', 'ApplicationController@showApply')->name('frontend.apply');
    Route::group(['middleware' => ['auth']], function()
    {
        // Application
        Route::get('apply/completed', 'ApplicationController@successApplication')->name('frontend.apply.application.success');
        Route::get('apply/{type}', 'ApplicationController@showApplication')->name('frontend.apply.application');

        Route::post('apply', 'ApplicationController@postApplication')->name('frontend.apply.application.post');
    });

});

// Authentication Pages
Route::group(['namespace' => 'Auth','middleware' => 'web'], function (){
    Route::get('auth/validate', 'SteamController@validateSteam')->name('auth.validate');
    Route::get('login', 'SteamController@loginPage')->name('auth.login');
    Route::post('register', 'SteamController@registerUser')->name('frontend.user.register.post');
    Route::get('auth/logout', 'SteamController@logout')->name('auth.logout');

});


// Authenticated Frontend
Route::group(['namespace' => 'Frontend', 'middleware' => ['web','auth']], function (){
    //Report in Check
    Route::group(['namespace' => 'Unit'], function()
    {
        //My Inbox
        Route::get('/my-inbox', ['as' => 'inbox', 'uses' => 'myInboxController@index']);
        Route::get('/my-inbox/create', ['as' => 'inbox.create', 'uses' => 'myInboxController@create']);
        Route::post('/my-inbox', ['as' => 'inbox.store', 'uses' => 'myInboxController@store']);
        Route::get('/my-inbox/{id}', ['as' => 'inbox.show', 'uses' => 'myInboxController@show']);
        Route::put('/my-inbox/{id}', ['as' => 'inbox.update', 'uses' => 'myInboxController@update']);
        Route::post('/my-inbox/delete', ['as' => 'inbox.removeThreads', 'uses' => 'myInboxController@deleteInboxThreads']);
        Route::get('/my-inbox/edit-message/{id}', ['as' => 'inbox.edit.message', 'uses' => 'myInboxController@editMessage']);
        Route::put('/my-inbox/edit-message/{id}', ['as' => 'inbox.edit.message.update', 'uses' => 'myInboxController@editMessageSave']);

        //Paperwork
        Route::get('paperwork/discharge', ['as' => 'frontend.paperwork.discharge', 'uses' => 'PaperworkController@showDischargeForm']);
        Route::post('paperwork/discharge', ['as' => 'frontend.paperwork.discharge.post', 'uses' => 'PaperworkController@storeDischargeForm']);
        Route::get('paperwork/file-correction', ['as' => 'frontend.paperwork.file-correction', 'uses' => 'PaperworkController@showFileCorrectionForm']);
        Route::post('paperwork/file-correction', ['as' => 'frontend.paperwork.file-correction.post', 'uses' => 'PaperworkController@storeFileCorrectionForm']);
        Route::get('paperwork/bad-conduct', ['as' => 'frontend.paperwork.bad-conduct', 'uses' => 'PaperworkController@showBadConductForm']);
        Route::post('paperwork/bad-conduct', ['as' => 'frontend.paperwork.bad-conduct.post', 'uses' => 'PaperworkController@storeBadConductForm']);
        Route::get('paperwork/leave', ['as' => 'frontend.paperwork.leave', 'uses' => 'PaperworkController@showLeaveForm']);
        Route::post('paperwork/leave', ['as' => 'frontend.paperwork.leave.post', 'uses' => 'PaperworkController@storeLeaveForm']);


        Route::get('paperwork/{id}/view', ['as' => 'frontend.paperwork.show', 'uses' => 'PaperworkController@showPaperwork']);

    });

    Route::get('settings', ['as' => 'frontend.settings', 'uses' => 'UserController@settings']);
    Route::get('settings/teamspeak', ['as' => 'frontend.settings.teamspeak', 'uses' => 'UserController@teamspeak']);
    Route::delete('settings/teamspeak/{id}/delete', ['as' => 'frontend.settings.teamspeak.delete', 'uses' => 'UserController@deleteTeamspeak']);
    Route::post('settings/teamspeak', ['as' => 'frontend.settings.teamspeak.post', 'uses' => 'UserController@postTeamspeak']);
    Route::post('settings', ['as' => 'frontend.settings.post', 'uses' => 'UserController@postSettings']);

    Route::get('calendar', 'PageController@calendar')->name('frontend.calendar');
    Route::post('calendar', 'PageController@setCalendar')->name('frontend.calendar.timezone');




    //Auto-Complete
    Route::get('autocomplete/members', 'AutoCompleteController@getMembers');
});

// Authenticated Backend (Admin)
Route::group(['namespace' => 'Backend', 'middleware' => ['web','auth','admin'], 'prefix' => 'admin'], function (){
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
        Route::post('members/{id}/add-service-history', 'FileController@addServiceHistory')->name('admin.members.edit.add-service-history');
        Route::resource('members', 'FileController', ['as' => 'admin']);


        Route::resource('programs', 'ProgramController', ['as' => 'admin']);
        Route::resource('awards', 'AwardController', ['as' => 'admin']);
        Route::resource('ribbons', 'RibbonController', ['as' => 'admin']);
        Route::resource('qualifications', 'QualificationController', ['as' => 'admin']);
    });

    Route::group(['namespace' => 'Unit', 'prefix'=>'paperwork'], function (){
        Route::get('program-completion', 'PaperworkController@showProgramCompletionForm')->name('admin.paperwork.program-completion');
        Route::post('program-completion', 'PaperworkController@storeProgramCompletionForm')->name('admin.paperwork.program-completion.post');
    });



});