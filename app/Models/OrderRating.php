<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderRating extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'order_code','rating',
    ];
    protected $primaryKey = 'rating_id';
    protected $table = 'tbl_rating';


    public function review()
{
    return $this->belongsTo('App\Models\OrderReview', 'range_id');
}
}

