<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'order_date', 'sale', 'profit',
         'quantity', 'total_order'
    ];
    protected $primaryKey = 'id_statistical';
    protected $table = 'tbl_statistical';
    public function statistic()
    {
        return $this->belongsToMany('App\Models\Order', 'order_date');
    }
}
