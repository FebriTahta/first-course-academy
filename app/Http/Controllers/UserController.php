<?php

namespace App\Http\Controllers;
use App\User;
use App\Profile;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_user = User::all();
        return view('admin.daftarUser.index', compact('data_user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id             = $request->id;               
        $post           =   User::updateOrCreate(['id' => $id],
                            [
                                'name' => $request->name,
                                'role' => $request->role,                        
                                'email' => $request->email,
                                'stat' => '0',                        
                                'password'=>bcrypt('secret'),                                                
                            ]);
        $data_profile   = Profile::where(['user_id'=>$request->id])->first();
        
        if ($data_profile===null) {
            # code...
            $post->profile()->save(new Profile);
        }
        $notif = array(
            'pesan-sukses' => 'User berhasil ditambahkan'
        );
        return redirect()->back()->with($notif);
    }    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
