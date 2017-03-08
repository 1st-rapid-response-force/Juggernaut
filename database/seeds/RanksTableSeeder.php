<?php

use Illuminate\Database\Seeder;

class RanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Enlisted
        \App\Models\Unit\Rank::create([
            'name' => 'Civilian',
            'abbreviation' => '',
            'sort_order' => 1,
            'teamspeak_id' => 38,
        ]);

        \App\Models\Unit\Rank::create([
            'name' => 'Private',
            'abbreviation' => 'PV1',
            'sort_order' => 2,
            'teamspeak_id' => 10
        ]);

        \App\Models\Unit\Rank::create([
            'name' => 'Private',
            'abbreviation' => 'PV2',
            'sort_order' => 3,
            'teamspeak_id' => 11,
            'image' => '/img/ranks/pv2.png'
        ]);

        \App\Models\Unit\Rank::create([
            'name' => 'Private First Class',
            'abbreviation' => 'PFC',
            'sort_order' => 4,
            'teamspeak_id' => 12,
            'image' => '/img/ranks/pfc.png'
        ]);

        \App\Models\Unit\Rank::create([
            'name' => 'Specialist',
            'abbreviation' => 'SPC',
            'sort_order' => 5,
            'teamspeak_id' => 13,
            'image' => '/img/ranks/spc.png'
        ]);

        \App\Models\Unit\Rank::create([
            'name' => 'Corporal',
            'abbreviation' => 'CPL',
            'sort_order' => 6,
            'teamspeak_id' => 14,
            'image' => '/img/ranks/cpl.png'
        ]);

        \App\Models\Unit\Rank::create([
            'name' => 'Sergeant',
            'abbreviation' => 'SGT',
            'sort_order' => 7,
            'teamspeak_id' => 15,
            'image' => '/img/ranks/sgt.png'
        ]);

        \App\Models\Unit\Rank::create([
            'name' => 'Staff Sergeant',
            'abbreviation' => 'SSG',
            'sort_order' => 8,
            'teamspeak_id' => 16,
            'image' => '/img/ranks/ssg.png'
        ]);

        \App\Models\Unit\Rank::create([
            'name' => 'Sergeant First Class',
            'abbreviation' => 'SFC',
            'sort_order' => 9,
            'teamspeak_id' => 17,
            'image' => '/img/ranks/sfc.png'
        ]);

        \App\Models\Unit\Rank::create([
            'name' => 'Master Sergeant',
            'abbreviation' => 'MSG',
            'sort_order' => 10,
            'teamspeak_id' => 18,
            'image' => '/img/ranks/msg.png'
        ]);

        \App\Models\Unit\Rank::create([
            'name' => 'First Sergeant',
            'abbreviation' => '1SG',
            'sort_order' => 11,
            'teamspeak_id' => 19,
            'image' => '/img/ranks/1sg.png'
        ]);

        \App\Models\Unit\Rank::create([
            'name' => 'Sergeant Major',
            'abbreviation' => 'SGM',
            'sort_order' => 12,
            'teamspeak_id' => 20,
            'image' => '/img/ranks/sgm.png'
        ]);

        \App\Models\Unit\Rank::create([
            'name' => 'Command Sergeant Major',
            'abbreviation' => 'CSM',
            'sort_order' => 13,
            'teamspeak_id' => 21,
            'image' => '/img/ranks/csm.png'
        ]);

        // Warrant Officers
        \App\Models\Unit\Rank::create([
            'name' => 'Warrant Officer 1',
            'abbreviation' => 'WO1',
            'sort_order' => 14,
            'teamspeak_id' => 22,
            'image' => '/img/ranks/wo1.png'
        ]);

        \App\Models\Unit\Rank::create([
            'name' => 'Chief Warrant Officer 2',
            'abbreviation' => 'CW2',
            'sort_order' => 15,
            'teamspeak_id' => 23,
            'image' => '/img/ranks/cw2.png'
        ]);

        \App\Models\Unit\Rank::create([
            'name' => 'Chief Warrant Officer 3',
            'abbreviation' => 'CW3',
            'sort_order' => 16,
            'teamspeak_id' => 24,
            'image' => '/img/ranks/cw3.png'
        ]);

        \App\Models\Unit\Rank::create([
            'name' => 'Chief Warrant Officer 4',
            'abbreviation' => 'CW4',
            'sort_order' => 17,
            'teamspeak_id' => 25,
            'image' => '/img/ranks/cw4.png'
        ]);

        \App\Models\Unit\Rank::create([
            'name' => 'Chief Warrant Officer 5',
            'abbreviation' => 'CW5',
            'sort_order' => 18,
            'teamspeak_id' => 26,
            'image' => '/img/ranks/cw5.png'
        ]);

        // Officer
        \App\Models\Unit\Rank::create([
            'name' => 'Second Lieutenant',
            'abbreviation' => '2LT',
            'sort_order' => 19,
            'teamspeak_id' => 27,
            'image' => '/img/ranks/2lt.png'
        ]);

        \App\Models\Unit\Rank::create([
            'name' => 'First Lieutenant',
            'abbreviation' => '1LT',
            'sort_order' => 20,
            'teamspeak_id' => 28,
            'image' => '/img/ranks/1lt.png'
        ]);

        \App\Models\Unit\Rank::create([
            'name' => 'Captain',
            'abbreviation' => 'CPT',
            'sort_order' => 21,
            'teamspeak_id' => 29,
            'image' => '/img/ranks/cpt.png'
        ]);

        \App\Models\Unit\Rank::create([
            'name' => 'Major',
            'abbreviation' => 'MAJ',
            'sort_order' => 22,
            'teamspeak_id' => 30,
            'image' => '/img/ranks/maj.png'
        ]);

        \App\Models\Unit\Rank::create([
            'name' => 'Lieutenant Colonel',
            'abbreviation' => 'LTC',
            'sort_order' => 23,
            'teamspeak_id' => 31,
            'image' => '/img/ranks/ltc.png'
        ]);

        \App\Models\Unit\Rank::create([
            'name' => 'Colonel',
            'abbreviation' => 'COL',
            'sort_order' => 24,
            'teamspeak_id' => 32,
            'image' => '/img/ranks/ltc.png'
        ]);

    }
}
