<?php

namespace App\Http\Controllers\Frontend\Unit;

use App\Models\Unit\Paperwork;
use Illuminate\Http\Request;
use App\Models\Unit\Team;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PaperworkController extends Controller
{
    public function showPaperwork($id)
    {
        $paperwork = Paperwork::findOrFail($id);

        switch ($paperwork->type){
            case 'training':
                flash('You cannot view this paperwork at the moment.','warning');
                return redirect()->back();
                break;
            case 'file-correction':
                flash('You cannot view this paperwork at the moment.','warning');
                return redirect()->back();
                break;
            case 'loa-request':
                flash('You cannot view this paperwork at the moment.','warning');
                return redirect()->back();
                break;
            case 'assignment-change':
                flash('You cannot view this paperwork at the moment.','warning');
                return redirect()->back();
                break;
            case 'bad-conduct':
                flash('You cannot view this paperwork at the moment.','warning');
                return redirect()->back();
                break;
            case 'discharge':
                flash('You cannot view this paperwork at the moment.','warning');
                return redirect()->back();
                break;
            case 'aar':
                flash('You cannot view this paperwork at the moment.','warning');
                return redirect()->back();
                break;
            case 'program-completion':
                return view('frontend.paperwork.program-completion.show',['form' => $paperwork]);
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
        \Log::info('User filled out discharge paperwork', ['user_id' => \Auth::User()->id,'member' => \Auth::User()->member->searchable_name, 'paperwork_id' => $paperwork]);
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
        \Log::info('User filled out file correction paperwork', ['user_id' => \Auth::User()->id,'member' => \Auth::User()->member->searchable_name, 'paperwork_id' => $paperwork]);
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
        \Log::info('User filled out bad conduct paperwork', ['user_id' => \Auth::User()->id,'member' => \Auth::User()->member->searchable_name, 'paperwork_id' => $paperwork]);
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
        \Log::info('User filled out leave of absence paperwork', ['user_id' => \Auth::User()->id,'member' => \Auth::User()->member->searchable_name, 'paperwork_id' => $paperwork]);
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
        \Log::info('User filled out flight plan paperwork', ['user_id' => \Auth::User()->id,'member' => \Auth::User()->member->searchable_name, 'paperwork_id' => $paperwork]);
        return redirect(route('frontend.files.my-file'));
    }

    public function updateFlightPlanForm(Request $request, $id)
    {
        $form = collect($request->except('_token'));
        $paperwork = Paperwork::findOrFail($id);
        $paperwork->update(['type'=>'flight-plan','paperwork'=> $form->toJson()]);
        \Log::info('User updated flight-plan paperwork', ['user_id' => \Auth::User()->id,'member' => \Auth::User()->member->searchable_name, 'paperwork_id' => $paperwork]);
        flash('Your Flight Plan has been updated, it is now visible to the ATC.', 'success');
        return redirect()->back();
    }

    public function showAfterActionReport($id)
    {
        $team = Team::findOrFail($id);
        return view('frontend.paperwork.aar.new', ['team' => $team]);
    }

    public function storeAfterActionReport($id, Request $request)
    {
        $form = collect($request->except('_token'));
        $paperwork = \Auth::User()->member->paperwork()->create(['type'=>'aar','paperwork'=> $form->toJson(),'team_id' => $request->team_id]);
    }
}
