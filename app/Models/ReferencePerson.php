<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferencePerson extends Model
{
    use HasFactory;

    protected $guarded;

    public function Customer(): \Illuminate\Database\Eloquent\Relations\HasMany{
        return $this->belongsTo(Customer::class);
    }
}
