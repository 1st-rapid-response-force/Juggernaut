<?php

use Illuminate\Database\Seeder;

class TeamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rrf = \App\Models\Unit\Team::create([
            'name' => 'Task Force Everest',
            'leader_id' => 1
        ]);

        // Utility Groups
        $util = \App\Models\Unit\Team::create([
            'name' => 'Pending Assignment',
            'parent_id' => $rrf->id
        ]);
        $util = \App\Models\Unit\Team::create([
            'name' => 'Discharged',
            'parent_id' => $rrf->id
        ]);



    }
}
