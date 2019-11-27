<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChallengesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challenges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idLevel')->unsigned();
            $table->bigInteger('idCategory')->unsigned();
            $table->string('name', 40);
            $table->text('description')->nullable();
            $table->text('hint')->nullable();
            $table->text('flag');
            $table->timestamps();
            $table->foreign('idLevel')->references('id')->on('levels');
            $table->foreign('idCategory')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('challenges');
    }
}
