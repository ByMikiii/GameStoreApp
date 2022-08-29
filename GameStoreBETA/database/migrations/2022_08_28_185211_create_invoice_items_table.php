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
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->increments('invoice_items_id');
            $table->float('game_price');
            $table->unsignedInteger('invoice_id');
            $table->unsignedInteger('game_id');
            $table->timestamps();

            $table->foreign('invoice_id')->references('invoice_id')->on('invoices');
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
        Schema::dropIfExists('invoice_items');
    }
};