<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDisciplinaryColumnPaperwork extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paperworks', function (Blueprint $table) {
            $table->integer('appeal')->after('team_id')->nullable();
            $table->integer('disciplinary_member_id')->after('appeal')->nullable();
            $table->integer('disciplinary_team_id')->after('appeal')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paperworks', function (Blueprint $table) {
            $table->dropColumn('appeal');
            $table->dropColumn('disciplinary_member_id');
            $table->dropColumn('disciplinary_team_id');
        });
    }
}
