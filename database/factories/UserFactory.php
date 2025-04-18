<?php

namespace Database\Factories;

use App\Models\Country;
use Faker\Guesser\Name;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $randomCountryId = Country::all()->random()->id;
        $username = fake()->userName();
        return [
            'name' => $username,
            'full_name' => fake()->name(),
            'country_id' => $randomCountryId,
            'email' => fake()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'wallet' => fake()->randomDigitNotNull(),
            'address' => fake()->address(),
            'profile_photo' => "https://eu.ui-avatars.com/api/?name=".$username."&background=random",
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}