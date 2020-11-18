<?php

namespace App\Http\Controllers;
use App\Pertanyaan;
use App\Answer;
use App\Kursus;
use App\Kuis;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SoalController extends Controller
{
    public function create($slug)
    {
        $data = Kuis::where('slug',$slug)->first();
        $data_id = $data->id;//id kuis
        $data_slug = $data->slug;//slug kuis        
        $datas= $data->kursus->first();
        return view('admin.daftarSoal.create', compact('data_slug','data','data_id','datas'));
    }
 
    public function store(Request $request)
    {
        $data = $request->all();
        
        $pertanyaans = (new Pertanyaan)->storePertanyaan([//insert dari model question
            'kuis_id'=>$request->kuis_id,            
            'pertanyaan_name'=>$request->pertanyaan_name,
            
        ]);
        if($request -> hasFile('pertanyaan_name'))
            {
                $request->file('pertanyaan_name')->move('pertanyaan_picture/',$request->file('pertanyaan_name')->getClientOriginalName());
                $addpertanyaan->pertanyaan_name = $request->file('pertanyaan_name')->getClientOriginalName();
                $addpertanyaan->save();
            }
        $answer = (new Answer)->storeAnswer($data,$pertanyaans);//insert dari model answer

        $notif = array(
            'pesan-sukses' => 'soal baru berhasil ditambahkan'
        );
        return redirect()->back()->with($notif);        
    }

    public function detail($slug)
    {
        
        $data_kuis = Kuis::where('slug',$slug)->first();
        $data1 = $data_kuis->id;
        $data_pertanyaan = Pertanyaan::where('kuis_id',$data1)->get();
        $total_soal = $data_pertanyaan->count();
        
        $datas = $data_kuis->kursus->first();
        return view('admin.daftarSoal.detail',compact('datas','data_pertanyaan','data_kuis','total_soal'));
    }

    public function edit($id)
    {
        $data_1 = Pertanyaan::find($id);
        $data_id = $data_1->id;
        $data_2 = Answer::where('pertanyaan_id', $data_id)->get();
        return view('admin.daftarSoal.edit',compact('data_1','data_2'));
    }

    // public function update(Request $request, $id)
    // {
    //     $data = $request->all(); 
    //     $pertanyaan = (new Pertanyaan)->updatePertanyaan($id, $request);
    //     $answer = (new Answer)->updateAnswer($request, $pertanyaan);

    //     $data_1 = Pertanyaan::where('id', $id)->first();
    //     $data_2 = $data_1->kuis_id;
    //     $data_3 = Kuis::where('id', $data_2)->first();
    //     $data_4 = $data_3->slug;
    //     $notif = array(
    //         'pesan-sukses' => 'soal berhasil diperbarui'
    //     );
        
    //     return redirect('/detail-soal/'.$data_4)->with($notif);
    // }
}
