<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $fillable = [
        'kuis_id','profile_id','nilai','ke'
    ];

    public function kuis()
    {
        return $this->belongsTo(Kuis::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
