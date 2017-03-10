<?php

namespace App\Http\Controllers\Backend\Unit;

use App\Models\Unit\Program;
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
}
