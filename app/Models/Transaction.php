<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'vehicle_id', 'amount'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            $customer = $transaction->customer;

            // jumlah transaksi yang sudah dilakukan oleh customer
            $transactionCount = $customer->transactions()->count();

            //  diskon jika transaksi adalah kelipatan dari 5 + 1 (6, 11, 16)
            if (($transactionCount + 1) % 5 === 0) {
                $transaction->amount = 0.00;
            } else {
                $transaction->amount = $transaction->vehicle->price;
            }
        });
    }

    // Accessor untuk status
    public function getStatusAttribute()
    {
        return $this->amount == 0.00 ? 'Promo' : 'Normal';
    }
}
