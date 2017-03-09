<?php

use Illuminate\Database\Seeder;

class DemoRibbonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ribbon = \App\Models\Unit\Ribbon::create(['name' => 'Army Service Ribbon', 'description' => 'Provided for outstanding service', 'published'=> true]);
        $ribbon->addMedia(public_path('img/ribbons/army-service.jpg'))->preservingOriginal()->toCollection('image');

        $ribbon = \App\Models\Unit\Ribbon::create(['name' => 'Humanitarian', 'description' => 'Provided for outstanding service', 'published'=> true]);
        $ribbon->addMedia(public_path('img/ribbons/humanitarian.jpg'))->preservingOriginal()->toCollection('image');

        $ribbon = \App\Models\Unit\Ribbon::create(['name' => 'Presidential', 'description' => 'Provided for outstanding service', 'published'=> true]);
        $ribbon->addMedia(public_path('img/ribbons/presidential.jpg'))->preservingOriginal()->toCollection('image');
    }
}
