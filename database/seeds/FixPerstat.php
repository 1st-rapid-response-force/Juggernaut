<?php

use Illuminate\Database\Seeder;

class FixPerstat extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();
        $later = $now->addWeek(1);
        \App\Models\Unit\Perstat::create(['from' => $now, 'to' => $later, 'assigned' => 3, 'active' => true]);
    }
}
