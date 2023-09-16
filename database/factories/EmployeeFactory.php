<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'firstname' => fake()->firstName,
            'lastname' => fake()->lastName,
            'user_id' => function (){
                $user = User::all()->first();

                if($user){
                    return $user->id;
                }else {
                    return User::factory()->create()->id;
                }
            },
            'gender' => fake()->randomLetter,
            'identity_number' => fake()->unique()->numberBetween(1000000000, 999999999),
            'branch_id' => function(){
                return Branch::factory()->create()->id;
            },
            'address_id' => function (){
                return Address::factory()->create()->id;
            }
        ];
    }
}
