<?php
use App\Kuis;
use App\User;
use App\Profile;
// use Auth;
namespace App;

use Illuminate\Database\Eloquent\Model;

class reset extends Model
{
    protected $fillable = [
        'user_id', 'kuis_id','profile_id'
    ];

    public function kuis()
    {
        return $this->belongsTo(Kuis::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }    
}
