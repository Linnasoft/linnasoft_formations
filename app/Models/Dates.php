<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dates extends Model
{
    protected $table = "formations_dates";
    protected $fillable = ['formation_id', 'starts_on', 'starts_at', 'ends_at'];
}
