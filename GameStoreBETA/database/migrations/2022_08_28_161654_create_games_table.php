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
        Schema::create('games', function (Blueprint $table) {
            $table->id('game_id');
            $table->string('name', 50);
            $table->string('slug', 50);
            $table->text('description');
            $table->integer('publisher_id')->unsigned();
            $table->timestamp('release_date');
            $table->timestamps();

            $table->foreign('publisher_id')->references('publisher_id')->on('publishers');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
};