<?php

namespace App\Http\Controllers;
use App\Video;
use Illuminate\Support\Str;
use Auth;
use App\Kursus;
use Illuminate\Http\Request;

class VideoController extends Controller
{ 
    public function store(Request $request)
    {
        $kursus_id          = $request->kursus_id;
        $video_id           = $request->id;
        $kursus             = Kursus::find($kursus_id);
        $video              = Video::updateOrCreate(['id' => $video_id],
                            [
                            'user_id'=>$request->user_id,            
                            'kelas_id'=>$request->kelas_id,
                            'mapel_id'=>$request->mapel_id,
                            'video_link'=>$request->video_link,
                            'video_name'=>$request->video_name,                    
                            ]);
        $data_video         = Video::find($video_id);
        //cek data video tersebut sudah ada apa belum, kalo sudah hanya update, kalo belum add lagi ke kursus
        if ($data_video     ===     null) {
            # code...
            $kursus->video()->attach($video);
        }        
        $notif = array(
            'pesan-sukses' => 'video kursus baru berhasil ditambahkan',                
        );
        return redirect()->back()->with($notif);                                
    }

    public function storecopy(Request $request)
    {
        $id         = $request->kursus_id;
        $kursus     = Kursus::find($id);        
        
        foreach ($request->video_id as $key => $value) {
            # code...
            $data   = array (
                'video_id'=>$request->video_id[$key]
            );            
            $kursus->video()->syncWithoutDetaching($data);                         
        }
        $notif = array(
            'pesan-sukses' => 'video kursus baru berhasil disalin',                
        );
        return redirect()->back()->with($notif);        
    }

    public function removeVid(Request $request)
    {
        $video_id   = $request->id;
        $kursus_id  = $request->kursus_id;
        $kursus     = Kursus::find($kursus_id);
        $video      = Video::find($video_id);
        
        $kursus->video()->detach($video);
        
        $notif = array(
            'pesan-peringatan' => 'video kursus berhasil dihapus',                
            );
            
        return redirect()->back()->with($notif);        
    }

    //start copy video encode anya test
    public function get_video_name()
    {
        $video_id = (new video)->get_video_name();
        echo json_encode($video_id);                
    }

    // public function get_kelasId()
    // {
    //     $kelsId_ = (new Video)->get_kelasId();
    //     echo json_encode($kelsId_);
    // }

    // public function get_mapelId()
    // {
    //     $maplId_ = (new Video)->get_mapelId();
    //     echo json_encode($maplId_);
    // }

    public function get_videoLink()
    {
        $vidL_ = (new Video)->get_videoLink();
        echo json_encode($vidL_);
    }

    // public function get_slugV()
    // {
    //     $slugV_ = (new Video)->get_slugV();
    //     echo json_encode($slugV_);
    // }
    //end start copy video encode

    public function myvideo()
    {
        $user   = Auth::id();
        $video  = Video::where('user_id', $user)->get();
        return view('admin/daftarKonten/video', compact('video'));
    }
}
