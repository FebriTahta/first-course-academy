<?php

namespace App\Http\Controllers;
use App\Profile;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($id)
    {
        $data_profile = Profile::where('user_id', $id)->first();
        return view('admin.profile.index', compact('data_profile'));
    }

    public function store(Request $request)
    {
        // $data = $request->all();
        $data_p = Profile::updateOrCreate(['user_id'=>$request->user_id],
        [
            'photo' =>$request->photo,
            'alamat' =>$request->alamat,
            'telp' =>$request->telp,
            'alumni' =>$request->alumni,
            'gender' =>$request->gender,

        ]);
        if($request -> hasFile('photo'))
            {
                $request->file('photo')->move('photo/',$request->file('photo')->getClientOriginalName());
                $data_p->photo = $request->file('photo')->getClientOriginalName();
                $data_p->save();
            }          
        // $data_p->update($data);

        $notif = array(
            'pesan-sukses' => 'Data Profile telah diperbarui'
        );
        return redirect()->back()->with($notif);
    }

    //hapus user disini, karena user controller pake route
    public function dell(Request $request)
    {
        $id = $request->id;
        User::find($id)->delete();
        
        $notif = array(
            'pesan-bahaya' => 'User berhasil dihapus'
        );
        return redirect()->back()->with($notif);
    }
}
