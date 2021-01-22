@extends('layouts.new_layouts.master')

@section('content')

<div class="w3l-homeblock2 py-5">
    <div class="container py-lg-5 py-md-4">
        <!-- block -->
        <div class="left-right" style="margin-bottom: 20px">
            <h3 class="section-title-left mb-sm-4 mb-2"> Semua Kursus</h3>
            {{-- <a href="{{ route('allkursus') }}" class="more btn btn-small mb-sm-0 mb-4">Lihat lebih banyak kursus</a> --}}
            <p><small>Terdapat {{ count($kursus) }} kursus aktif yang tersedia</small></p>
        </div>
        <div class="row">
            @foreach ($kursus as $item)
                        <!--instruktur-->
                        @auth
                            @if (auth()->user()->role=='instruktur')
                                <div class="col-lg-4 col-md-6 item">
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
                                <div class="col-lg-4 col-md-6 item">
                                    <div class="card">
                                        <div class="card-header p-0 position-relative">
                                            
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
                                <div class="col-lg-4 col-md-6 item">
                                    <div class="card">
                                        <div class="card-header p-0 position-relative">
                                            
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
                            <div class="col-lg-4 col-md-6 item">
                                <div class="card">
                                    <div class="card-header p-0 position-relative">
                                        
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
@endsection