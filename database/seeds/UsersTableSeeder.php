<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Command
        $oges = \App\User::create([
            'first_name' => 'Mike',
            'last_name' => 'Oges',
            'email' => 'jmogletree@gmail.com',
            'steam_id' => '76561198066379365',
            'board_member' => true,
        ]);

        $oges->member()->create([
            'rank_id' => '23',
            'team_id' => '1',
            'searchable_name' => 'LCOL. Oges.M',
            'position' => 'Unit Commander'
        ]);

        $rod = \App\User::create([
            'first_name' => 'Guillermo',
            'last_name' => 'Rodriguez',
            'email' => 'rodriguez.g@1st-rrf.com',
            'steam_id' => '76561198011615406',
            'admin' => true,
            'board_member' => true,
        ]);
        $rod->member()->create([
            'searchable_name' => 'MAJ. Rodriguez.G',
            'rank_id' => '22',
            'team_id' => '9',
            'position' => 'Flight Commander'
        ]);

        $striker =\App\User::create([
            'first_name' => 'Alexander',
            'last_name' => 'Striker',
            'email' => 'striker.a@1st-rrf.com',
            'steam_id' => '76561198021531457',
            'admin' => true,
            'board_member' => true,
        ]);

        $striker->member()->create([
            'rank_id' => '22',
            'team_id' => '16',
            'searchable_name' => 'MAJ. Striker.A',
            'position' => 'ODA OIC'
        ]);


    }
}
