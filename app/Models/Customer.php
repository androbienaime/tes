<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
    protected $fillable =[
        'code',
        'name',
        'firstname',
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
        return $this->hasMany(Account::class);
    }

    public function Reference_people(): \Illuminate\Database\Eloquent\Relations\HasMany{
        return $this->hasMany(ReferencePerson::class);
    }

    public function Employee(){
        return $this->belongsTo(Employee::class);
    }
}
