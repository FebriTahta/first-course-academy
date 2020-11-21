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
        $email      = $request->email;
        $result     = User::where('email', $email)->first();
        $result_mail= $result->email;
        
        if ($result_mail == $email) {
            # code...
            $notif = array(
                'message' => 'Email sudah pernah terdaftar. Gunakan Email Lain'
            );
            return redirect()->back()->with($notif);
        } else {
            # code...
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
}
