<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class heartbeat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'csm:heartbeat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pings Server to request server information.';

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
        $process = new Process('python3 '.base_path('Capri/csmclient.py RRF_SERVERSTATUS'));
        $process->run();
    }
}
