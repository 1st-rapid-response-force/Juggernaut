<?php

namespace App\Http\Controllers\Frontend\Unit;

use App\Models\Unit\Member;
use App\Models\Unit\Paperwork;
use App\Models\Unit\PaperworkMessage;
use Illuminate\Http\Request;
use App\Models\Unit\Team;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PaperworkController extends Controller
{
    public function showPaperwork($id)
    {
        $paperwork = Paperwork::findOrFail($id);

        switch ($paperwork->type) {
            case 'training':
                flash('You cannot view this paperwork at this moment.', 'warning');
                return redirect()->back();
                break;
            case 'file-correction':
                return view('frontend.paperwork.file-correction.show', ['form' => $paperwork]);
                break;
            case 'leave':
                return view('frontend.paperwork.leave.show', ['form' => $paperwork]);
                break;
            case 'change-request':
                return view('frontend.paperwork.change-request.show', ['form' => $paperwork]);
                break;
            case 'assignment-change':
                flash('You cannot view this paperwork at this moment.', 'warning');
                return redirect()->back();
                break;
            case 'bad-conduct':
                // Checks if user viewing content has access to the report - Leadership and Admin
                $team = Team::findOrFail($paperwork->disciplinary_team_id);
                $leader = Team::all()->pluck('leader_id')->contains(\Auth::User()->id);

                if(!(\Auth::User()->admin || $leader))
                {
                    flash('You do not have permission to access this.', 'danger');
                    return redirect()->back();
                }
                return view('frontend.paperwork.bad-conduct.show', ['form' => $paperwork]);
                break;
            case 'discharge':
                flash('You cannot view this paperwork at the moment.', 'warning');
                return redirect()->back();
                break;
            case 'aar':
                return view('frontend.paperwork.aar.show', ['form' => $paperwork]);
                break;
            case 'program-completion':
                return view('frontend.paperwork.program-completion.show', ['form' => $paperwork]);
                break;
            case 'flight-plan':
                $date = new Carbon($paperwork->getPaperwork()->date);
                $now = new Carbon();

                if ($date->addDay(1) > $now) {
                    return view('frontend.paperwork.aviation.flight-plan.edit', ['paperwork' => $paperwork]);
                } else {
                    return view('frontend.paperwork.aviation.flight-plan.show', ['paperwork' => $paperwork]);
                }
                break;
            default:
                flash('You cannot view this paperwork at this moment.', 'warning');
                return redirect()->back();

        }
    }

    public function showDischargeForm()
    {
        return view('frontend.paperwork.discharge.new');
    }

    public function storeDischargeForm(Request $request)
    {
        $form = collect($request->except('_token'));
        $paperwork = \Auth::User()->member->paperwork()->create(['type' => 'discharge', 'paperwork' => $form->toJson()]);
        \Log::info('User filled out discharge paperwork', ['user_id' => \Auth::User()->id, 'member' => \Auth::User()->member->searchable_name, 'paperwork_id' => $paperwork]);
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
        $paperwork = \Auth::User()->member->paperwork()->create(['type' => 'file-correction', 'paperwork' => $form->toJson()]);
        \Log::info('User filled out file correction paperwork', ['user_id' => \Auth::User()->id, 'member' => \Auth::User()->member->searchable_name, 'paperwork_id' => $paperwork]);
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
        $mem = Member::where('searchable_name', $request->violator_name)->first();
        $paperwork = \Auth::User()->member->paperwork()->create(['type' => 'bad-conduct', 'paperwork' => $form->toJson(),'disciplinary_team_id'=>$mem->team->id]);

        \Log::info('User filled out bad conduct paperwork', ['user_id' => \Auth::User()->id, 'member' => \Auth::User()->member->searchable_name, 'paperwork_id' => $paperwork,'disciplinary_team_id'=>$mem->team->id]);
        flash('Bad Conduct Form has been filed, We will contact you soon regarding this form.', 'success');
        return redirect(route('frontend.files.my-file'));
    }

    public function showFlightPlanForm()
    {
        return view('frontend.paperwork.aviation.flight-plan.new');
    }

    public function storeFlightPlanForm(Request $request)
    {
        $form = collect($request->except('_token'));
        $paperwork = \Auth::User()->member->paperwork()->create(['type' => 'flight-plan', 'paperwork' => $form->toJson()]);
        flash('Your Flight Plan has been filed, it is now visible to the ATC.', 'success');
        \Log::info('User filled out flight plan paperwork', ['user_id' => \Auth::User()->id, 'member' => \Auth::User()->member->searchable_name, 'paperwork_id' => $paperwork]);
        return redirect(route('frontend.files.my-file'));
    }

    public function updateFlightPlanForm(Request $request, $id)
    {
        $form = collect($request->except('_token'));
        $paperwork = Paperwork::findOrFail($id);
        $paperwork->update(['type' => 'flight-plan', 'paperwork' => $form->toJson()]);
        \Log::info('User updated flight-plan paperwork', ['user_id' => \Auth::User()->id, 'member' => \Auth::User()->member->searchable_name, 'paperwork_id' => $paperwork]);
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
        $paperwork = \Auth::User()->member->paperwork()->create(['type' => 'aar', 'paperwork' => $form->toJson(), 'team_id' => $request->team_id]);
        flash('Your AAR has been filed.', 'success');
        \Log::notice('User filled out change request paperwork', ['user_id' => \Auth::User()->id, 'member' => \Auth::User()->member->searchable_name, 'paperwork_id' => $paperwork]);
        return redirect(route('frontend.team', \Auth::User()->member->team_id));
    }

    public function showChangeForm()
    {
        return view('frontend.paperwork.change-request.new');
    }

    public function storeChangeForm(Request $request)
    {
        $form = collect($request->except('_token'));
        $paperwork = \Auth::User()->member->paperwork()->create(['type' => 'change-request', 'paperwork' => $form->toJson()]);
        flash('Your Change Request has been filed, you can monitor the status of this paperwork via your file.', 'success');
        \Log::notice('User filled out change request paperwork', ['user_id' => \Auth::User()->id, 'member' => \Auth::User()->member->searchable_name, 'paperwork_id' => $paperwork]);
        return redirect(route('frontend.files.my-file'));
    }

    public function createNote($id, Request $request)
    {
        $note = new PaperworkMessage;
        $note->member_id = \Auth::User()->member->id;
        $note->paperwork_id = $id;
        $note->message = $request->message;
        $note->save();
        flash('Paperwork note added successfully.', 'success');
        return redirect()->back();
    }

    public function deleteNote($id, $note)
    {
        $noteModel = PaperworkMessage::findOrFail($note);
        $noteModel->delete();
        flash('Paperwork note deleted successfully.', 'success');
        return redirect()->back();
    }

    public function storeAdminOptions($id, Request $request)
    {
        $paperwork = Paperwork::findOrFail($id);
        $paperwork->status = $request->status;
        $paperwork->save();
        flash('Paperwork has been updated.', 'success');
        return redirect()->back();
    }

    public function storeAppealOptions($id, Request $request)
    {
        $paperwork = Paperwork::findOrFail($id);
        $paperwork->appeal = $request->appeal;
        $paperwork->save();
        flash('Paperwork has been updated.', 'success');
        return redirect()->back();
    }

    public function appeal($id)
    {
        $paperwork = Paperwork::findOrFail($id);
        $discipline = Member::findOrFail($paperwork->disciplinary_member_id);

        // Mark Document as appealed
        $paperwork->appeal = 1;

        // Determine if there is a higher group and assign it to them
        if(isset($discipline->team->parentTeam))
        {
            $paperwork->disciplinary_team_id = $discipline->team->parentTeam->id;
            flash('This disciplinary item has been appealed someone should get in touch soon regarding this issue.', 'success');
        } else {
            $paperwork->appeal = 3;
            flash('Appeal Limit reached - No Higher COC, appeal is denied.', 'danger');
        }

        // Save it
        $paperwork->save();


        return redirect()->back();

    }

    public function showNCSForm($id)
    {
        $leader = Team::all()->pluck('leader_id')->contains(\Auth::User()->id);

        if(!(\Auth::User()->admin || $leader))
        {
            flash('You do not have permission to access this.','danger');
            return redirect(route('frontend.files.my-file'));
        }

        $member = Member::findOrFail($id);
        return view('frontend.paperwork.disciplinary.ncs.new', ['member' => $member]);
    }

    public function storeNCSForm($id, Request $request)
    {
        $leader = Team::all()->pluck('leader_id')->contains(\Auth::User()->id);
        $discipline = Member::findOrFail($id);

        if(!(\Auth::User()->admin || $leader))
        {
            flash('You do not have permission to access this.','danger');
            return redirect(route('frontend.files.my-file'));
        }
        $form = collect($request->except('_token'));

        $paperwork = \Auth::User()->member->paperwork()->create(['type' => 'ncs', 'paperwork' => $form->toJson(),'status' => 2, 'disciplinary_member_id' => $id, 'disciplinary_team_id' => $discipline->team->id]);
        \Log::notice('User filled out an NCS', ['user_id' => \Auth::User()->id, 'filing_party_member' => \Auth::User()->member->searchable_name, 'against'=> $request->name, 'paperwork_id' => $paperwork]);
        return redirect(route('frontend.files.my-file'));
    }

    public function viewPublicNCS($id)
    {
        $paperwork = Paperwork::findOrFail($id);
        return view('frontend.paperwork.disciplinary.ncs.show', ['form' => $paperwork]);
    }

    public function showArticleForm($id)
    {
        $leader = Team::all()->pluck('leader_id')->contains(\Auth::User()->id);

        if(!(\Auth::User()->admin))
        {
            flash('You do not have permission to access this.','danger');
            return redirect(route('frontend.files.my-file'));
        }

        $member = Member::findOrFail($id);
        return view('frontend.paperwork.disciplinary.article-15.new', ['member' => $member]);
    }

    public function storeArticleForm($id, Request $request)
    {
        $discipline = Member::findOrFail($id);

        if(!(\Auth::User()->admin ))
        {
            flash('You do not have permission to access this.','danger');
            return redirect(route('frontend.files.my-file'));
        }
        $form = collect($request->except('_token'));

        $paperwork = \Auth::User()->member->paperwork()->create(['type' => 'article-15', 'paperwork' => $form->toJson(),'status' => 2, 'disciplinary_member_id' => $id, 'disciplinary_team_id' => $discipline->team->id]);
        \Log::notice('User filled out an Article 15', ['user_id' => \Auth::User()->id, 'filing_party_member' => \Auth::User()->member->searchable_name, 'against'=> $request->name, 'paperwork_id' => $paperwork]);
        return redirect(route('frontend.files.my-file'));
    }

    public function viewPublicArticle($id)
    {
        $paperwork = Paperwork::findOrFail($id);
        return view('frontend.paperwork.disciplinary.article-15.show', ['form' => $paperwork]);
    }

}
