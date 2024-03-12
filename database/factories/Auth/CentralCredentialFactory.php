<?php

namespace Database\Factories\Auth;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Auth\CentralCredential>
 */
class CentralCredentialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "username" => fake()->userName(),
            "email" => fake()->email(),
            "password" => fake()->password()
        ];
    }
}
