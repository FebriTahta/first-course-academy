<?php

namespace App\Http\Controllers;
use App\User;
use App\Kursus;
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

    public function aktifkankursus(Request $request)
    {
        $id_kursus      = $request->id;
        $data           = $request->all();
        $data_kursus    = Kursus::where('id', $id_kursus)->update(['status'=>$request->status]);        

        return redirect()->back();
    }

    public function nonaktifankursus(Request $request)
    {
        $id_kursus      = $request->id;
        $data           = $request->all();
        $data_kursus    = Kursus::where('id', $id_kursus)->update(['status'=>$request->status]);        

        return redirect()->back();
    }
}
