<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::create([
            "lastname" => "Lestr",
            "firstname" => "BG",
            "identity_number" => "2090210210",
            "user_id" => User::all()->first()->id,
            "gender" => "Male",
            "branch_id" => Branch::all()->first()->id
        ]);
    }
}
