<?php

namespace App\Http\Controllers\Backend\Unit;

use App\Models\Unit\Paperwork;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PaperworkController extends Controller
{
    public function index()
    {
        $paperwork = Paperwork::all();
        return view('backend.paperwork.index',['paperwork' => $paperwork]);
    }

    public function showProgramCompletionForm()
    {
        return view('backend.paperwork.program-completion.new');
    }

    public function storeProgramCompletionForm(Request $request)
    {
        $form = collect($request->except('_token'));
        $paperwork = \Auth::User()->member->paperwork()->create(['type'=>'discharge','paperwork'=> $form->toJson()]);
        flash('Discharge Application has been filed, we will notify you via email.', 'success');
        return redirect(route('frontend.files.my-file'));
    }

    public function reviewFlightPlan(Request $request)
    {

    }

}
