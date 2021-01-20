<?php

namespace App;
use App\Kursus;
use App\Kelas;
use App\Mapel;
use App\User;
use EmbedServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Cohensive\Embed\Facades\Embed;

class Video extends Model
{
    protected $fillable = [
        'user_id','kelas_id','mapel_id','video_link','video_name','slug'
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

    public function get_video_name()
    {
        
        $video_id = $_GET["video_id"];

        $query=Video::find($video_id);        
        $a=$query["video_name"];        
        return $a;        
    }    

    public function get_kelasId()
    {
        $video_name = $_GET['video_name'];

        $query=Video::where('video_name', $video_name)->first();        
        $c=$query["kelas_id"];                
        return $c;        
    }

    public function get_mapelId()
    {
        $video_name = $_GET['video_name'];

        $query=Video::where('video_name', $video_name)->first();        
        $d=$query["mapel_id"];                
        return $d;        
    }

    public function get_videoLink()
    {
        $video_id = $_GET['video_id'];

        $query=Video::find($video_id);        
        $e=$query["video_link"];                
        return $e;        
    }

    public function get_slugV()
    {
        $video_name = $_GET['video_name'];

        $query=Video::where('video_name', $video_name)->first();        
        $f=$query["slug"];                
        return $f;        
    }
}
