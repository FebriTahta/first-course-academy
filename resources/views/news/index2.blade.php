@extends('layouts.new_layouts.master')
<link rel="stylesheet" id="css-main" href="{{ asset('assets/css/codebase.min.css') }}">
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-8 mb-100" style="max-width: 750px">
            <div class="overflow-hidden rounded mb-10 img-responsive" style="max-height: 350px">
                {{-- <a class="#img-link" href="#we">
                    <img class="img-fluid" src="{{ asset('news_picture/'.$news->news_pict) }}" alt="">
                </a> --}}
                <img class="img-fluid push" src="{{ asset('news_picture/'.$news->news_pict) }}" alt="">
            </div>
            <h3 class="h4 font-w700 text-uppercase mb-5">{{ $news->news_tittle }}</h3>
            <div class="text-muted mb-10">
                <span class="mr-2">
                    <i class="fa fa-fw fa-calendar mr-2"></i>{{ $news->created_at }}
                </span>
                <a class="text-muted mr-2" href="#{{ $news->user->name }}">
                    <i class="fa fa-fw fa-user mr-2"></i>{{ $news->user->name }} ({{ $news->user->role }})
                </a>
                <a class="text-muted" href="javascript:void(0)">
                    <i class="fa fa-fw fa-tag mr-2"></i>NEWS
                </a>
            </div>
            <div class=""style="max-width: 800px">
                <p>{!! $news->news_desc !!}</p>
            </div>
        </div>
        <div class="col-lg-3">
            <h4>INFO PENTING</h4><br>
            <p>Jangan lewatkan informasi menarik mengenai "Course Academy" yang rutin dikirimkan ke email anda dengan mendaftar dan menjadi anggota keluarga kami</p>
        </div>
    </div>    
</div>
@endsection