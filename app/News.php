<?php
use App\User;
namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'user_id','news_tittle','news_desc'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
