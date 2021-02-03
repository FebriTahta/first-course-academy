@extends('layouts.new_layouts.master')
@section('head')
<link rel="stylesheet" id="css-main" href="{{ asset('assets/css/codebase.min.css') }}">
<link rel="stylesheet" id="css-main" href="{{ asset('assets/assets/css/fab.css') }}">
<link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('assets/js/plugins/summernote/summernote-bs4.css') }}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
@endsection
@section('content')

<div class="w3l-homeblock2 w3l-homeblock6 py-5">
    <div class="container-fluid px-sm-5 py-lg-5 py-md-4">
        <!-- block -->
            @if (Session::has('message'))
            <div class="alert alert-danger text-bold">{{ Session::get('message') }}</div>                
            @endif
            @if (Session::has('pesan-peringatan'))
                    <div class="alert alert-warning text-bold">{{ Session::get('pesan-peringatan') }}</div>                
            @endif
            @if (Session::has('pesan-sukses'))
                <div class="alert alert-info text-bold">{{ Session::get('pesan-sukses') }}</div>
            @endif
            <h3 class="section-title-left mb-4"> My Course</h3>
            <div class="left-right">
                <small id="waktu"></small>
                <small class="section-right" id="jam"></small>
            </div>
        <div class="row">
            <div class="col-lg-6 mb-50">
                <div class="bg-clr-white">
                    <div class="row">
                        <div class="col-sm-6 position-relative">
                            <a>
                                <img class="card-img-bottom d-block radius-image-full" src="{{ asset('kursus_picture/'.$data_kursus->kursus_pict) }}" style="min-height: 263px" alt="Card image cap">
                            </a>
                        </div>
                        <div class="col-sm-6 card-body blog-details align-self">                            
                            <span class="label-blue hover-box">
                                @if ($data_kursus->status=='aktif')
                                    <form action="{{ route('nonaktifkan') }}" method="POST">@csrf
                                        <input type="hidden" name="id" value="{{ $data_kursus->id }}">
                                        <input type="hidden" name="status" value="nonaktif">
                                        <button class="btn btn-sm text-uppercase text-primary" @if (auth()->user()->role=='siswa') disabled @endif type="submit">{{ $data_kursus->status }}</button>
                                    </form>                                        
                                @else
                                    <form action="{{ route('aktifkan') }}" method="POST">@csrf
                                        <input type="hidden" name="id" value="{{ $data_kursus->id }}">
                                        <input type="hidden" name="status" value="aktif">
                                        <button class="btn btn-sm text-uppercase text-danger" @if (auth()->user()->role=='siswa') disabled @endif type="submit">{{ $data_kursus->status }}</button>
                                    </form>
                                @endif
                            </span>
                            <a href="{{ route('myCourse',$data_kursus->slug) }}" class="blog-desc">{{ $data_kursus->mapel->mapel_name }} | {{ $data_kursus->kelas->kelas_name }}
                            </a>
                            {{-- <p>Lorem ipsum dolor sit amet consectetur ipsum adipisicing elit. Quis
                                vitae sit.</p> --}}
                            <div class="author align-items-center mt-3">
                                <img 
                                    @if ($data_kursus->user->profile->photo==null)
                                        src="{{ asset('assets/assets/images/a1.jpg') }}"
                                    @else
                                    src="{{ asset('photo/'.$data_kursus->user->profile->photo) }}"
                                    @endif alt="" class="img-fluid rounded-circle">
                                <ul class="blog-meta">
                                    <li>
                                        <a >{{ $data_kursus->user->name }}</a> 
                                    </li>
                                    <li class="meta-item blog-lesson">
                                        <span class="meta-value"> {{ $data_kursus->user->role }} </span>. <span class="meta-value ml-2"><span class="fa fa-check"></span></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 trending mt-lg-0 mt-5 mb-20" style="margin-top: 15px">
                <div class="topics">                    
                    <a class="topics-list hover-box" onclick="videoscroll()">
                        <div class="list1">
                            <span class="fa fa-play"></span>
                            <h4><u>{{ $data_kursus->video->count() }}</u> Video Kursus</h4>
                        </div>
                    </a>
                    <a class="topics-list mt-3 hover-box" onclick="artikelscroll()">
                        <div class="list1" >
                            <span class="fa fa-book"></span>
                            <h4><u>{{ $data_kursus->artikel->count() }}</u> Artikel & Buku Kursus</h4>
                        </div>
                    </a>
                    <a  class="topics-list mt-3 hover-box" onclick="kuisscroll()">
                        <div class="list1">
                            <span class="fa fa-pencil-square"></span>
                            <h4><u>{{ $data_kursus->kuis->count() }}</u> Latihan Soal</h4>
                        </div>
                    </a>
                    <a href="{{ route('detailsiswa',$data_kursus->slug) }}"
                        class="topics-list mt-3 hover-box">
                        <div class="list1">
                            <span class="fa fa-pie-chart"></span>
                            <h4><u>{{ $data_kursus->profile->count() }}</u> Peserta Didik</h4>
                        </div>
                    </a>
                </div>                            
            </div>
            <div class="col-lg-12 trending mt-lg-0 mt-5 py-lg-5" style="margin-top: 15px">
                <div class="mt-4 left-right bg-clr-white p-3">
                    <h5 class="section-title-left align-self pl-2 mb-sm-0 mb-3">Forum {{ $data_kursus->mapel->mapel_name }} | {{ $data_kursus->kelas->kelas_name }} </h5>
                    <a class="btn btn-style btn-primary" href="/forums-daftar-pertanyaan/premium/{{ $data_kursus->kelas->slug }}/{{ $data_kursus->mapel->slug }}">KUNJUNGI FORUM</a>
                </div>   
            </div>
        </div>
    </div>
</div>

<!--filter-->
<div class="w3l-homeblock2 w3l-homeblock6 " id="daftarvideo">
    <div class="container-fluid px-sm-5 py-lg-5 py-md-4 mb-200">
        <div class="js-filter" data-speed="400">
            <!--filter-->
            <div class="p-10 bg-white">
                <div class="block-header border-bottom push">                            
                    <div class="col-3 col-xl-3 nav nav-pills">
                        <div class="nav-item text-center" style="width: 100%">                        
                            <a class="nav-link active" href="#" data-category-link="videos">
                            <i class="fa fa-fw fa-info-circle mr-5"></i>video</a>
                        </div>                    
                    </div>
                    <div class="col-3 col-xl-3 nav nav-pills">
                        <div class="nav-item text-center" style="width: 100%">
                            <a class="nav-link" href="#" data-category-link="latihansoal">
                            <i class="fa fa-fw fa-edit mr-5"></i>kuis</a>
                        </div>                    
                    </div>
                    <div class="col-3 col-xl-3 nav nav-pills">
                        <div class="nav-item text-center" style="width: 100%">
                            <a class="nav-link" href="#" data-category-link="artikel">
                            <i class="fa fa-fw fa-book mr-5"></i>book</a>
                        </div>                    
                    </div>                                                                               
                </div>                                              
            </div>
            <!--video-->
            <div class="" data-category="videos">
                @if (auth()->user()->role=='instruktur')
                <h5 class="mb-4" style="margin-top: 20px"> <span class="fa fa-plus label-blue btn hover-box" data-toggle="modal" data-target="#addvideo"></span></h5>    
                @else
                    <h5 class="mb-4" style="margin-top: 20px"> <span class="label-blue text-uppercase"> video</span></h5>
                @endif        
                    <hr>        
                <div class="row">
                    @if (count($data_kursus->video)==null)
                        <div class="col-12 col-xl-12 text-center" style="max-height: 100px">
                            <p class="text-danger">Belum Ada Video Kursus Yang Tersedia</p>
                        </div>
                    @else
                        @foreach ($data_kursus->video as $key=>$item)
                            <div class="col-12 col-xl-4 ribbon ribbon-top ribbon-left ribbon-modern ribbon-danger" style="max-height: 100px" >
                                @if (auth()->user()->role=='instruktur')
                                    @if (auth()->user()->id==$data_kursus->user->id)
                                    <a class="ribbon-box hover-box text-white" data-toggle="modal" data-target="#modal-fromleft-remove-video" data-id="{{ $item->id }}" data-kursus_id="{{ $data_kursus->id }}">
                                        <i class="fa fa-trash"> {{ $key+1 }}</i>
                                    </a>
                                    @endif
                                @endif
                                <a class="block block-rounded block-link-pop text-right bg-primary  video-btn view-video" data-toggle="modal" data-video_link="{{ $item->video_link }}" data-target="#myModal" type="button">
                                    <div class="block-content block-content-full clearfix border-black-op-b border-3x">
                                        <div class="float-left mt-10 d-sm-block">
                                            <i class="fa fa-play fa-3x text-white"></i>
                                        </div>
                                        <div class="font-size-sm font-w600 text-white-op text-uppercase">{{ $item->video_name }}</div>                        
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endif                        
                </div>
            </div>
            <!--latihan soal-->
            <div class="" data-category="latihansoal" style="display: none">
                @if (auth()->user()->role=='instruktur')
                <h5 class="mb-4" style="margin-top: 20px"> <span class="fa fa-plus label-blue btn hover-box" data-toggle="modal" data-target="#addkuiss"></span></h5>    
                @else
                    <h5 class="mb-4" style="margin-top: 20px"> <span class="label-blue text-uppercase"> latihan soal</span></h5>
                @endif
                <hr>
                <div class="col-12">
                    @if (count($data_kursus->kuis)==null)
                        <div class="col-12 col-xl-12 text-center" style="max-height: 100px">
                            <p class="text-danger">Belum Ada Latihan SOal Yang Tersedia</p>
                        </div>
                    @else
                        <div class="bg-clr-white">
                            <table class="table table-borderless table-vcenter">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">#</th>
                                        <th style="width: 42%">Kuis</th>
                                        @if (auth()->user()->role=='siswa')
                                            <th class="text-center float-right">Status </th>
                                        @endif                                
                                        {{-- <th class="float-right"></th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_kursus->kuis as $key=>$item)
                                    <tr>
                                        <td style="width: 5%">{{ $key+1 }}</td>
                                        <td style="width: 42%">
                                            @if (auth()->user()->role=='instruktur')
                                                <a href="/detail-latihan-soal/{{ $item->slug }}/{{ $data_kursus->slug }}">({{ $item->pertanyaan->count() }} soal) {{ $item->kuis_name }}</a>
                                            @elseif(auth()->user()->role=='admin')
                                                <a href="/detail-latihan-soal/{{ $item->slug }}/{{ $data_kursus->slug }}">({{ $item->pertanyaan->count() }} soal) {{ $item->kuis_name }}</a>
                                            @else
                                                @if ($item->pertanyaan->count()!==0)
                                                    <a href="/kuis-form-latihan-soal/{{ $item->slug }}/{{ $data_kursus->slug }}" class="text-primary">({{ $item->pertanyaan->count() }} soal) {{ $item->kuis_name }}</a>
                                                @else
                                                    <a href="#{{ $item->kuis_name }}" class="text-danger">({{ $item->pertanyaan->count() }} soal) {{ $item->kuis_name }}</a>
                                                @endif
                                            @endif                                    
                                        </td>
                                        @if (auth()->user()->role=='siswa')
                                            <td class="text-center " style="width: 15%">
                                                <?php $sudah_dikerjakan = App\Result::where('profile_id', auth()->user()->id)->where('kuis_id', $item->id)->first()?>
                                                @if ($sudah_dikerjakan==null)
                                                    <p class="badge badge-danger text-uppercase float-right">belum</p>&nbsp;&nbsp;&nbsp;
                                                @else
                                                    <p class="badge badge-success text-uppercase float-right btn text-white hover-box" data-toggle="modal" data-target="#modalNilai" data-kuis_id="{{ $item->id }}" data-profile_id="{{ auth()->user()->id }}" id="btnNilai">SELESAI</p>&nbsp;&nbsp;&nbsp;
                                                @endif
                                            </td>
                                        @endif
        
                                        @if (auth()->user()->role=='instruktur')
                                            @if (auth()->user()->id==$data_kursus->user->id)
                                                @if (auth()->user()->id !== $item->user_id)
                                                    <td class="float-right">
                                                        <a href="#" data-id="{{ $item->id }}" data-kursus_id="{{ $data_kursus->id }}" data-toggle="modal" data-target="#hapuskuis" class="fa fa-trash text-danger"> hapus</a>
                                                    </td>    
                                                @else
                                                    <td class="float-right">
                                                        {{-- <a href="/buat-soal/{{ $item->id }}/{{ $item->slug }}"><i class="fa fa-plus"></i> soal</a> --}}
                                                        <a href="#" data-id="{{ $item->id }}" data-kursus_id="{{ $data_kursus->id }}" data-toggle="modal" data-target="#hapuskuis" class="fa fa-trash text-danger"> hapus</a>
                                                    </td>
                                                @endif
                                            @endif                                 
                                        @else                                
                                        
                                        @endif
                                    </tr>
                                    @endforeach                    
                                </tbody>
                            </table>
                        </div>
                    @endif                        
                </div>
            </div>
            <!--artikel-->
            <div class="" data-category="artikel" style="display: none">
                @if (auth()->user()->role=='instruktur')
                    <h5 class="mb-4" style="margin-top: 20px"> <span class="fa fa-plus label-blue btn hover-box" data-toggle="modal" data-target="#addartikels"></span></h5>    
                @else
                    <h5 class="mb-4" style="margin-top: 20px"> <span class="label-blue text-uppercase"> artikel</span></h5>
                @endif
                    <hr>        
                <div class="row">
                    @if (count($data_kursus->artikel)==null)
                        <div class="col-12 col-xl-12 text-center" style="max-height: 100px">
                            <p class="text-danger">Belum Ada Artikel & Buku Yang Tersedia</p>                            
                        </div>
                    @else
                        @foreach ($data_kursus->artikel as $key=>$item)
                            <div class="col-12 col-xl-6 text-left ribbon ribbon-bottom ribbon-right ribbon-modern ribbon-danger">
                                @if (auth()->user()->role=='instruktur')
                                    @if (auth()->user()->id==$data_kursus->user->id)
                                        <a class="ribbon-box hover-box text-white" data-toggle="modal" data-target="#modal-fromleft-remove-artikel" data-id="{{ $item->id }}" data-kursus_id="{{ $data_kursus->id }}">
                                            <i class="fa fa-trash"> 1</i>
                                        </a>
                                    @endif
                                @endif
                                <a class="block block-rounded block-link-shadow" href="/artikel/{{ $item->id }}/{{ $item->slug }}" style="min-height: 80px">
                                    <div class="block-content block-content-full">
                                        <p class="font-size-sm text-muted float-sm-right mb-5"><em></em></p>
                                        <h4 class="font-size-default text-primary mb-0">
                                            <i class="fa fa-newspaper-o text-muted mr-5"></i> {{ $item->artikel_title }}
                                        </h4>
                                    </div>
                                </a>
                            </div>
                        @endforeach 
                    @endif                       
                </div>
            </div>
        </div>
        <!-- block -->
    </div>        
</div>
<!--floating button-->




        @if (auth()->user()->role=='instruktur')
            @if (auth()->user()->id == $data_kursus->user->id)
            <div class="fab-container">
                <div class="fab fab-icon-holder">
                    <i class="fa fa-question"></i>
                </div>
                <ul class="fab-options">
                    <li>
                        <span class="fab-label">Manage Video Kursus</span>
                        <a class="fab-icon-holder" href="{{ route('myvidInstruktur',$data_kursus->slug) }}">                
                            <i class="fa fa-plus"> <i class="fa fa-play"></i></i>
                        </a>
                    </li>
                    <li>
                        <span class="fab-label">Manage Artikel</span>
                        <a class="fab-icon-holder" href="{{ route('myArtikel',$data_kursus->slug) }}">
                            <i class="fas fa fa-plus"> <i class="fas fa fa-book"></i></i>
                        </a>
                    </li>        
                    <li>
                        <span class="fab-label">Manage Latihan Soal</span>
                        <a class="fab-icon-holder" href="{{ route('mykuisInstruktur',$data_kursus->slug) }}">                
                            <i class="fa fa-plus"> <i class="fa fa-pencil"></i></i>
                        </a>
                    </li>
                </ul>
            </div>
            @endif

            @else
            <div class="fab-container">
                <div class="fab fab-icon-holder">
                    <i class="fa fa-question"></i>
                </div>
                <ul class="fab-options">
                    <li>
                        <span class="fab-label">MATERI</span>
                        <div class="fab-icon-holder" onclick="videoscroll()">
                            <i class="fas fa-video"></i>
                        </div>
                    </li>
                </ul>
            </div>
        @endif                


<!--modal play video--> 
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-info">
                    <h3 class="block-title"></h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <iframe id="playvideo" src="" frameborder="0" allowfullscreen width="100%" height="380" position="relative"></iframe>
                </div>
            </div>                
        </div>
    </div>
</div>
<!--end modal play video-->

<!--modal view nilai--> 
<div class="modal fade" id="modalNilai" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-info">
                    <h3 class="block-title"></h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="block-content">
                        <div class="form-group">
                            <table class="table table-hover" id="daftarnilai">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NILAI</th>
                                        <th>OPSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- nilai retrieve dari ajax --}}
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <p id="nilai">LALALA </p>
                        </div>
                    </div>
                </div>
            </div>                
        </div>
    </div>
</div>
<!--end modal view nilai-->

<!--modal add video--> 
<div class="modal fade" id="addvideo" tabindex="-1" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-info">
                    <h3 class="block-title">DAFTAR VIDEO</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="{{ route('storecopy') }}" method="post"> @csrf
                        <input type="hidden" name="kursus_id" value="{{ $data_kursus->id }}">
                        <table class="table table-striped" id="addvideos">
                            <thead>
                                <tr>
                                    <th style="width: 5%">#</th>
                                    <th>video</th>
                                    <th>owner</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($filter_video as $key=> $item)
                                <tr>
                                    <td style="width: 5%">{{ $key+1 }}</td>
                                    <td><a href="#" class="text-primary view-video" data-dismiss="modal" data-toggle="modal" data-video_link="{{ $item->video_link }}" data-target="#myModal">{{ $item->video_name }}</a></td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>
                                        <label class="css-control css-control-info css-checkbox">
                                            <input type="checkbox" class="css-control-input" name="video_id[]" value="{{ $item->id }}">
                                            <span class="css-control-indicator"></span>
                                        </label> 
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button class="btn btn-sm btn-primary" type="submit">sumbit</button>
                    </form>
                </div>
            </div>                
        </div>
    </div>
</div>
<!--end modal add video-->

<!--modal hapus video-->
<div class="modal fade" id="modal-fromleft-remove-video" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('removeVid') }}" method="POST" enctype="multipart/form-data">@csrf                    
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-danger">
                        <h3 class="block-title">REMOVE VIDEO</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content">                            
                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                                <p class="text-uppercase">video tersebut akan dihapus dari kursus anda</p>
                                <input type="hidden" id="kursus_id" name="kursus_id">
                                <input type="hidden" id="id" name="id">
                            </div>                                                      
                        </div>
                        <div class="col-sm-4 form-group">
                            <button class="btn btn-danger" type="submit">YES</button>
                        </div>
                    </div>                                                               
                </div>                        
            </form>                   
        </div>            
    </div>
</div>
<!--end modal hapus video-->

<!--modal add kuis--> 
<div class="modal fade" id="addkuiss" tabindex="-1" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-info">
                    <h3 class="block-title">DAFTAR KUIS</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="{{ route('salinKuis') }}" method="post"> @csrf
                        <input type="hidden" name="kursus_id" value="{{ $data_kursus->id }}">
                        <table class="table table-striped" id="addkuis">
                            <thead>
                                <tr>
                                    <th style="width: 5%">#</th>
                                    <th>kuis</th>
                                    <th>owner</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($filter_kuis as $key=> $item)
                                <tr>
                                    @if ($item->pertanyaan->count()==0)
                                        
                                    @else
                                    <td style="width: 5%">{{ $key+1 }}</td>
                                    <td><a href="#" class="text-primary view-video">({{ $item->pertanyaan->count() }} soal) {{ $item->kuis_name }}</a></td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>
                                        <label class="css-control css-control-info css-checkbox">
                                            <input type="checkbox" class="css-control-input" name="kuis_id[]" value="{{ $item->id }}">
                                            <span class="css-control-indicator"></span>
                                        </label> 
                                    </td>
                                    @endif
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button class="btn btn-sm btn-primary" type="submit">sumbit</button>
                    </form>
                </div>
            </div>                
        </div>
    </div>
</div>
<!--end modal add kuis-->

<!--modal hapus Kuis-->
<div class="modal fade" id="hapuskuis" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('removeKuis') }}" method="POST" enctype="multipart/form-data">@csrf                    
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-danger">
                        <h3 class="block-title text-uppercase">remove kuis</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content">                            
                        <div class="form-group">
                            <div class="col-sm-12">
                                <p class="text-uppercase">kuis tersebut akan dihapus dari kursus anda</p>
                                <input type="hidden" id="kursus_id" name="kursus_id">
                                <input type="hidden" id="id" name="id">
                            </div>                                                      
                        </div>
                        <div class="col-sm-4 form-group">
                            <button class="btn btn-danger" type="submit">remove</button>
                        </div>
                    </div>                                                               
                </div>                        
            </form>                   
        </div>            
    </div>
</div>
<!--end modal hapus kuis-->

<!--modal add artikel--> 
<div class="modal fade" id="addartikels" tabindex="-1" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-info">
                    <h3 class="block-title">DAFTAR ARTIKEL</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="{{ route('salinArtikel') }}" method="post"> @csrf
                        <input type="hidden" name="kursus_id" value="{{ $data_kursus->id }}">
                        <table class="table table-striped" id="addartikel">
                            <thead>
                                <tr>
                                    <th style="width: 5%">#</th>
                                    <th>artikel</th>
                                    <th>owner</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($filter_artikel as $key=> $item)
                                <tr>
                                    <td style="width: 5%">{{ $key+1 }}</td>
                                    <td><a href="/artikel/{{ $item->id }}/{{ $item->slug }}" class="text-primary">{{ $item->artikel_title }}</a></td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>
                                        <label class="css-control css-control-info css-checkbox">
                                            <input type="checkbox" class="css-control-input" name="artikel_id[]" value="{{ $item->id }}">
                                            <span class="css-control-indicator"></span>
                                        </label> 
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button class="btn btn-sm btn-primary" type="submit">sumbit</button>
                    </form>
                </div>
            </div>                
        </div>
    </div>
</div>
<!--end modal add artikel-->

<!--modal hapus Kuis-->
<div class="modal fade" id="modal-fromleft-remove-artikel" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('removeArtikel') }}" method="POST" enctype="multipart/form-data">@csrf                    
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-danger">
                        <h3 class="block-title text-uppercase">remove artikel</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content">                            
                        <div class="form-group">
                            <div class="col-sm-12">
                                <p class="text-uppercase">Artikel tersebut akan dihapus dari kursus anda</p>
                                <input type="hidden" id="kursus_id" name="kursus_id">
                                <input type="hidden" id="id" name="id">
                            </div>                                                      
                        </div>
                        <div class="col-sm-4 form-group">
                            <button class="btn btn-danger" type="submit">remove</button>
                        </div>
                    </div>                                                               
                </div>                        
            </form>                   
        </div>            
    </div>
</div>
<!--end modal hapus kuis-->


@endsection

@section('script')
<script>    
    var table;
    $(document).ready(function(){    
        table= $('#addvideos').DataTable({});        
    });
    var table2;
    $(document).ready(function(){    
        table2= $('#addkuis').DataTable({});        
    });
    var table3;
    $(document).ready(function(){    
        table3= $('#addartikel').DataTable({});        
    });
    var table4;
    $(document).ready(function(){    
        table4= $('#daftarnilai').DataTable({});        
    });
</script>

<script>
    function videoscroll()
    {
        var skrollke = document.getElementById("daftarvideo");
        skrollke.scrollIntoView();
    }
    function artikelscroll()
    {
        var skrollke = document.getElementById("daftarartikel");
        skrollke.scrollIntoView();
    }
    function kuisscroll()
    {
        var skrollke = document.getElementById("daftarakuis");
        skrollke.scrollIntoView();
    }        
</script>

<script>
    $('#modalNilai').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget)
        var kuis_id = button.data('kuis_id')
        var profile_id = button.data('profile_id')
        console.log(kuis_id);
        //gajadi dipake
        $.ajax({  //create an ajax request to display.php
          type: "GET",
          url: "http://127.0.0.1:8000/get-nilai/"+kuis_id+"/"+profile_id,       
          success: function (response) {
            for(var i=0; i<len; i++){
            var nilai = response['data'][i].nilai;
            $("#nilai").html(response['data'][i].nilai);
            }
            var len = 0;
            $('#daftarnilai tbody').empty(); // Empty <tbody>
            if(response['data'] != null){
            len = response['data'].length;
            }
            if(len > 0){
            for(var i=0; i<len; i++){
            var id = response['data'][i].id;
            var nilai = response['data'][i].nilai;
            var tr_str = "<tr>" +
            "<td align='center'>" + (i+1) + "</td>" +
            "<td align='center'>" + nilai + "</td>" +
            "</tr>";
            $("#daftarnilai tbody").append(tr_str);
            }
            }else if(response['data'] != null){
            var tr_str = "<tr>" +
            "<td align='center'>1</td>" +
            "<td align='center'>" + response['data'].nilai + "</td>" + 
            "</tr>";
            $("#daftarnilai tbody").append(tr_str);
            }else{
            var tr_str = "<tr>" +
            "<td align='center' colspan='4'>No record found.</td>" +
            "</tr>";
            $("#daftarnilai tbody").append(tr_str);
            }
            
          }
        })
    })
</script>

<script>
    var data = $("#playvideo").attr('src');
    //open modal and play video
    $(document).on('click','.view-video',function(){
        console.log($(this).attr('data-video_link'));
        $('#myModal').modal();
        $("#playvideo").attr('src', $(this).attr('data-video_link'));                  
        // $('.block-title').text('Menonton');
    })      
    //close modal and stop play video
    $("#myModal").on('hide.bs.modal', function(){
            $("#playvideo").attr('src', '');
        });            
</script>

<script>
    $('#modal-fromleft-remove-video').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var kursus_id = button.data('kursus_id')
        var modal = $(this)
        console.log(id);
        modal.find('.block-content #id').val(id);
        modal.find('.block-content #kursus_id').val(kursus_id);
    })
</script>
<script>
    $('#hapuskuis').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var kursus_id = button.data('kursus_id')
        var modal = $(this)        
        modal.find('.block-content #id').val(id);
        modal.find('.block-content #kursus_id').val(kursus_id);
    })
</script>
<script>
    $('#modal-fromleft-remove-artikel').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var kursus_id = button.data('kursus_id')
        var modal = $(this)        
        modal.find('.block-content #id').val(id);
        modal.find('.block-content #kursus_id').val(kursus_id);
    })
</script>
{{-- video in 1 iframe note in modal (tidak dipakai sudah direvisi dengan yang bawah) --}}
{{-- <script>        
    var data = $("#playvideo").attr('src');
    // play video
    $(document).on('click','.view-video',function(){
        console.log($(this).attr('data-video_link'));            
        $("#playvideo").attr('src', $(this).attr('data-video_link'));
    });                                                           
</script> --}}
@endsection