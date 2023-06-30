<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProducts extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'cate_name', 'meta_keywords', 'meta_desc', 'cate_quantity', 'cate_status'
    ];
    protected $primaryKey = 'cate_id';
    protected $table = 'tbl_cate_pro';
}
