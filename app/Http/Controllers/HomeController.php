<?php

namespace App\Http\Controllers;
use App\User;
use App\Profile;
use Auth;
use DB;
use App\Kursus;
use App\Mapel;
use App\Kelas;
use App\Video;
use App\Kuis;
use App\Book;
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
        $this->middleware(['auth','verified']);
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
        
        $data_kursus    = Kursus::all();
        $data_kuis      = Kuis::all();
        $data_video     = Video::all();
        $data_buku      = Book::all();

        $data_admin             =   User::where('role', 'admin')->get();        
        $data_instruktur        =   User::where('role','instruktur')->get();
        $data_siswa             =   User::where('role','siswa')->get();
        $data_user_non_acc      =   User::where('stat','0')->get();

        $belum_verif            =   User::where('email_verified_at', null)->get();
        $pengunjung             =   User::where('role','pengunjung')->get();
        $total_semua            =   User::all()->count();
        $verif                  =   $total_semua - $belum_verif->count();
        $id = Auth::id();
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

        $kursus_user    = Kursus::where('user_id', $id)->with('profile')->get();

        if ($data_user == 'siswa') {
            # code...
            return view('client.mycourse.list');

        }elseif($data_user == 'pengunjung') {
            
            return view('client.mycourse.list');

        }elseif($data_user == 'admin'){
            # code...            
            return view('admin.dashboard.index',compact('verif','pengunjung','belum_verif','kursus_user','data_instruktur','data_siswa','data_user_non_acc','data_kursus','data_video','data_buku','data_kuis'))->with('role', json_encode($array));
            
        }elseif($data_user == 'instruktur'){
            // return redirect('/dashboard');
            return view('client.mycourse.list');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

    public function searching(Request $request)
    {
        $search = $request->search;

        if($search == ''){
            $mapels = Mapel::orderby('mapel_name','asc')->select('id','mapel_name')->limit(5)->get();
        }
        else{
            $mapels = Mapel::orderby('mapel_name','asc')->select('id','mapel_name')->where('mapel_name','like','%'.$search.'%')->limit(5)->get();
        }

        $response = array();
        foreach ($mapels as $key => $map) {
            # code...
            $response[] = array("value"=>$map->id,"label"=>$map->mapel_name);
        }

        return response()->json($response);

    }

}
