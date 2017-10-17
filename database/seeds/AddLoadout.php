<?php

use Illuminate\Database\Seeder;
use \App\Models\Unit\Loadout;
use \App\Models\Unit\Qualification;

class AddLoadout extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $qualification = Qualification::create(['name' => 'Task Force Everest', 'description' => 'A member within Task Force Everest', 'published'=> true]);
        $qualification->addMedia(public_path('img/logo.png'))->preservingOriginal()->toCollection('image');

        // Add Blank Objects for all categories
        $item = new Loadout;
        $item->qualification_id = $qualification->id;
        $item->category = 'primary';
        $item->name = 'No Primary Weapon';
        $item->class_name = '';
        $item->empty = true;
        $item->save();
        $id1 = $item->id;

        $item = new Loadout;
        $item->qualification_id = $qualification->id;
        $item->category = 'secondary';
        $item->name = 'No Secondary Weapon';
        $item->class_name = '';
        $item->empty = true;
        $item->save();
        $id2 = $item->id;

        $item = new Loadout;
        $item->qualification_id = $qualification->id;
        $item->category = 'launcher';
        $item->name = 'No Launcher Weapon';
        $item->class_name = '';
        $item->empty = true;
        $item->save();
        $id3 = $item->id;

        $item = new Loadout;
        $item->qualification_id = $qualification->id;
        $item->category = 'thrown';
        $item->name = 'No Thrown Weapon';
        $item->class_name = '';
        $item->empty = true;
        $item->save();
        $id4 = $item->id;

        $item = new Loadout;
        $item->qualification_id = $qualification->id;
        $item->category = 'uniform';
        $item->name = 'No Uniform';
        $item->class_name = '';
        $item->empty = true;
        $item->save();
        $id5 = $item->id;

        $item = new Loadout;
        $item->qualification_id = $qualification->id;
        $item->category = 'vest';
        $item->name = 'No Vest';
        $item->class_name = '';
        $item->empty = true;
        $item->save();
        $id6 = $item->id;

        $item = new Loadout;
        $item->qualification_id = $qualification->id;
        $item->category = 'backpack';
        $item->name = 'No Backpack';
        $item->class_name = '';
        $item->empty = true;
        $item->save();
        $id7 = $item->id;

        $item = new Loadout;
        $item->qualification_id = $qualification->id;
        $item->category = 'helmet';
        $item->name = 'No Helmet';
        $item->class_name = '';
        $item->empty = true;
        $item->save();
        $id8 = $item->id;

        $item = new Loadout;
        $item->qualification_id = $qualification->id;
        $item->category = 'goggles';
        $item->name = 'No Goggles';
        $item->class_name = '';
        $item->empty = true;
        $item->save();
        $id9 = $item->id;

        $item = new Loadout;
        $item->qualification_id = $qualification->id;
        $item->category = 'nightvision';
        $item->name = 'No Nightvision';
        $item->class_name = '';
        $item->empty = true;
        $item->save();
        $id10 = $item->id;

        $item = new Loadout;
        $item->qualification_id = $qualification->id;
        $item->category = 'binoculars';
        $item->name = 'No Binoculars';
        $item->class_name = '';
        $item->empty = true;
        $item->save();
        $id11 = $item->id;

        $item = new Loadout;
        $item->qualification_id = $qualification->id;
        $item->category = 'primary_attachments';
        $item->name = 'No Primary Attachments';
        $item->class_name = '';
        $item->empty = true;
        $item->save();
        $id12 = $item->id;

        $item = new Loadout;
        $item->qualification_id = $qualification->id;
        $item->category = 'secondary_attachments';
        $item->name = 'No Secondary Attachments';
        $item->class_name = '';
        $item->empty = true;
        $item->save();
        $id13 = $item->id;

        $item = new Loadout;
        $item->qualification_id = $qualification->id;
        $item->category = 'launcher_attachments';
        $item->name = 'No Launcher Attachments';
        $item->class_name = '';
        $item->empty = true;
        $item->save();
        $id14 = $item->id;

        $item = new Loadout;
        $item->qualification_id = $qualification->id;
        $item->category = 'launcher_attachments';
        $item->name = 'No Item';
        $item->class_name = '';
        $item->empty = true;
        $item->save();
        $id15 = $item->id;

        $all = \App\Models\Unit\Member::all();
        foreach($all as $member)
        {
            $member->loadout()->sync([$id1,$id2,$id3,$id4,$id5,$id6,$id7,$id8,$id9,$id10,$id11,$id12,$id13,$id14,$id15]);
        }
    }
}
