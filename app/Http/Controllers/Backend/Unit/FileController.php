<?php

namespace App\Http\Controllers\Backend\Unit;

use App\Models\Unit\Award;
use App\Models\Unit\Member;
use App\Models\Unit\Rank;
use App\Models\Unit\Team;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FileController extends Controller
{
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

        // Call Jobs
        \Artisan::call('member:avatar');
        \Artisan::call('member:searchable');
        \Artisan::call('member:squadxml');
        \Artisan::call('member:cac');

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
}
