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
            $table->biginteger('idUser')->unsigned();
            $table->string('name', 55);
            $table->integer('score');
            $table->text('phrase')->nulleable();
            $table->string('avatar', 255)->nullable();
            $table->string('couch', 55)->nullable();
            $table->timestamps();
            $table->foregin('idUser')->references('id')->on('user');
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
