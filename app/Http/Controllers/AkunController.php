<?php

namespace App\Http\Controllers;
use App\User;
use App\Profile;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\DaftarPengunjung;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    public function index()
    {
        return view('client.akun.index');
    }

    public function daftar(Request $request)
    {
        $post   =   User::create([
            'name'=>$request->name,
            'role'=>'pengunjung',
            'stat'=>'0',
            'email'=>$request->email,
            'password'=>bcrypt($request->password), 
        ]);
        $post->profile()->save(new Profile);

        $detail         = [
            'title'     => 'Hai Admin',
            'body'      => '"'.$request->name.'" telah bergabung sebagai pengunjung ',
            'link'      => 'course-academy.top/dashboard'
        ];
        //kirim email dulu
        $when           = Carbon::now()->addSeconds(10);
        $admin  = User::where('role','admin')->get();
        
        foreach ($admin as $item) {
            # code...
            Mail::to($item->email)->send((new DaftarPengunjung($detail))->delay($when));
            $notif = array(
                'pesan-sukses' => 'Registrasi sukses '
            );
            return redirect()->back()->with($notif);
        }       
    }
}
