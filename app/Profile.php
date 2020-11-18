<?php

namespace App;
use App\User;
use App\Kursus;
use App\reset;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'photo','user_id','alamat','telp','gender','alumni'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kursus()
    {
        return $this->belongsToMany(Kursus::class);
    }

    public function reset()
    {
        return $this->hasMany(reset::class);
    }
}
