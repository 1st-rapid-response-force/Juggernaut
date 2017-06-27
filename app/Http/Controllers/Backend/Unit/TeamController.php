<?php

namespace App\Http\Controllers\Backend\Unit;

use App\Models\Unit\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        return view('backend.unit.teams.index',['teams'=> $teams]);
    }

    public function edit($id)
    {
        $team = Team::findOrFail($id);
        return view('backend.unit.teams.edit', ['team'=> $team]);
    }

    public function update($id, Request $request)
    {
        $team = $team = Team::findOrFail($id)->update($request->all());
        flash('You updated a team!', 'success');
        return redirect()->back();
    }

    public function store(Request $request)
    {
        $team = Team::create(['name' => $request->name]);
        $team->leader_id = $request->leader_id;
        $team->parent_id = $request->parent_id;
        $team->save();
        flash('You created a team!', 'success');
        return redirect()->back();
    }
}
