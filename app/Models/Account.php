<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Account extends Model
{
    protected $fillable = ['code', 'type_of_account_id', 'customer_id', 'balance', 'state'];
    use HasFactory;


    public function Customer(){
        return $this->belongsTo(Customer::class);
    }
    public function type_of_account(){
        return $this->belongsTo(TypeOfAccount::class);
    }

    public static function genAccountsCode(){
        $code = [
            'code' => mt_rand(10000, 99999)
        ];

        $rules = ['code' => 'unique:accounts'];

        $validate = Validator::make($code, $rules)->passes();

        return $validate ? $code['code'] : self::genAccountsCode();
    }
}
