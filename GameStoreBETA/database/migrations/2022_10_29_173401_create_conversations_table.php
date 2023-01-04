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
        Schema::create('conversations', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedInteger('user_one')->unsigned();
            $table->unsignedInteger('user_two')->unsigned();
            $table->timestamps();

            $table->foreign('user_one')->references('id')->on('users');
            $table->foreign('user_two')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conversations');
    }
};
