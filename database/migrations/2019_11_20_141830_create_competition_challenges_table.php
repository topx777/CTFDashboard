<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionChallengesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competition_challenges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idCompetition')->unsigned();
            $table->bigInteger('idChallenge')->unsigned();
            $table->bigInteger('idLevel')->unsigned();
            $table->timestamps();
            $table->foreign('idCompetition')->references('id')->on('competitions');
            $table->foreign('idChallenge')->references('id')->on('challenges');
            $table->foreign('idLevel')->references('id')->on('levels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('competition_challenges');
    }
}
