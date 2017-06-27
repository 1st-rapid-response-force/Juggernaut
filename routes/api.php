<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('loadout/{steam_id}', 'Frontend\Unit\LoadoutController@getLoadoutAPI')->name('api.loadout.get');



Route::group(['middleware' => ['auth:api']], function (){
    Route::get('teams/{id}/members', 'Backend\API\TeamController@getTeamMembers')->name('api.team.members.get');
    Route::get('teams/{id}/members/{assignment_id}', 'Backend\API\TeamController@getAssignmentMembers')->name('api.team.assignments.members.get');
    Route::post('teams/{id}/members/{assignment_id}', 'Backend\API\TeamController@updateAssignmentMembers')->name('api.team.assignments.members.update');
    Route::get('teams/{id}/assignments', 'Backend\API\TeamController@getAssignments')->name('api.team.assignments.get');
    Route::post('teams/{id}/assignments', 'Backend\API\TeamController@storeAssignment')->name('api.team.assignments.store');
    Route::post('teams/{id}/assignments/ordering', 'Backend\API\TeamController@updateOrdering')->name('api.team.assignments.ordering.store');
    Route::post('teams/{id}/assignments/{assignment_id}', 'Backend\API\TeamController@updateAssignment')->name('api.team.assignments.update');
    Route::delete('teams/{id}/assignments/{assignment_id}', 'Backend\API\TeamController@revokeAssignment')->name('api.team.assignments.delete');
    Route::get('teams', 'Backend\API\TeamController@getTeams')->name('api.team');
});