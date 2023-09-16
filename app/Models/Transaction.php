<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;

class Transaction extends Model
{
    protected $fillable = [
        'account_id',
        'code',
        'amount',
        'employee_id',
        'type_of_transaction_id',
        'case_payments'
    ];
    use HasFactory, SoftDeletes;

    public function Employee(){
        return $this->belongsTo(Employee::class);
    }

    public function Type_of_transaction(){
        return $this->belongsTo(TypeOfTransaction::class);
    }

    public function Account(){
        return $this->belongsTo(Account::class);
    }


    public function tags_payment(){
        return $this->hasMany(TagsPayment::class);
    }

    public function tagspayment(){
        return $this->hasMany(TagsPayment::class);
    }
    public static function genTransactionCode(){
        $code = [
            'code' => mt_rand(1000000000, 999999999999)
        ];

        $rules = ['code' => 'unique:transactions'];

        $validate = Validator::make($code, $rules)->passes();

        return $validate ? $code['code'] : self::genTransactionCode();
    }
}
