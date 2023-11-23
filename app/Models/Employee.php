<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        "firstname",
        "lastname",
        "user_id",
        "gender",
        "identity_number",
        "branch_id",
        "address_id",
        "employee_id"
    ];
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function address(){
        return $this->belongsTo(Address::class);
    }


}
