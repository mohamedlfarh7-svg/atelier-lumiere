<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    'category', 
    'product_id', 
    'product_name',  
    'product_image', 
    'name', 
    'phone', 
    'city', 
    'address', 
    'shipping_fee', 
    'total_price', 
    'status'
];
}
