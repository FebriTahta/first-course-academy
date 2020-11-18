@extends('layouts.client_layouts.master')

@section('content')        
    {{-- <div class="content mt-50">
        <div class="row">
            <div class="col-12 border-bottom">

            </div>

            <div class="col-xl-8 mt-10">
                <div class="row">
                    @foreach ($kursus as $item)
                    <div class="col-xl-4">
                        <a href="" class="block block-rounded block-link-pop">
                            <div class="block-content border-bottom">
                                <img src="{{ asset('assets\media\drawkit\9 SCENE.svg') }}" alt="">
                            </div>    
                            <div class="block-content text-center text-secondary">
                                <label>{{ $item->mapel->mapel_name }} | {{ $item->kelas->kelas_name }}</label>
                            </div>
                            <div class="block-content text-secondary">
                                <p>instruktur : {{ $item->user->name }}</p>
                            </div>
                        </a>
                    </div>
                    @endforeach                    
                    
                </div>
            </div>            
        </div>
    </div> --}}

    <!-- LANDING PAGE -->

<div class="landing">
    <div class="landingText" data-aos="fade-up" data-aos-duration="1000">
        <h1>Belajar.<span style="color:#e0501b;font-size: 4vw"> di Rumah.</span> </h1>
        <h3>Kini kami hadir dalam bentuk <span style="color:#e0501b;font-size: 20px">digital / online.</span> 
        <br>Fitur khusus bagi anda yang telah mengikuti kursus private kami</h3>
        <div class="btn">
            <a href="#">Lihat Kursus</a>
        </div>
    </div>
    <div class="landingImage" data-aos="fade-down" data-aos-duration="2000">
        <img src="{{ asset('assets/media/ui/bg.png') }}" alt="">
    </div>
</div>

<!-- ABOUT SECTION -->

<div class="about">
    <div class="aboutText" data-aos="fade-up" data-aos-duration="1000">
        <h1>Kesuliatan Belajar dan Solusi <br> <span style="color:#2f8be0;font-size:3vw">Bukankah begitu ?</span> </h1>
        <img src="{{ asset('assets/media/ui/doctor-woman-400px.png') }}" alt="">
    </div>
    <div class="aboutList" data-aos="fade-left" data-aos-duration="1000">
        <ol>
            <li> 
                <span>01</span>
                 <p>Pada masa pandemi yang melanda hampir seluruh dunia. Sekolah'pun banyak yang dilakukan secara online dan tidak bertatap muka</p>
            </li>
            <li> 
                <span>02</span>
                 <p>Kami melihat banyak kasus anak yang kesulitan dalam memahami materi secara online karena tidak ada pembimbing profesional yang mengarahkan</p>
            </li>
            <li> 
                <span>03</span>
                 <p>Kami berfokus pada kursus private untuk menemani serta membantu anda dan adik-adik memahami materi secara langsung, tentunya dengan protokol kesehatan yang benar</p>
            </li>
            <li> 
                <span>04</span>
                 <p>Kami juga menyediakan fitur online berupa materi video, latihan soal, e-book, serta forum bagi anda yang mengikuti dan menggunakan jasa kami</p>
            </li>

        </ol>
    </div>
</div>

<!-- INFO SECTION -->

<div class="infoSection">
    <div class="infoHeader" data-aos="fade-up" data-aos-duration="1000">
        <h1>Yang anda dapatkan dari kami <br> <span style="color:#e0501b">Virus Pengetahuan.!</span> </h1>
    </div>
    <div class="infoCards">
        <div class="card one" data-aos="fade-up" data-aos-duration="1000">
            <img src="{{ asset('assets/media/ui/movie.png') }}" class="cardoneImg" alt="" data-aos="fade-up" data-aos-duration="1100">
            <div class="cardbgone"></div>
            <div class="cardContent">
                <h2>Aman dan terkendali</h2>
                <p>3 jam / hari & 3x / minggu kami datang untuk mengarahkan anda belajar</p>
                <a href="#">
                    <div class="cardBtn">
                        <img src="{{ asset('assets/media/ui/next.png') }}" alt="" class="cardIcon">
                    </div>
                </a>
            </div>
        </div>
        <div class="card two" data-aos="fade-up" data-aos-duration="1300">
            <img src="{{ asset('assets/media/ui/learn.png') }}" class="cardtwoImg" alt="" data-aos="fade-up" data-aos-duration="1200">
            <div class="cardbgtwo"></div>
            <div class="cardContent">
                <h2>Ingin Lebih ? </h2>
                <p>Kami hadir dalam bentuk digital dengan materi dan latihan soal</p>
                <a href="#">
                    <div class="cardBtn">
                        <img src="{{ asset('assets/media/ui/next.png') }}" alt="" class="cardIcon">
                    </div>
                </a>
            </div>
        </div>
        <div class="card three" data-aos="fade-up" data-aos-duration="1600">
            <img src="{{ asset('assets/media/ui/videocall.png') }}" class="cardthreeImg" alt="" data-aos="fade-up" data-aos-duration="1300">
            <div class="cardbgone"></div>
            <div class="cardContent">
                <h2>Saling membantu</h2>
                <p>Ilmu pengetahuan tidak hanya dari guru, terdapat forum untuk saling bertukar pikiran</p>
                <a href="#">
                    <div class="cardBtn">
                        <img src="{{ asset('assets/media/ui/next.png') }}" alt="" class="cardIcon">
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- BANNER AND FOOTER -->

<div class="banner">
    {{-- <div class="bannerText" data-aos="fade-right" data-aos-duration="1000">
        <h1>Download the HealthCare App Today. <br> <span style="font-size:1.6vw;font-weight:normal"  class="bannerInnerText">
            Stay Updated and get all your medical needs taken care of!
        </span> </h1>
        <a href="#"> <img src="img/AndroidPNG.png" alt=""> </a>
        <a href="#"> <img src="img/iosPNG.png" alt=""> </a>
    </div>
    <div class="bannerImg" data-aos="fade-up" data-aos-duration="1000">
        <img src="img/MobileApp.png" alt="">
    </div> --}}
</div>

<div class="footer">
    <h2>HealthCare.</h2>
    <div class="footerlinks">
        <a href="#" class="mainlink">Corona Updates</a>
        <a href="#">Help</a>
        <a href="#">About</a>
        <a href="#">Contact</a>
    </div>
</div>
@endsection