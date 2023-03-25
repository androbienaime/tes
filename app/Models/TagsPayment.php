<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagsPayment extends Model
{
    use HasFactory;

    public function Account(){
        return $this->belongsTo(Account::class);
    }
}
