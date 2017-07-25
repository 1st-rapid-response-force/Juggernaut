<?php

namespace App\Http\Controllers\Backend\Unit;

use App\Models\Unit\Mission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MissionController extends Controller
{
    public function index()
    {
        $missions = Mission::all();
        return view('backend.unit.missions.index',['missions' => $missions]);
    }

    public function store(Request $request)
    {
        //dd($request);
        $checksum = md5_file($request->file('mission'));
        $mission = Mission::create(['name' => $request->name, 'checksum' => $checksum, 'user_id' =>\Auth::User()->id]);

        if($request->hasFile('mission')) {
            $mission->clearMediaCollection('mission');
            $mission->addMedia($request->file('mission'))->toCollection('mission');
        }

        flash('You have uploaded the mission!', 'success');
        return redirect()->back();
    }

    public function edit($id)
    {
        $mission = Mission::findOrFail($id);
        return view('backend.unit.missions.edit',['mission' => $mission]);
    }

    public function update($id, Request $request)
    {
        $mission = Mission::findOrFail($id);
        $mission->update(['name' => $request->name]);

        if($request->hasFile('mission')) {
            $mission->clearMediaCollection('mission');
            $mission->addMedia($request->file('mission'))->toCollection('mission');
            $checksum = md5_file($request->file('mission'));
            $mission->update(['checksum' => $checksum, 'user_id' => \Auth::User()->id]);
        }

        flash('You have updated the mission!', 'success');
        return redirect()->back();

    }

    public function destroy($id, Request $request){
        $mission = Mission::findOrFail($id);
        $mission->delete();

        flash('You have deleted the mission!', 'success');
        return redirect()->back();
    }

    public function getMissionsAPI()
    {
        $missions = Mission::all();
        return response()->json($missions->toArray());
    }
}
