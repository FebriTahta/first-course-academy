@extends('layouts.admin_layouts.master')
    
@section('head')
    
@endsection

@section('content')
    <!-- Hero -->
<div class="bg-image bg-image-bottom" style="background-image: url({{ asset('assets/media/photos/photo34@2x.jpg') }});">
    <div class="bg-primary-dark-op">
        <div class="content content-top text-center overflow-hidden">
            <div class="pb-10">
                <h1 class="font-w700 text-white mb-10 invisible" data-toggle="appear" data-class="animated fadeInUp">BUAT ARTIKEL BARU</h1>
                <h2 class="h4 font-w400 text-white-op invisible" data-toggle="appear" data-class="animated fadeInUp"></h2>
            </div>
        </div>
    </div>
</div>
<!-- END Hero -->

<div class="content">
    <div class="col-12">
        <div class="content-heading"><label>DAFTAR ARTIKEL</label></div>
        @if (Session::has('pesan'))
                    <div class="alert alert-info text-bold">{{ Session::get('pesan') }}</div>
                @endif
                @if (Session::has('pesan-peringatan'))
                    <div class="alert alert-warning text-bold">{{ Session::get('pesan-peringatan') }}</div>
                @endif
                @if (Session::has('pesan-bahaya'))
                    <div class="alert alert-danger text-bold">{{ Session::get('pesan-bahaya') }}</div>
                @endif
                @if (Session::has('pesan-sukses'))
                    <div class="alert alert-success text-bold">{{ Session::get('pesan-sukses') }}</div>
                @endif    
        <form action="{{ route('uploadArtikel') }}" method="POST" enctype="multipart/form-data">@csrf
            <div class="row">
                <input type="hidden" name="user_id" id="" value="{{ auth()->user()->id }}">
                <div class="form-group col-6">
                    <select name="mapel_id" id="" class="form-control" required>
                        @foreach ($mapel as $key=>$item)
                            <option value="{{ $item->id }}">{{ $item->mapel_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-6">
                    <select name="kelas_id" id="" class="form-control" required>
                        @foreach ($kelas as$key=>$item)
                            <option value="{{ $item->id }}">{{ $item->kelas_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-6">
                    <input type="file" name="artikel_pict" class="form-control" placeholder="gambar" required>
                </div>
                <div class="form-group col-6">
                    <input type="text" name="artikel_title" class="form-control" placeholder="judul" required>
                </div>
                <div class="form-group col-12">
                    <textarea class="js-summernote" name="artikel_text" id="" cols="30" rows="10">KONTEN ARTIKEL</textarea>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary form-control" type="submit"> UPLOAD</button>
            </div>
        </form>
</div>
@endsection