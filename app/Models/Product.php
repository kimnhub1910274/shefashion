<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'product_name', 'product_image', 'product_price',
         'product_desc', 'category_id', 'product_status', 'product_quantity', 'product_sold'
    ];
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';
}
