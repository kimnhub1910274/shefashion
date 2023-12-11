<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'customer_id','ship_address', 'ship_note', 'ship_fee', 'payment_method', 'created_at'
    ];
    protected $primaryKey = 'ship_id';
    protected $table = 'tbl_ship';
}
