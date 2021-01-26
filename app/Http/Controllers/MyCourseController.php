<?php

namespace App\Http\Controllers;
use App\Kursus;
use App\Kuis;
use App\Pertanyaan;
use App\Answer;
use App\Result;
use App\reset;
use App\Profile;
use App\Video;
use App\User;
use Carbon\Carbon;
use App\Artikel;
use App\kursus_video;
use App\kuis_kursus;
use App\artikel_kursus;
use Auth;
use App\Mail\PengajuanResetKuis;
use App\Mail\AccResetKuis;
use App\Mail\AjuanReset;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class MyCourseController extends Controller
{
    public function courseform($slug)
    {        
        $data_kursus        = Kursus::where('slug',$slug)->first();
        $data_kursus_id     = $data_kursus->id;
        $mapel_id           = $data_kursus->mapel->id;
        $kelas_id           = $data_kursus->kelas->id;
        //video
        $video_masuk        = kursus_video::where('kursus_id', $data_kursus_id)->pluck('video_id')->toArray();
        $filter_video       = Video::where('kelas_id', $kelas_id)->where('mapel_id', $mapel_id)->whereNotIn('id', $video_masuk)->get();
        //latihansoal
        $kuis_masuk         = kuis_kursus::where('kursus_id', $data_kursus_id)->pluck('kuis_id')->toArray();
        $filter_kuis        = Kuis::where('kelas_id', $kelas_id)->where('mapel_id', $mapel_id)->whereNotIn('id', $kuis_masuk)->get();
        //artikel
        $artikel_masuk      = artikel_kursus::where('kursus_id', $data_kursus_id)->pluck('artikel_id')->toArray();
        $filter_artikel     = Artikel::where('kelas_id', $kelas_id)->where('mapel_id', $mapel_id)->whereNotIn('id', $artikel_masuk)->get();
        return view('client.mycourse.index', compact('data_kursus','filter_video','filter_kuis','filter_artikel'));        
    }

    public function kuisform($id)
    {
        $user_id            = Auth::id();        
        $data_kuis          = Kuis::where('id',$id)->first();
        $data_kuis_id       = $data_kuis->id;     
        // $data_pertanyaan    = Pertanyaan::where('kuis_id', $data_kuis_id)->with('answer')->inRandomOrder()->get();
        $data_pertanyaan    = Pertanyaan::where('kuis_id', $data_kuis_id)->with('answer')->get();
        $data_result        = Result::where('user_id', $user_id)->where('kuis_id', $data_kuis_id)->get();        
        $data_pertanyaan_R  = Pertanyaan::where('kuis_id', $data_kuis_id)->get();
        $profile            = Profile::where('user_id',$user_id)->first();
        $profile_id         = $profile->id;
        
        $data_reset         = reset::where('kuis_id',$data_kuis_id)->where('profile_id', $profile_id)->get();

        $jumlah_soal        = $data_pertanyaan->count();
        $salah              = Result::where('user_id', $user_id)->where('kuis_id', $data_kuis_id)->where('myresult','0')->count();
        $benar              = Result::where('user_id', $user_id)->where('kuis_id', $data_kuis_id)->where('myresult','1')->count();
        if ($data_result->count() > 0) {
            # code...
            $nilai              = ($jumlah_soal - $salah) * (100/$jumlah_soal);
            return view('client.mykuis.index2', compact('data_reset','nilai','data_pertanyaan','data_kuis','data_result','data_pertanyaan_R','jumlah_soal','salah','benar'));
        }else{            
            return view('client.mykuis.index2', compact('data_pertanyaan','data_kuis','data_result','data_pertanyaan_R','jumlah_soal','salah','benar'));
        }
        
    }
    //new_ui
    public function kuisform2($slug, $slug2)
    {
        // slug 1 untuk kuis dan slug 2 untuk kursus
        $user_id            = Auth::id();        
        $data_kuis          = Kuis::where('slug',$slug)->first();        
        $data_kuis_id       = $data_kuis->id;

        $data_kursus        = Kursus::where('slug',$slug2)->first();
        // $data_pertanyaan    = Pertanyaan::where('kuis_id', $data_kuis_id)->with('answer')->inRandomOrder()->get();
        $data_pertanyaan    = Pertanyaan::where('kuis_id', $data_kuis_id)->with('answer')->get();
        $data_result        = Result::where('profile_id', $user_id)->where('kuis_id', $data_kuis_id)->get();        
        $data_pertanyaan_R  = Pertanyaan::where('kuis_id', $data_kuis_id)->get();
        $profile            = Profile::where('user_id',$user_id)->first();
        $profile_id         = $profile->id;
        
        $data_reset         = reset::where('kuis_id',$data_kuis_id)->where('profile_id', $profile_id)->get();

        $jumlah_soal        = $data_pertanyaan->count();
        $salah              = Result::where('profile_id', $user_id)->where('kuis_id', $data_kuis_id)->where('myresult','0')->count();
        $benar              = Result::where('profile_id', $user_id)->where('kuis_id', $data_kuis_id)->where('myresult','1')->count();
        if ($data_result->count() > 0) {
            
            # code...
            $nilai              = ($jumlah_soal - $salah) * (100/$jumlah_soal);
            return view('client.mykuis.index2', compact('data_kursus','data_reset','nilai','data_pertanyaan','data_kuis','data_result','data_pertanyaan_R','jumlah_soal','salah','benar'));
        }else{            
            return view('client.mykuis.index2', compact('data_kursus','data_pertanyaan','data_kuis','data_result','data_pertanyaan_R','jumlah_soal','salah','benar'));
        }
    }    

    public function submitkuis(Request $request)
    {
        
        $result = 0;
        foreach ($request->input('pertanyaans', []) as $key => $pertanyaan) {
            $status = 0;

            if ($request->input('answers.'.$pertanyaan) != null
                && Answer::find($request->input('answers.'.$pertanyaan))->is_correct
            ) {
                $status = 1;
                $result++;
            }
            Result::create([
                'user_id'       => $request->user_id,
                'profile_id'    => Auth::id(),
                'kuis_id'       => $request->kuis_id,
                'pertanyaan_id' => $pertanyaan,
                'answer_id'     => $request->input('answers.'.$pertanyaan),                
                'myresult'      => $status,
            ]);
        }        

        $notif = array(
            'pesan-sukses' => 'anda telah menyelesaikan kuis',                
            );

        return redirect()->back()->with($notif);
        
    }

    //berubah dan tidak dipakai
    public function detailresult($slug)
    {
        $user_id            = Auth::id();
        $data_kuis          = Kuis::where('slug', $slug)->first();
        $data_kuis_id       = $data_kuis->id;                
        $data_pertanyaan    = Pertanyaan::where('kuis_id', $data_kuis_id)->get();
        $data_result        = Result::where('user_id', $user_id)
                                    ->where('kuis_id',$data_kuis_id)->get();
        $data_result_benar  = Result::where('user_id', $user_id)
                                    ->where('kuis_id',$data_kuis_id)
                                    ->where('myresult','1')->count();
        $data_result_salah  = Result::where('user_id', $user_id)
                                    ->where('kuis_id',$data_kuis_id)
                                    ->where('myresult','0')->count();                                    
        $jumlah_soal        = $data_result->count();
        $nilai              = ($jumlah_soal - $data_result_salah) * (100/$jumlah_soal);
                
        return view('client.mykuis.detail', compact('data_kuis','data_pertanyaan','data_result','data_result_benar','nilai'));
    }

    public function detailresultsiswa($id, $user_id)
    {
        $user_id            = $user_id;
        $data_kuis          = Kuis::where('id', $id)->first();
        $data_kelas         = $data_kuis->kelas->id;
        $data_mapel         = $data_kuis->mapel->id;
        $data_kursus        = Kursus::where('kelas_id',$data_kelas)->where('mapel_id',$data_mapel)->first();
        $data_kuis_id       = $data_kuis->id;                
        $data_pertanyaan    = Pertanyaan::where('kuis_id', $data_kuis_id)->get();
        $data_result        = Result::where('user_id', $user_id)
                                    ->where('kuis_id',$data_kuis_id)->get();
        $result_siswa       = Result::where('user_id', $user_id)
                                    ->where('kuis_id', $data_kuis_id)->first();                                    
        $benar              = Result::where('user_id', $user_id)
                                    ->where('kuis_id',$data_kuis_id)
                                    ->where('myresult','1')->count();
        $salah              = Result::where('user_id', $user_id)
                                    ->where('kuis_id',$data_kuis_id)
                                    ->where('myresult','0')->count();                                    
        $jumlah_soal        = $data_result->count();
        $nilai              = ($jumlah_soal - $salah) * (100/$jumlah_soal);                

        return view('client.mykuis.index2', compact('data_kursus','result_siswa','data_kuis','data_pertanyaan','data_result','benar','nilai','salah'));
    }

    public function resetkuis(Request $request)
    {   
        $profile_id     = $request->profile_id;
        $profile        = Profile::find($profile_id);
        $user_id        = $profile->user_id;
        $user           = User::find($user_id);
        $user_name      = $user->name;
        $user_mail      = $user->email;
        $kuis           = Kuis::find($request->kuis_id);
        $kuis_name      = $kuis->kuis_name;
        
        $detail         = [
            'title'     => 'Hai '.$user_name.'',
            'body'      => 'Pengajuan reset hasil kuis pada kuis ('.$kuis_name.') yang sudah kamu ajukan telah disetujui dan telah direset oleh instruktur',
            'link'      => 'course-academy.top'
        ];
        //kirim email dulu
        $when           = Carbon::now()->addSeconds(10);
        Mail::to($user_mail)->send((new AccResetKuis($detail))->delay($when));
        
        $result         =   Result::where([
                                    'kuis_id'=>$request->kuis_id,
                                    'profile_id'=>$request->profile_id,
                            ])->delete();        
        $reset          =   reset::find($request->id)->delete();
        
        $notif          =   array('pesan-peringatan' => 'hasil kuis berhasil direset');
        
        return redirect()->back()->with($notif);
    }

    public function ajukanreset(Request $request)
    {
        $kuis_id            = $request->kuis_id;
        $user_id            = Auth::id();
        $kuis               = Kuis::find($kuis_id);
        $nama_kuis          = $kuis->kuis_name;
        $instruktur         = User::find($request->user_id);
        $nama_instruktur    = $instruktur->name;
        $email_instruktur   = $instruktur->email;
        $siswa              = Profile::find($request->profile_id);
        $siswas             = $siswa->user_id;
        $siswass            = User::find($siswas);
        $nama_siswa         = $siswass->name;
        //kirim ke template email
        $detail         = [
            'title'   => 'Dear '.$nama_instruktur.' as Instruktur',
            'body'    => 'seorang siswa bernama ('.$nama_siswa.') mengajukan Penghapusan hasil Kuis / Reset hasil kuis pada kuis ('.$nama_kuis.'). Sebelum menyetujui Penghapusan hasil kuis dimohon untuk memeriksa kuis tersebut terlebih dahulu',
            'link'    => 'course-academy.top'
        ];
        //kirim email dulu
        // return $email_instruktur;
        $when               = Carbon::now()->addSeconds(10);
        Mail::to($email_instruktur)->send((new PengajuanResetKuis($detail))->delay($when));
        //terus reset
        $reset          = reset::create([                    
                          'kuis_id'=>$request->kuis_id,      
                          'profile_id'=>$request->profile_id,                                                    
                          'user_id'=>$request->user_id,
        ]);                      
        //redirect & notif di halaman web
        $notif          = array('pesan-info' => 'pengajuan mereset hasil kuis dikirim, tunggu instruktur menyetujuinya');
        return redirect()->back()->with($notif);
    }

    //newui
    public function formreset()
    {
        $id     = Auth::id();
        $resets = Reset::where('user_id',$id)->get();
        return view('/instruktur.reset', compact('resets'));
    }
    
}
