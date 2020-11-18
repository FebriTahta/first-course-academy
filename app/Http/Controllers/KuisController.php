<?php

namespace App\Http\Controllers;
use App\Kuis;
use App\Kursus;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class KuisController extends Controller
{
    public function store(Request $request)
    {
        $kursus_id      = $request->kursus_id;        
        $kuis_id        = $request->id;
        $kursus         = Kursus::find($kursus_id);
        $cek_kuis       = Kuis::where('slug',$request->slug)->first();
        
        if ($cek_kuis   == null) {
            # code...
            $new_kuis       = Kuis::updateOrCreate(['id' => $kuis_id],[
                'user_id'   =>  $request->user_id,            
                'kelas_id'  =>  $request->kelas_id,
                'mapel_id'  =>  $request->mapel_id,
                'kuis_name' =>  $request->kuis_name,
                'kuis_desc' =>  $request->kuis_desc,
                'slug'=>Str::slug($request->slug)
            ]);
            $data_kuis      = Kuis::find($kuis_id);
            //cek jika sudah ada sebelumnya maka hanya update, jika belum add ke kursus
            if ($data_kuis  === null) {
                # code...
                $kursus->kuis()->attach($new_kuis);
            }
            $notif = array(
                        'pesan-sukses' => 'kuis baru berhasil ditambahkan pada kursus',                
                    );
            return redirect()->back()->with($notif);
        }else{
            $notif = array(
                'pesan-peringatan' => 'Anda sudah pernah membuat kuis tersebut. silahkan periksa di daftar anda',                
            );
        return redirect()->back()->with($notif);
        }
    }

    public function salin(Request $request)
    {
        $id         = $request->kursus_id;
        $kursus     = Kursus::find($id);

        foreach ($request->kuis_id as $key => $value) {
            # code...
            $data   = array (
                'kuis_id'=>$request->kuis_id[$key]
            );
            $kursus->kuis()->syncWithoutDetaching($data);
        }
        $notif = array(
            'pesan-sukses' => 'kuis baru berhasil disalin',                
        );
        return redirect()->back()->with($notif);
    }

    public function remove(Request $request)
    {
        $kuis_id   = $request->id;
        $kursus_id  = $request->kursus_id;
        $kursus     = Kursus::find($kursus_id);
        $kuis      = Kuis::find($kuis_id);

        $kursus->kuis()->detach($kuis);        
        $notif = array(
            'pesan-peringatan' => 'kuis tersebut berhasil dihapus',                
            );
                        
        return redirect()->back()->with($notif);   
    }

    public function mykuis()
    {
        $user   = Auth::id();
        $kuis   = Kuis::where('user_id', $user)->get();
        return view('/admin/daftarKonten/kuis', compact('kuis'));
    }
}
