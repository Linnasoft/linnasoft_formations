<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    protected $table = "formations";
    protected $fillable = ['f_title', 'f_price', 'f_description', 'f_certification', 'f_requirements', 'f_type', 'f_max_students'];
}
