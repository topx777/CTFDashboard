<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competitions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50);
            $table->boolean('state')->default(false);
            $table->text('rules');
            $table->dateTime('startTime');
            $table->dateTime('endTime');
            $table->bigInteger('idJudge')->unsigned();
            $table->tinyInteger('dificulty');
            $table->tinyInteger('unlockType');
            $table->tinyInteger('gameMode');
            $table->timestamps();
            $table->foreign('idJudge')->references('id')->on('judges');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('competitions');
    }
}
