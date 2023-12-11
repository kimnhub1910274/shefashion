<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'id_customer','name','phone', 'locate',
    ];
    protected $primaryKey = 'id_address';
    protected $table = 'tbl_address';
}
