<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('video')->nullable();
            $table->string('document')->nullable();
            $table->timestamps();
        });

        Schema::create('programs_dates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('program_id');
            $table->unsignedInteger('responsible_id');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->integer('status')->default(1);
            $table->timestamps();
        });

        Schema::create('member_program', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('member_id')->unsigned();
            $table->integer('program_id')->unsigned();
            $table->dateTime('completed_at');
            $table->unsignedInteger('paperwork_id')->nullable();
            $table->text('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_program');
        Schema::dropIfExists('programs_dates');
        Schema::dropIfExists('programs');
    }
}
