<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerstatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perstats', function (Blueprint $table) {
            $table->increments('id');
            $table->date('from');
            $table->date('to');
            $table->unsignedInteger('assigned')->default(0);
            $table->boolean('active')->default(false);
            $table->timestamps();
        });

        Schema::create('member_perstat', function (Blueprint $table) {
            $table->unsignedInteger('perstat_id');
            $table->unsignedInteger('member_id');
            $table->primary(['member_id', 'perstat_id']);
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->foreign('perstat_id')->references('id')->on('perstats')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_perstat');
        Schema::dropIfExists('perstats');
    }
}
