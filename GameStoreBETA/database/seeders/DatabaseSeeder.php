<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Country;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    { 
        if(count(Country::all()) < 230){ 
            $this->call(CountriesTableSeeder::class);
        }
        $this->call(UsersTableSeeder::class);

    }
}