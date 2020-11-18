@extends('layouts.client_layouts.master')

@section('content')
<!-- Hero -->
<div class="bg-image bg-image-bottom" style="background-image: url({{ asset('assets/media/photos/photo34@2x.jpg') }});">
    <div class="bg-primary-dark-op">
        <div class="content content-top text-center overflow-hidden">
            <div class="pb-10">
                <h3 class="font-w700 text-white mb-10 invisible" data-toggle="appear" data-class="animated fadeInUp">FORUM</h3>
                <p class="font-w400 text-white-op invisible" data-toggle="appear" data-class="animated fadeInUp">{{ $data_kelas->kelas_name }} | {{ $data_mapel->mapel_name }}</p>
            </div>
        </div>
    </div>
</div>
<!-- END Hero -->
<div class="container">
    <div class="row">
        <div class="col-12"><h2 class="content-heading"><a href="{{ route('home') }}"> DASHBOARD </a><small>|<a href="{{ route('forum') }}"> Forum </a></small></h2>
            @if (Session::has('pesan-sukses'))
            <div class="alert alert-info text-bold">{{ Session::get('pesan-sukses') }}</div>
            @endif
        </div> 
        <div class="col-xl-5">
            <div class="block block-rounded">
                <div class="block-header block-header-default">                    
                    <div class="block-content text-center">
                        <h5>DAFTAR PERTANYAAN</h5>
                    </div>
                    <div class="block-options">                    
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-down"></i></button>
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="pinned_toggle">
                            <i class="si si-pin"></i>
                        </button>

                    </div>
                </div>
                <div class="block-content">
                    @foreach ($data_forum as $item_forum)                                            
                    <div class="block block-mode-hidden">
                        <div class="block-header block-header-default">
                            <h3 class="block-title"><a href="/forum-detail-pertanyaan/{{ $item_forum->slug }}">{{ $item_forum->judul_pertanyaan }}</a></h3>
                            <div class="block-options">
                                <!-- To toggle block's content, just add the following properties to your button: data-toggle="block-option" data-action="content_toggle" -->
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-down"></i></button>
                            </div>
                        </div>
                        <div class="block-content">
                            <p>{!! $item_forum->desc_pertanyaan !!}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-xl-7">
            <div class="block block-rounded border-bottom">
                <div class="block-header block-header-default">                    
                    <div class="block-content">
                        
                    </div>
                </div>

                <div class="block-content border-bottom">
                    <h1 class="h4 font-w400">{{ $data_pertanyaan_forum->judul_pertanyaan }}</h1>
                </div>
                <div class="block-content border-bottom">
                    <p>{!! $data_pertanyaan_forum->desc_pertanyaan !!}</p>
                </div>

                <div class="komen">
                    <div class="block-content">
                        <p>DAFTAR KOMENTAR</p>
                    </div>
                    <div class="row">
                        
                        @if (count($data_pertanyaan_forum->komentar) == 0)
                        
                        <div class="col-10 col-md-10">
                            <div class="block-content text-left">
                                <p class="text-danger">BELUM ADA KOMENTAR PADA PERTANYAAN INI</p>
                            </div>
                        </div>
                        @else
                            @foreach ($data_pertanyaan_forum->komentar as $item)
                            <div class="col-2 col-md-2">
                                <div class="block-content">
                                    <input type="text" class="form-control" disabled>
                                </div>
                            </div>
                            
                            <div class="col-9 col-md-9 border-bottom flex-box">
                                <div class="block block-rounded">
                                    <div class="block-content text-left">
                                        <p class="text-primary">{{ $item->user->name }}</p>                                        
                                        <p>{!! $item->komen !!}</p>                                        
                                    </div>
                                </div>                                
                            </div>
                            @endforeach                        
                        @endif                        
                    </div>
                </div>
            </div>            

            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <p>komentar</p>
                </div>
                @auth
                @if (auth()->user()->stat==='1')
                <form action="{{ route('post-komentar') }}" method="POST" enctype="multipart/form-data">@csrf
                    <div class="block-content">
                        <div class="form-group">
                            <input type="hidden" name="forum_id" value="{{ $data_pertanyaan_forum->id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <textarea name="komen" id="komen" cols="30" rows="10" class="js-summernote form-control">Silahkan Isi Komentar Anda</textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-primary">post komentar</button>
                        </div>
                    </div>
                </form>                 
                @endauth
                @else
                <div class="block-content text-center">
                    <a href="/login" class="btn btn-primary">Silahkan Login untuk memberikan komentar</a>
                </div>
                <div class="block-content"></div>
                @endif                                                               
            </div>
        </div>
    </div>
</div>
@endsection