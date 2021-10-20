<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = "students";
    protected $fillable = ['firstname', 'lastname', 'email', 'phone_number', 'gender', 'formation_id'];
}
