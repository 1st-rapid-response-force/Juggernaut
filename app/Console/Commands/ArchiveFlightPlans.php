<?php

namespace App\Console\Commands;

use App\Models\Unit\Paperwork;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ArchiveFlightPlans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aviation:flight-plan-archive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks all active flight plans and archives any that are older than a day.';

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
        $now = Carbon::now();

        $paperwork = Paperwork::whereType('flight-plan')->whereStatus(1)->get();
        foreach($paperwork as $paper)
        {
            if(!(($paper->created_at->addDay(1)) > $now) )
            {
                $paper->status = 2;
                $paper->save();
            }
        }
    }
}
