<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['title', 'amount', 'category', 'date', 'notes'];
    protected $casts = ['amount' => 'decimal:2', 'date' => 'date'];
}
