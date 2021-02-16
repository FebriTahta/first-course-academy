<?php

namespace App\Http\Controllers;
use App\Kursus;
use App\Kuis;
use App\Video;
use App\Book;
use App\User;
use App\Result;
use App\reset;
use DB;
use Auth;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    
    public function index()
    {
        $data_kursus    = Kursus::all();
        $data_kuis      = Kuis::all();
        $data_video     = Video::all();
        $data_buku      = Book::all();
        $user           = User::all();

        $data_instruktur        =   User::where('role','instruktur')->get();
        $data_siswa             =   User::where('role','siswa')->get();
        $data_user_non_acc      =   User::where('stat','0')->get();

        $total_semua            =   User::all()->count();
        $belum_verif            =   User::where('email_verified_at', null)->get();
        $verif                  =   $total_semua - $belum_verif->count();
        $pengunjung             =   User::where('role','pengunjung')->get();

        $id = Auth::id();
        $kursus_user    = Kursus::where('user_id', $id)->with('profile')->get();

        //chart
        $data = DB::table('users')
        ->select(
            DB::raw('role as role'),
            DB::raw('count(*) as number')
        )->groupBy('role')->get();

        $array[] = ['Role', 'Number'];
        foreach ($data as $key => $value) {
            # code...
            $array[++$key] = [$value->role, $value->number];
        }
        // dd($data, json_encode($array));
        return view('admin.dashboard.index',compact('verif','user','pengunjung','belum_verif','kursus_user','data_instruktur','data_siswa','data_user_non_acc','data_kursus','data_video','data_buku','data_kuis','role',json_encode($array)));
    }
    
}
