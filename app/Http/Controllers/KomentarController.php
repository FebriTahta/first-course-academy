<?php

namespace App\Http\Controllers;
use App\Komentar;
use Illuminate\Support\Facades\Mail;
use App\Mail\PostKomentar;
use Carbon\Carbon;
use App\User;
use App\Forum;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    public function postkomen(Request $request)
    {
        $post   = Komentar::updateOrCreate([
            'forum_id'  => $request->forum_id,
            'user_id'   => $request->user_id,
            'status'    => '0',
            'komen'     => $request->komen
        ]);
        if($request -> hasFile('komen'))
        {
            $request->file('komen')->move('komen/',$request->file('komen')->getClientOriginalName());
            $post->komen = $request->file('komen')->getClientOriginalName();
            $post->save();
        }
        
        $komentator     = User::find($request->user_id);
        $komentator_name= $komentator->name;
        $forum          = Forum::find($request->forum_id);
        $link           = $forum->slug;
        $user_forum     = $forum->user_id;
        $user           = User::find($user_forum);
        $user_name      = $user->name;
        $user_mail      = $user->email;

        $detail         = [
            'title'     => 'Hai '.$user_name.'',
            'body'      => 'Pertanyaan anda dikomentari oleh "'.$komentator_name.'"',
            'link'      => 'course-academy.top/forum-detail-pertanyaan/'.$link.''
        ];
        //kirim email dulu
        $when           = Carbon::now()->addSeconds(10);
        Mail::to($user_mail)->send((new PostKomentar($detail))->delay($when));

        return redirect()->back();
    }
}
