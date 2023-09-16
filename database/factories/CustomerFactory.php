<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => fake()->unique()->numberBetween(1000, 9999),
            'name' => fake()->lastName(),
            'firstname' => fake()->firstName,
            'gender' => fake()->randomLetter,
            'identity_number' => fake()->unique()->numberBetween(1000000000, 999999999),
            'employee_id' => function(){
                $employee = Employee::all()->first();

                if(!$employee){
                    $employee = Employee::factory()->create();
                }

                return $employee->id;
            },
            'address_id' => Address::factory()->create()->id,
        ];
    }
}
