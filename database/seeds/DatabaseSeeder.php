<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1st Run
        /*
        $this->call(UsersTableSeeder::class);
        $this->call(RanksTableSeeder::class);
        $this->call(TeamTableSeeder::class);
        $this->call(TimelineSeeder::class);
        */

        $this->call(FixPerstat::class);
    }
}
