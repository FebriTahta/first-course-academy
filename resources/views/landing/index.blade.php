@extends('layouts.c_layouts.master')

@section('content')
<!-- LANDING PAGE -->

<div class="landing">
    <div class="landingText" data-aos="fade-up" data-aos-duration="1000">
        <h1>Course.<span style="color:blue;font-size: 4vw"> Academy.</span> </h1>
        {{-- <h3>Kini kami hadir dalam bentuk <span style="color:#e0501b;font-size: 2vw">digital / online.</span>  --}}
            <h3>Kini kami hadir dalam bentuk Digital
        <br>Belajar dengan aman dan menyenangkan bersama kami</h3>
        <div class="btn">            
            {{-- <a href="{{ route('kursusAdmin') }}">semua kursus</a> --}}
            <a href="{{ route('allkursus') }}">semua kursus</a>            
        </div>
    </div>
    <div class="landingImage" data-aos="fade-down" data-aos-duration="2000">
        {{-- <img src="{{ asset('assets/media/ui/bg.png') }}" alt=""> --}}
        <img src="{{ asset('assets/media/drawkit/8-SCENE.svg') }}" alt="">
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

@endsection