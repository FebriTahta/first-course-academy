<?php

namespace App\Http\Controllers;
use App\Book;
use App\Kursus;
use Auth;
use App\User;
use App\Kelas;
use App\Mapel;
use App\Artikel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    public function store(Request $request)
    {   
        $id     = $request->kursus_id;
        //model book
        $data   =   new Book;
        //book file move to storage untuk download
        $artikel_id = $request->artikel_id;        
        $slug   = $request->book_name.$artikel_id.$request->user_id;
        if($request -> hasFile('book_file'))
        {            
            $book_file       = $request->file('book_file');
            $filename        = $book_file->getClientOriginalName();
            $request->book_file->move('storage/',$filename);

            $data->book_file = $filename;            
        }
        //data book
        $data->book_name    = $request->book_name;
        $data->artikel_id   = $artikel_id;
        $data->user_id      = $request->user_id;      
        $data->slug         = Str::slug($slug);
        //save book
        $data->save();
        //insert to pivot
        if ($id === null) {
            # code...
            $notif = array(
                'pesan-sukses' => 'Buku baru berhasil ditambahkan',                
            );
            return redirect()->back()->with($notif); 

        } else {
            # code...
            $kursus = Kursus::find($id);
            $kursus->book()->attach($data);
            $notif = array(
                'pesan-sukses' => 'Buku baru berhasil ditambahkan',                
            );
            return redirect()->back()->with($notif);   
        }                     
    }

    public function salin(Request $request)
    {
        $id     = $request->kursus_id;
        $kursus = Kursus::find($id);

        foreach ($request->book_id as $key => $value) {
            # code...
            $data   = array (
                'book_id'=>$request->book_id[$key]
            );
            $kursus->book()->syncWithoutDetaching($data);
        }
        $notif = array(
            'pesan-sukses' => 'Buku berhasil disalin',                
        );
        return redirect()->back()->with($notif);
    }

    public function getDownload($file)
    {        
        return response()->download('storage/'.$file);        
    }

    public function mybook(){
        $user   = Auth::id();
        $users  = User::find($user);
        $book   = Artikel::where('user_id', $user)->get();
        $books  = Artikel::all();
        $kelass = Kelas::all();
        $mapels = Mapel::all();
        return view('/admin/daftarKonten/book', compact('book','books','users','kelass','mapels','user'));
    }

    public function remove(Request $request){
        $id         = $request->id;
        $kursus_id  = $request->kursus_id;

        $buku       = Book::find($id);
        $book_name  = $buku->book_name;
        $kursus     = Kursus::find($kursus_id);
        $notif      = array(
                        'message' => 'Buku "'.$book_name.'" berhasil dihapus',                
                    );
        $kursus->book()->detach($buku);
        return redirect()->back()->with($notif);
    }

    public function hapusBukuPermanen(Request $request)
    {
        $id         = $request->id;
        $books      = Book::find($id);
        $book_name  = $books->book_name;        
        $notif = array(
            'pesan-bahaya' => 'Buku "'.$book_name.'" berhasil dihapus',                
        );
        $books->delete();
        return redirect()->back()->with($notif);
    }
}
