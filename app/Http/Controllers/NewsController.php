<?php

namespace App\Http\Controllers;
use App\News;
use App\User;
use App\Kursus;
use Auth;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news   = News::orderBy('id', 'DESC')->get();
        return view('admin.news.index', compact('news'));
    }

    public function index2($id)
    {
        $news       = News::find($id);
        $allnews    = News::orderBy('id','DESC')->get();
        return view('news.index2', compact('news','allnews'));
    }

    public function display()
    {
        $news   = News::orderBy('id', 'DESC')->paginate(1);
        $course = Kursus::inRandomOrder()->limit(3)->get();
        return view('news.index', compact('news','course'));
    }

    public function edit($id)
    {
        $news   = News::find($id);
        return view('admin.news.edit' , compact('news'));
    }

    public function store(Request $request)
    {
        $user_id    = Auth::id();
        $id         = $request->id;
        $post       = News::updateOrCreate(['id'=> $id], [
            'user_id'       => $user_id,
            'news_pict'     => $request->news_pict,
            'news_tittle'   => $request->news_tittle,
            'news_desc'     => $request->news_desc
        ]);
        if($request -> hasFile('news_pict'))
            {
                $request->file('news_pict')->move('news_picture/',$request->file('news_pict')->getClientOriginalName());
                $post->news_pict = $request->file('news_pict')->getClientOriginalName();
                $post->save();
            }
        $notif = array(
            'pesan-sukses' => 'News baru saja diterbitkan',                
        );
        return redirect()->back()->with($notif);
    }

    public function remove(Request $request){
        $id             = $request->id;
        $news           = News::find($id);
        $news_tittle    = $news->news_tittle;

        $notif = array(
            'message' => 'News "'.$news_tittle.'" telah dihapus',                
        );

        $news->delete();
        
        return redirect()->back()->with($notif);

    }

    public function update(Request $request)
    {
        $user_id    = Auth::id();
        $id         = $request->id;
        $post       = News::updateOrCreate(['id'=> $id], [
            'user_id'       => $user_id,
            'news_pict'     => $request->news_pict,
            'news_tittle'   => $request->news_tittle,
            'news_desc'     => $request->news_desc
        ]);
        if($request -> hasFile('news_pict'))
            {
                $request->file('news_pict')->move('news_picture/',$request->file('news_pict')->getClientOriginalName());
                $post->news_pict = $request->file('news_pict')->getClientOriginalName();
                $post->save();
            }
        $notif = array(
            'pesan-sukses' => 'News telah disunting',                
        );
        return redirect('/news')->with($notif);
    }
}
