@extends('layouts.client_layouts.master')

@section('content')
<!-- Hero -->
<div class="bg-image bg-image-bottom" style="background-image: url({{ asset('assets/media/photos/photo34@2x.jpg') }});">
    <div class="bg-primary-dark-op">
        <div class="content content-top text-center overflow-hidden">
            <h5 class="h4 font-w400 text-white-op invisible" data-toggle="appear" data-class="animated fadeInUp">NEWS!!</h5>
        </div>
    </div>
</div>
<!-- END Hero -->

<div class="content">
    
        <h2 class="content-heading">NEWS <small> Berita yang perlu anda tahu!</small></h2>
        @if (Session::has('message'))
        <div class="alert alert-danger text-bold">{{ Session::get('message') }}</div>                
        @endif
        @if (Session::has('pesan-peringatan'))
                <div class="alert alert-warning text-bold">{{ Session::get('pesan-peringatan') }}</div>                
        @endif
        @if (Session::has('pesan-sukses'))
            <div class="alert alert-info text-bold">{{ Session::get('pesan-sukses') }}</div>
        @endif    

    <div class="row">       
        <div class="col-md-8">
            <div class="block">
                <div class="block-header block-header-default">
                    <div class="block-content text-center">
                        <h5>BERITA TERBARU</h5>
                    </div>                    
                </div>                
                <?php $i=1?>
                    @foreach ($news as $item)
                    <div class="block-content">
                        <div class="soal">
                            <p class="border-bottom border-top" >Oleh : {{ $item->user->name }} as {{ $item->user->role }}<label class="float-right">{{ $item->created_at }}</label></p>                            
                        </div>                        
                        <h1 class=""><u>{!! $item->news_tittle !!}</u></h1>
                    </div>
                    
                    <div class="block-content">
                        <p>{!! $item->news_desc !!}</p>
                    </div>
                    <?php $i++?>
                    <div class="block-content">{{ $news->links() }}</div>
                    @endforeach                
            </div>            
        </div>
        
        <div class="col-md-4">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <div class="block-content text-center">
                        <h5>KURSUS KAMI</h5>
                    </div>
                </div>
                <div class="block-content bg-transparent">
                    <!-- Modern on Background Image -->
                    @foreach ($course as $items)                                            
                    <div class="bg-image" style="background-image: url({{ 'kursus_picture/'.$items->kursus_pict }});">
                        <div class="block block-transparent">
                            <div class="block-content block-content-full bg-black-op ribbon ribbon-left ribbon-bottom ribbon-modern ribbon-primary">
                                <div class="ribbon-box text-uppercase">Instruktur : {{ $items->user->name }}</div>
                                <div class="text-center py-50">
                                    <h4 class="font-w700 text-white text-uppercase mb-0">{{ $items->mapel->mapel_name }} {{ $items->kelas->kelas_name }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!-- END Modern on Background Image -->
                </div>

                <div class="block-content text-center">
                    <p>Lihat lebih banyak kursus kami</p>
                    <a href="{{ route('allkursus') }}" type="button" class="btn btn-outline-primary btn-rounded">KURSUS</a>
                </div>

                <div class="block-content"></div>
            </div>
        </div>
        <div class="col-12">
            <div class="block bg-transparent">
                <div class="block-content text-center">
                    <p>UNTUK PENDAFTARAN MENJADI PESERTA DIDIK SILAHKAN HUBUNGI</p>
                    <p class="fa fa-phone"> &nbsp;&nbsp;&nbsp; 081-329-145-651</p>
                </div>
            </div>
        </div>                
    </div>
</div>
@endsection