<?php

namespace App\Http\Controllers\Backend\Unit;

use App\Models\Unit\Mission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MissionController extends Controller
{
    public function index()
    {
        $missions = Mission::all();
        $hour = Carbon::now();
        $hour->second = 0;
        $hour->minute = 0;
        $hour->addHour(1);
        $deploy = false;

        $missions = Mission::whereDeploy(1)->get();

        if($missions->count() > 0)
            $deploy = true;

        return view('backend.unit.missions.index',['missions' => $missions,'deploymentTime' => $hour,'deploy' => $deploy]);
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
            $mission->update(['checksum' => $checksum, 'user_id' => \Auth::User()->id, 'deploy' => 1]);
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

    public function getMissionDeployStatusAPI()
    {
        $missions = Mission::whereDeploy(1)->get();

        if($missions->count() > 0)
            return response()->json(["deploy" => true]);

        return response()->json(["deploy" => false]);
    }

    public function setMissionDeployStatusAPI(Request $request)
    {
        if($request->RRF_DEPLOYMENT_KEY == env('RRF_DEPLOYMENT_KEY',''))
        {
            // If pinged by server, deploy status will be set to false
            $missions = Mission::whereDeploy(1)->update(['deploy' => 0]);
            return response()->json(["status" => 1, "message" => 'DEPLOYMENT SET']);
        } else {
            return response()->json(["status" => 0, "message" => "RRF_DEPLOYMENT_KEY INVALID"]);
        }

    }
}
