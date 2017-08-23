<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationsTableRedux extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('operations');

        Schema::create('operations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('published')->default(false);
            $table->string('required_elements')->nullable();
            $table->string('optional_elements')->nullable();
            $table->text('description')->nullable();
            $table->text('training')->nullable();
            $table->text('admin')->nullable();
            $table->text('credit')->nullable();
            $table->dateTimeTz('start_time');
            $table->dateTimeTz('end_time');
            $table->timestamps();
        });

        Schema::create('member_operation', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('member_id')->unsigned();
            $table->integer('operation_id')->unsigned();
            $table->integer('status')->default(1);
        });

        Schema::create('operations_frago', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedInteger('member_id');
            $table->integer('operation_id')->unsigned();
            $table->text('message');
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
        Schema::dropIfExists('member_operation');
        Schema::dropIfExists('operations_frago');
        Schema::dropIfExists('operations');
    }
}
