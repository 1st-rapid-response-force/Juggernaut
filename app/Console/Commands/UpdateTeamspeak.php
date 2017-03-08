<?php

namespace App\Console\Commands;

use App\Repositories\Frontend\Unit\Teamspeak\TeamspeakContract;
use App\User;
use Illuminate\Console\Command;

/**
 * Class UpdateTeamspeak
 * @package App\Console\Commands
 */
class UpdateTeamspeak extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'member:update-teamspeak';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates teamspeak groups';

    /**
     * @var TeamspeakContract
     */
    protected $ts;


    /**
     * UpdateTeamspeak constructor.
     * @param TeamspeakContract $ts
     */
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
        $this->info('Updating Teamspeak');
        $users = User::all();

        foreach ($users as $user)
        {
            $this->info('Updating user - '.$user->member);
            $this->ts->update($user);
            sleep(2);
        }

        $this->info('Updating Teamspeak completed');
    }
}
