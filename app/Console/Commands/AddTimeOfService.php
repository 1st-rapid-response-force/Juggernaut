<?php

namespace App\Console\Commands;

use App\Models\Unit\Member;
use Illuminate\Console\Command;

class AddTimeOfService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'catalyst:credit-tig';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Credits all active members with time in service';

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
        $members = Member::whereActive(1)->get();
        foreach($members as $member)
        {
                if($member->hasReportedIn())
                {
                    $member->time_in_service = $member->time_in_service+7;
                    $member->save();
                } else {
                    $member->time_in_service = $member->time_in_service-7;

                    if($member->time_in_service < 0)
                    $member->time_in_service = 0;

                    $member->save();
                    \Log::notice('CATALYST - Deducted 7 days, failed to report in', ['member'=> $member->searchable_name,'member_id' => $member->id]);
                }

        }
        \Log::info('CATALYST - Credited all active members for Time in Service (+1)');
    }
}
