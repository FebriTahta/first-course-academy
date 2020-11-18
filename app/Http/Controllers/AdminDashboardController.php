<?php

namespace App\Http\Controllers;
use App\Kursus;
use App\Kuis;
use App\Video;
use App\Book;
use App\User;
use App\Result;
use App\reset;
use Auth;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $data_kursus    = Kursus::all();
        $data_kuis      = Kuis::all();
        $data_video     = Video::all();
        $data_buku      = Book::all();

        $data_instruktur        =   User::where('role','instruktur')->get();
        $data_siswa             =   User::where('role','siswa')->get();
        $data_user_non_acc      =   User::where('stat','0')->get();

        $id = Auth::id();
        $kursus_user    = Kursus::where('user_id', $id)->with('profile')->get();
        
        return view('admin.dashboard.index',compact('kursus_user','data_instruktur','data_siswa','data_user_non_acc','data_kursus','data_video','data_buku','data_kuis'));                                      
    }
    
}
