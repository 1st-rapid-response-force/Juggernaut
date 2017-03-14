<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Unit\Teamspeak;
use App\Repositories\Frontend\Unit\Teamspeak\TeamspeakContract;
use Illuminate\Database\QueryException;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $ts;

    public function __construct(TeamspeakContract $ts)
    {
        $this->ts = $ts;
    }

    public function settings()
    {
        return view('frontend.user.settings');
    }

    public function postSettings(Request $request)
    {
        $user = \Auth::User();
        $user->update($request->except(['_token','bio']));
        $user->member()->update(['bio' => $request->get('bio')]);

        // Call Jobs
        \Artisan::call('member:avatar');
        \Artisan::call('member:searchable');
        \Artisan::call('member:squadxml');
        \Artisan::call('member:cac');

        flash('Settings updated','success');
        return redirect()->back();
    }

    public function teamspeak()
    {
        return view('frontend.user.teamspeak');
    }

    public function postTeamspeak(Request $request)
    {
        $this->validate($request, [
            'description' => 'required|string',
            'uuid' => 'required|string',
        ]);

        $user = \Auth::User();

        try {
            $ts =  $user->member->teamspeak()->create([
                'description' => $request->description,
                'uuid' => $request->uuid
            ]);
        } catch (QueryException $e) {
            flash('You must have a unique UUID in order to save this value.','error');
            return redirect()->back();
        }
        $attempt = $this->ts->update($user);

        if($attempt['success'] == false)
        {
            $ts->delete();
            flash($attempt['message'].' - UUID has been removed.','danger');
            return redirect()->back();
        }

        flash('Teamspeak UUID added successfully, update has been pushed to teamspeak server','success');
        return redirect()->back();

    }

    public function deleteTeamspeak($id, Request $request)
    {
        $user = \Auth::user();
        try {
            $ts = Teamspeak::findOrFail($id);
        } catch (QueryException $e) {
            flash('This is not a valid Teamspeak ID to delete.','danger');
            return redirect()->back();
        }
        //Is this the users id?
        if(!$ts->member_id == $user->member->id)
        {
            flash('This is not your Teamspeak ID, you cannot delete it! Action has been logged and reported','danger');
            return redirect()->back();
        }
        $this->ts->delete($ts->uuid);
        $ts->delete();
        flash('Teamspeak UUID removed successfully','success');
        return redirect()->back();
    }
}
