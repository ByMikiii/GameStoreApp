<?php
//2022_08_28_164916
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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 20);
            $table->string('full_name', 30)->nullable();
            $table->unsignedInteger('country_id')->nullable();
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->float('wallet')->default(0);
            $table->string('locale', 2)->default('sk');
            $table->string('address', 100)->nullable();
            $table->boolean('is_admin')->default(0);
            $table->boolean('is_publisher')->default(0);
            $table->string('profile_photo', 200)->default("https://eu.ui-avatars.com/api/?name=a&background=random");
            $table->rememberToken();
            $table->timestamps();
            
            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};