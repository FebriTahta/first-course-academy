<?php

namespace App\Http\Controllers;
use App\User;
use App\Kursus;
use App\Komentar;
use Illuminate\Http\Request;

class ChangeStatus extends Controller
{
    public function changestatus(Request $request)
    {
        $user = User::find($request->user_id);
        $user->stat = $request->stat;
        $user->save();

        return response()->json(['success'=>'Status User Berhasil Diperbarui']);
    }

    public function komentarbenar(Request $request)
    {
        $komen = Komentar::find($request->id);
        $komen->status = $request->status;
        $komen->save();
        return response()->json(['success'=>'Komentar tersebut dipilih sebagai komentar yang benar']);
    }

    public function aktifkankursus(Request $request)
    {
        $id_kursus      = $request->id;
        $data           = $request->all();
        $kursus         = Kursus::find($id_kursus);
        $mapel          = $kursus->mapel->mapel_name;
        $kelas          = $kursus->kelas->kelas_name;
        $data_kursus    = Kursus::where('id', $id_kursus)->update(['status'=>$request->status]);        

        $notif      = array(
            'pesan-sukses' => 'Kursus "'.$mapel.' '.$kelas.'" berhasil "diaktifkan"',                
        );        
        return redirect()->back()->with($notif);
    }

    public function nonaktifankursus(Request $request)
    {
        $id_kursus      = $request->id;
        $kursus         = Kursus::find($id_kursus);
        $mapel          = $kursus->mapel->mapel_name;
        $kelas          = $kursus->kelas->kelas_name;
        $data           = $request->all();
        $data_kursus    = Kursus::where('id', $id_kursus)->update(['status'=>$request->status]);
        
        $notif      = array(
            'message' => 'Kursus "'.$mapel.' '.$kelas.'" berhasil "di non aktifkan"',
        );        
        return redirect()->back()->with($notif);                
    }
}
