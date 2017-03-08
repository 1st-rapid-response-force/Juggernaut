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
        ]);

        $oges->member()->create([
            'rank_id' => '23',
            'team_id' => '1',
            'searchable_name' => 'LCOL. Oges.M'
        ]);

        $rod = \App\User::create([
            'first_name' => 'Guillermo',
            'last_name' => 'Rodriguez',
            'email' => 'rodriguez.g@sdg.com',
            'steam_id' => '76561198011615406',
            'admin' => true
        ]);
        $rod->member()->create([
            'searchable_name' => 'SSG. Rodriguez.G',
            'rank_id' => '8',
            'team_id' => '2'
        ]);

        $striker =\App\User::create([
            'first_name' => 'Alexander',
            'last_name' => 'Striker',
            'email' => 'striker.a@sdg.com',
            'steam_id' => '76561198021531457',
            'admin' => true
        ]);

        $striker->member()->create([
            'rank_id' => '21',
            'team_id' => '3',
            'searchable_name' => 'CPT. Striker.A'
        ]);

        $champ = \App\User::create([
            'first_name' => 'Christopher',
            'last_name' => 'Champ',
            'email' => 'champ@sdg.com',
            'steam_id' => '76561198039677876',
        ]);

        $champ->member()->create([
            'rank_id' => '7',
            'team_id' => '1',
            'searchable_name' => 'SGT. Champ.C'
        ]);

        $soler = \App\User::create([
            'first_name' => 'Rafael',
            'last_name' => 'Soler-Crespo',
            'email' => 'soler-crespo@sdg.com',
            'steam_id' => '76561197972808712',
        ]);

        $soler->member()->create([
            'rank_id' => '7',
            'team_id' => '2',
            'searchable_name' => 'SGT. Soler-Crespo.R'
        ]);

    }
}
