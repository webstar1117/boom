<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $guarded = [];

    public function plan()
    {
        return $this->hasOne('App\Models\Plan', 'id', 'plan_id');    
    }
    use HasFactory;
}