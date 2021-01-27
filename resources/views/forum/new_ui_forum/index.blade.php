@extends('layouts.new_layouts.master')
@section('head')
    
@endsection

@section('content')
<div class="w3l-homeblock2 w3l-homeblock6 py-5">
    <div class="container-fluid px-sm-5 py-lg-5 py-md-4">
        <div class="row">
            @auth
            <div class="col-lg-6" style="margin-bottom: 50px">
                <div class="bg-clr-white" style="min-height: 270px">
                    <div class="row">                        
                        <div class="col-sm-12 card-body blog-details align-self">
                            <div class="pad" style="margin-left: 10%">
                                <p class="blog-desc jam text-bold" id="jam" ></p>
                                <a class="blog-desc waktu" id="waktu"> </a>                                
                            </div>                            
                            <div class="author mt-3" style="margin-left: 10%">
                                @if (auth()->user()->role=='admin')
                                    <img 
                                        src="{{ asset('assets/assets/images/a1.jpg') }}"
                                        alt="" class="img-fluid rounded-circle">
                                    <ul class="blog-meta">
                                        <li>
                                            <a >{{ auth()->user()->name }}</a> 
                                        </li>
                                        <li class="meta-item blog-lesson">
                                            <p>{{ auth()->user()->role }} </p>
                                        </li>
                                    </ul>
                                @else
                                    <img 
                                        @if (auth()->user()->profile->photo==null)
                                            src="{{ asset('assets/assets/images/a1.jpg') }}"
                                        @else
                                            src="{{ asset('photo/'.auth()->user()->profile->photo) }}"
                                        @endif alt="" class="img-fluid rounded-circle">
                                    <ul class="blog-meta">
                                        <li>
                                            <a >{{ auth()->user()->name }}</a> 
                                        </li>
                                        <li class="meta-item blog-lesson">
                                            <p>{{ auth()->user()->role }} </p>
                                        </li>
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="bg-clr-white" style="min-height: 270px">
                    <div class="col-sm-12 card-body blog-details align-self">
                        <div class="pad" style="margin-left: 10%">
                            <p class="blog-desc text-bold"> Hi. Selamat datang!</p>
                            <p class="text-muted">
                                @if (auth()->user()->role=='instruktur')
                                    @if (count(auth()->user()->kursus)==0)
                                        Dapatkan forum premium khusus untuk instruktur dan siswa dengan mengambil kursus
                                    @else
                                        Anda Mempunyai <strong>{{ count(auth()->user()->kursus) }} Forum Premium</strong>.<br>
                                        <small>Silahkan periksa forum premium anda dan berinteraksilah dengan siswa anda</small><br>
                                        <button style="margin-top: 30px" class="btn btn-sm btn-primary" onclick="keforum()">FORUM</button>
                                    @endif
                                @elseif(auth()->user()->role=='admin')
                                    Terdapat <strong>{{ $kategori->count() }} Forum Premium dan Reguler</strong>
                                    <small>Silahkan periksa forum-forum tersebut dibawah ini</small> <br>
                                    <button style="margin-top: 30px" class="btn btn-sm btn-primary" onclick="keforum()">FORUM</button>
                                @else
                                    @if (count(auth()->user()->profile->kursus)==0)
                                        Dapatkan forum premium khusus untuk instruktur dan siswa dengan mengambil kursus (segera hubungi ADMIN)
                                    @else
                                        Anda Mempunyai <strong>{{ count(auth()->user()->profile->kursus) }} Forum Premium</strong>.<br>
                                        <small>Silahkan periksa forum premium anda dan ajukan pertanyaan apabila kesulitan belajar. Selamat Belajar! ^ ^</small><br>
                                        <button style="margin-top: 30px" class="btn btn-sm btn-primary" onclick="keforum()">FORUM</button>
                                    @endif
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="col-lg-6" style="margin-bottom: 50px">
                <div class="bg-clr-white" style="min-height: 270px">
                    <div class="row">                        
                        <div class="col-sm-12 card-body blog-details align-self">
                            <div class="pad" style="margin-left: 10%">
                                <p class="blog-desc jam text-bold" id="jam" ></p>
                                <a class="blog-desc waktu" id="waktu"> </a>                                
                            </div>                            
                            <div class="author mt-3" style="margin-left: 10%">

                                    <img 
                                        src="{{ asset('assets/assets/images/a1.jpg') }}"
                                        alt="" class="img-fluid rounded-circle">
                                    <ul class="blog-meta">
                                        <li>
                                            <a >Hi Pengunjung !</a> 
                                        </li>
                                        <li class="meta-item blog-lesson">
                                            <p>Kabar Baik ? </p>
                                        </li>
                                    </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endauth
        </div>
    </div>
</div>

@auth
<section class="w3l-homeblock1 py-sm-5 py-4">
    <div class="container py-md-4" id="forum">
        <div class="left-right">
            <h3 class="section-title-left mb-sm-4 mb-2"> FORUM PREMIUM</h3>
        </div>
        <div class="grids-area-hny main-cont-wthree-fea row">
            @if (auth()->user()->role=='instruktur')
                @foreach (auth()->user()->kursus as $key=>$item)
                <div class="col-lg-3 col-6 grids-feature" style="margin-bottom: 10px">
                    <a href="/forums-daftar-pertanyaan/premium/{{ $item->kelas->slug }}/{{ $item->mapel->slug }}">
                        <div class="area-box">
                            <span class="fa fa-university"></span>
                            <h4 class="title-head text-uppercase">{{ $item->mapel->mapel_name }} {{ $item->kelas->kelas_name }}</h4>
                        </div>
                    </a>
                </div>
                @endforeach
            @elseif(auth()->user()->role=='siswa')
                @foreach (auth()->user()->profile->kursus as $key=>$item)
                <div class="col-lg-3 col-6 grids-feature" style="margin-bottom: 10px">
                    <a href="#premium">
                        <div class="area-box">
                            <span class="fa fa-university"></span>
                            <h4 class="title-head text-uppercase">{{ $item->mapel->mapel_name }} {{ $item->kelas->kelas_name }}</h4>
                        </div>
                    </a>
                </div>
                @endforeach
            @elseif(auth()->user()->role=='admin')
                @foreach ($data_mapel as $item_m)
                    @foreach ($item_m->kelas as $item_k)
                    <div class="col-lg-3 col-6 grids-feature" style="margin-bottom: 10px">
                        <a href="#premium">
                            <div class="area-box">
                                <span class="fa fa-university"></span>
                                <h4 class="title-head text-uppercase">{{ $item_m->mapel_name }} {{ $item_k->kelas_name }}</h4>
                            </div>
                        </a>
                    </div>
                    @endforeach
                @endforeach
            @else
            <div class="col-12 text-center">
                <p class="text-danger">DAPATKAN FITUR FORUM PREMIUM DAN BERINTERAKSILAH DENGAN PARA INSTRUKTUR YANG AHLI DIBIDANGNYA DENGAN MENDAFTAR SEBAGAI SISWA DAN JADI BAGIAN DARI KELUARGA KAMI</p>
            </div>
            @endif
        </div>
    </div>
</section>
@endauth

<section class="w3l-homeblock1 py-sm-5 py-4">
    <div class="container py-md-4">
        <div class="left-right">
            <h3 class="section-title-left mb-sm-4 mb-2"> FORUM REGULER</h3>
        </div>
        <div class="grids-area-hny main-cont-wthree-fea row">
            @foreach ($data_mapel as $item_m)
                @foreach ($item_m->kelas as $item_k)
                <div class="col-lg-3 col-6 grids-feature" style="margin-bottom: 10px">
                    <a href="/forums-daftar-pertanyaan/{{ $item_k->slug }}/{{ $item_m->slug }}">
                        <div class="area-box">
                            <span class="fa fa-university"></span>
                            <h4 class="title-head text-uppercase">{{ $item_m->mapel_name }} {{ $item_k->kelas_name }}</h4>
                        </div>
                    </a>
                </div>
                @endforeach
            @endforeach
        </div>
    </div>
</section>

@endsection

@section('script')
    <script>
        function keforum()
    {
        var skrollke = document.getElementById("forum");
        skrollke.scrollIntoView();
    }
    </script>
@endsection