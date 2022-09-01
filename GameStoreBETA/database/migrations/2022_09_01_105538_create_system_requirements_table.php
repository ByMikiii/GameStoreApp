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
        Schema::create('system_requirements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('os', 200)->nullable();
            $table->string('processor', 200)->nullable();
            $table->string('memory', 200)->nullable();
            $table->string('graphics', 200)->nullable();
            $table->string('storage', 200)->nullable();
            $table->unsignedInteger('game_id');
            $table->timestamps();

            $table->foreign('game_id')->references('id')->on('games');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_requirements');
    }
};