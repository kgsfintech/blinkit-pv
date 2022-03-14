<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teamprofile extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function teammember()
    {
        return $this->hasMany('App\Models\Teammember','id','teammember_id');
    }
    
}
