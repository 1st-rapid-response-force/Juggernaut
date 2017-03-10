<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('searchable_name')->default('');
            $table->string('position')->nullable();
            $table->unsignedInteger('rank_id');
            $table->unsignedInteger('team_id');
            $table->unsignedInteger('face_id')->default(1);
            $table->text('bio')->nullable();
            $table->string('avatar')->default('/img/avatars/background.png');
            $table->integer('active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
