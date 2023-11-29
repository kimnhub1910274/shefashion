<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeShip extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'fee_id_city','fee_id_district', 'fee_id_ward', 'fee_ship'
    ];
    protected $primaryKey = 'fee_id';
    protected $table = 'tbl_feeship';

    public function city(){
        return $this->belongsTo('App\Models\City', 'fee_id_city');
    }
    public function district(){
        return $this->belongsTo('App\Models\District', 'fee_id_district');
    }public function ward(){
        return $this->belongsTo('App\Models\Ward', 'fee_id_ward');
    }
}
