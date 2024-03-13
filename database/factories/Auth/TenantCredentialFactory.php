<?php

namespace Database\Factories\Auth;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Auth\TenantCredential>
 */
class TenantCredentialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "email" => fake()->email(),
            "password" => fake()->password()
        ];
    }
}
