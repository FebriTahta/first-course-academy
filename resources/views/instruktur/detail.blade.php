@extends('layouts.new_layouts.master')
@section('head')

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
            <h3 class="section-title-left mb-4"> Detail Instruktur</h3>
        <div class="row">
            <div class="col-lg-6 mb-50">
                <div class="bg-clr-white" style="min-height: 270px">
                    <div class="row">                        
                        <div class="col-sm-12 card-body blog-details align-self">
                            <div class="pad" style="margin-left: 10%">
                                <p class="blog-desc jam text-bold" id="jam" ></p>
                                <a class="blog-desc waktu" id="waktu"> </a>                                
                            </div>                            
                            <div class="author mt-3" style="margin-left: 10%">
                                <img 
                                    @if ($instruktur->photo==null)
                                        src="{{ asset('assets/assets/images/a1.jpg') }}"
                                    @else
                                    src="{{ asset('photo/'.$instruktur->photo) }}"
                                    @endif alt="" class="img-fluid rounded-circle">
                                <ul class="blog-meta">
                                    <li>
                                        <a >{{ $instruktur->name }}</a> 
                                    </li>
                                    <li class="meta-item blog-lesson">
                                        <p>{{ $instruktur->role }} | ALUMNI : {{ $instruktur->profile->alumni }}</p>
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
                            <h4><u>{{ $instruktur->video->count() }}</u> Video Kursus</h4>
                        </div>
                    </a>
                    <a class="topics-list mt-3 hover-box" onclick="artikelscroll()">
                        <div class="list1" >
                            <span class="fa fa-book"></span>
                            <h4><u>{{ $instruktur->artikel->count() }}</u> Artikel & Buku Kursus</h4>
                        </div>
                    </a>
                    <a  class="topics-list mt-3 hover-box" onclick="kuisscroll()">
                        <div class="list1">
                            {{-- <span class="fa fa-file-alt"></span> --}}
                            <span class="fa fa-pencil"></span>
                            <h4><u>{{ $instruktur->kuis->count() }}</u> Latihan Soal</h4>
                        </div>
                    </a>
                    <a  class="topics-list mt-3 hover-box">
                        <div class="list1">
                            <span class="fa fa-pie-chart"></span>
                            <h4><u>{{ $instruktur->kursus->count() }}</u> Kursus</h4>
                        </div>
                    </a>
                </div>                            
            </div>
        </div>
    </div>
</div>
<div class="w3l-homeblock2 py-5">
    <div class="container py-lg-5 py-md-4">
        <!-- block -->
        <div class="left-right">
            <h3 class="section-title-left mb-sm-4 mb-2 text-uppercase"> KURSUS YANG DIMILIKI {{ $instruktur->name }}</h3>
            <a href="{{ route('allkursus') }}" class="more btn btn-small mb-sm-0 mb-4">KURSUS LAIN</a>
        </div>
        <div class="row">
            @foreach ($instruktur->kursus as $item)
            <div class="col-lg-4 col-md-6 item" style="margin-bottom: 20px">
                <div class="card">
                    <div class="card-header p-0 position-relative">
                        <a href="{{ route('myCourse',$item->slug) }}">
                            <img class="card-img-bottom d-block radius-image-full" style="max-height: 250px" src="{{ asset('kursus_picture/'.$item->kursus_pict) }}"
                                alt="Card image cap">
                        </a>
                    </div>
                    <div class="card-body blog-details">
                        <a href="#blog-single.html" class="blog-desc">{{ $item->mapel->mapel_name }} | {{ $item->kelas->kelas_name }}
                        </a>
                        <div class="author align-items-center">
                            <img 
                                @if ($item->user->profile->photo==null)
                                        src="{{ asset('assets/assets/images/a1.jpg') }}"
                                    @else
                                        src="{{ asset('photo/'.$item->user->profile->photo) }}"
                                @endif 
                            alt="" class="img-fluid rounded-circle" />
                            <ul class="blog-meta">
                                <li>
                                    <a href="author.html">{{ $item->user->name }}</a> </a>
                                </li>
                                <li class="meta-item blog-lesson">
                                    {{-- <div class="row"> --}}
                                        <div class="meta-value">
                                            <div class="row">
                                                <div class="col-4 col-sm-4">
                                                    <span>{{ $item->video->count() }} video</span>
                                                </div>
                                                <div class="col-4 col-sm-4">
                                                    <span>{{ $item->artikel->count() }} book</span>
                                                </div>
                                                <div class="col-4 col-sm-4">
                                                    <span>{{ $item->kuis->count() }} kuis</span>
                                                </div>
                                            </div>
                                        </div>
                                    {{-- </div> --}}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach 
        </div>
    </div>
</div>

@endsection

@section('script')
<script>    
    var table;
    $(document).ready(function(){    
        table= $('#kursus').DataTable({});        
    });
</script>

<script type="text/javascript">
    var months  =['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    var theDays =['Minggu','Senen','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    var date    = new Date();
    var day     = date.getDate();
    var month   = date.getMonth();
    var thisDay = date.getDay(),
        thisDay = theDays[thisDay];
    var yy      = date.getYear();
    var year    = (yy<1000) ? yy + 1900: yy;
    document.write(thisDay+',' + day + '' + months[month] + '' + year);
    document.getElementById("waktu").innerHTML=(thisDay+', ' + day + '' + months[month] + '' + year);
</script>
<script>
    function showtime()
    {            
        var today       = new Date();
        var curr_hour   = today.getHours();
        var curr_minute = today.getMinutes();
        var curr_second = today.getSeconds();            
        curr_hour       = checkTime(curr_hour);
        curr_minute     = checkTime(curr_minute);
        curr_second     = checkTime(curr_second);
        document.getElementById("jam").innerHTML=curr_hour+ ":" + curr_minute + ":" + curr_second ;                        
    }
    function checkTime(i){            
        if(i == 60){
            i = 60;
        }
        return i;        
    }
    setInterval(showtime, 500);
</script>
@endsection