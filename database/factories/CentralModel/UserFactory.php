<?php

namespace Database\Factories\CentralModel;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CentralModel\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "first_name" => fake()->firstName(),
            "last_name" => fake()->lastName(),
            "bio" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque, doloribus distinctio numquam repudiandae officiis minus exercitationem totam molestiae sapiente praesentium itaque saepe temporibus nulla nemo pariatur porro soluta recusandae cum!"
        ];
    }
}
