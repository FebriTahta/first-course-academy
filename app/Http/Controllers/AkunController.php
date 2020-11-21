<?php

namespace App\Http\Controllers;
use App\User;
use App\Profile;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\UbahPengguna;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    public function index()
    {
        return view('client.akun.index');
    }

    public function daftar(Request $request)
    {
        $email       = $request->email;
        $result      = User::where('email', $request->email)->first();
        // $result_mail = $result->email;
        
        if ($result !== null) {
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

    public function ubahpengguna(Request $request)
    {
        $id             = $request->id;
        $nama           = $request->name;
        $email          = $request->email;
        $result         = User::where('email', $request->email)->first();
        if ($result == $email) {
            # code...
            $notif = array(
                'pesan-bahaya' => 'Email sudah pernah terdaftar. Gunakan Email Lain'
            );
            return redirect()->back()->with($notif);
        } else {
            # code...
            $post           =   User::updateOrCreate(['id' => $id],
                            [
                                'name' => $request->name,
                                'role' => $request->role,     
                                'email' => $request->email,
                                'stat' => '0',                        
                                                              
                            ]);
            $data_profile   = Profile::where(['user_id'=>$request->id])->first();

            $detail         = [
                'title'     => 'Hai '.$nama.'',
                'body'      => 'Silahkan masuk dengan (Email : '.$email.') dan (Password : secret). Untuk kedepannya anda bisa memperbarui password anda sendiri pada menu Reset / Lupa password',
                'link'      => 'course-academy.top/login'
            ];
            //kirim email dulu
            $when           = Carbon::now()->addSeconds(10);

            Mail::to($email)->send((new UbahPengguna($detail))->delay($when));

            if ($data_profile===null) {
                # code...
                $post->profile()->save(new Profile);
            }
            $notif = array(
                'pesan-sukses' => 'User berhasil ditambahkan'
            );
            return redirect()->back()->with($notif);
        }
    }
}
