<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Transaction extends Model
{
    protected $fillable = ['account_id', 'amount', 'employee_id', 'type_of_transaction_id'];
    use HasFactory;

    public static function genTransactionCode(){
        $code = [
            'code' => mt_rand(10000, 99999)
        ];

        $rules = ['code' => 'unique:accounts'];

        $validate = Validator::make($code, $rules)->passes();

        return $validate ? $code['code'] : self::genTransactionCode();
    }
}
