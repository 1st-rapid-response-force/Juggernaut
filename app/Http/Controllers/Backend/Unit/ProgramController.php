<?php

namespace App\Http\Controllers\Backend\Unit;

use App\Models\Unit\Program;
use App\Models\Unit\ProgramGoal;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::all();
        return view('backend.unit.programs.index',['programs'=> $programs]);
    }

    public function edit($id)
    {
        $program = Program::findOrFail($id);
        return view('backend.unit.programs.edit',['program'=> $program]);
    }

    public function update(Request $request,$id)
    {
        $program = Program::findOrFail($id);
        $program->update($request->all());

        if($request->hasFile('file'))
        {
            foreach ($request->file as $file)
            {
                $program->clearMediaCollection('attachments');
                $program->addMedia($file)->toCollection('attachments');
            }

        }


        flash('You updated your program!', 'success');
        return redirect()->back();
    }


    public function store(Request $request)
    {
        $program = Program::create($request->all());

        if($request->hasFile('file'))
        {
            foreach ($request->file as $file)
            {
                $program->addMedia($file)->toCollection('attachments');
            }

        }

        flash('You created a program!', 'success');
        return redirect()->back();
    }

    public function destroy($id, Request $request)
    {
        $program = Program::findOrFail($id);
        $program->delete();
        flash('You deleted a program!', 'success');
        return redirect()->back();
    }

    public function viewProgramGoals($id)
    {
        $program = Program::findOrFail($id);
        return view('backend.unit.programs.program-goals',['program'=> $program]);
    }

    public function editProgramGoal($program, $goal)
    {
        $program = Program::findOrFail($program);
        $goal = ProgramGoal::findOrFail($goal);

        return view('backend.unit.programs.program-goals-edit',['goal'=> $goal,'program' => $program]);
    }

    public function storeProgramGoal($id, Request $request)
    {
        $program = Program::findOrFail($id);
        $program->goals()->create($request->all());
        flash('You have created a program goal!', 'success');
        return redirect()->back();
    }

    public function updateProgramGoal($program, $goal, Request $request)
    {
        $program = Program::findOrFail($program);
        $goal = ProgramGoal::findOrFail($goal);

        $goal->update($request->all());
        flash('You have updated a program goal!', 'success');
        return redirect()->back();
    }

    public function deleteProgramGoal($program, $goal, Request $request)
    {
        $program = Program::findOrFail($program);
        $goal = ProgramGoal::findOrFail($goal);
        $goal->delete();
        flash('You deleted a program goal!', 'success');
        return redirect()->back();
    }
}
