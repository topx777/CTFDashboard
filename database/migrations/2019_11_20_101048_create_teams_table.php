<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idUser')->unsigned();
            $table->string('name', 55);
            $table->integer('score')->default(0);
            $table->text('phrase')->nulleable();
            $table->string('avatar', 255)->nullable();
            $table->string('couch', 55)->nullable();
            $table->string('teamPassword')->nullable();
            $table->bigInteger('idCompetition')->unsigned();
            $table->timestamps();
            $table->foreign('idUser')->references('id')->on('users');
            $table->foreign('idCompetition')->references('id')->on('competitions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
