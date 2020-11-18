<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kursus_video extends Model
{
    protected $table = "kursus_video";
    protected $fillable = ['kursus_id','video_id'];
}
