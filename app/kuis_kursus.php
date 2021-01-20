<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kuis_kursus extends Model
{
    protected $table = "kuis_kursus";
    protected $fillable = ['kuis_id','kursus_id'];
}
