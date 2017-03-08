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
    Route::get('our-mission', 'PageController@mission')->name('frontend.mission');
    Route::get('our-history', 'PageController@history')->name('frontend.history');
    Route::get('our-process', 'PageController@process')->name('frontend.process');
    Route::get('infil', 'PageController@infil')->name('frontend.infil');
});

// Authentication Pages
Route::group(['namespace' => 'Auth','middleware' => 'web'], function (){
    Route::get('auth/validate', 'SteamController@validateSteam')->name('auth.validate');
    Route::get('login', 'SteamController@loginPage')->name('auth.login');
    Route::get('auth/logout', 'SteamController@logout')->name('auth.logout');


});


// Authenticated Frontend
Route::group(['namespace' => 'Frontend', 'middleware' => ['web','auth']], function (){
    //Report in Check
    Route::group(['namespace' => 'Unit','middleware' => ['auth']], function()
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

    Route::group(['namespace' => 'Unit\Calendar'], function (){
        Route::resource('calendar', 'CalendarController', ['except' => ['show','create'], 'as' => 'admin']);
        /**
         * Award Status'
         */
        Route::get('create/event', 'CalendarController@createEvent')->name('admin.calendar.create.event');
        Route::get('create/school', 'CalendarController@createSchool')->name('admin.calendar.create.school');
        Route::get('create/training', 'CalendarController@createTraining')->name('admin.calendar.create.training');
    });



});