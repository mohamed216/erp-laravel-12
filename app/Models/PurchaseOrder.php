<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PurchaseOrder extends Model
{
    protected $fillable = ['order_number', 'supplier_id', 'total_amount', 'status', 'order_date'];
    public function supplier() { return $this->belongsTo(Supplier::class); }
}
