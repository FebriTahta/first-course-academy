<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kelas_mapel extends Model
{
    protected $table = "kelas_mapel";
    protected $fillable = ['kelas_id','mapel_id'];
}
