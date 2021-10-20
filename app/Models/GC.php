<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GC extends Model
{
    protected $table = "general_conditions";
    protected $fillable = ['label', 'value'];
}
