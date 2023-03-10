<?php

namespace Database\Seeders;

use App\Models\TypeOfTransaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeOfTransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeOfTransaction::create([
            "name" => "DEPOSIT"
        ]);

        TypeOfTransaction::create([
            "name" => "WITHDRAWAL"
        ]);

        TypeOfTransaction::create([
            "name" => "PAYMENT"
        ]);
    }
}
