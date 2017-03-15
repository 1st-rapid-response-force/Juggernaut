<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramGoals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs_goals', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('program_id');
            $table->text('goal')->nullable();
            $table->string('category')->nullable();
            $table->timestamps();
        });

        Schema::create('goal_member', function (Blueprint $table) {
            $table->unsignedInteger('goal_id');
            $table->unsignedInteger('member_id');
            $table->unsignedInteger('processor_id')->nullable();
            $table->text('note')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->primary(['member_id', 'goal_id']);
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->foreign('goal_id')->references('id')->on('programs_goals')->onDelete('cascade');
        });

        Schema::table('members', function (Blueprint $table) {
            $table->unsignedInteger('current_program_id')->default(0)->nullable()->after('face_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn('current_program_id');
        });

        Schema::dropIfExists('goal_member');
        Schema::dropIfExists('programs_goals');
    }
}
