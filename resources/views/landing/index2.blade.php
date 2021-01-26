@extends('layouts.new_layouts.master')

@section('content')
    <div class="content">
        <section class="w3l-testimonials py-sm-5 py-4" id="testimonials">
            <!-- main-slider -->
            <div class="testimonials pt-2 pb-5">
                <div class="container pb-lg-5">
                    <div class="owl-testimonial owl-carousel owl-theme mb-md-0 mb-sm-5 mb-4">
                        <div class="item">
                            <div class="row slider-info">
                                <div class="col-lg-8 message-info align-self">
                                    <span class="label-blue mb-sm-4 mb-3">Course Goal</span>
                                    <h3 class="title-big mb-4">Dapatkanlah materi bergengsi dan jadi juara kelas.
                                    </h3>
                                    <p class="message">Kursus kami menyediakan materi terbaru dan ter-update yang disampaikan
                                        oleh para instruktur profesional dari Universitas bergengsi.
                                        Materi dikemas dengan padat dan menarik dalam bentuk video dan dokumen sehingga mudah dipahami.</p>
                                </div>
                                <div class="col-lg-4 col-md-8 img-circle mt-lg-0 mt-4">
                                    <img src="{{ ('assets/media/ui/learn.png') }}" class="img-fluid radius-image-full" alt="client image">
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row slider-info">
                                <div class="col-lg-8 message-info align-self">
                                    <span class="label-blue mb-sm-4 mb-3">Course Goal</span>
                                    <h3 class="title-big mb-4">Dapatkan kemudahan akses belajar dimanapun dan kapanpun.
                                    </h3>
                                    <p class="message">Anda dapat mengakses seluruh materi dari kami dengan ponsel anda.
                                        Dengan kumudahan mengakses materi belajar membuat anda berada satu langkah didepan lebih siap
                                        dalam menghadapi masa depan.  
                                    </p>
                                </div>
                                <div class="col-lg-4 col-md-8 img-circle mt-lg-0 mt-4">
                                    <img src="{{ ('assets/media/ui/MobileApp.png') }}" class="img-fluid radius-image-full" alt="client image">
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
            <!-- /main-slider -->
        </section>              

        <div class="w3l-homeblock2 py-5">
            <div class="container py-lg-5 py-md-4">
                <!-- block -->
                <div class="left-right">
                    <h3 class="section-title-left mb-sm-4 mb-2"> Recent Course</h3>
                    <a href="{{ route('allkursus') }}" class="more btn btn-small mb-sm-0 mb-4">View More</a>
                </div>
                <div class="row">
                    @foreach ($recent_course as $item)
                        <!--instruktur-->
                        @auth
                            @if (auth()->user()->role=='instruktur')
                                <div class="col-lg-4 col-md-6 item" style="margin-top: 50px">
                                    <div class="card">
                                        <div class="card-header p-0 position-relative">
                                            
                                            <a @if (auth()->user()->id == $item->user_id) href="{{ route('myCourse',$item->slug) }}" @endif >
                                                <img class="card-img-bottom d-block radius-image-full" style="max-height: 250px" src="{{ asset('kursus_picture/'.$item->kursus_pict) }}"
                                                    alt="Card image cap">
                                            </a>
                                        </div>
                                        <div class="card-body blog-details">
                                            @if (auth()->user()->id == $item->user_id)
                                                <span class="label-blue"> kursus anda </span><br>
                                            @else
                                                <span class="label-blue text-danger"> bukan kursus anda </span><br>
                                            @endif
                                            <a @if (auth()->user()->id == $item->user_id) href="{{ route('myCourse',$item->slug) }}" @endif class="blog-desc">{{ $item->mapel->mapel_name }} | {{ $item->kelas->kelas_name }}
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
                                                        <a  @if (auth()->user()->id == $item->user_id) href="{{ route('myCourse',$item->slug) }}" @endif >{{ $item->user->name }}</a> </a>
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
                                <!--siswa-->
                            @elseif(auth()->user()->role=='siswa')
                                <?php $punya = App\kursus_profile::where('kursus_id', $item->id)->where('profile_id', auth()->user()->profile->id)->first()?>
                                <div class="col-lg-4 col-md-6 item" style="margin-top: 50px">
                                    <div class="card">
                                        <div class="card-header position-relative">
                                            
                                            <a @if ($punya !== null) href="{{ route('myCourse',$item->slug) }}" @endif >
                                                <img class="card-img-bottom d-block radius-image-full" style="max-height: 250px" src="{{ asset('kursus_picture/'.$item->kursus_pict) }}"
                                                    alt="Card image cap">
                                            </a>
                                        </div>
                                        <div class="card-body blog-details">
                                            @if ($punya !== null)
                                                <span class="label-blue"> kursus anda </span><br>
                                            @else
                                                <span class="label-blue text-danger"> bukan kursus anda </span><br>
                                            @endif
                                            <a @if ($punya !==null ) href="{{ route('myCourse',$item->slug) }}" @endif class="blog-desc">{{ $item->mapel->mapel_name }} | {{ $item->kelas->kelas_name }}
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
                                                        <a  @if ($punya !== null) href="{{ route('myCourse',$item->slug) }}" @endif >{{ $item->user->name }}</a> </a>
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
                            <!--admin-->
                            @elseif(auth()->user()->role=='admin')
                                <div class="col-lg-4 col-md-6 item" style="margin-top: 50px">
                                    <div class="card">
                                        <div class="card-header position-relative">
                                            
                                            <a href="{{ route('myCourse',$item->slug) }}" >
                                                <img class="card-img-bottom d-block radius-image-full" style="max-height: 250px" src="{{ asset('kursus_picture/'.$item->kursus_pict) }}"
                                                    alt="Card image cap">
                                            </a>
                                        </div>
                                        <div class="card-body blog-details">
                                            <a href="{{ route('myCourse',$item->slug) }}" class="blog-desc">{{ $item->mapel->mapel_name }} | {{ $item->kelas->kelas_name }}
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
                                                        <a href="{{ route('myCourse',$item->slug) }}" >{{ $item->user->name }}</a> </a>
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
                            <!--pengunjung-->
                            @elseif(auth()->user()->role=='pengunjung')
                            <?php $punya = App\kursus_profile::where('kursus_id', $item->id)->where('profile_id', auth()->user()->profile->id)->first()?>
                            <div class="col-lg-4 col-md-6 item" style="margin-top: 50px">
                                <div class="card">
                                    <div class="card-header position-relative" >
                                        
                                        <a @if ($punya !== null) href="{{ route('myCourse',$item->slug) }}" @endif >
                                            <img class="card-img-bottom d-block radius-image-full" style="max-height: 250px" src="{{ asset('kursus_picture/'.$item->kursus_pict) }}"
                                                alt="Card image cap">
                                        </a>
                                    </div>
                                    <div class="card-body blog-details">
                                        @if ($punya !== null)
                                            <span class="label-blue"> kursus anda </span><br>
                                        @else
                                            <span class="label-blue text-danger"> bukan kursus anda </span><br>
                                        @endif
                                        <a @if ($punya !==null ) href="{{ route('myCourse',$item->slug) }}" @endif class="blog-desc">{{ $item->mapel->mapel_name }} | {{ $item->kelas->kelas_name }}
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
                                                    <a  @if ($punya !== null) href="{{ route('myCourse',$item->slug) }}" @endif >{{ $item->user->name }}</a> </a>
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
                            @endif
                        <!--tidak login-->
                        @else
                            <div class="col-lg-4 col-md-6 item">
                                <div class="card">
                                    <div class="card-header p-0 position-relative">
                                        
                                        <a>
                                            <img class="card-img-bottom d-block radius-image-full" style="max-height: 250px" src="{{ asset('kursus_picture/'.$item->kursus_pict) }}"
                                                alt="Card image cap">
                                        </a>
                                    </div>
                                    <div class="card-body blog-details">
                                            <span class="label-blue text-danger"> bukan kursus anda </span><br>
                                        <a class="blog-desc">{{ $item->mapel->mapel_name }} | {{ $item->kelas->kelas_name }}
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
                                                    <a >{{ $item->user->name }}</a> </a>
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
                        @endauth
                    @endforeach
                </div>
            </div>
        </div>                
    </div>
    <div class="w3l-homeblock2 w3l-homeblock5 py-5">
        <div class="container py-lg-5 py-md-4">
            <!-- block -->
            <div class="left-right">
                <h3 class="section-title-left mb-sm-4 mb-2"> INSTRUKTUR</h3>
                <a href="{{ route('allinstruktur') }}" class="more btn btn-small mb-sm-0 mb-4">View more</a>
            </div>
            <div class="row">
                @foreach ($recent_instruktur as $item)
                    <div class="col-lg-4">
                        <div class="bg-clr-white hover-box" style="max-height: 150px; margin-bottom: 10px">
                            <div class="row">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-11 card-body blog-details align-self" >
                                    <div class="author align-items-center">
                                        <img @if($item->profile->photo===null) src="{{ asset('assets/assets/images/a1.jpg') }}" @else src="{{ asset('photo/'.$item->profile->photo) }}" @endif alt="" class="img-fluid rounded-circle">
                                        <ul class="blog-meta">
                                            <li>
                                                <a href="{{ route('detailInstruktur',$item->id) }}">{{ $item->name }}</a> 
                                            </li>
                                            <li class="meta-item blog-lesson">
                                                <span class="meta-value"> @if($item->profile->alumni==null)@else{{ $item->profile->alumni }} @endif </span>
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
    <div class="w3l-homeblock2 w3l-homeblock6 py-5" >
        <div class="container-fluid px-sm-5 py-lg-5 py-md-4">
            <!-- block -->
            @if (count($recent_news)!==0)
            <h3 class="section-title-left mb-4"> NEWS </h3>
            @endif
            <div class="row" >
                @foreach ($recent_news as $item)
                <div class="col-lg-6 news" id="news" style="margin-top: 50px">
                    <div class="bg-clr-white hover-box" style="min-height: 280px">
                        <div class="row">
                            <div class="col-sm-6 position-relative" style="min-height: 280px">
                                <a href="{{ route('newsDetail',$item->id) }}" >
                                    <img class="card-img-bottom d-block radius-image-full" style="min-height: 280px" src="{{ asset('news_picture/'.$item->news_pict) }}" alt="Card image cap">
                                </a>
                            </div>
                            <div class="col-sm-6 card-body blog-details align-self">
                                <a href="{{ route('newsDetail',$item->id) }}" class="blog-desc">{{ $item->news_tittle }}
                                </a>
                                <p></p>
                                <div class="author align-items-center mt-3">
                                    <img src="{{ asset('assets/assets/images/a2.jpg') }}" alt="" class="img-fluid rounded-circle">
                                    <ul class="blog-meta">
                                        <li>
                                            <a href="{{ route('newsDetail',$item->id) }}">{{ $item->user->name }} &nbsp; ({{ $item->user->role }})</a> 
                                        </li>
                                        <li class="meta-item blog-lesson">
                                            <span class="meta-value"> {{ $item->created_at }} </span>.
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
@endsection

@section('script')
    <script>
        // news
    function news()
    {
        var skrollke = document.getElementById("news");
        skrollke.scrollIntoView();
    }
    </script>
@endsection