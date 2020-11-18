<?php
use App\Pertanyaan;
use App\Kursus;
use App\Kelas;
use App\Mapel;
use App\Result;
use App\User;
use App\reset;
namespace App;

use Illuminate\Database\Eloquent\Model;

class Kuis extends Model
{
    protected $fillable = ['user_id','kelas_id','mapel_id','kuis_name','kuis_desc','slug'];

    public function pertanyaan()
    {
        return $this->hasMany(Pertanyaan::class);
    }
    
    public function kursus()
    {
        return $this->belongsToMany(Kursus::class);
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function result()
    {
        return $this->hasMany(Result::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reset()
    {
        return $this->hasMany(reset::class);
    }
}
