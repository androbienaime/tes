<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueWithinTimeframe implements Rule
{
    public function passes($attribute, $value)
    {
        // Insérez votre logique de validation ici
        $currentTime = Carbon::now();
        $tenMinutesAgo = $currentTime->subMinutes(10);

        $count = DB::table('transactions')
            ->where('amount', $value['amount'])
            ->where('created_at', '>=', $tenMinutesAgo)
            ->count();

        return $count === 0;
    }

    public function message()
    {
        return ;
    }
}

