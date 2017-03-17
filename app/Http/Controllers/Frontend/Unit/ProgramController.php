<?php

namespace App\Http\Controllers\Frontend\Unit;

use App\Models\Unit\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProgramController extends Controller
{
    public function getMyProgram()
    {
        \Log::info('User viewed my program page', ['user_id' => \Auth::User()->id, 'member' => \Auth::User()->member->searchable_name, 'program_id' => \Auth::User()->member->program->id, 'program' => \Auth::User()->member->program->name]);
        return view('frontend.program.my-program');
    }

    public function enrollInProgram(Request $request)
    {
        $user = \Auth::User();
        $program = Program::findOrFail($request->program_id);
        $user->member->current_program_id = $program->id;
        $user->push();

        \Log::info('User enrolled into program', ['user_id' => \Auth::User()->id,'member' => \Auth::User()->member->searchable_name, 'program_id' => $program->id, 'program' => $program->name]);
        flash('You have enrolled in this program.','success');
        return redirect()->back();
    }
}
