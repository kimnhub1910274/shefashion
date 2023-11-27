<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderReview extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'customer_id', 'order_code', 'review', 'img', 'range', 'review_date'
    ];
    protected $primaryKey = 'order_review';
    protected $table = 'tbl_order_review';

    public function order(){
        return $this->belongsTo('App\Models\Order', 'order_id');
    }
    public function customer(){
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }
    public function rating(){
        return $this->belongsTo('App\Models\OrderRating', 'order_code');
    }
}
