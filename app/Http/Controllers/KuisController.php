<?php

namespace App\Http\Controllers;
use App\Kuis;
use App\Kursus;
use Auth;
use App\User;
use App\Kelas;
use App\Mapel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class KuisController extends Controller
{
    public function store(Request $request)
    {
        $kursus_id      = $request->kursus_id;        
        $kuis_id        = $request->id;        
        $cek_kuis       = Kuis::where('slug',$request->slug)->first();                
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
            if ($kursus_id === null) {
                # code...
                $notif = array(
                    'pesan-sukses' => 'kuis berhasil ditambahkan',                
                );
                return redirect()->back()->with($notif);
            } else {
                # code...
                if ($data_kuis  === null) {
                    # code...
                    $kursus         = Kursus::find($kursus_id);
                    $kursus->kuis()->attach($new_kuis);
                }
                    $notif = array(
                                'pesan-sukses' => 'kuis baru berhasil ditambahkan pada kursus',                
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
        $kuis_id    = $request->id;
        $kursus_id  = $request->kursus_id;
        $kursus     = Kursus::find($kursus_id);
        $kuis       = Kuis::find($kuis_id);

        $kursus->kuis()->detach($kuis);        
        $notif = array(
            'pesan-peringatan' => 'kuis tersebut berhasil dihapus',                
            );
                        
        return redirect()->back()->with($notif);   
    }

    public function mykuis()
    {
        $user   = Auth::id();
        $users  = User::find($user);
        $kuis   = Kuis::where('user_id', $user)->get();
        $kuiss  = Kuis::all();
        $kelass = Kelas::all();
        $mapels = Mapel::all();
        $instruktur = User::where('role', 'instruktur')->where('stat', '1')->get();
        return view('/admin/daftarKonten/kuis', compact('kuis','kuiss','user','users','kelass','mapels','instruktur'));
    }

    public function hapusKuisPermanen(Request $request){
        $id         = $request->id;
        $kuis       = Kuis::find($id);
        $kuis_name  = $kuis->kuis_name;

        $notif      = array(
                    'pesan-bahaya' => 'kuis "'.$kuis_name.'" berhasil dihapus',                
                    );
        $kuis->delete();    
        return redirect()->back()->with($notif);   
    }
}
