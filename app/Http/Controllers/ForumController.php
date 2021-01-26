<?php

namespace App\Http\Controllers;
use App\Mapel;
use App\Kelas;
use App\Forum;
use Auth;
use App\User;
use App\Kursus;
use App\Komentar;
use App\kelas_mapel;
use App\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        $id         = Auth::id();
        $user       = User::find($id);
        $data_kelas = Kelas::all();
        $data_mapel = Mapel::all();
        $data_kursus= Kursus::all();
        $kategori   = kelas_mapel::all();
        return view('forum.index',compact('kategori','data_kelas','data_mapel','user','data_kursus'));
    }

    public function index2()
    {
        $id         = Auth::id();
        $user       = User::find($id);
        $data_kelas = Kelas::all();
        $data_mapel = Mapel::all();
        $data_kursus = Kursus::all();
        $kategori   = kelas_mapel::all();
        return view('forum.new_ui_forum.index',compact('kategori','data_kelas','data_mapel','user','data_kursus'));
    }
    
    public function daftarpertanyaan($slug_k,$slug_m)
    {
        $id             = Auth::id();
        $data_kelas     = Kelas::where('slug',$slug_k)->first();
        $data_kelas_id  = $data_kelas->id;
        $data_mapel     = Mapel::where('slug',$slug_m)->first();
        $data_mapel_id  = $data_mapel->id;
        $data_forum     = Forum::where('kelas_id', $data_kelas_id)->where('mapel_id', $data_mapel_id)->where('status','reguler')->orderBy('id', 'DESC')->paginate(10);        
        $pertanyaanku   = Forum::where('user_id', $id)->where('kelas_id', $data_kelas_id)->where('status','reguler')->where('mapel_id', $data_mapel_id)->orderBy('id','DESC')->get();
        return view('forum.daftar_pertanyaan', compact('data_kelas','data_mapel','data_forum','pertanyaanku'));
    }
    //new_ui_forum
    public function daftarpertanyaans($slug_k,$slug_m)
    {
        $id             = Auth::id();
        $data_kelas     = Kelas::where('slug',$slug_k)->first();
        $data_kelas_id  = $data_kelas->id;
        $data_mapel     = Mapel::where('slug',$slug_m)->first();
        $data_mapel_id  = $data_mapel->id;
        $data_forum     = Forum::where('kelas_id', $data_kelas_id)->where('mapel_id', $data_mapel_id)->where('status','reguler')->orderBy('id', 'DESC')->paginate(20);        
        $pertanyaanku   = Forum::where('user_id', $id)->where('kelas_id', $data_kelas_id)->where('mapel_id', $data_mapel_id)->where('status','reguler')->orderBy('id','DESC')->paginate(20);
        return view('forum.new_ui_forum.daftar_pertanyaan', compact('data_kelas','data_mapel','data_forum','pertanyaanku'));
    }

    public function detailpertanyaanss($slug)
    {
        $id                     = Auth::id();
        $data_pertanyaan_forum  = Forum::where('slug',$slug)->first();
        $forum_id               = $data_pertanyaan_forum->id;  
        $get_kelas_id           = $data_pertanyaan_forum->kelas_id;
        $data_kelas             = Kelas::where('id', $get_kelas_id)->first();
        $get_mapel_id           = $data_pertanyaan_forum->mapel_id;
        $data_mapel             = Mapel::where('id', $get_mapel_id)->first();
        $data_forum             = Forum::where('kelas_id', $get_kelas_id)->where('mapel_id', $get_mapel_id)->where('status','reguler')->paginate(20);
        $pertanyaanku           = Forum::where('user_id', $id)->where('kelas_id', $get_kelas_id)->where('mapel_id', $get_mapel_id)->where('status','reguler')->orderBy('id','DESC')->paginate(20);
        $komen                  = Komentar::where('forum_id', $forum_id)->orderBy('status','DESC')->get();
        return view('forum.new_ui_forum.detail_pertanyaan',compact('komen','data_pertanyaan_forum','data_kelas','data_mapel','data_forum','pertanyaanku'));
    }

    public function daftarpertanyaanP($slug_k,$slug_m)
    {
        $id             = Auth::id();
        $data_kelas     = Kelas::where('slug',$slug_k)->first();
        $data_kelas_id  = $data_kelas->id;
        $data_mapel     = Mapel::where('slug',$slug_m)->first();
        $data_mapel_id  = $data_mapel->id;
        $data_forum     = Forum::where('kelas_id', $data_kelas_id)->where('status','premium')->where('mapel_id', $data_mapel_id)->orderBy('id', 'DESC')->paginate(10);        
        $pertanyaanku   = Forum::where('user_id', $id)->where('kelas_id', $data_kelas_id)->where('mapel_id', $data_mapel_id)->where('status','premium')->orderBy('id','DESC')->get();
        return view('forum.daftar_pertanyaan_premium', compact('data_kelas','data_mapel','data_forum','pertanyaanku'));
    }

    public function detailpertanyaan($slug)
    {
        $data_pertanyaan_forum  = Forum::where('slug',$slug)->first();
        $forum_id               = $data_pertanyaan_forum->id;        
        $get_kelas_id           = $data_pertanyaan_forum->kelas_id;
        $data_kelas             = Kelas::where('id', $get_kelas_id)->first();
        $get_mapel_id           = $data_pertanyaan_forum->mapel_id;
        $data_mapel             = Mapel::where('id', $get_mapel_id)->first();
        $data_forum             = Forum::where('kelas_id', $get_kelas_id)->where('mapel_id', $get_mapel_id)->where('status','reguler')->paginate(5);

        $komen                 = Komentar::where('forum_id', $forum_id)->orderBy('status','DESC')->get();
                return view('forum.detail_pertanyaan',compact('komen','data_pertanyaan_forum','data_kelas','data_mapel','data_forum'));
    }

    public function store(Request $request)
    {
        
        $a=Forum::create([
            'user_id'=>$request->user_id,
            'kelas_id'=>$request->kelas_id,
            'mapel_id'=>$request->mapel_id,
            'judul_pertanyaan'=>$request->judul_pertanyaan,
            'desc_pertanyaan'=>$request->desc_pertanyaan,
            'status' => $request->status,
            'slug'=>Str::slug($request->slug)
        ]);
        if($request -> hasFile('desc_pertanyaan'))
        {
            $request->file('desc_pertanyaan')->move('desc_pertanyaan/',$request->file('desc_pertanyaan')->getClientOriginalName());
            $a->desc_pertanyaan = $request->file('desc_pertanyaan')->getClientOriginalName();
            $a->save();
        }
        $notif = array(
            'pesan-sukses' => 'Pertanyaan anda berhasil di publikasi',                
            );
        return redirect()->back()->with($notif);                    
    }

    public function storeP(Request $request)
    {
        
        $a=Forum::create([
            'user_id'=>$request->user_id,
            'kelas_id'=>$request->kelas_id,
            'mapel_id'=>$request->mapel_id,
            'judul_pertanyaan'=>$request->judul_pertanyaan,
            'desc_pertanyaan'=>$request->desc_pertanyaan,
            'status'=>$request->status,
            'slug'=>Str::slug($request->slug)
        ]);
        if($request -> hasFile('desc_pertanyaan'))
        {
            $request->file('desc_pertanyaan')->move('desc_pertanyaan/',$request->file('desc_pertanyaan')->getClientOriginalName());
            $a->desc_pertanyaan = $request->file('desc_pertanyaan')->getClientOriginalName();
            $a->save();
        }
        $notif = array(
            'pesan-sukses' => 'Pertanyaan anda berhasil di publikasi',                
            );
        return redirect()->back()->with($notif);                    
    }
}
