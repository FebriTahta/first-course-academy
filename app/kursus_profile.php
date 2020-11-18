<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kursus_profile extends Model
{
    protected $table = "kursus_profile";
    protected $fillable = ['kursus_id','profile_id'];
}
