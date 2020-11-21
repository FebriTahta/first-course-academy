<?php

namespace App\Http\Controllers;
use App\Kelas;
use App\Mapel;
use App\Kursus;
use App\kelas_mapel;
use App\User;
use App\Video;
use App\Kuis;
use App\Book;
use App\kursus_profile;
use App\Profile;
use App\kursus_video;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class KursusController extends Controller
{

    public function index()
    {
        $data_kelas=Kelas::all();
        $data_mapel=Mapel::all();
        $data_kategori=kelas_mapel::all();
        $data_kursus=Kursus::all();
        $data_user=User::all();        
        $data_instruktur=User::where('role','instruktur')->where('stat','1')->get();
        return view('admin.daftarKursus.index',compact('data_instruktur','data_user','data_kelas','data_mapel','data_kursus'));
    }

    public function store(Request $request)
    {
        $result = Kursus::where([
            'user_id'=>$request->user_id,
            'kelas_id'=>$request->kelas_id,
            'mapel_id'=>$request->mapel_id
        ])->first();

        if ($result===null) {
            # code...
            $addinstrukturkursus=Kursus::firstOrCreate([
                'user_id'=>$request->user_id,
                'kelas_id'=>$request->kelas_id,
                'mapel_id'=>$request->mapel_id,
                'kursus_pict'=>$request->kursus_pict,
                'status'=>'non aktif',
                'slug'=>Str::slug($request->slug.'-'.$request->user_id)
            ]);
            if($request -> hasFile('kursus_pict'))
            {
                $request->file('kursus_pict')->move('kursus_picture/',$request->file('kursus_pict')->getClientOriginalName());
                $addinstrukturkursus->kursus_pict = $request->file('kursus_pict')->getClientOriginalName();
                $addinstrukturkursus->save();
            }
            $notif = array(
                'pesan-sukses' => 'Materi Kursus Baru Berhasil Ditambahkan',                
                );
            return redirect()->back()->with($notif);

        } else {
            # code...
            $notif = array(
                'pesan-peringatan' => 'instruktur pada kategori kursus ini sudah terdaftar'
            );
            return redirect()->back()->with($notif);
        }
    }

    public function detail($slug)
    {           
        $data_kursus        =   Kursus::where('slug',$slug)->first();
        $data               =   $data_kursus->id;
        $data_id_kelas      =   $data_kursus->kelas_id;
        $data_id_mapel      =   $data_kursus->mapel_id;
                
        $data_kursus_siswa  =   kursus_profile::where('kursus_id', $data)->first();        
        $siswa_kursus       =   Profile::all();
        $total_user         =   Profile::all()->count();        
        $data_kuis          =   Kuis::where('kelas_id', $data_id_kelas)->where('mapel_id', $data_id_mapel)->get();                
        $data_book          =   Book::where('kelas_id', $data_id_kelas)->where('mapel_id', $data_id_mapel)->get();        
        $total_video        =   Video::where('kelas_id',$data_id_kelas)->where('mapel_id',$data_id_mapel)->pluck('video_name')->count();                
        $list_data_video_kursus =   Video::where('kelas_id',$data_id_kelas)->where('mapel_id',$data_id_mapel)->get();                            
        
        $data_instruktur        = $data_kursus->user_id;
        $data_instruktur_kursus = User::find($data_instruktur);
        
        //compare array
        $kursus_video           = kursus_video::where('kursus_id', $data)->pluck('video_id')->toArray();
        $kursus_video_all       = Video::where('kelas_id',$data_id_kelas)->where('mapel_id',$data_id_mapel)->pluck('id')->toArray();
        $data_siswa             = User::where('role','siswa')->where('stat','1')->get();
        return view('admin.detailKursus.index',compact('data_siswa','kursus_video_all','kursus_video','data_kuis','siswa_kursus','total_user','data_kursus_siswa','data_instruktur_kursus','data_book','data','data_kursus','total_video','list_data_video_kursus'));
    }

    public function addsiswa(Request $request)
    {                         
        foreach($request->profile_id as $item=>$value){
            $datas=array(                
                'kursus_id'=>$request->kursus_id[$item],
                'profile_id'=>$request->profile_id[$item]
            );
            kursus_profile::updateOrCreate($datas);            
        }
        $notif = array(
            'pesan-sukses' => 'siswa baru bergabung kedalam kursus',                
            );
        return redirect()->back()->with($notif);
    }

    public function removesiswa(Request $request)
    {
        $kursus_id      = $request->kursus_id;
        $profile_id     = $request->profile_id;
        kursus_profile::where('kursus_id', $kursus_id)->where('profile_id', $profile_id)->delete();        
        $notif = array(
            'pesan-peringatan' => 'siswa tersebut telah dikeluarkan dari kursus',                
            );
        return redirect()->back()->with($notif);
    }

    public function remove(Request $request)
    {
        $data = $request->id;

        $kursus = Kursus::find($data);

        if (count($kursus->profile)) {
            # code...
            $notif = array(
                'pesan-peringatan' => 'GAGAL menghapus karena pada kursus tersebut terdapat siswa yang berlangganan kursus',                
                );
            return redirect()->back()->with($notif);
        } else {
            # code...
            Kursus::where('id', $data)->delete();
            $notif = array(
                'pesan-peringatan' => 'kursus tersebut berhasil dihapus',                
                );
            return redirect()->back()->with($notif);
        }                        
    }

    public function mykursus(Request $request)
    {
        $kursus     = Kursus::all();
        return view('admin.daftarKonten.kursus', compact('kursus'));
    }

    public function allkursus()
    {
        $user       = Auth::id();
        $kursus     = Kursus::where('status','aktif')->get(); 
        return view('semuaKursus.index',compact('kursus'));
    }

    public function allkursusadmin()
    {
        $user       = Auth::id();
        $kursus     = Kursus::where('status','aktif')->get(); 
        return view('semuaKursus.index2',compact('kursus'));
    }
    
}
