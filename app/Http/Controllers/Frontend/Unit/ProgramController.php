<?php

namespace App\Http\Controllers\Frontend\Unit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProgramController extends Controller
{
    public function getMyProgram()
    {
        return view('frontend.program.my-program');
    }
}
