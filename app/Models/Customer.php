<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable =[
        'code',
        'name',
        'first_name',
        'gender',
        'identity_number',
        'employee_id',
        'address_id'
    ];
    use HasFactory;

    public function Address(){
        return $this->belongsTo(Address::class);
    }

    public function Account(){
        return $this->belongsTo(Account::class);
    }

    public function Referenceperson(){
        return $this->hasMany(ReferencePerson::class);
    }

    public function Employee(){
        return $this->belongsTo(Employee::class);
    }
}
