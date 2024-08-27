<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getFreeWashAvailableAttribute()
    {
        return $this->transactions()->count() >= 5;
    }
}
