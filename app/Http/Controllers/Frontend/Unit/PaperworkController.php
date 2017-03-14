<?php

namespace App\Http\Controllers\Frontend\Unit;

use App\Models\Unit\Paperwork;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PaperworkController extends Controller
{
    public function showPaperwork($id)
    {
        $paperwork = Paperwork::findOrFail($id);

        switch ($paperwork->type){
            case 'training':
                break;
            case 'file-correction':
                break;
            case 'loa-request':
                break;
            case 'assignment-change':
                break;
            case 'bad-conduct':
                break;
            case 'discharge':
                break;
            case 'flight-plan':
                return view('frontend.paperwork.aviation.flight-plan.edit', ['paperwork' => $paperwork]);
                break;

        }
    }

    public function showDischargeForm()
    {
        return view('frontend.paperwork.discharge.new');
    }

    public function storeDischargeForm(Request $request)
    {
        $form = collect($request->except('_token'));
        $paperwork = \Auth::User()->member->paperwork()->create(['type'=>'discharge','paperwork'=> $form->toJson()]);
        flash('Discharge Application has been filed, we will notify you via email.', 'success');
        return redirect(route('frontend.files.my-file'));
    }

    public function showFileCorrectionForm()
    {
        return view('frontend.paperwork.file-correction.new');
    }

    public function storeFileCorrectionForm(Request $request)
    {
        $form = collect($request->except('_token'));
        $paperwork = \Auth::User()->member->paperwork()->create(['type'=>'file-correction','paperwork'=> $form->toJson()]);
        flash('File Correction form has been filed, We will contact you soon regarding this form.', 'success');
        return redirect(route('frontend.files.my-file'));
    }

    public function showBadConductForm()
    {
        return view('frontend.paperwork.bad-conduct.new');
    }

    public function storeBadConductForm(Request $request)
    {
        $form = collect($request->except('_token'));
        $paperwork = \Auth::User()->member->paperwork()->create(['type'=>'bad-conduct','paperwork'=> $form->toJson()]);
        flash('Bad Conduct Form has been filed, We will contact you soon regarding this form.', 'success');
        return redirect(route('frontend.files.my-file'));
    }

    public function showLeaveForm()
    {
        return view('frontend.paperwork.leave.new');
    }

    public function storeLeaveForm(Request $request)
    {
        $form = collect($request->except('_token'));
        $paperwork = \Auth::User()->member->paperwork()->create(['type'=>'leave','paperwork'=> $form->toJson()]);
        flash('Your Leave of Absence Request has been filed, We will contact you soon regarding this form.', 'success');
        return redirect(route('frontend.files.my-file'));
    }

    public function showFlightPlanForm()
    {
        return view('frontend.paperwork.aviation.flight-plan.new');
    }

    public function storeFlightPlanForm(Request $request)
    {
        $form = collect($request->except('_token'));
        $paperwork = \Auth::User()->member->paperwork()->create(['type'=>'flight-plan','paperwork'=> $form->toJson()]);
        flash('Your Flight Plan has been filed, it is now visible to the ATC.', 'success');
        return redirect(route('frontend.files.my-file'));
    }

    public function updateFlightPlanForm(Request $request, $id)
    {
        $form = collect($request->except('_token'));
        $paperwork = Paperwork::findOrFail($id);
        $paperwork->update(['type'=>'flight-plan','paperwork'=> $form->toJson()]);
        flash('Your Flight Plan has been updated, it is now visible to the ATC.', 'success');
        return redirect()->back();
    }
}
