<?php

namespace App\Http\Controllers;
use App\Kelas;
use App\Mapel;
use App\Artikel;
use App\Kursus;
use App\Book;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index($slug)
    {
        $user_id    = Auth::id();
        $artikels   = Artikel::where('user_id', $user_id)->get();
        $kelass     = Kelas::all();
        $mapels     = Mapel::all();
        $kursus     = Kursus::where('slug',$slug)->first();
        return view('/client.konten.artikel',compact('kursus','kelass','mapels','artikels'));
    }

    public function store(Request $request)
    {
        $kursus_id          = $request->kursus_id;        
        $artikel_id         = $request->id;        
        $cek_artikel        = Artikel::find($artikel_id);
        $slug               = $request->artikel_title.$request->user_id;        
            # code...
            $new_artikel        =   Artikel::updateOrCreate(['id' => $artikel_id],[
                'user_id'       =>  $request->user_id,            
                'kelas_id'      =>  $request->kelas_id,
                'mapel_id'      =>  $request->mapel_id,
                'artikel_pict'  =>  $request->artikel_pict,
                'artikel_title' =>  $request->artikel_title,
                'artikel_text'  =>  $request->artikel_text,
                'slug'          =>  Str::slug($slug)
            ]);
            if($request -> hasFile('artikel_pict'))
            {
                $request->file('artikel_pict')->move('artikel_picture/',$request->file('artikel_pict')->getClientOriginalName());
                $new_artikel->artikel_pict = $request->file('artikel_pict')->getClientOriginalName();
                $new_artikel->save();
            }

            $data_artikel       = Artikel::find($artikel_id);
            //cek jika sudah ada sebelumnya maka hanya update, jika belum add ke kursus
            if ($kursus_id === null) {
                # code...
                $notif = array(
                    'pesan-sukses' => 'Artikel berhasil ditambahkan',                
                );
                return redirect()->back()->with($notif);

            } else {
                # code...
                if ($data_artikel  === null) {
                    # code...
                    $kursus         = Kursus::find($kursus_id);
                    $kursus->artikel()->attach($new_artikel);
                }
                    $notif = array(
                                'pesan-sukses' => 'Artikel baru berhasil ditambahkan pada kursus',                
                            );
                    return redirect()->back()->with($notif);
            }                                
    }

    public function salin(Request $request)
    {
        $id         = $request->kursus_id;
        $kursus     = Kursus::find($id);

        foreach ($request->artikel_id as $key => $value) {
            # code...
            $data   = array (
                'artikel_id'=>$request->artikel_id[$key]
            );
            $kursus->artikel()->syncWithoutDetaching($data);
        }
        $notif = array(
            'pesan-sukses' => 'Artikel baru berhasil ditambahkan',                
        );
        return redirect()->back()->with($notif);
    }
 
    public function remove(Request $request)
    {
        $artikel_id     = $request->id;
        $kursus_id      = $request->kursus_id;
        $kursus         = Kursus::find($kursus_id);
        $artikel        = Artikel::find($artikel_id);

        $kursus->artikel()->detach($artikel);        
        $notif = array(
            'pesan-peringatan' => 'Artikel tersebut berhasil dihapus',                
            );
                        
        return redirect()->back()->with($notif);   
    }

    public function create($slug)
    {
        $kursus     = Kursus::where('slug',$slug)->first();
        return view('/client.myartikel.create', compact('kursus'));
    }

    public function createform()
    {
        $mapel = Mapel::all();
        $kelas = Kelas::all();
        return view('/admin.artikel.create',compact('mapel','kelas'));
    }

    public function removeArtikelPermanen(Request $request)
    {
        $id         = $request->id;
        $artikel      = Artikel::find($id);
        
        $notif = array(
            'pesan-bahaya' => 'Artikel berhasil dihapus',                
        );
        $artikel->delete();
        return redirect()->back()->with($notif);
    }

    public function edit($slug,$slug2)
    {
        $kursus     = Kursus::where('slug',$slug)->first();
        $artikel    = Artikel::where('slug',$slug2)->first();
        return view('/client.myartikel.edit', compact('kursus','artikel'));
    }

    public function detail($id, $slug)
    {
        $book       = Book::where('artikel_id', $id)->get();
        $artikel    = Artikel::find($id);
        return view('/client.myartikel.detail',compact('artikel','book'));
    }
}
