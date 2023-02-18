<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = ["code", "name", "address_id"];
    use HasFactory;

    public function Address(){
        return $this->belongsTo(Address::class);
    }
}
