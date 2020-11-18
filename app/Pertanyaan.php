<?php

namespace App;
use App\kuis;
use App\Pertanyaan;
use App\Result;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $fillable = [
        'kuis_id','pertanyaan_name','slug'
    ];

    public function kuis()
    {
        return $this->belongsTo(Kuis::class);        
    }

    public function answer()
    {
        return $this->hasMany(Answer::class);
    }

    public function result()
    {
        return $this->hasMany(Result::class);
    }

    public function storePertanyaan($data)
    {
        return Pertanyaan::create($data);
    }
    
    
    public function updatePertanyaan($id, $data)
    {
        $pertanyaans = Pertanyaan::where('id', $id)->first();
        $pertanyaans->pertanyaan_name = $data['pertanyaan_name'];        
        $pertanyaans->save();
        return $pertanyaans;
    }

    public function deletePertanyaan()
    {
        Pertanyaan::where('id', $id)->delete();
    }
}
