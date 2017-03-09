<?php

namespace App\Http\Controllers\Backend\Unit\Application;

use App\Models\Application;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::all();
        return view('backend.applications.index',['applications' => $applications]);
    }

    public function show($id)
    {
        $app = Application::findOrFail($id);
        return view('backend.applications.show',['app' => $app]);
    }

    public function destroy($id)
    {
        $app = Application::findOrFail($id);
        $app->delete();
        flash('Successfully removed application.', 'success');
        return redirect(route('admin.applications.index'));
    }

    public function acceptApplicant($id)
    {
        // Sets application to accepted
        $app = Application::findOrFail($id);
        $app->status = 3;
        $app->save();

        // Email User
        $data = [
            'name'=>$app->user->name(),
            'steam_id'=>$app->user->steam_id
        ];
        $this->emailApprove($app->user,$data);

        //Create member
        $app->user->member()->create([
            'position' => 'Recruit',
            'rank_id' => 2,
            'team_id' => 2,
        ]);

        // Queue jobs
        \Artisan::call('member:avatar');
        \Artisan::call('member:searchable');
        \Artisan::call('member:squadxml');


        flash('Application has been approved.', 'success');
        return redirect(route('admin.applications.index'));

    }

    public function declineApplicant($id)
    {
        $app = Application::findOrFail($id);
        $app->status = 2;
        $app->save();

        $data = [];
        $this->emailDecline($app->user,$data);

        flash('Application has been declined.', 'success');
        return redirect(route('admin.applications.index'));
    }

    /**
     * Sends email to user - Approve
     * @param $user
     * @param $data
     */
    private function emailApprove($user,$data)
    {
        \Mail::send('emails.applicationAccepted', ['user' => $user,'data' =>$data], function ($m) use ($user,$data) {
            $m->to($user->email, $user->vpf);
            $m->subject('1st RRF - Your Application has been accepted');
            $m->from('no-reply@1st-rrf.com','1st Rapid Response Force');
            $m->sender('no-reply@1st-rrf.com','1st Rapid Response Force');
        });
    }
    /**
     * Sends email to user - Decline
     * @param $user
     * @param $data
     */
    private function emailDecline($user,$data)
    {
        \Mail::send('emails.applicationDeclined', ['user' => $user,'data' =>$data], function ($m) use ($user,$data) {
            $m->to($user->email, 'User');
            $m->subject('1st RRF - Your Application has been declined');
            $m->from('no-reply@1st-rrf.com','1st Rapid Response Force');
            $m->sender('no-reply@1st-rrf.com','1st Rapid Response Force');
        });
    }
}
