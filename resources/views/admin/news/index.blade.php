@extends('layouts.admin_layouts.master')

@section('content')
    <!-- Hero -->
<div class="bg-image bg-image-bottom" style="background-image: url({{ asset('assets/media/photos/photo34@2x.jpg') }});">
    <div class="bg-primary-dark-op">
        <div class="content content-top text-center overflow-hidden">
            <h5 class="h4 font-w400 text-white-op invisible" data-toggle="appear" data-class="animated fadeInUp">Welcome to your News page!</h5>
        </div>
    </div>
</div>
<!-- END Hero -->
<div class="content">
    <h2 class="content-heading">News | <small>tampilkan berita pada halaman utama</small></h2>
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
        <div class="col-xl-4">
            <div class="block">
                <div class="block-header block-header-default">

                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="block">
                <div class="block-header block-header-default">

                </div>

                <div class="block-content">
                    <form action="" method="POST">@csrf
                        <div class="form-group">                            
                            <input class="form-control" id="val-tittle" type="text" name="news_tittle" placeholder="judul berita" required>                            
                        </div>
                        <div class="form-group">                            
                            <textarea class="js-summernote" name="news_desc" id="val-desc" cols="30" rows="10" placeholder="deskripsi berita" required> Deskripsi Berita!</textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-outline-primary">post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection