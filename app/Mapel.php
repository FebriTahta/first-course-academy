<?php

namespace App;
use App\Kelas;
use App\Kursus;
use App\Book;
use App\Kuis;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $fillable = [
        'mapel_name','slug'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class);
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

    public function book()
    {
        return $this->hasMany(Book::class);
    }

    public function artikel()
    {
        return $this->hasMany(Artikel::class);
    }
    
}
