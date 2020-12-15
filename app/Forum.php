<?php
use App\User;
use App\Komentar;
namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $fillable = [
        'user_id','kelas_id','mapel_id','judul_pertanyaan','desc_pertanyaan','slug','status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function komentar()
    {
        return $this->hasMany(Komentar::class);
    }
}
