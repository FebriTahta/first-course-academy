@extends('layouts.client_layouts.master')

@section('content')
<!-- Hero -->
<div class="bg-image bg-image-bottom" style="background-image: url({{ asset('assets/media/photos/photo34@2x.jpg') }});">
    <div class="bg-primary-dark-op">
        <div class="content content-top text-center overflow-hidden">
            <h5 class="h4 font-w400 text-white-op invisible" data-toggle="appear" data-class="animated fadeInUp"></h5>
        </div>
    </div>
</div>
<!-- END Hero -->
<div class="content">
    <div class="my-50 text-center">
        <h2 class="font-w700 text-black mb-10">
            <i class="fa fa-book text-muted mr-5"></i> DAFTAR KURSUS
        </h2>
        <h3 class="h5 text-muted mb-0">
            kami memiliki total {{ $kursus->count() }} kursus aktif! <a href="be_pages_real_estate_listing_new.html"></a>.
        </h3>
    </div>
    <div class="row">
        @foreach ($kursus as $item)
        <div class="col-md-6 col-xl-4 js-appear-enabled animated fadeIn" data-toggle="appear">
            <!-- Property -->
            <div class="block block-rounded">
                <div class="block-content p-0 overflow-hidden">
                    <a class="img-link" href="be_pages_real_estate_listing.html">
                        <img class="rounded-top" src="{{ asset('kursus_picture/'.$item->kursus_pict) }}" alt="" height="285px">
                    </a>                    
                </div>
                <div class="block-content border-bottom">
                    <h4 class="font-size-h5 mb-10"> {{ $item->kelas->kelas_name }}</h4>
                    <h5 class="font-size-h1 font-w300 mb-5"> {{ $item->mapel->mapel_name }}</h5>
                    <p class="text-muted">
                        <i class="fa fa-map-pin mr-5"></i> Instruktur : {{ $item->user->name }}
                    </p>
                </div>
                <div class="block-content border-bottom">
                    <div class="row">                        
                        <div class="col-4">
                            <div class="mb-5 font-size-sm text-muted">{{ $item->book->count() }} &nbsp;<i class="si si-notebook"></i> Buku</div>
                        </div>
                        <div class="col-4">
                            <div class="mb-5 font-size-sm text-muted">{{ $item->video->count() }} &nbsp;<i class="si si-control-play"></i>  Video</div>
                        </div>
                        <div class="col-4">
                            <div class="mb-5 font-size-sm text-muted">{{ $item->kuis->count() }} &nbsp;<i class="fa fa-pencil"></i> Kuis</div>
                        </div>
                    </div>
                </div>
                <div class="block-content block-content-full text-center">
                    <div class="row">
                        @auth
                            @if (auth()->user()->role=='siswa')
                                <?php $punya = App\kursus_profile::where('kursus_id', $item->id)->where('profile_id', auth()->user()->profile->id)->first()?>
                                @if ($punya !== null)
                                    @if (auth()->user()->stat == 0)
                                    <div class="block-content text-center">
                                        <a href="#" class="btn btn-outline-warning"> ANDA SEDAN TIDAK AKTIF</a>
                                    </div>
                                    @else
                                    <div class="block-content text-center">
                                        <a href="{{ route('myCourse', $item->slug) }}" class="btn btn-outline-primary"> START</a>
                                    </div>
                                    @endif                                    
                                @else
                                    <div class="block-content">
                                        <a href="#" class="btn btn-outline-danger"> BUKAN KURSUS ANDA</a>
                                    </div>                            
                                @endif
                            @elseif(auth()->user()->role=='instruktur')                                
                                @if ($item->user_id == auth()->user()->id)
                                    <div class="block-content text-center">
                                        <a href="{{ route('kursus', $item->slug) }}" class="btn btn-outline-primary"> START</a>
                                    </div>
                                @else
                                    <div class="block-content">
                                        <a href="#" class="btn btn-outline-danger"> BUKAN KURSUS ANDA</a>
                                    </div>
                                @endif
                            @elseif(auth()->user()->role=='admin')
                            <div class="block-content text-center">
                                <a href="{{ route('kursusAdmin', $item->slug) }}" class="btn btn-outline-primary"> START</a>
                            </div>
                            @elseif(auth()->user()->role=='pengunjung')
                            <div class="block-content text-center">
                                <a href="#" class="btn btn-outline-primary"> HUBUNGI ADMIN UNTUK MENDAPATKAN KURSUS</a>
                            </div>
                            @endif
                                             
                        @else
                        <div class="block-content text-center">
                            <a href="{{ route('login') }}" class="btn btn-primary"> SILAHKAN LOGIN </a>
                        </div>                            
                        @endauth                        
                    </div>
                </div>
            </div>
            <!-- END Property -->            
        </div>
        @endforeach        
    </div>
    <div class="block bg-transparent mt-50">
        <div class="block-conent text-center bg-trasnparent">
            <p>Untuk pendaftaran silahkan hubungi kontak berikut</p>
            <p class="fa fa-phone"> 081-329-146-514</p>
        </div>
    </div>
</div>
@endsection