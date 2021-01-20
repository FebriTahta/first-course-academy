<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $fillable = [
        'user_id','kelas_id','mapel_id','artikel_pict','artikel_title','artikel_text','slug'
    ];

    public function kursus()
    {
        return $this->belongsToMany(Kursus::class)->withTimestamps();
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
