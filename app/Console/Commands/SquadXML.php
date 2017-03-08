<?php

namespace App\Console\Commands;

use App\Models\Unit\Team;
use Illuminate\Console\Command;

class SquadXML extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'member:squadxml';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates all squad xmls for the unit';

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
        $teams = Team::all();
        foreach ($teams as $team)
        {
            $members = $team->members;

            $xml = '<?xml version="1.0"?>'. PHP_EOL;
            $xml .= '<!DOCTYPE squad SYSTEM "squad.dtd">'. PHP_EOL;
            $xml .= '<?xml-stylesheet href="squad.xsl" type="text/xsl"?>'. PHP_EOL;
            $xml .= '<squad nick="SDG">'. PHP_EOL;
            $xml .= '<name>NATO Strategic Development Group</name>'. PHP_EOL;
            $xml .= '<email>contactus@sdg-arma.com</email>'. PHP_EOL;
            $xml .= '<web>sdg-arma.com</web>'. PHP_EOL;
            $xml .= '<picture>logo-'.$team->id.'.paa</picture>'. PHP_EOL;
            $xml .= '<title>NATO Strategic Development Group</title>'. PHP_EOL;
            foreach ($members as $member)
            {
                $xml .= '<member id="'.$member->user->steam_id.'" nick="'.$member.'">'. PHP_EOL;
                $xml .= '<name>'.$member->user->first_name.' '.$member->user->last_name.'</name>'. PHP_EOL;
                $xml .= '<email>'.$member->user->email.'</email>'. PHP_EOL;
                $xml .= '<icq>N/A</icq>'. PHP_EOL;
                $xml .= '<remark>NATO Strategic Development Group - '.$member->team->name.'</remark>'. PHP_EOL;
                $xml .= '</member>'. PHP_EOL;
            }
            $xml .= '</squad>'. PHP_EOL;

            //Save to file system just in case
            $file = fopen(public_path().'/squadxml/team-'.$team->id.'.xml','w');
            fwrite($file,$xml);
            fclose($file);
        }
    }
}
