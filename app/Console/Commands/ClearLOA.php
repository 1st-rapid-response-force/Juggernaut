<?php

namespace App\Console\Commands;

use App\Models\Unit\Member;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Repositories\Frontend\Unit\Teamspeak\TeamspeakContract;

class ClearLOA extends Command
{
    protected $ts;


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'member:clear-loa';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs nightly and clears LOA on expiration';


    public function __construct(TeamspeakContract $ts)
    {
        $this->ts = $ts;
        parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $members = Member::all();

        // Check LOA status
        foreach ($members as $member)
        {
            $now = Carbon::now();
            $returnDate = Carbon::parse($member->loa_return);
            if($member->loa)
            {
                //check if return date
                if($now > $returnDate)
                {
                    $member->loa = false;
                    $member->loa_return = null;
                    $member->save();
                    $this->ts->update($member->user);
                }
            }

        }
    }
}
