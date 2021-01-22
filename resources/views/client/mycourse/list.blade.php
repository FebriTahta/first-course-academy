@extends('layouts.new_layouts.master')
@section('head')
@endsection
@section('content')
<div class="w3l-homeblock2 w3l-homeblock6 py-5">
    <div class="container-fluid px-sm-5 py-lg-5 py-md-4">
        <div class="row">
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
                                        Anda belum memiliki kursus. Segera hubungi Admin untuk mendapatkan kursus
                                    @else
                                        Anda Mempunyai <strong>{{ count(auth()->user()->kursus) }} Kursus</strong>.<br>
                                        <small>Silahkan periksa dan atur materi pada daftar kursus anda</small><br>
                                        <button style="margin-top: 30px" class="btn btn-sm btn-success" onclick="scrollfu()">Daftar kursus anda</button>
                                    @endif
                                @else
                                    @if (count(auth()->user()->profile->kursus)==0)
                                        <small> Anda belum memiliki kursus. Segera hubungi Admin untuk mendapatkan kursus dan akses materi bergengsi kami</small><br>
                                    @else
                                        Anda telah berlangganan <strong>{{ count(auth()->user()->profile->kursus) }} Kursus</strong>.<br>
                                        <small>Terimakasih telah berlangganan kursus pada kami. Selamat Belajar!^^</small>
                                        <button style="margin-top: 30px" class="btn btn-sm btn-success" onclick="scrollfu()">Daftar kursus anda</button>
                                    @endif
                                @endif
                                <button type="button" onclick="scrollfu2()" class="btn btn-sm btn-primary" style="margin-top: 30px">
                                    PROFILE
                                </button>
                                <a class="btn btn-sm btn-danger" href="{{ route('password.request') }}" style="margin-top: 30px">
                                    {{ __('Forgot / Reset Your Password?') }}
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if (auth()->user()->role=='instruktur')
<section class="w3l-homeblock1 py-sm-5 py-4">
    <div class="container py-md-4">
        <div class="grids-area-hny main-cont-wthree-fea row">
            <div class="col-lg-3 col-6 grids-feature">
                <a href="#video">
                    <div class="area-box">
                        <span class="fa fa-play"></span>
                        <h4 class="title-head text-uppercase"><u>{{ count(auth()->user()->video) }}</u> Video</h4>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-6 grids-feature">
                <a href="#kuis">
                    <div class="area-box">
                        <span class="fa fa-book"></span>
                        <h4 class="title-head text-uppercase"><u>{{ count(auth()->user()->artikel) }}</u> Artikel</h4>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-6 grids-feature mt-lg-0 mt-md-4 mt-3">
                <a href="#kuis">
                    <div class="area-box">
                        <span class="fa fa-pencil-square"></span>
                        <h4 class="title-head text-uppercase"><u>{{ count(auth()->user()->kuis) }}</u> Latihan soal</h4>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-6 grids-feature mt-lg-0 mt-md-4 mt-3">
                <a href="#kursus">
                    <div class="area-box">
                        <span class="fa fa-university"></span>
                        <h4 class="title-head text-uppercase"><u>{{ count(auth()->user()->kursus) }}</u> kursus</h4>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
@else
@endif

<div class="w3l-homeblock2 w3l-homeblock5 py-5">
    <div class="container py-lg-5 py-md-4" id="daftarkursus">
        <!-- block -->
        @auth
            @if (auth()->user()->role=='pengunjung')
            @else
                <div class="left-right">
                    <h3 class="section-title-left mb-sm-4 mb-2"> MY COURSE</h3>
                </div>
            @endif
        @endauth
        <div class="row">
            @if (auth()->user()->role=='siswa')
                @foreach (auth()->user()->profile->kursus as $item)
                <div class="col-lg-6" style="margin-bottom: 20px">
                    <div class="bg-clr-white hover-box">
                        <div class="row">
                            <div class="col-sm-5 position-relative">
                                <a href="{{ route('myCourse',$item->slug) }}" class="image-mobile" >
                                    <img class="card-img-bottom d-block radius-image-full" style="min-height: 160px" src="{{ asset('kursus_picture/'.$item->kursus_pict) }}" alt="Card image cap">
                                </a>
                            </div>
                            <div class="col-sm-7 card-body blog-details align-self">
                                <a href="{{ route('myCourse',$item->slug) }}" class="blog-desc">{{ $item->mapel->mapel_name }}{{ $item->kelas->kelas_name }}
                                </a>
                                <div class="author align-items-center">
                                    <img @if ($item->user->profile->photo==null) src="{{ asset('/assets/assets/images/a2.jpg') }}" @else src="{{ asset('photo/'.$item->user->profile->photo) }}" @endif alt="" class="img-fluid rounded-circle">
                                    <ul class="blog-meta">
                                        <li>
                                            <a href="{{ route('myCourse',$item->slug) }}">{{ $item->user->name }}</a> 
                                        </li>
                                        <li class="meta-item blog-lesson">
                                            <span class="meta-value"> {{ $item->user->role }} </span>. 
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                @foreach (auth()->user()->kursus as $item)
                <div class="col-lg-6" style="margin-bottom: 20px">
                    <div class="bg-clr-white hover-box">
                        <div class="row">
                            <div class="col-sm-5 position-relative">
                                <a href="{{ route('myCourse',$item->slug) }}" class="image-mobile" >
                                    <img class="card-img-bottom d-block radius-image-full" style="min-height: 160px" src="{{ asset('kursus_picture/'.$item->kursus_pict) }}" alt="Card image cap">
                                </a>
                            </div>
                            <div class="col-sm-7 card-body blog-details align-self">
                                <a href="{{ route('myCourse',$item->slug) }}" class="blog-desc">{{ $item->mapel->mapel_name }}{{ $item->kelas->kelas_name }}
                                </a>
                                <div class="author align-items-center">
                                    <img src="{{ asset('assets/assets/images/a2.jpg') }}" alt="" class="img-fluid rounded-circle">
                                    <ul class="blog-meta">
                                        <li>
                                            <a href="{{ route('myCourse',$item->slug) }}">{{ $item->user->name }}</a> 
                                        </li>
                                        <li class="meta-item blog-lesson">
                                            <span class="meta-value"> {{ $item->status }} </span>. 
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<div class="content">
    <section class="w3l-homeblock1 py-sm-5 py-4" style="min-height: 800px">
        <div class="container py-lg-5 py-md-4" id="profile">
            <div class="block bg-clr-white" >
                <div class="block-header block-header-default">
                    
                </div>
                <div class="block-content" >
                    <div class="row items-push">
                        <div class="col-lg-2" style="padding: 10%">
                            PROFILE
                        </div>
                        <div class="col-lg-8 offset-lg-1" style="padding: 10%">
                            <form action="{{ route('storeProfile') }}" method="post" enctype="multipart/form-data"> @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <div class="form-group">
                                    <label for="hosting-settings-profile-alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control" placeholder="Jl Simo Jawar III / Rt 02. Rw 01. no. 104 Surabaya">{{ auth()->user()->profile->alamat }}</textarea>
                                </div>                                        
                                <div class="form-group">
                                    <label for="phone">Nomor Telephone</label>
                                    <input type="tel" class="form-control" id="phone" name="telp" placeholder="081-329-146-514" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}-[0-9]{3}" value="{{ auth()->user()->profile->telp }}" required>
                                    <small>Format: 081-329-146-514</small>
                                </div>
                                <div class="form-group">
                                    <label>
                                        @if (auth()->user()->role=='instruktur')
                                            Alumni Perguruan Tinggi / Universitas
                                        @else
                                            Asal Sekolah
                                        @endif 
                                    </label>
                                    <input type="text" name="alumni" class="form-control" placeholder="SMPN 4 Surabaya" value="{{ auth()->user()->profile->alumni }} "  required>
                                </div>
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select name="gender" id="gender" class="form-control" required>
                                        <option value="">Pilih salah satu</option>
                                        <option @if(auth()->user()->profile->gender=='Laki-Laki') selected @endif value="Laki-Laki">Laki-Laki</option>
                                        <option @if(auth()->user()->profile->gender=='Perempuan') selected @endif value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="photo">Photo</label><br>
                                    <input type="file" name="photo">
                                </div>
                                <div class="form-group float-right">
                                    <button type="submit" class="btn btn-primary">Update</button>                                        
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>                                        
</div>
@endsection

@section('script')
    <script>
        function scrollfu()
        {
            var skrollke = document.getElementById("daftarkursus");
            skrollke.scrollIntoView();
        }        
    </script>
    <script>
        function scrollfu2()
        {
            var skrollke = document.getElementById("profile");
            skrollke.scrollIntoView();
        }
    </script>
@endsection