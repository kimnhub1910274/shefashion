<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    public $timestamp =false;
    protected $fillable = [
        'admin_email', 'admin_name', 'admin_phone', 'admin_password'
    ];
    protected $primaryKey = 'admin_id';
    protected $table = 'tbl_admin';


}
