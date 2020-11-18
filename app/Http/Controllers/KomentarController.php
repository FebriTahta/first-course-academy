<?php

namespace App\Http\Controllers;
use App\Komentar;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    public function postkomen(Request $request)
    {
        $post   = Komentar::updateOrCreate([
            'forum_id'  => $request->forum_id,
            'user_id'   => $request->user_id,
            'komen'     => $request->komen
        ]);

        return redirect()->back();
    }
}
