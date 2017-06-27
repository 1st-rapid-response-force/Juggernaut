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
        // Uncomment for a full dev seed
        /*
        $this->call(UsersTableSeeder::class);
        $this->call(RanksTableSeeder::class);
        $this->call(TeamTableSeeder::class);
        $this->call(TimelineSeeder::class);
        $this->call(FixPerstat::class);
        $this->call(AddLoadout::class);
        */

        // This is section is intended for deployment to production
        $this->call(AddAssignment::class);
    }
}
