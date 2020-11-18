<?php

namespace App;
use App\User;
use App\Kuis;
use App\Pertanyaan;
use App\Answer;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'user_id','kuis_id','pertanyaan_id','answer_id','myresult'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kuis()
    {
        return $this->belongsTo(Kuis::class);
    }

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class);
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
    
}
