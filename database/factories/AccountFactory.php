<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\TypeOfAccount;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => function(){
                $typeofAccount = TypeOfAccount::all()->first();
                $code = " ";
                if($typeofAccount){
                    $code = $typeofAccount->prefix.'-'.rand(100, 999);
                }else{
                    $code = TypeOfAccount::factory()->create()->prefix.'-'.rand(100, 999);
                }

                return $code;
            },
            'type_of_account_id' => function(){
                $typeofaccount = TypeOfAccount::all()->first();
                if(!$typeofaccount){
                    $typeofaccount = TypeOfAccount::factory()->create();
                }

                return $typeofaccount->id;
            },
            'customer_id' => function(){
                $customer = Customer::all()->first();
                if(!$customer){
                    $customer = Customer::factory()->create();
                }
                return $customer->id;
            },
            'state' => 1,
            'employee_id' =>function(){
                $employee = Employee::all()->first();

                if(!$employee){
                    $employee = Employee::factory()->create();
                }

                return $employee->id;
            }
        ];
    }
}
