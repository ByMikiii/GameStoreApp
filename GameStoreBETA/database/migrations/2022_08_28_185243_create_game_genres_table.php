<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_genres', function (Blueprint $table) {
            $table->id('game_genre_id');
            $table->integer('genre_id')->unsigned();
            $table->integer('game_id')->unsigned();
            $table->timestamps();

            $table->foreign('genre_id')->references('genre_id')->on('genres');
            $table->foreign('game_id')->references('game_id')->on('games');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_genres');
    }
};