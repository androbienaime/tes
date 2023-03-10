<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfAccount extends Model
{
    protected $fillable = [
        'name',
        'price',
        'duration',
        'active_case_payments'
    ];
    use HasFactory;
}
