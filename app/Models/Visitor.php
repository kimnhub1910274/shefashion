<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'ip_address','date_visit',
    ];
    protected $primaryKey = 'id_visitor';
    protected $table = 'tbl_visitor';
}
