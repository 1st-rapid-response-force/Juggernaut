<?php

namespace App\Http\Controllers\Backend\API;

use App\Models\Unit\Assignment;
use App\Models\Unit\Member;
use App\Models\Unit\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{
    // TODO: Need to add auth to this API via request
    public function getAssignments($id)
    {
        $team = Team::findOrFail($id);
        return response()->json($team->assignments()->orderBy('order')->get()->toArray());
    }

    public function storeAssignment($id, Request $request)
    {
        $team = Team::findOrFail($id);
        if(!$team->isLeader(\Auth::User()))
        {
            return response()->json('',200);
        }
        $assignment = Assignment::create($request->all());
        return response()->json($assignment->toArray());
    }

    public function revokeAssignment($id, $assignment_id,Request $request)
    {
        $team = Team::findOrFail($id);
        if(!$team->isLeader(\Auth::User()))
        {
            return response()->json('',200);
        }

        // Cleanup
        $members = Member::where('assignment_id',$assignment_id)->get();
        foreach ($members as $member)
        {
            $member->assignment_id = 1;
            $member->save();
        }

        $assignment = Assignment::findOrFail($assignment_id);
        $assignment->delete();
        return response()->json(null,204);
    }

    public function updateOrdering($id, Request $request)
    {
        $team = Team::findOrFail($id);
        if(!$team->isLeader(\Auth::User()))
        {
            return response()->json('',200);
        }
        $order = 1;
        foreach($request->assignments as $assignment)
        {
            $assignment = Assignment::findOrFail($assignment);
            $assignment->order = $order;
            $assignment->save();
            $order++;
        }

    }

    public function updateAssignment($id, $assignment_id, Request $request)
    {
        $team = Team::findOrFail($id);
        if(!$team->isLeader(\Auth::User()))
        {
            return response()->json('',200);
        }
        $assignment = Assignment::findOrFail($assignment_id);
        $assignment->update(['name' => $request->name]);
    }

    public function getTeams()
    {
        $teams = Team::all();
        return response()->json($teams->toArray());
    }

    public function getTeamMembers($id)
    {
        $team = Team::findOrFail($id);
        return response()->json($team->members->toArray());
    }

    public function getAssignmentMembers($id, $assignment_id)
    {
        $assignment = Assignment::findOrFail($assignment_id);
        return response()->json($assignment->members()->pluck('id')->toArray());
    }

    public function updateAssignmentMembers($id, $assignment_id, Request $request)
    {
        $team = Team::findOrFail($id);
        if(!$team->isLeader(\Auth::User()))
        {
            return response()->json('',200);
        }
        // We know we will receive a variable for members
        $assignment = Assignment::findOrFail($assignment_id);
        foreach($request->members as $member_id)
        {
            $member = Member::findOrFail($member_id);
            $member->assignment_id = $assignment->id;
            $member->save();
        }
    }
}

