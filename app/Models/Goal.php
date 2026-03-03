<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Goal extends Model
{
    protected $fillable = ['title', 'target', 'current', 'period', 'start_date', 'end_date', 'achieved'];
}
