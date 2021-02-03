@extends('layouts.new_layouts.master')
@section('head')
<link rel="stylesheet" id="css-main" href="{{ asset('assets/css/codebase.min.css') }}">
<link rel="stylesheet" id="css-main" href="{{ asset('assets/assets/css/fab.css') }}">
<link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('assets/js/plugins/summernote/summernote-bs4.css') }}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
@endsection
@section('content')
<div class="w3l-homeblock2 w3l-homeblock6 py-5">
    <div class="container-fluid px-sm-5 py-lg-5 py-md-4">
        <div class="row">
            <div class="col-lg-6 mb-50">
                <div class="bg-clr-white">
                    <div class="row">
                        <div class="col-sm-6 position-relative">
                            <a>
                                <img class="card-img-bottom d-block radius-image-full" src="{{ asset('kursus_picture/'.$data_kursus->kursus_pict) }}" style="min-height: 263px" alt="Card image cap">
                            </a>
                        </div>
                        <div class="col-sm-6 card-body blog-details align-self">                            
                            <span class="label-blue hover-box">
                                @if ($data_kursus->status=='aktif')
                                    <form action="{{ route('nonaktifkan') }}" method="POST">@csrf
                                        <input type="hidden" name="id" value="{{ $data_kursus->id }}">
                                        <input type="hidden" name="status" value="nonaktif">
                                        <button class="btn btn-sm text-uppercase text-primary" @if (auth()->user()->role=='siswa') disabled @endif type="submit">{{ $data_kursus->status }}</button>
                                    </form>                                        
                                @else
                                    <form action="{{ route('aktifkan') }}" method="POST">@csrf
                                        <input type="hidden" name="id" value="{{ $data_kursus->id }}">
                                        <input type="hidden" name="status" value="aktif">
                                        <button class="btn btn-sm text-uppercase text-danger" @if (auth()->user()->role=='siswa') disabled @endif type="submit">{{ $data_kursus->status }}</button>
                                    </form>
                                @endif
                            </span>
                            <a class="blog-desc">{{ $data_kursus->mapel->mapel_name }} | {{ $data_kursus->kelas->kelas_name }}
                            </a>
                            {{-- <p>Lorem ipsum dolor sit amet consectetur ipsum adipisicing elit. Quis
                                vitae sit.</p> --}}
                            <div class="author align-items-center mt-3">
                                <img 
                                    @if ($data_kursus->user->profile->photo==null)
                                        src="{{ asset('assets/assets/images/a1.jpg') }}"
                                    @else
                                    src="{{ asset('photo/'.$data_kursus->user->profile->photo) }}"
                                    @endif alt="" class="img-fluid rounded-circle">
                                <ul class="blog-meta">
                                    <li>
                                        <a >{{ $data_kursus->user->name }}</a> 
                                    </li>
                                    <li class="meta-item blog-lesson">
                                        <span class="meta-value"> {{ $data_kursus->user->role }} </span>. <span class="meta-value ml-2"><span class="fa fa-check"></span></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 trending mt-lg-0 mt-5 mb-20" style="margin-top: 15px">
                <div class="topics">                    
                    <a class="topics-list hover-box" onclick="videoscroll()">
                        <div class="list1">
                            <span class="fa fa-play"></span>
                            <h4><u>{{ $data_kursus->video->count() }}</u> Video Kursus</h4>
                        </div>
                    </a>
                    <a class="topics-list mt-3 hover-box" onclick="artikelscroll()">
                        <div class="list1" >
                            <span class="fa fa-book"></span>
                            <h4><u>{{ $data_kursus->artikel->count() }}</u> Artikel & Buku Kursus</h4>
                        </div>
                    </a>
                    <a  class="topics-list mt-3 hover-box" onclick="kuisscroll()">
                        <div class="list1">
                            <span class="fa fa-pencil-square"></span>
                            <h4><u>{{ $data_kursus->kuis->count() }}</u> Latihan Soal</h4>
                        </div>
                    </a>
                    <a @if (auth()->user()->role=='siswa') @else href="{{ route('detailsiswa',$data_kursus->slug) }}" @endif  
                        class="topics-list mt-3 hover-box">
                        <div class="list1">
                            <span class="fa fa-pie-chart"></span>
                            <h4><u>{{ $data_kursus->profile->count() }}</u> Peserta Didik</h4>
                        </div>
                    </a>
                </div>                            
            </div>
            <div class="col-lg-12 trending mt-lg-0 mt-5 py-lg-5" style="margin-top: 15px">
                <div class="mt-4 left-right bg-clr-white p-3">
                    <h5 class="section-title-left align-self pl-2 mb-sm-0 mb-3">Forum {{ $data_kursus->mapel->mapel_name }} | {{ $data_kursus->kelas->kelas_name }} </h5>
                    <a class="btn btn-style btn-primary" href="/forums-daftar-pertanyaan/premium/{{ $data_kursus->kelas->slug }}/{{ $data_kursus->mapel->slug }}">KUNJUNGI FORUM</a>
                </div>   
            </div>
        </div>
        <div class="w3l-homeblock2 w3l-homeblock5 py-5">
            <div class="container py-lg-5 py-md-4">
                <!-- block -->
                <div class="left-right">
                    <h3 class="section-title-left mb-sm-4 mb-2"> PESERTA DIDIK</h3>
                </div>
                <div class="row">
                    @foreach ($data_kursus->profile as $item)
                        <div class="col-lg-4">
                            <div class="bg-clr-white hover-box" style="max-height: 150px; margin-bottom: 10px">
                                <div class="row">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-11 card-body blog-details align-self" >
                                        <div class="author align-items-center">
                                            <img @if($item->photo===null) src="{{ asset('assets/assets/images/a1.jpg') }}" @else src="{{ asset('photo/'.$item->photo) }}" @endif alt="" class="img-fluid rounded-circle">
                                            <ul class="blog-meta">
                                                <li>
                                                    <a href="/data-peserta-didik/{{ $data_kursus->slug }}/{{ $item->id }}">{{ $item->user->name }}</a> 
                                                </li>
                                                <li class="meta-item blog-lesson">
                                                    <span class="meta-value"> @if($item->alumni==null) belum mengisi profile @else{{ $item->alumni }} @endif </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection