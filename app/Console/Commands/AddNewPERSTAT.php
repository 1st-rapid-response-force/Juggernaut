<?php

namespace App\Console\Commands;

use App\Models\Unit\Member;
use App\Models\Unit\Perstat;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AddNewPERSTAT extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'member:create-perstat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);


        // Set old perstat to active
        $perstatOld = Perstat::where('active','=','1')->first();
        $perstatOld->active = false;
        $perstatOld->save();


        $date = Carbon::createFromFormat('Y-m-d', $perstatOld->to)->addWeek();
        $date->hour= 0;
        $date->minute = 0;
        $date->second = 0;

        // Lets deal with inactives
        $inactives = $perstatOld->pendingReportIn();
        foreach($inactives as $member)
        {
            // TIS penalty
            $member->time_in_service = $member->time_in_service-7;
            if($member->time_in_service < 0)
                $member->time_in_service = 0;
            $member->save();
            \Log::notice('CATALYST - Deducted 7 days, failed to report in', ['member'=> $member->searchable_name,'member_id' => $member->id]);

            // Email, and Create an infraction report
            $this->emailFailureToReportIn($member->user);
        }

        //New Perstat
        $assigned = Member::where('active','=','1')->get()->count();

        $perstat = new Perstat;
        $perstat->from = $perstatOld->to;
        $perstat->to = $date->toDateString();
        $perstat->assigned = $assigned;
        $perstat->active = true;
        $perstat->save();

        // Lets email the guys and let them know a new PERSTAT is here
        $active = Member::active()->get();
        foreach($active as $member)
        {
            $this->emailNewReportIn($member->user);
        }
    }

    private function emailNewReportIn($user)
    {
        \Mail::queue('emails.newReportIn', ['user' => $user], function ($m) use ($user) {
            $m->to($user->email, $user->vpf);
            $m->subject('1st RRF - New Report In Period');
            $m->from('no-reply@1st-rrf.com','1st Rapid Response Force');
            $m->sender('no-reply@1st-rrf.com','1st Rapid Response Force');
        });
    }
    private function emailFailureToReportIn($user)
    {
        $data = ['name' => $user->vpf];
        \Mail::queue('emails.failureReportIn', ['user' => $user, 'data' => $data], function ($m) use ($user) {
            $m->to($user->email, $user->vpf);
            $m->subject('1st RRF - Failure to Report In');
            $m->from('no-reply@1st-rrf.com','1st Rapid Response Force');
            $m->sender('no-reply@1st-rrf.com','1st Rapid Response Force');
        });
    }
}
