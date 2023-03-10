<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("role_user")->truncate();

        $superAdmin = User::create([
            "name" => "admin",
            "email" => "admin@lestruviens.com",
            "password" => Hash::make("Admin")
        ]);

        $superAdminRole = Role::where("name", "superAdmin")->first();

        $superAdmin->roles()->attach($superAdminRole);
    }

}
