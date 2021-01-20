<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class artikel_kursus extends Model
{
    protected $table = "artikel_kursus";
    protected $fillable = ['artikel_id','kursus_id'];
}
