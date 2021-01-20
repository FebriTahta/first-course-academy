@extends('layouts.new_layouts.master')

@section('head')
<link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" id="css-main" href="{{ asset('assets/css/codebase.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/js/plugins/summernote/summernote-bs4.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="row">
        <div class="col-xl-3">
            <div class="block block-rounded bg-transparent">
                <div class="block-content">
                    @if (auth()->user()->role=='instruktur')
                    <button class="btn btn-sm btn-primary fa fa-plus hover-box" data-toggle="modal" data-target="#myBook"> Buku</button>
                    @endif                    
                </div>                
                <div class="block-content">
                    <h3 class="block-title text-uppercase">
                        <i class="fa fa-fw fa-book mr-5"></i> DAFTAR BUKU
                    </h3>
                    <table class="table table-borderless">
                        <tbody>
                            @foreach ($book as $key=>$item)
                            <tr>
                                <td style="width: 10%">{{ $key+1 }}</td>
                                <td><a href="{{ route('download', $item->book_file) }}">{{ $item->book_name }}</a></td>
                            </tr>
                            @endforeach                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="mb-50">
                <div class="overflow-hidden rounded mb-20" style="height: 300px;" >
                    <a class="img-link" href="be_pages_generic_story.html">
                        <img class="img-fluid" src="{{ asset('artikel_picture/'.$artikel->artikel_pict) }}" alt="">
                    </a>
                </div>
                <h3 class="h4 font-w700 text-uppercase mb-5">{{ $artikel->artikel_title }}</h3>
                <div class="text-muted mb-10">
                    <span class="mr-15">
                        <i class="fa fa-fw fa-calendar mr-5"></i>{{ $artikel->created_at }}
                    </span>
                    <a class="text-muted mr-15" href="be_pages_generic_profile.html">
                        <i class="fa fa-fw fa-user mr-5"></i>{{ $artikel->user->name }} ({{ $artikel->user->role }})
                    </a>
                    <a class="text-muted" href="javascript:void(0)">
                        <i class="fa fa-fw fa-tag mr-5"></i>Artikel
                    </a>
                </div>
                <p>{!! $artikel->artikel_text !!}</p>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="block block-transparent">
                <div class="block-header">
                    <h3 class="block-title text-uppercase">
                        <i class="fa fa-fw fa-university mr-5"></i> Kursus lain anda
                    </h3>
                </div>
                <div class="block-content block-content-full">
                    @if (auth()->user()->role=='siswa')
                        @foreach (auth()->user()->profile->kursus as $item)
                            <a class="btn btn-sm btn-alt-secondary mb-5" href="/my-course/{{ $item->slug }}">
                                <i class="fa fa-check text-muted mr-5"></i>{{ $item->mapel->mapel_name }} | {{ $item->kelas->kelas_name }}
                            </a>
                        @endforeach
                    @elseif(auth()->user()->role=='instruktur')
                        @foreach (auth()->user()->kursus as $item)
                            <a class="btn btn-sm btn-alt-secondary mb-5" href="/my-course/{{ $item->slug }}">
                                <i class="fa fa-check text-muted mr-5"></i>{{ $item->mapel->mapel_name }} | {{ $item->kelas->kelas_name }}
                            </a>
                        @endforeach
                    @else
                    
                    @endif
                </div>
            </div>
        </div>
    </div>    
</div>
<!--modal add book-->    
<div class="modal fade" id="myBook" tabindex="-1" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-info">
                    <h3 class="block-title">UPLOAD BUKU</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="{{ route('addBook') }}" method="POST" enctype="multipart/form-data">@csrf
                        <div class="form-group">                            
                            <input type="hidden" class="form-control" name="id">
                            <input type="hidden" class="form-control" name="artikel_id" value="{{ $artikel->id }}">
                            <input type="hidden" class="form-control" name="user_id" value="{{ auth()->user()->id }}">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="book_name" placeholder="JUDUL BUKU" required>
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control" name="book_file" placeholder="FILES BUKU" accept=".docx,.pdf" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"> UPLOAD</button>
                        </div>
                    </form>
                </div>
            </div>                
        </div>
    </div>
</div>
<!--end modal add book--> 
@endsection

@section('script')

@endsection