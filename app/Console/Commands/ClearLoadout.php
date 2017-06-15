<?php

namespace App\Console\Commands;

use App\Models\Unit\Member;
use Illuminate\Console\Command;

class ClearLoadout extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'member:clear-loadout';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command clears all loadouts for members';

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
        foreach (Member::all() as $member)
        {
            $member->loadout()->sync([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]);
        }
    }
}
