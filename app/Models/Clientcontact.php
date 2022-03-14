<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientcontact extends Model
{
    use HasFactory;

    protected $guarded = [];
    
     public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }
}
