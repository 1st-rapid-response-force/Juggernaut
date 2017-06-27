<?php

namespace App\Http\Controllers\Backend\Unit;

use App\Models\Unit\Award;
use App\Models\Unit\Member;
use App\Models\Unit\Rank;
use App\Models\Unit\Team;
use App\Models\Unit\ServiceHistory;
use App\Repositories\Frontend\Unit\Teamspeak\TeamspeakContract;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FileController extends Controller
{
    protected $ts;

    public function __construct(TeamspeakContract $ts)
    {
        $this->ts = $ts;
    }

    public function index()
    {
        $files = Member::all();
        return view('backend.unit.files.index', ['files' => $files]);
    }

    public function show($id)
    {
        $file = Member::findOrFail($id);
        $teams = Team::all();
        $ranks = Rank::all();
        return view('backend.unit.files.edit', ['file' => $file, 'teams' => $teams, 'ranks' => $ranks]);
    }

    public function update($id, Request $request)
    {
        $file = Member::findOrFail($id);
        $user = User::findOrFail($file->user->id);

        $file->update($request->member);
        $user->update($request->user);

        //Update teamspeak
        $this->ts->update($user);

        // Call Jobs
        //\Artisan::queue('member:avatar');
        \Artisan::queue('member:searchable');
        \Artisan::queue('member:squadxml');
        //\Artisan::queue('member:cac');

        flash('You updated a members file!', 'success');
        return redirect()->back();
    }

    public function addAward($id, Request $request)
    {
        $file = Member::findOrFail($id);
        $date = new Carbon($request->awarded_at);
        $file->awards()->attach($request->award_id,['note' => $request->note, 'awarded_at' => $date]);

        flash('You added an award to this members file!', 'success');
        return redirect()->back();
    }

    public function addQualification($id, Request $request)
    {
        $file = Member::findOrFail($id);
        $date = new Carbon($request->awarded_at);
        $file->qualifications()->attach($request->qualification_id,['note' => $request->note, 'awarded_at' => $date]);

        flash('You added an qualification to this members file!', 'success');
        return redirect()->back();
    }

    public function addTraining($id, Request $request)
    {

    }

    public function addRibbon($id, Request $request)
    {
        $file = Member::findOrFail($id);
        $date = new Carbon($request->awarded_at);
        $file->ribbons()->attach($request->ribbon_id,['note' => $request->note, 'awarded_at' => $date]);

        flash('You added an ribbon to this members file!', 'success');
        return redirect()->back();
    }

    public function addServiceHistory($id, Request $request)
    {
        $file = Member::findOrFail($id);
        $date = new Carbon($request->date);

        $serviceHistory = $file->serviceHistory()->create(['text'=> $request->text,'date'=> $date]);

        flash('You added a service history to this members file!', 'success');
        return redirect()->back();
    }
    public function deleteServiceHistory($id, $service,Request $request)
    {
        $file = Member::findOrFail($id);
        $service = ServiceHistory::findOrFail($service);
        $service->delete();

        flash('You deleted this service history entry!', 'success');
        return redirect()->back();
    }

    public function processDischarge($id, Request $request)
    {
        $file = Member::findOrFail($id);
        $date = new Carbon();

        // Record discharge change in Service History
        $serviceHistory = $file->serviceHistory()->create(['text'=> $request->discharge_type." from the 1st Rapid Response Force",'date'=> $date]);

        // Delete all Teamspeak IDs
        foreach($file->teamspeak as $ts)
        {
            $this->ts->delete($ts->uuid);
        }

        // Set Member info to discharged
        $file->team_id = 17;
        $file->active = 0;
        $file->rank_id = 1;
        $file->position = $request->discharge_type;
        $file->save();

        \Artisan::queue('member:searchable');
        \Artisan::queue('member:squadxml');

        $data = collect(['discharge_type'=> $request->discharge_type]);
        $this->emailDischarge($file->user, $data);

        flash('You have discharged this member','success');

        return redirect()->back();

    }

    private function emailDischarge($user,$data)
    {
        \Mail::send('emails.discharge', ['user' => $user,'data' =>$data], function ($m) use ($user,$data) {
            $m->to($user->email, $user->member);
            $m->subject('1st RRF - You have been discharged');
            $m->from('no-reply@1st-rrf.com','1st Rapid Response Force');
            $m->sender('no-reply@1st-rrf.com','1st Rapid Response Force');
        });
    }
}
