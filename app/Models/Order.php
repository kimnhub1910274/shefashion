<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'customer_id', 'ship_id', 'order_total', 'order_status', 'created_at'
    ];
    protected $primaryKey = 'order_id';
    protected $table = 'tbl_orders';



}
