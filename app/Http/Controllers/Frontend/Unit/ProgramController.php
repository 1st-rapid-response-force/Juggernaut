<?php

namespace App\Http\Controllers\Frontend\Unit;

use App\Models\Unit\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProgramController extends Controller
{
    public function getMyProgram()
    {
        return view('frontend.program.my-program');
    }

    public function enrollInProgram(Request $request)
    {
        $user = \Auth::User();
        $program = Program::findOrFail($request->program_id);
        $user->member->current_program_id = $program->id;
        $user->push();

        flash('You have enrolled in this program.','success');
        return redirect()->back();
    }
}
