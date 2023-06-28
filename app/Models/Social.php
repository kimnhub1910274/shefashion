<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    public $timestamp =false;
    protected $fillable = [
        'provider_user_id', 'provider', 'user'
    ];
    protected $primaryKey = 'user_id';
    protected $table = 'tbl_social';

    public function login(){
        return $this->belongTo('App\Login', 'user');
    }
}
