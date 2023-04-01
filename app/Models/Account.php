<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Validator;

class Account extends Model
{
    protected $fillable = [
        'code',
        'type_of_account_id',
        'customer_id',
        'balance',
        'state'
    ];
    use HasFactory;


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Customer(){
        return $this->belongsTo(Customer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type_of_account(){
        return $this->belongsTo(TypeOfAccount::class);
    }

    public function transactions() : HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function tagspayment() : HasMany{
        return $this->hasMany(TagsPayment::class, 'account_id');
    }

    /**
     * @return mixed
     */
    public static function genAccountsCode(TypeOfAccount $typeOfAccount){
        $code = [
            'code' => mt_rand(100, 999)
        ];

        $rules = ['code' => 'unique:accounts'];

        $validate = Validator::make($code, $rules)->passes();

        return $validate ? $typeOfAccount->prefix.'-'.$code['code'] : self::genAccountsCode();
    }
}
