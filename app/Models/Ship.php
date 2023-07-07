<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'customer_id','ship_name', 'ship_address', 'ship_phone', 'ship_email', 'ship_note'
    ];
    protected $primaryKey = 'ship_id';
    protected $table = 'tbl_ship';
}
