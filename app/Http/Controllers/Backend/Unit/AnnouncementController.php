<?php

namespace App\Http\Controllers\Backend\Unit;

use App\Models\Unit\Announcement;
use App\Models\Unit\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::all();
        return view('backend.unit.announcements.index',['announcements' => $announcements]);
    }

    public function create()
    {
        return view('backend.unit.announcements.create');
    }

    public function store(Request $request)
    {
        $announcement = \Auth::User()->announcement()->create($request->all());

        // Email User
        $data = [
            'subject'=>$request->subject,
            'message'=>$request->message,
        ];


        if($request->sendEmail)
        {
            $activeMembers = Member::whereActive(1)->get();
            foreach($activeMembers as $member)
            {
                $this->emailAnnounce($member->user,$data);
            }
        }

        flash('Your announcement has been created!', 'success');
        return redirect(route('admin.announcements.index'));

    }

    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('backend.unit.announcements.edit',['announcement' => $announcement]);
    }

    public function update($id, Request $request)
    {

        $announcement = Announcement::findOrFail($id);
        $announcement->update($request->all());
        flash('Your announcement has been sent!', 'success');
        return redirect()->back();
    }

    /**
     * Sends email to user - Approve
     * @param $user
     * @param $data
     */
    private function emailAnnounce($user,$data)
    {
        \Mail::queue('emails.announcement', ['user' => $user,'data' =>$data], function ($m) use ($user,$data) {
            $m->to($user->email, $user->vpf);
            $m->subject('1st RRF - '.$data['subject']);
            $m->from('no-reply@1st-rrf.com','1st Rapid Response Force');
            $m->sender('no-reply@1st-rrf.com','1st Rapid Response Force');
        });
    }

}
