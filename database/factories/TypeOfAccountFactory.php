<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TypeOfAccount>
 */
class TypeOfAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->unique()->sentence(2),
            'price' => rand(5, 100),
            'duration' => rand(1, 3),
            'prefix' => fake()->unique()->sentence(1),
            'description' => fake()->paragraph(),
            "active_case_payments" => rand(0, 1)
        ];
    }
}
