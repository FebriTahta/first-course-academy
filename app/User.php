<?php

namespace App;
use App\Video;
use App\Profile;
use App\Kuis;
use App\Result;
use App\reset;
use App\Forum;
use App\Book;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','role','stat','email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function result()
    {
        return $this->hasMany(Result::class);
    }

    public function reset()
    {
        return $this->hasMany(reset::class);
    }

    public function forum()
    {
        return $this->hasMany(Forum::class);
    }

    public function book()
    {
        return $this->hasMany(Book::class);
    }
    
}
