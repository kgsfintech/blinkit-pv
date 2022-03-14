<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subfinancialclassfication extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function financialstatementclassification()
    {
        return $this->belongsTo('App\Models\Financialstatementclassification');
    }
}
