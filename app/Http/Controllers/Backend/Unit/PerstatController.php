<?php

namespace App\Http\Controllers\Backend\Unit;

use App\Models\Unit\Member;
use App\Models\Unit\Perstat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class PerstatController
 * @package App\Http\Controllers\Backend\Unit
 */
class PerstatController extends Controller
{


    public function index()
    {
        $perstats = Perstat::all();
        // Deal with new PERSTAT Logic
        $perstatOld = Perstat::where('active','=','1')->first();
        $date = Carbon::createFromFormat('Y-m-d', $perstatOld->to);
        $date->hour= 0;
        $date->minute = 0;
        $date->second = 0;
        $dateNew = Carbon::createFromFormat('Y-m-d', $perstatOld->to)->addWeek();
        $dateNew->hour= 0;
        $dateNew->minute = 0;
        $dateNew->second = 0;
        $now = Carbon::now();
        //Determine whether to show button
        if($now->gt($date))
        {
            $validNew = true;
        } else {
            $validNew = false;
        }

        return view('backend.unit.perstat.index')
            ->with('perstats', $perstats)
            ->with('validNew',$validNew)
            ->with('oldPerstat',$perstatOld)
            ->with('newDate',$dateNew);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Set old perstat to active
        $perstatOld = Perstat::where('active','=','1')->first();
        $perstatOld->active = false;
        $perstatOld->save();
        $date = Carbon::createFromFormat('Y-m-d', $perstatOld->to)->addWeek();
        $date->hour= 0;
        $date->minute = 0;
        $date->second = 0;
        //New Perstat
        $assigned = Member::where('active','=','1')->get()->count();
        $perstat = new Perstat;
        $perstat->from = $perstatOld->to;
        $perstat->to = $date->toDateString();
        $perstat->assigned = $assigned;
        $perstat->active = true;
        $perstat->save();
        flash('PERSTAT added successfully','success');
        return redirect()->back();
    }

    /**
     * @param $id
     * @return $this
     */
    public function show($id)
    {
        $perstat = Perstat::find($id);
        return view('backend.unit.perstat.show')
            ->with('perstat',$perstat);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function email(Request $request, $id)
    {
        $perstat = Perstat::find($id);
        $pending = $perstat->pendingReportIn();
        foreach($pending as $member)
        {
            $this->emailReportIn($member->user);
        }
        flash('Emails have been sent to pending members','success');
        return redirect()->back();
    }

    /**
     * @param $user
     */
    private function emailReportIn($user)
    {
        \Mail::queue('emails.reportIn', ['user' => $user], function ($m) use ($user) {
            $m->to($user->email, $user->member);
            $m->subject('1st RRF - Report In');
            $m->from('no-reply@1st-rrf.com','1st Rapid Response Force');
            $m->sender('no-reply@1st-rrf.com','1st Rapid Response Force');
        });
    }
}
