<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders extends Model
{
    use HasFactory;
    // use SoftDeletes; // implement pending

    protected $table = 'orders';

    public function OrderProduct()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }
    public function OrderCustomer()
    {
        return $this->belongsTo(Customers::class, 'customer_id', 'id');
    }
    public function OrderStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status', 'id');
    }
}
