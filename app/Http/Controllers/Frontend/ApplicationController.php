<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Message;
use App\User;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Apply\CreateApplicationRequest;

class ApplicationController extends Controller
{
    public function showApply()
    {
        return view('frontend.apply.apply');
    }

    public function showApplication()
    {
        $user = \Auth::User();
        if (!count($user->application)) {
            \Log::notice('User viewed application page', ['user_id' => \Auth::User()->id, 'steam_id' => \Auth::User()->steam_id, 'steam_url' => 'http://steamcommunity.com/profiles/'.$user->steam_id]);
            return view('frontend.apply.application', []);
        } else {
            flash('You have already submitted an application.', 'danger');
            return redirect()->back();
        }
    }

    public function postApplication(CreateApplicationRequest $request)
    {
        $user = \Auth::User();

        //Do a quick check to prevent duplicates
        if (count($user->application)) {
            flash('You have already submitted an application.', 'danger');
            return redirect()->back();
        }

        $appInput = collect($request->except('_token'));
        $appModel = $user->application()->create(['application' => $appInput->toJson()]);

        // Change name from app
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->save();

        \Log::notice('User filled out application', ['user_id' => \Auth::User()->id,'application_id'=>$appModel->id, 'steam_id' => \Auth::User()->steam_id, 'steam_url' => 'http://steamcommunity.com/profiles/'.$user->steam_id]);

        $admins = User::whereAdmin(true)->pluck('id');
        $data = [
            'title' => 'New Applicant - '.$user->name(),
            'applicant' => $user->name(),
            'steam_url' => 'http://steamcommunity.com/profiles/'.$user->steam_id,
            'type' => $request->type,
            'application' =>route('admin.applications.show',$appModel->id),
        ];
        $this->emailNewApplication($admins,$data);

        return redirect(route('frontend.apply.application.success'));
    }

    public function successApplication()
    {
        $user = \Auth::User();
        if (count($user->application))
        {
            return view('frontend.apply.completed');
        } else {
            flash('You need to complete an application before accessing this page.','danger');
            return redirect(route('frontend.apply'));
        }

    }

    /**
     * Sends emails to all admin
     * @param $users
     * @param $data
     */
    private function emailNewApplication($users,$data)
    {
        foreach($users as $userID)
        {
            $user = User::find($userID);
            \Mail::send('emails.newApplicant', ['user' => $user,'data' =>$data], function ($m) use ($user,$data) {
                $m->to($user->email, $user->member);
                $m->subject('TF Everest - '.$data['title']);
                $m->from('no-reply@tf-everest.com','Task Force Everest');
                $m->sender('no-reply@tf-everest.com','Task Force Everest');
            });
        }
    }

}
