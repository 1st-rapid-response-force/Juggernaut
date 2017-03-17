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

    public function showApplication($type)
    {
        $user = \Auth::User();
        if (!count($user->application)) {

            if (($type == 'officer') || $type == 'nco' || $type == 'enlisted') {
                \Log::notice('User viewed application page', ['user_id' => \Auth::User()->id, 'steam_id' => \Auth::User()->steam_id, 'steam_url' => 'http://steamcommunity.com/profiles/'.$user->steam_id]);
                return view('frontend.apply.application', ['type' => $type]);
            } else {
                flash('There is no application for this type.', 'danger');
                return redirect()->back();
            }
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
        // We need to check the type in order to redirect them accordingly (also assign interview)
        if(($request->type == 'officer') || ($request->type == 'nco'))
        {
            // TODO: I need to unfuck this later
            $appModel->interview_required = true;
            $appModel->interview_id = mt_rand(1,3);
            $appModel->save();

            $body = \Crypt::encrypt('SYSTEM MESSAGE: THE FOLLOWING MEMBER IS REQUESTING A POSITION WHICH REQUIRES AN INTERVIEW: '.$request->type.' - PLEASE CONTACT MEMBER ON TEAMSPEAK - http://steamcommunity.com/profiles/'.$user->steam_id);
            //Lets email the interviewer
            $thread = Thread::create(
                [
                    'subject' => 'New Applicant - Interview Request - '.$user->name(),
                ]
            );
            // Message
            $message = Message::create(
                [
                    'thread_id' => $thread->id,
                    'user_id'   => $appModel->interview_id,
                    'body'      => $body
                ]
            );

            // Sender
            Participant::create(
                [
                    'thread_id' => $thread->id,
                    'user_id'   => $appModel->interview_id,
                    'last_read' => new Carbon
                ]
            );
            $data = [
                'title' => 'New Applicant - Interview Request - '.$user->name(),
                'content' => 'SYSTEM MESSAGE: THE FOLLOWING MEMBER IS REQUESTING A POSITION WHICH REQUIRES AN INTERVIEW: '.$request->type.' - PLEASE CONTACT MEMBER ON TEAMSPEAK - http://steamcommunity.com/profiles/'.$user->steam_id,
                'creator' => $appModel->interview_id,
                'id' => $thread->id
            ];
            $this->emailUsersNewMessage([$appModel->interview_id],$data);

        }

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
     * Sends emails to all recipients
     * @param $users
     * @param $data
     */
    private function emailUsersNewMessage($users,$data)
    {
        foreach($users as $userID)
        {
            $user = User::find($userID);
            \Mail::send('emails.newMessage', ['user' => $user,'data' =>$data], function ($m) use ($user,$data) {
                $m->to($user->email, $user->member);
                $m->subject('1st RRF - New Message - '.$data['title']);
                $m->from('no-reply@1st-rrf.com','NATO Strategic Development Group');
                $m->sender('no-reply@1st-rrf.com','NATO Strategic Development Group');
            });
        }
    }

}
