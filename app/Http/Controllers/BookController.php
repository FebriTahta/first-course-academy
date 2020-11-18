<?php

namespace App\Http\Controllers;
use App\Book;
use App\Kursus;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    public function store(Request $request)
    {   
        //model kursus untuk di attach pada tabel povot
        $id     = $request->kursus_id;
        $kursus = Kursus::find($id);
        //model book
        $data   =   new Book;
        //book file move to storage untuk download
        if($request -> hasFile('book_file'))
        {            
            $book_file       = $request->file('book_file');
            $filename        = $book_file->getClientOriginalName();
            $request->book_file->move('storage/',$filename);

            $data->book_file = $filename;            
        }
        //data book
        $data->book_name    = $request->book_name;
        $data->user_id      = $request->user_id;
        $data->kelas_id     = $request->kelas_id;
        $data->mapel_id     = $request->mapel_id;        
        $data->slug         = Str::slug($request->book_name);
        //save book
        $data->save();
        //insert to pivot
        $kursus->book()->attach($data);
        $notif = array(
            'pesan-sukses' => 'Buku baru berhasil ditambahkan',                
        );
        return redirect()->back()->with($notif);        
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
        $book  = Book::where('user_id', $user)->get();
        return view('/admin/daftarKonten/book', compact('book'));
    }
}
