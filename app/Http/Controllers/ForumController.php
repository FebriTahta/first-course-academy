<?php

namespace App\Http\Controllers;
use App\Mapel;
use App\Kelas;
use App\Forum;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        $data_kelas=Kelas::all();
        $data_mapel=Mapel::all();
        return view('forum.index',compact('data_kelas','data_mapel'));
    }
    
    public function daftarpertanyaan($slug_k,$slug_m)
    {
        $data_kelas     = Kelas::where('slug',$slug_k)->first();
        $data_kelas_id  = $data_kelas->id;
        $data_mapel     = Mapel::where('slug',$slug_m)->first();
        $data_mapel_id  = $data_mapel->id;
        $data_forum     = Forum::where('kelas_id', $data_kelas_id)->where('mapel_id', $data_mapel_id)->get();
        $id             = Auth::id();
        $pertanyaanku   = Forum::where('user_id', $id)->where('kelas_id', $data_kelas_id)->where('mapel_id', $data_mapel_id)->get();
        return view('forum.daftar_pertanyaan', compact('data_kelas','data_mapel','data_forum','pertanyaanku'));
    }

    public function detailpertanyaan($slug)
    {
        $data_pertanyaan_forum  = Forum::where('slug',$slug)->first();
        $get_kelas_id           = $data_pertanyaan_forum->kelas_id;
        $data_kelas             = Kelas::where('id', $get_kelas_id)->first();
        $get_mapel_id           = $data_pertanyaan_forum->mapel_id;
        $data_mapel             = Mapel::where('id', $get_mapel_id)->first();
        $data_forum             = Forum::where('kelas_id', $get_kelas_id)->where('mapel_id', $get_mapel_id)->get();
        return view('forum.detail_pertanyaan',compact('data_pertanyaan_forum','data_kelas','data_mapel','data_forum'));
    }

    public function store(Request $request)
    {
        Forum::updateOrCreate([
            'user_id'=>$request->user_id,
            'kelas_id'=>$request->kelas_id,
            'mapel_id'=>$request->mapel_id,
            'judul_pertanyaan'=>$request->judul,
            'desc_pertanyaan'=>$request->desc,
            'slug'=>Str::slug($request->slug)
        ]);
        if($request -> hasFile('kursus_desc'))
        {
            $request->file('kursus_desc')->move('kursus_desc/',$request->file('kursus_desc')->getClientOriginalName());
            $addinstrukturkursus->kursus_desc = $request->file('kursus_desc')->getClientOriginalName();
            $addinstrukturkursus->save();
        }
        $notif = array(
            'pesan-sukses' => 'Pertanyaan anda berhasil di publikasi',                
            );
        return redirect()->back()->with($notif);                    
    }
}
