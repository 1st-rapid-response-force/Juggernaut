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
            'name' => '1st Rapid Response Force - HQ',
            'leader_id' => 1
        ]);

        $rrf = \App\Models\Unit\Team::create([
            'name' => '1st Rapid Response Force - Reserves',
            'parent_id' => $rrf->id
        ]);

        // 1st Platoon
        $platoon = \App\Models\Unit\Team::create([
            'name' => '1st Platoon - Command',
            'parent_id' => $rrf->id
        ]);

        $squad = \App\Models\Unit\Team::create([
            'name' => '1st Platoon - Medical Detachment',
            'parent_id' => $platoon->id
        ]);

        $squad = \App\Models\Unit\Team::create([
            'name' => '1st Platoon - 1st Squad',
            'parent_id' => $platoon->id
        ]);

        $squad = \App\Models\Unit\Team::create([
            'name' => '1st Platoon - 2nd Squad',
            'parent_id' => $platoon->id
        ]);

        $squad = \App\Models\Unit\Team::create([
            'name' => '1st Platoon - 3rd Squad',
            'parent_id' => $platoon->id
        ]);

        $squad = \App\Models\Unit\Team::create([
            'name' => '1st Platoon - 4th Squad',
            'parent_id' => $platoon->id
        ]);

        // Aviation
        $air = \App\Models\Unit\Team::create([
            'name' => 'Aviation Command',
            'parent_id' => $rrf->id,
            'leader_id' => 2
        ]);

        $rot = \App\Models\Unit\Team::create([
            'name' => '1st Squadron - Aircraft One',
            'parent_id' => $air->id
        ]);

        $rot = \App\Models\Unit\Team::create([
            'name' => '1st Squadron - Aircraft Two',
            'parent_id' => $air->id
        ]);

        $rot = \App\Models\Unit\Team::create([
            'name' => '1st Squadron - Aircraft Three',
            'parent_id' => $air->id
        ]);

        $rot = \App\Models\Unit\Team::create([
            'name' => '2nd Squadron - Aircraft One',
            'parent_id' => $air->id
        ]);

        $rot = \App\Models\Unit\Team::create([
            'name' => '2nd Squadron - Aircraft Two',
            'parent_id' => $air->id
        ]);

        $rot = \App\Models\Unit\Team::create([
            'name' => '2nd Squadron - Special Operations',
            'parent_id' => $air->id
        ]);

        // Aviation
        $special = \App\Models\Unit\Team::create([
            'name' => 'Operational Detachment Alpha (SFOD-A)',
            'parent_id' => $rrf->id,
            'leader_id' => 3
        ]);


    }
}
