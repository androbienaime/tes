<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Branch::create([
            "code" => "001",
            "name" => "Centrale",
            "address_id" => Address::all()->first()->id
        ]);
    }
}
