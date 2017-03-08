<?php

namespace App\Console\Commands;

use App\Models\Unit\Member;
use Illuminate\Console\Command;

class CreateSearchable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'member:searchable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a searchable string';

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
        Member::chunk(10, function ($members){
           foreach ($members as $member)
           {
               $member->searchable_name = $member;
               $member->save();
           }
        });
    }
}
