<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['invoice_number', 'order_id', 'customer_id', 'total_amount', 'paid_amount', 'status'];
    protected $casts = ['total_amount' => 'decimal:2', 'paid_amount' => 'decimal:2'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function getRemainingAttribute()
    {
        return $this->total_amount - $this->paid_amount;
    }
}
