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
            $table->boolean('masterDisabled')->default(false);
            $table->text('rules');
            $table->dateTime('startTime');
            $table->dateTime('endTime');
            $table->bigInteger('idJudge')->unsigned();
            $table->tinyInteger('dificulty'); // 0: facil (25) ; 1: medio (50), 2: dificil 75; 3:extremo 100
            $table->tinyInteger('unlockType'); // 0: general ; 1: por nivel
            $table->tinyInteger('gameMode'); // 0: presencial ; 1: remoto
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
