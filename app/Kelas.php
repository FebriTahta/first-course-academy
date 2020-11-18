<?php

namespace App;
use App\Mapel;
use App\Kursus;
use App\Kelas;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = [
        'kelas_name','slug'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function mapel()
    {
        return $this->belongsToMany(Mapel::class);
    }

    public function kursus()
    {
        return $this->hasMany(Kursus::class);
    }

    public function video()
    {
        return $this->hasMany(Video::class);
    }

    public function kuis()
    {
        return $this->hasMany(Kuis::class);
    }
}
