<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->unsignedInteger('team_id')->default(1);
        $table->integer('order')->default(0);
        $table->boolean('enabled')->default(true);
        $table->timestamps();
    });

        Schema::table('members', function (Blueprint $table) {
            $table->unsignedInteger('assignment_id')->after('team_id')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignments');

        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn('assignment_id');
        });
    }
}
