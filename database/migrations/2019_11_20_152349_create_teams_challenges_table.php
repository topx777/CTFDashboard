<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsChallengesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams_challenges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idTeam')->unsigned();
            $table->bigInteger('idChallenge')->unsigned();
            $table->integer('score');
            $table->dateTime('time')->nullable();
            $table->boolean('whithHint')->default(false);
            $table->foreign('idTeam')->references('id')->on('teams');
            $table->foreign('idChallenge')->references('id')->on('challenges');
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
        Schema::dropIfExists('teams_challenges');
    }
}
