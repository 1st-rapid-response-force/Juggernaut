<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoadoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loadouts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('qualification_id')->nullable();
            $table->enum('category',['primary','secondary','launcher','thrown','uniform','vest','backpack','helmet','goggles','nightvision','binoculars','primary_attachments','secondary_attachments','launcher_attachments','items']);
            $table->string('name');
            $table->string('class_name');
            $table->boolean('empty')->default(false);
            $table->timestamps();
        });

        Schema::create('loadouts_members', function(Blueprint $table)
        {
            $table->unsignedInteger('member_id');
            $table->unsignedInteger('loadout_id');
            $table->engine = 'InnoDB';
            $table->primary(['member_id', 'loadout_id']);
            //$table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            //$table->foreign('loadout_id')->references('id')->on('loadouts')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loadouts');
        Schema::dropIfExists('loadouts_members');
    }
}
