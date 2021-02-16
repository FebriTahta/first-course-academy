@extends('layouts.new_layouts.master')
@section('head')
<link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" id="css-main" href="{{ asset('assets/css/codebase.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/js/plugins/summernote/summernote-bs4.css') }}">
@endsection
@section('content')
{{-- <div class="w3l-homeblock2 w3l-homeblock6 py-5">
    <div class="container-fluid px-sm-5 py-lg-5 py-md-4">
        <h3 class="section-title-left mb-4"> BUAT ARTIKEL BARU </h3>

    </div>
</div> --}}

<div class="content" style="">
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
    <div class="row">
        <div class="col-lg-9">
            <form action="{{ route('uploadArtikel') }}" method="POST" enctype="multipart/form-data">@csrf
                <div class="form-group">
                    <input type="hidden" class="form-control" name="kursus_id">
                    <input type="hidden" class="form-control" name="id">
                    <input type="hidden" class="form-control" name="kelas_id" id="kelas_id" value="{{ $kursus->kelas->id }}">
                    <input type="hidden" class="form-control" name="mapel_id" id="mapel_id" value="{{ $kursus->mapel->id }}">
                    <input type="hidden" class="form-control" name="user_id" value="{{ auth()->user()->id }}">
                </div>
                <div class="form-group">
                    <label for="">GAMBAR HEADER ARTIKEL</label>
                    <input type="file" class="form-control" name="artikel_pict" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="artikel_title" placeholder="JUDUL ARTIKEL" required>
                </div>
                <div class="form-group">
                    <textarea class="form-control js-summernote" name="artikel_text" id="artikel_text" cols="30" rows="10">TULIS ARTIKEL DISINI & GUNAKAN MODE FULL-SCREEN UNTUK LEBIH DETAIL</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"> UPLOAD</button>
                </div>
            </form>
        </div>
        <div class="col-lg-3">
            <div class="block block-transparent">
                <div class="block-header">
                    <h3 class="block-title text-uppercase">
                        <i class="fa fa-fw fa-university mr-5"></i> Kursus lain anda
                    </h3>
                </div>
                <div class="block-content block-content-full">
                    
                        @foreach (auth()->user()->kursus as $item)
                            <a class="btn btn-sm btn-alt-secondary mb-5" href="/my-course/{{ $item->slug }}">
                                <i class="fa fa-check text-muted mr-5"></i>{{ $item->mapel->mapel_name }} | {{ $item->kelas->kelas_name }}
                            </a>
                        @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection