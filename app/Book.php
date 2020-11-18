<?php

namespace App;
use App\Kursus;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'user_id','kelas_id','mapel_id','book_name','book_file','slug'
    ];

    public function kursus()
    {
        return $this->belongsToMany(kursus::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
