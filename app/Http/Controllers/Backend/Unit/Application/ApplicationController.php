<?php

namespace App\Http\Controllers\Backend\Unit\Application;

use App\Models\Application;
use App\Models\Unit\Perstat;
use App\Models\Unit\Team;
use App\Models\Unit\TeamTimeline;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::orderBy('id','asd')->get();
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

        if ($app->status == 3) {
            flash('This application has already been processed.', 'warning');
            return redirect()->back();
        }

        $app->status = 3;
        $app->save();



        // Email User
        $data = [
            'name'=>$app->user->name(),
            'steam_id'=>$app->user->steam_id
        ];
        $this->emailApprove($app->user,$data);

        //Create member
        $mem = $app->user->member()->create([
            'position' => 'Recruit',
            'rank_id' => 2,
            'team_id' => 2,
        ]);

        // Determine if Active or Reserve
        if($app->getApplication()->reserve)
        {
            $mem->reserve = 1;
        } else {
            $pending = Team::whereName('Recruits')->first();
            $mem->team_id = $pending->id;
        }

        $mem->save();


        // Sync empty
        $app->user->member->loadout()->sync([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]);


        // Call Jobs
        \Artisan::queue('member:avatar');
        \Artisan::queue('member:searchable');
        \Artisan::queue('member:squadxml');
        \Artisan::queue('member:cac');

        // Create all relevant records
        $app->user->member->serviceHistory()->create(['text' => 'Enlisted in the 1st Rapid Response Force','date'=> new Carbon]);


        // Create Timeline
        TeamTimeline::create([
                'team_id' => 2,
                'name' => $app->user->member.' has joined the 1st RRF',
                'type' => 'new-member',
                'body' => $app->user->member.' has been accepted and has joined the 1st Rapid Response Force!',
                'date' => new Carbon
        ]);


        // Report in
        $perstat = Perstat::where('active','=','1')->first();
        $app->user->member->perstat()->attach($perstat->id);
        $app->user->member->ribbons()->attach([1 => ['awarded_at' =>  new Carbon]]);

        \Log::info('User accepted application', ['user_id' => \Auth::User()->id, 'member' => $app->user->member->searchable_name, 'application_id' => $app->id]);
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
        \Log::info('User declined application', ['user_id' => \Auth::User()->id, 'application_id' => $app->id]);

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
