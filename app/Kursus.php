<?php

namespace App;
use App\User;
use App\Kelas;
use App\Mapel;
use App\Video;
use App\Kuis;
use App\Profile;
use Illuminate\Database\Eloquent\Model;

class Kursus extends Model
{
    protected $fillable = [
        'user_id','kelas_id','mapel_id','kursus_pict','slug','status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    public function artikel()
    {
        return $this->belongsToMany(Artikel::class)->withTimestamps();
    }

    public function video()
    {
        return $this->belongsToMany(Video::class)->withTimestamps();
    }

    public function profile()
    {
        return $this->belongsToMany(Profile::class);
    }

    public function kuis()
    {
        return $this->belongsToMany(Kuis::class);
    }

    public function book()
    {
        return $this->belongsToMany(Book::class);
    }
}
