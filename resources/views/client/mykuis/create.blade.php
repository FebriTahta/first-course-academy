@extends('layouts.new_layouts.master')

@section('head')
<link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" id="css-main" href="{{ asset('assets/css/codebase.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/js/plugins/summernote/summernote-bs4.css') }}">
@endsection

@section('content')    

<div class="w3l-homeblock2 w3l-homeblock6 py-5">
    <div class="container-fluid px-sm-5 py-lg-5 py-md-4">
        <!-- block -->
        @if (Session::has('message'))
        <div class="alert alert-danger text-bold">{{ Session::get('message') }}</div>                
        @endif
        @if (Session::has('pesan-peringatan'))
                <div class="alert alert-warning text-bold">{{ Session::get('pesan-peringatan') }}</div>                
        @endif
        @if (Session::has('pesan-sukses'))
            <div class="alert alert-info text-bold">{{ Session::get('pesan-sukses') }}</div>
        @endif
            <h3 class="section-title-left mb-4"> Form Latihan Soal ({{ auth()->user()->name }})</h3>
        <div class="row">
            <div class="col-lg-6" style="margin-bottom: 20px">
                <div class="bg-clr-white">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-5 card-body blog-details align-self">
                            <span class="label-blue">Latihan Soal</span>
                            <a class="blog-desc">{{ $data_kuis->mapel->mapel_name }} | {{ $data_kuis->kelas->kelas_name }}
                            </a>
                            {{-- <p>Lorem ipsum dolor sit amet consectetur ipsum adipisicing elit. Quis
                                vitae sit.</p> --}}
                            <div class="author align-items-center mt-3">
                                <img 
                                    @if ($data_kuis->user->profile->photo==null)
                                        src="{{ asset('assets/assets/images/a1.jpg') }}"
                                    @else
                                    src="{{ asset('photo/'.$data_kuis->user->profile->photo) }}"
                                    @endif alt="" class="img-fluid rounded-circle">
                                <ul class="blog-meta">
                                    <li>
                                        <a >{{ $data_kuis->user->name }}</a> 
                                    </li>
                                    <li class="meta-item blog-lesson">
                                        <span class="meta-value"> {{ $data_kuis->user->role }} </span>. <span class="meta-value ml-2"></span> <span class="fa fa-check"> owner latihan soal</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            {{-- <a>
                                <img class="card-img-bottom d-block radius-image-full" src="{{ asset('kursus_picture/'.$data_kursus->kursus_pict) }}" style="min-height: 263px" alt="Card image cap">
                            </a> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6" style="margin-bottom: 20px">
                <div class="bg-clr-white" style="min-height: 233px; max-height: 233px;">
                    <div class="block-content">
                        <div class="block-content" style="margin-top: 30px">
                            <span class="label-blue">{{ $data_kuis->kuis_name }} </span>                            
                            <p class="blog-desc" style="padding: 5px; margin-top: 10px" >{{ $data_kuis->kuis_desc }}</p>
                        </div>
                    </div>
                </div>
            </div>                                    
        </div>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-lg-4" style="margin-top: 50px">
            <div class="topics">                                   
                <a class="topics-list hover-box" >
                    <div class="bg-clr-white" style="padding: 5%">                
                        <h4> Total Soal pada Kuis (<u>{{ $data_kuis->pertanyaan->count() }}</u>) Soal</h4>
                    </div>
                </a><br>
                <a class="topics-list mt-3 hover-box">
                    <div class="bg-clr-white text-danger" style="padding: 5%">                            
                        <h4 class="text-danger">NOTE</h4><br>
                        <h4 class="text-danger"><small> Gunakan full-screen untuk lebih detail saat membuat pertanyaan & Resize hingga 50% apabila menambahkan gambar </small></h4>
                    </div>
                </a>
            </div>                            
        </div>

        <div class="col-lg-8">
            <div class="left-right bg-clr-white p-3" style="margin-top: 50px;">                    
                <form action="{{ route('storeSoal') }}" method="post" enctype="multipart/form-data">@csrf
                <div class="form" style="padding: 20px">
                    <div class="form-group">
                        <input type="hidden" name="kuis_id" value="{{ $data->id }}">
                        <textarea id="js-summernote" class="js-summernote " name="pertanyaan_name" required>
                            TULIS PERTANYAAN
                        </textarea>
                    </div>
                    <div class="form-group">
                        <h5 class="text-uppercase">pilihan ganda</h5>                                                        
                        <div class="form-group ml-15">                            
                            <div class="row">
                                @for($i=0;$i<4;$i++)
                                <div class="col-sm-10">
                                    <textarea type="text" name="options[]" class="js-summernote form-group form-control col-md-8 span7 @error('name') border-red @enderror" placeholder=" options {{$i+1}}" required> PILIHAN Ke {{ $i+1 }}</textarea>
                                </div>
                                <div class="col-sm-2">
                                    <label class="css-control css-control-info css-radio">
                                        <input type="radio" class="css-control-input" name="correct_answer" value="{{$i}}" required>
                                        <span class="css-control-indicator"></span> BENAR
                                    </label>
                                </div>
                                @endfor
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-outline-primary text-right"> UPLOAD</button>
                            </div>
                        </div>                                            
                    </div>
                </form>                
            </div>   
        </div>
    </div>
</div>
@endsection
@section('script')

@endsection