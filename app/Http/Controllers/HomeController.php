<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $auth       = Auth::id();
        $data       = User::findorFail($auth);
        $data_user  = $data->role;
        $data_admin = User::where('role', 'admin')->get();
        if ($data_user == 'siswa') {
            # code...
            return view('client.mycourse.list');
        }else {
            # code...
            return redirect('/dashboard');
        }            
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

}
