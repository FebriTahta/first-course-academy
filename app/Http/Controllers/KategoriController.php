<?php

namespace App\Http\Controllers;
use App\Kelas;
use App\Mapel;
use App\kelas_mapel;
use App\Kursus;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $data_mapel = Mapel::all();
        $data_kelas = Kelas::all();
        $data_kategori = kelas_mapel::all();
        return view('admin.daftarKategori.index', compact('data_mapel','data_kelas','data_kategori'));
    }

    public function storemapel(Request $request)
    {
        $result = Mapel::where(['mapel_name' => $request->mapel_name])->first();
        if ($result===null) {
            # code...
            $add_mapel = Mapel::firstOrCreate([
                'mapel_name'=>$request->mapel_name,
                'slug'=>Str::slug($request->mapel_name)
            ]);            
            $notif = array(
                'pesan-sukses' => 'Data mapel Baru Berhasil Ditambahkan',                
            );  
            return redirect()->back()->with($notif);
        }
        $notif = array(
            'pesan' => 'Data mapel Sudah Ada, Silahkan Periksa Daftar mapel yang Ada',            
        );  
        return redirect()->back()->with($notif);
    }
    
    public function storekelas(Request $request)
    {
        $result = Kelas::where(['kelas_name' => $request->kelas_name])->first();
        if ($result===null) {
            # code...
            $add_kelas = Kelas::firstOrCreate([
                'kelas_name'=>$request->kelas_name,
                'slug'=>Str::slug($request->kelas_name)
            ]);            
            $notif = array(
                'pesan-sukses' => 'Data Kelas Baru Berhasil Ditambahkan',
                'alert-type' => 'success'
            );  
            return redirect()->back()->with($notif);
        }
        $notif = array(
            'pesan' => 'Data Kelas Sudah Ada, Silahkan Periksa Daftar kelas yang Ada',
            'alert-type' => 'info'
        );  
        return redirect()->back()->with($notif);
    }

    public function storekategorikursus(Request $request)
    {
        $result = kelas_mapel::where(['kelas_id' => $request->kelas_id])->where(['mapel_id' => $request->mapel_id])->first();
        if ($result===null) {
            # code...
            $kelas      = Kelas::where('id', $request->kelas_id)->first();
            $mapel      = Mapel::where('id', $request->mapel_id)->first();
            $kelas->mapel()->syncWithoutDetaching($mapel);
            $notif = array(
                'pesan-sukses' => 'Kategori Kursus Baru Berhasil Ditambahkan',
                'alert-type' => 'success'
            );  
            return redirect()->back()->with($notif);
        }
        $notif = array(
            'pesan' => 'Kategori Kursus Sudah Ada. Silahkan Periksa Daftar kategori yang Ada',
            'alert-type' => 'info'
        );  
        return redirect()->back()->with($notif);
    }

    public function dellkelas(Request $request)
    {
        $id         =   $request->id;
        $kelas      =   Kelas::find($id);
        $kategori   =   kelas_mapel::where('kelas_id', $id)->first();

        if ($kategori == null) {
            # code...
            $kelas->delete();
            $notif      = array(
                'pesan-peringatan' => 'Kelas Tersebut Berhasil Dihapus',            
            );  
            return redirect()->back()->with($notif);

        }else{
            $notif      = array(
                'pesan-peringatan' => 'Tidak dapat menghapus kelas yang menjadi kategori kursus',            
            );  
            return redirect()->back()->with($notif);
        }                      
    }

    public function dellmapel(Request $request)
    {
        $id         =   $request->id;
        $mapel      =   Mapel::find($id);
        $kategori   =   kelas_mapel::where('mapel_id', $id)->first();

        if ($kategori == null) {
            # code...
            $mapel->delete();

            $notif      = array(
                'pesan-peringatan' => 'Mapel Tersebut Berhasil Dihapus',            
            );  
            return redirect()->back()->with($notif);

        }else{
            $notif      = array(
                'pesan-peringatan' => 'Tidak dapat menghapus mapel yang menjadi kategori kursus',            
            );  
            return redirect()->back()->with($notif);
        }         
    }

    public function dellkategori(Request $request)
    {        
        $kelas      = Kelas::where('id', $request->kelas_id)->first();
        $mapel      = Mapel::where('id', $request->mapel_id)->first();        
        $kursus     = Kursus::where('kelas_id', $request->kelas_id)->where('mapel_id', $request->mapel_id)->first();
        
        if ($kursus === null) {
            # code...
            $kelas->mapel()->detach($mapel);

            $notif  = array(
                'pesan-peringatan' => 'Kategori Tersebut Berhasil Dihapus',            
            );  
            return redirect()->back()->with($notif);
        } else {
            # code...
            $notif  = array(
                'pesan-peringatan' => 'Gagal Menghapus Kategori Kursus karena terdapat kursus dalam kategori tersebut',            
            );  
            return redirect()->back()->with($notif);
        }                
    }
}
