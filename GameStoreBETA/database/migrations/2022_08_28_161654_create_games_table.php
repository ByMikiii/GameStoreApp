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
            $table->increments('id');
            $table->string('name', 50);
            $table->string('slug', 50);
            $table->text('description');
            $table->unsignedInteger('publisher_id');
            $table->float('original_price', 10, 2);
            $table->float('sale_price', 10, 2);
            $table->boolean('is_sale');
            $table->timestamp('release_date');
            $table->timestamps();

            $table->foreign('publisher_id')->references('id')->on('publishers');

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