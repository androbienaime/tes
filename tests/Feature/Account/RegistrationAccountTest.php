<?php

namespace Tests\Feature\Account;

//use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Account;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\TypeOfAccount;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationAccountTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_account_screen_can_be_rendered()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/admin/account');

        $response->assertOk();
    }

    public function test_new_accounts_can_registred() : void
    {
        $user = User::factory()->create();
        $employee = Employee::factory()->create();
        $typeofAccount = TypeOfAccount::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post("/admin/account", [
                'id' => 1,
                'code' => Account::genAccountsCode($typeofAccount).'-'.rand(1000, 1100),
                'type_of_account_id' => $typeofAccount,
                'customer_id' => Customer::factory()->create(),
                'state' => 1
            ]);

        $response->assertRedirect("/admin/account");
    }
}
