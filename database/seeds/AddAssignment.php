<?php

use Illuminate\Database\Seeder;

class AddAssignment extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $assignment = \App\Models\Unit\Assignment::create(['name'=>'Unassigned']);
    }
}
