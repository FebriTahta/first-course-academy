@extends('layouts.admin_layouts.master')

@section('content')
<!-- Hero -->
<div class="bg-image bg-image-bottom" style="background-image: url({{ asset('assets/media/photos/photo34@2x.jpg') }});">
    <div class="bg-primary-dark-op">
        <div class="content content-top text-center overflow-hidden">
            <h5 class="h4 font-w400 text-white-op invisible" data-toggle="appear" data-class="animated fadeInUp">Welcome to your Kursus management page!</h5>
        </div>
    </div>
</div>
<!-- END Hero -->

<div class="content">
    <div class="col-xl-12">
        <h2 class="content-heading">KURSUS <small>Instruktur :  ({{ $data_kursus->user->name }})</small></h2>
        @if (Session::has('message'))
        <div class="alert alert-danger text-bold">{{ Session::get('message') }}</div>                
        @endif
        @if (Session::has('pesan-peringatan'))
                <div class="alert alert-warning text-bold">{{ Session::get('pesan-peringatan') }}</div>                
        @endif
        @if (Session::has('pesan-sukses'))
            <div class="alert alert-info text-bold">{{ Session::get('pesan-sukses') }}</div>
        @endif
    </div>
<div class="row">
    <div class="col-xl-6">
        
        <!--video-->
        <div class="block shadow block-rounded border-bottom">
            @if (count($data_kursus->video) === 0)
            <div class="block-content bg-secondary text-white row">
                <h5 class="text-center text-white col-12">BELUM ADA MATERI VIDEO KURSUS</h5>
                <div class="col-4 col-xl-4"><a type="button" class="mb-20 salin" data-toggle="modal" data-target="#modal-popout" data-total_video="{{ $total_video }}"><i class="si si-docs"></i> salin video</a></div>
                <div class="col-4 col-xl-4 text-center"><a type="button" class="mb-20 text-white" data-toggle="modal" data-target="#modal-popout-videoku"><i class="si si-docs"></i> video saya</a></div>
                <div class="col-4 col-xl-4"><a type="button" class="mb-20 salin float-right" data-toggle="modal" data-target="#modal-fromleft"><i class="fa fa-plus"></i> buat video</a></div>                                
            </div>
            <iframe id="playvideo" src="" frameborder="0" allowfullscreen width="100%" height="380" position="absolute"></iframe>
            @else
                
            <div class="block-content bg-secondary" style="height: 62px">
                <div class="float-left text-left">
                    <a type="button" class="mb-20 text-white" data-toggle="modal" data-target="#modal-popout" data-total_video="{{ $total_video }}"><i class="fa fa-plus"></i> ADD VIDEO</a>
                </div>
                {{-- <div class="col-4 col-xl-4 text-center">
                    <a type="button" class="mb-20 text-white" data-toggle="modal" data-target="#modal-popout-videoku"><i class="si si-docs"></i> video saya</a>
                </div> --}}
                <div class="float-right">
                    <a type="button" class="mb-20 float-right text-white" data-toggle="modal" data-target="#modal-fromleft"><i class="fa fa-plus"></i> CREATE VIDEO</a>
                </div>                                                
            </div>            
            <iframe id="playvideo" src="" frameborder="0" allowfullscreen width="100%" height="380" position="absolute"></iframe>
            @endif                            
           
        </div>
        <!--end video-->

        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">konten</h3>
                <div class="block-options">
                    <!-- To toggle block's content, just add the following properties to your button: data-toggle="block-option" data-action="content_toggle" -->
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                </div>
            </div>
            
            <!--daftar konten-->
            <div class="block-content">
                <div class="js-filter" data-speed="400">
                    
                    <!--navbar konten-->
                    <div class="p-10 bg-white">
                        <div class="block-header border-bottom push">                            
                            <div class="col-3 col-xl-3 nav nav-pills">
                                <div class="nav-item text-center" style="width: 100%">                        
                                    <a class="nav-link active" href="#" data-category-link="info">
                                    <i class="fa fa-fw fa-info-circle mr-5"></i> info</a>
                                </div>                    
                            </div>
                            <div class="col-3 col-xl-3 nav nav-pills">
                                <div class="nav-item text-center" style="width: 100%">
                                    <a class="nav-link" href="#" data-category-link="kuis">
                                    <i class="fa fa-fw fa-edit mr-5"></i> kuis</a>
                                </div>                    
                            </div>
                            <div class="col-3 col-xl-3 nav nav-pills">
                                <div class="nav-item text-center" style="width: 100%">
                                    <a class="nav-link" href="#" data-category-link="book">
                                    <i class="fa fa-fw fa-book mr-5"></i> artikel</a>
                                </div>                    
                            </div>                                                                               
                        </div>                                              
                    </div>                    
                    <!--end navbar konten-->

                    <!--konten button-->
                    <div class="col-md-4 col-xl-12 row" data-category="kuis" style="display: none">
                        <div class="">
                            {{-- <h5 class="mb-4" style="margin-top: 20px"> <a href="#" data-target="#modal-fromright-salin-kuis" class="label-blue text-uppercase fa fa-plus" data-toggle="modal" > KUIS</a></h5> --}}
                            {{-- <button class="btn fa fa-copy" data-toggle="modal" data-target="#modal-fromright-salin-kuis">&nbsp; add kuis</button> --}}
                        </div>
                        {{-- <div class="col-4 col-xl-4">
                            <button class="btn fa fa-plus" data-toggle="modal" data-target="#modal-fromright">&nbsp; add new kuis </button>
                        </div> --}}
                        {{-- <div class="col-4 col-xl-4 text-center">
                            <button class="btn fa fa-copy float-right" data-toggle="modal" data-target="#modal-fromright-kuisku">&nbsp; </button>
                        </div>                         --}}
                    </div>
                    <div class="col-md-4 col-xl-12 row" data-category="book" style="display: none">
                        {{-- <button class="btn btn-sm fa fa-copy text-center" data-toggle="modal" data-target="#modal-fromright-salin-artikel">&nbsp; add artikel</button> --}}
                        {{-- <div class="col-4 col-xl-4"><button class="btn fa fa-plus" data-toggle="modal" data-target="#modal-fromright_book">&nbsp; upload buku</button></div>
                        <div class="col-4 col-xl-4 text-center"><button class="btn fa fa-copy " data-toggle="modal" data-target="#modal-fromright-bukuku">&nbsp; buku saya </button></div>
                        <div class="col-4 col-xl-4"><button class="btn fa fa-copy float-right" data-toggle="modal" data-target="#modal-fromright-salin-book">&nbsp; salin buku </button></div>                         --}}
                    </div>
                    <!--end konten button-->

                    <!--info-->
                    <div class="col-md-4 col-xl-12 mb-10" data-category="info">
                        <div class="block">
                            <div class="block-content">
                                {{-- <div class="col-md-3">
                                    <button type="button" class="js-swal-confirm btn btn-alt-secondary">
                                        <i class="fa fa-check"></i> Confirm
                                    </button>
                                </div> --}}
                                <p>kursus ini dikelolah oleh (instruktur) : <u>{{ $data_instruktur_kursus->name }}</u> </p>
                                <p>dengan peserta didik yang tergabung sebanyak : {{ $data_kursus->profile->count() }} anak</p>
                                <div class="row">
                                    <div class="col-4 col-sm-4">
                                        <p>Video course : {{ $data_kursus->video->count() }}</p>
                                    </div>
                                    <div class="col-4 col-sm-4">
                                        <p>Latihan Soal : {{ $data_kursus->kuis->count() }}</p>
                                    </div>
                                    <div class="col-4 col-sm-4">
                                        <p>artikel course : {{ $data_kursus->artikel->count() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--info-->

                    <!--kuis-->
                    <div class="col-md-4 col-xl-12 mb-10" data-category="kuis" style="display: none">                        
                        <table class="table table-borderless">                            
                            <tbody>
                                @foreach ($data_kursus->kuis as $kuis_item)
                                <tr>
                                    <td class="border-bottom" style="width: 35%"><i class="fa fa-fw fa-edit"></i>&nbsp;{{ $kuis_item->pertanyaan->count() }} soal &nbsp;&nbsp; <a href="{{ route('detailsSoal', $kuis_item->id) }}"> {{ $kuis_item->kuis_name }}</a></td>
                                    <td class="border-bottom"></td>                                    
                                        @if ($data_kursus->user_id !== $kuis_item->user_id)
                                            @if (auth()->user()->role === 'admin')
                                                <td class="text-right border-bottom"><i></i>&nbsp; <a href="{{ route('createSoals', $kuis_item->id) }}"><i class="fa fa-plus"></i> soal </a>
                                                    <a href="{{ route('createSoals', $kuis_item->id) }}" class="text-danger"><i class="fa fa-trash"></i> hapus</a>
                                                </td>
                                            @else
                                                <td class="text-left border-bottom d-none d-sm-table-cell"> By : {{ $kuis_item->user->name }}</td>
                                                <td class="text-right border-bottom text-danger"><i></i>&nbsp; fixed</td>
                                            @endif                                            
                                        @else
                                            <td class="text-left border-bottom d-none d-sm-table-cell"> By : Me</td>
                                            <td class="text-right border-bottom"><i></i>&nbsp; <a href="{{ route('createSoals', $kuis_item->id) }}"><i class="fa fa-plus"></i> soal</a></td>
                                        @endif                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!--kuis-->

                    <!--book-->
                    <div class="col-md-4 col-xl-12 mb-10" data-category="book" style="display: none">                        
                        <table class="table table-borderless">
                            <tbody>
                                {{-- @foreach ($data_kursus->book as $book_item)                                                                    
                                <tr>
                                    <td class="border-bottom"><i class="fa fa-fw fa-edit"></i>&nbsp; {{ $book_item->book_name }}</td>
                                    <td class="text-right border-bottom text-danger"><a href="#" class="text-danger" data-id="{{ $book_item->id }}" data-toggle="modal" data-target="#modal-fromright-removebuku"> hapus</a></td>
                                    <td class="text-right border-bottom"><i></i>&nbsp; <a href="{{ route('download', $book_item->book_file) }}">unduh</a></td>
                                </tr>
                                @endforeach --}}
                            </tbody>
                     
                    <h5 class="mb-4" style="margin-top: 20px"> <a href="#" class="label-blue text-uppercase fa fa-plus" data-toggle="modal" data-target="#modal-fromright-salin-artikel"> artikel</a></h5>
                
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
                                        <a class="ribbon-box hover-box text-white" data-toggle="modal" data-target="#modal-fromright-removebuku" data-id="{{ $item->id }}" data-kursus_id="{{ $data_kursus->id }}">
                                            <i class="fa fa-trash"> {{ $key+1 }}</i>
                                        </a>
                                    @endif
                                @elseif(auth()->user()->role=='admin')
                                <a class=" text-white ribbon-box hover-box text-white" data-toggle="modal" data-target="#modal-fromright-removebuku" data-id="{{ $item->id }}" data-kursus_id="{{ $data_kursus->id }}">
                                    <i class="fa fa-trash"> {{ $key+1 }}</i>
                                </a>
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
                        </table>
                    </div>
                    <!--book-->                    
                </div>                
            </div>
            <!--daftar konten-->

        </div>
    </div>            
    
    <div class="col-md-6">        
        <div class="block block-rounded block-mode-pinned">
            <!--daftar video-->
            <div class="block-header block-header-default ">
                <h3 type="button" class="block-title btn-block-option" data-toggle="block-option" data-action="content_toggle"></h3>
                <div class="block-options">                    
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="pinned_toggle">
                        <i class="si si-pin"></i>
                    </button>
                    <button class="btn" data-toggle="modal" data-target="#modal-fromleft"><i class="fa fa-fw fa-plus"></i></button>
                </div>
            </div>
                        
            <div class="block-content">
                <p class="text-center">DAFTAR VIDEO</p>
                @if (count($data_kursus->video)===0)
                <div class="block-content text-center">belum ada materi video kursus yang dibuat</div>
                <div class="block-content text-center mb-20 ">
                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-fromleft"><i class="fa fa-fw fa-plus"></i> add new video course</button>
                </div>
                @else
                <table class="table table-borderless border-top">                                               
                    @foreach ($data_kursus->video as $video_item)
                        <tr>
                            <td><a type="button" class="si si-control-play view-video" data-video_link="{{ $video_item->video_link }}">&nbsp;&nbsp;&nbsp;&nbsp; {{ $video_item->video_name }}</a></td>
                            <td>
                                <a type="button" ><i class="fa fa-trash text-danger" data-id="{{ $video_item->id }}" data-kursus_id="{{ $data_kursus->id }}" data-toggle="modal" data-target="#modal-fromleft-remove-video"></i></a>                                
                            </td>
                            <td>
                                @if ($video_item->user_id !== $data_kursus->user_id)
                                <a  type="button" data-toggle="modal" data-target="#modal-fromleft-tidakdapateditvideo"><i class="fa fa-pencil"></i></a>
                                @else
                                <a href="#" type="button" data-toggle="modal" data-target="#modal-fromleft-update-video" data-id="{{ $video_item->id }}"
                                    data-video_name="{{ $video_item->video_name }}" data-video_link="{{ $video_item->video_link }}"><i class="fa fa-pencil"></i></a>
                                @endif                                
                            </td>
                        </tr>
                    @endforeach                                                             
                </table>
                @endif                                                                 
            </div>
            <!--end daftar video-->
        </div>

        <div class="block block-rounded">
            <!--daftar siswa-->
            <div class="block-header bg-primary">
                <h3 class="text-white block-title btn-block-option" type="button" data-toggle="block-option" data-action="content_toggle"></h3>                
                <button class=" text-white btn btn-white" data-toggle="modal" data-target="#modal-addsiswa" data-total_user="{{ $siswa_kursus->count() }}" data-total_video="{{ $total_video }}"><i class="fa fa-fw fa-plus"></i> SISWA</button>
            </div>
                        
            <div class="block-content">
                <p class="text-center">DAFTAR SISWA</p>
                @if ($data_kursus_siswa===null)
                <div class="block-content text-center">belum ada siswa yang mengikut kursus</div>
                    <div class="block-content text-center mb-20">
                        <button class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-addsiswa" ><i class="fa fa-fw fa-plus"></i> tambahkan siswa baru</button>
                    </div>                                    
                @else                    
                    <table class="table table-striped" id="table_siswas">
                        <thead>
                            <tr>
                                <th>nama siswa</th>
                                <th>hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_kursus->profile as $siswa_kursus_ini)
                               
                                <tr>
                                    <td class=""><a href="{{ route('profile', $siswa_kursus_ini->user->id) }}">{{ $siswa_kursus_ini->user->name }}</a>
                                        {{-- <input type="hidden" class="form-control" id="kursus_id" name="kursus_id[]"
                                        value="{{ $data_kursus->id }}" required> --}}
                                    </td>
                                    <td class="text-left" style="width: 10%"> <a type="button" data-toggle="modal" data-target="#modal-removesiswa" data-kursus_id="{{ $data_kursus->id }}" data-profile_id="{{ $siswa_kursus_ini->id }}">&nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-trash text-danger"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <!--end daftar siswa-->
        </div>
    </div>    
</div>
    
</div>

<!--modal tidak dapat update SEMUA-->
<div class="modal fade" id="modal-fromleft-tidakdapateditvideo" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="#" method="POST" enctype="multipart/form-data">@csrf                    
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">update</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content">                            
                        <div class="form-group">
                            <div class="col-sm-12">
                                <p class="text-danger">anda tidak dapat mengedit data / sumber materi kursus yang anda salin</p>
                            </div>                                                                                   
                        </div>
                        <div class="col-sm-4 form-group">
                            <button class="btn btn-primary" type="button" data-dismiss="modal">OK</button>
                        </div>
                    </div>                                                               
                </div>                        
            </form>                   
        </div>            
    </div>
</div>
<!--end modal tidak bisa update SEMUA-->

<!--modal add siswa-->
<div class="modal fade" id="modal-addsiswa" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('addSiswaKursus') }}" method="POST" enctype="multipart/form-data">@csrf                    
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title text-uppercase">tambahkan siswa dalam kursus</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">                            
                        <div class="form-group">
                            <div class="col-sm-12">
                                @if (count($data_siswa)==null)
                                    <p class="text-center text-danger">BELUM ADA SISWA YANG TERDAFTAR DALAM SISTEM</p>
                                @else
                                <div class="form-group">
                                    <table class="table table-striped" id="addsis">
                                        <thead>
                                            <tr>
                                                <th>nama</th>
                                                <th>check</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($filtersiswa as $res)
                                                @if ($res->user->role=='siswa' && $res->user->stat=='1')
                                                <tr>
                                                    <td class=""><a href="{{ route('profile', $res->user->id) }}">{{ $res->user->name }}</a>
                                                        <input type="hidden" class="form-control" id="kursus_id" name="kursus_id[]"
                                                        value="{{ $data_kursus->id }}" required>
                                                    </td>
                                                    <td class="text-left" style="width: 10%"> <input type="checkbox" name="profile_id[]" value="{{ $res->id }}"></td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                   {{-- <div class="form-group">
                                       <table class="table table-borderless">
                                           @foreach ($filtersiswa as $res)
                                                @if ($res->user->role=='siswa' && $res->user->stat=='1')                                                                            
                                                    <tr>
                                                        <td class="text-left" style="width: 10%"> <input type="checkbox" name="profile_id[]" value="{{ $res->id }}"></td>
                                                        <td class=""><a href="{{ route('profile', $res->user->id) }}">{{ $res->user->name }}</a>
                                                            <input type="hidden" class="form-control" id="kursus_id" name="kursus_id[]"
                                                            value="{{ $data_kursus->id }}" required>
                                                        </td>
                                                    </tr>
                                                @endif
                                           @endforeach
                                       </table>
                                   </div> --}}
                                @endif                                                                
                            </div>
                        </div>
                        <div class="col-sm-4 form-group">
                            <button class="btn btn-primary" type="submit">add</button>
                        </div>
                    </div>                                                               
                </div>                        
            </form>                   
        </div>            
    </div>
</div>
<!--modal add siswa-->

<!--modal add siswa-->
<div class="modal fade" id="modal-removesiswa" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('removeSiswa') }}" method="POST" enctype="multipart/form-data">@csrf                    
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-danger">
                        <h3 class="block-title text-uppercase text-white">remove siswa dari kursus</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">                            
                        <div class="form-group">
                            <div class="col-sm-12">
                                <p class="text-danger">Anda yakin akan mengeluarkan siswa tersebut dari kursus ?</p>                            
                                <input type="hidden" name="kursus_id" id="kursus_id">
                                <input type="hidden" name="profile_id" id="profile_id">                 
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
<!--modal add siswa-->

<!--modal add video-->
<div class="modal fade" id="modal-fromleft" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('addVideo') }}" method="POST" enctype="multipart/form-data">@csrf                    
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">add new video course</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content">                            
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="hidden" class="form-control" id="user_id" name="user_id"
                                    value="{{ auth()->user()->id }}" required>
                                <input type="hidden" class="form-control" id="kursus_id" name="kursus_id"
                                    value="{{ $data_kursus->id }}" required>
                                <input type="hidden" class="form-control" id="kelas_id" name="kelas_id"
                                    value="{{ $data_kursus->kelas_id }}" required>
                                <input type="hidden" class="form-control" id="mapel_id" name="mapel_id"
                                    value="{{ $data_kursus->mapel_id }}" required>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-12 control-label">video link ( embeded )</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" name="video_link" id="video_link" rows="6" minlength="5" maxlength="500" required></textarea>                                    
                                </div>
                            </div>
                            <label for="name" class="col-sm-12 control-label">video name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="video_name" name="video_name"
                                    value="" required>
                            </div>                            
                        </div>
                        <div class="col-sm-4 form-group">
                            <button class="btn btn-primary" type="submit">add</button>
                        </div>
                    </div>                                                               
                </div>                        
            </form>                   
        </div>            
    </div>
</div>
<!--end modal add video-->

<!--modal update video-->
<div class="modal fade" id="modal-fromleft-update-video" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('addVideo') }}" method="POST" enctype="multipart/form-data">@csrf                    
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">update</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content">                            
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="hidden" id="id" name="id">
                                <input type="hidden" class="form-control" id="user_id" name="user_id"
                                    value="{{ auth()->user()->id }}" required>
                                <input type="hidden" class="form-control" id="kursus_id" name="kursus_id"
                                    value="{{ $data_kursus->id }}" required>
                                <input type="hidden" class="form-control" id="kelas_id" name="kelas_id"
                                    value="{{ $data_kursus->kelas_id }}" required>
                                <input type="hidden" class="form-control" id="mapel_id" name="mapel_id"
                                    value="{{ $data_kursus->mapel_id }}" required>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-12 control-label">video link ( embeded )</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" name="video_link" id="video_link" rows="6" minlength="5" maxlength="500" required></textarea>                                    
                                </div>
                            </div>
                            <label for="name" class="col-sm-12 control-label">video name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="video_name" name="video_name"
                                    value="" required>
                            </div>                            
                        </div>
                        <div class="col-sm-4 form-group">
                            <button class="btn btn-primary" type="submit">add</button>
                        </div>
                    </div>                                                               
                </div>                        
            </form>                   
        </div>            
    </div>
</div>
<!--end modal update video-->

<!--modal copy video-->
<div class="modal fade" id="modal-popout" tabindex="-1" role="dialog" aria-labelledby="modal-popout" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popout" role="document">
        <form action="{{ route('storecopy') }}" method="post"> @csrf
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">DAFTAR VIDEO YANG ADA</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <p class="text-center text-danger border-bottom">pastikan konten sesuai dengan materi anda</p><br>                        
                        @if (auth()->user()->role==='admin')
                            
                            <div class="form-group">
                                <table class="table table-borderless">
                                    {{-- @foreach ($list_data_video_kursus as $items_v)
                                    <tr>
                                        <td class="text-left float-left"><input type="hidden" name="kursus_id" value="{{ $data_kursus->id }}"></td>
                                        <td><input type="checkbox" name="video_id[]" value="{{ $items_v->id }}"></td>
                                        <td><label>{{ $items_v->video_name }}</label></td>
                                        <td><label>{{ $items_v->user->name }}</label></td>
                                        <td><a href="#" class="form-group float-right text-right view-video" data-dismiss="modal" aria-label="Close" id="modal-view-video" data-video_link="{{ $items_v->video_link }}">tonton</a></td>
                                    </tr>
                                    @endforeach --}}
                                    @foreach ($filtervideo as $res)
                                        <tr>
                                            <td class="text-left float-left"><input type="hidden" name="kursus_id" value="{{ $data_kursus->id }}"></td>
                                            <td><input type="checkbox" name="video_id[]" value="{{ $res->id }}"></td>
                                            <td><label>{{ $res->video_name }}</label></td>
                                            <td><label>{{ $res->user->name }}</label></td>
                                            <td><a href="#" class="form-group float-right text-right view-video" data-dismiss="modal" aria-label="Close" id="modal-view-video" data-video_link="{{ $res->video_link }}">tonton</a></td>
                                        </tr>
                                    @endforeach
                                </table>                                
                            </div>
                            
                        @else
                        <div class="form-group">
                            <table class="table table-borderless">
                            @foreach ($list_data_video_kursus as $res)
                                @if ($res->user_id !== auth()->user()->id)
                                    
                                            {{-- <tr>
                                                <td class="text-left float-left"><input type="hidden" name="kursus_id" value="{{ $data_kursus->id }}"></td>
                                                <td><input type="checkbox" name="video_id[]" value="{{ $item_v->id }}"></td>
                                                <td><label>{{ $item_v->video_name }}</label></td>
                                                <td><label>{{ $item_v->user->name }}</label></td>
                                                <td><a href="#" class="form-group float-right text-right view-video" data-dismiss="modal" aria-label="Close" id="modal-view-video" data-video_link="{{ $item_v->video_link }}">tonton</a></td>
                                            </tr> --}}
                                    
                                            
                                            <tr>
                                                <td class="text-left float-left"><input type="hidden" name="kursus_id" value="{{ $data_kursus->id }}"></td>
                                                <td><input type="checkbox" name="video_id[]" value="{{ $res->id }}"></td>
                                                <td><label>{{ $res->video_name }}</label></td>
                                                <td><label>{{ $res->user->name }}</label></td>
                                                <td><a href="#" class="form-group float-right text-right view-video" data-dismiss="modal" aria-label="Close" id="modal-view-video" data-video_link="{{ $res->video_link }}">tonton</a></td>
                                            </tr>
                                        
                                
                                @else
                                    {{-- <div class="form-group text-center">
                                        <p class="text-danger">BELUM ADA VIDEO PADA KATEGORI KURSUS INI</p>
                                    </div> --}}
                                @endif
                            @endforeach
                            </table>
                        </div>
                        @endif                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-alt-success">
                        <i class="fa fa-check"></i> salin
                    </button>                    
                </div>
            </div>
        </form>        
    </div>
</div>
<!--end modal copy video-->

<!--modal copy videoku-->
<div class="modal fade" id="modal-popout-videoku" tabindex="-1" role="dialog" aria-labelledby="modal-popout" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popout" role="document">
        <form action="{{ route('storecopy') }}" method="post"> @csrf
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">DAFTAR VIDEO SAYA</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <p class="text-center text-danger border-bottom">VIDEOKU</p>                        
                        @foreach ($list_data_video_kursus as $res)                        
                            @if ($res->user_id === $data_kursus->user_id)
                                <div class="form-group">
                                    <input type="hidden" name="kursus_id" value="{{ $data_kursus->id }}">
                                    <input type="checkbox" name="video_id[]" value="{{ $res->id }}">
                                    <label>{{ $res->video_name }}</label>
                                    <a href="#" class="form-group float-right text-right view-video" data-dismiss="modal" aria-label="Close" id="modal-view-video" data-video_link="{{ $res->video_link }}">tonton</a>
                                </div>
                            
                                {{-- <div class="form-group text-center">
                                    <p class="text-danger">ANDA BELUM MEMBUAT VIDEO</p>
                                </div> --}}                            
                            @endif
                        @endforeach                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-alt-success">
                        <i class="fa fa-check"></i> tambahkan
                    </button>
                </div>
            </div>
        </form>        
    </div>
</div>
<!--end modal copy videoku-->

<!--modal hapus video-->
<div class="modal fade" id="modal-fromleft-remove-video" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('removeVid') }}" method="POST" enctype="multipart/form-data">@csrf                    
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">remove video course</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content">                            
                        <div class="form-group">
                            <div class="col-sm-12">
                                <p>Anda yakin akan menghapus video tersebut dari kursus ini ?</p>
                                <p>Jika anda pembuat materi video kursus. Video kursus tersebut tidak akan dihapus dari sistem. Anda tetap dapat melihat daftar video yang anda buat di daftar video saya</p>
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
<!--end modal hapus video-->

<!--modal add & update kuis-->
<div class="modal fade" id="modal-fromright" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('addKuis') }}" method="POST" enctype="multipart/form-data">@csrf                    
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">KUIS</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content">                            
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="hidden" id="id" name="id">
                                <input type="hidden" class="form-control" id="user_id" name="user_id"
                                    value="{{ auth()->user()->id }}" required>
                                <input type="hidden" class="form-control" id="kursus_id" name="kursus_id"
                                    value="{{ $data }}" required>
                                <input type="hidden" class="form-control" id="kelas_id" name="kelas_id"
                                    value="{{ $data_kursus->kelas_id }}" required>
                                <input type="hidden" class="form-control" id="mapel_id" name="mapel_id"
                                    value="{{ $data_kursus->mapel_id }}" required>
                                <input type="hidden" name="slug" id="slug" value="" required>
                            </div>
                            
                            <label for="name" class="col-sm-12 control-label">judul kuis</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="kuis_name" onkeyup="getslug();" name="kuis_name"
                                    value="" required>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-12 control-label">deskripsi kuis</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" name="kuis_desc" id="kuis_desc" rows="6" minlength="5" maxlength="500" required></textarea>                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 form-group">
                            <button class="btn btn-primary" type="submit">add</button>
                        </div>
                    </div>                                                               
                </div>                        
            </form>                   
        </div>            
    </div>
</div>
<!--end modal add & update kuis-->

<!--modal salin kuis-->
<div class="modal fade" id="modal-fromright-salin-kuis" tabindex="-1" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
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
                                    <td><a href="{{ route('detailsSoal', $item->id) }}" class="text-primary view-video">({{ $item->pertanyaan->count() }} soal) {{ $item->kuis_name }}</a></td>
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
<!--end modal salin kuis-->

<!--modal salin artikel-->
<div class="modal fade" id="modal-fromright-salin-artikel" tabindex="-1" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
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
<!--end modal salin artikel-->

<!--modal salin kuisku-->
<div class="modal fade" id="modal-fromright-kuisku" tabindex="-1" role="dialog" aria-labelledby="modal-fromrigt" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-salin-kuis" class="form-horizontal" action="{{ route('salinKuis') }}" method="POST" enctype="multipart/form-data">@csrf 
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">DAFTAR KUISKU</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="hidden" id="id" name="id">
                            </div>
                            <div class="form-group">                                
                                <div class="block-content">                                                                            
                                    <p class="text-center text-danger border-bottom">KUISKU</p>                                    
                                    @foreach ($data_kuis as $item_kuis)
                                    @if ($item_kuis->user_id === $data_kursus->user_id)
                                    {{-- @if ($item_kuis->user_id === auth()->user()->id) --}}
                                    <div class="form-group">
                                        <input type="hidden" name="kursus_id" value="{{ $data_kursus->id }}">
                                        <input type="checkbox" name="kuis_id[]" value="{{ $item_kuis->id }}">
                                        <label>{{ $item_kuis->kuis_name }}</label>
                                        <a href="{{ route('detailsSoal', $item_kuis->id) }}" class="form-group float-right text-right">detail</a>
                                    </div>
                                    @else
                                    @endif                                    
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group float-right">
                            <button class="btn btn-primary" type="submit">tambahkan</button>
                        </div>
                    </div>                                                               
                </div>                        
            </form>                   
        </div>            
    </div>
</div>
<!--end modal salin kuisku-->

<!--modal hapus Kuis-->
<div class="modal fade" id="modal-fromleft-remove-kuis" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('removeKuis') }}" method="POST" enctype="multipart/form-data">@csrf                    
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">remove kuis</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content">                            
                        <div class="form-group">
                            <div class="col-sm-12">
                                <p>Anda yakin akan menghapus kuis tersebut dari kursus ini ?</p>
                                <p>Jika anda pembuat kuis ini. kuis tersebut tidak akan dihapus dari sistem. Anda tetap dapat melihat daftar kuis yang anda buat di daftar kuis saya</p>
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

<!--modal add file-->
<div class="modal fade" id="modal-fromright_book" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('addBook') }}" method="POST" enctype="multipart/form-data">@csrf                    
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">add new book</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content">                            
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="hidden" class="form-control" id="user_id" name="user_id"
                                    value="{{ auth()->user()->id }}" required>
                                <input type="hidden" class="form-control" id="kursus_id" name="kursus_id"
                                    value="{{ $data }}" required>
                                <input type="hidden" class="form-control" id="kelas_id" name="kelas_id"
                                    value="{{ $data_kursus->kelas_id }}" required>
                                <input type="hidden" class="form-control" id="mapel_id" name="mapel_id"
                                    value="{{ $data_kursus->mapel_id }}" required>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-12 control-label">judul buku</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="book_name" name="book_name"
                                        value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-12 control-label">file buku</label>
                                <div class="col-sm-12">
                                    <input type="file" name="book_file" id="book_file" accept=".docx,.pdf" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 form-group">
                            <button class="btn btn-primary" type="submit">add</button>
                        </div>
                    </div>                                                               
                </div>                        
            </form>                   
        </div>            
    </div>
</div>
<!--end modal add file-->

<!--modal salin buku-->
<div class="modal fade" id="modal-fromright-salin-book" tabindex="-1" role="dialog" aria-labelledby="modal-fromrigt" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-salin-kuis" class="form-horizontal" action="{{ route('salinBuku') }}" method="POST" enctype="multipart/form-data">@csrf 
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">salin buku</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content">                            
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="hidden" id="id" name="id">                                
                            </div>
                            <div class="form-group">                                
                                <div class="block-content">                                                                            
                                    <p class="text-center text-danger border-bottom">pastikan buku sesuai dengan materi anda</p>                                    
                                    {{-- @foreach ($data_book as $item_book)
                                    @if ($item_book->user_id !== $data_kursus->user_id)
                                    <div class="form-group">
                                        <input type="hidden" name="kursus_id" value="{{ $data_kursus->id }}">
                                        <input type="checkbox" name="book_id[]" value="{{ $item_book->id }}">
                                        <label>{{ $item_book->book_name }}</label>
                                        <a href="{{ route('download', $item_book->book_file) }}" class="form-group float-right text-right">download</a>
                                    </div>
                                    @else
                                    @endif                                    
                                    @endforeach --}}
                                </div>
                            </div>
                        </div>
                        <div class="form-group float-right">
                            <button class="btn btn-primary" type="submit">salin</button>
                        </div>
                    </div>                                                               
                </div>                        
            </form>                   
        </div>            
    </div>
</div>
<!--end modal salin buku-->

<!--modal salin bukuku-->
<div class="modal fade" id="modal-fromright-bukuku" tabindex="-1" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-salin-kuis" class="form-horizontal" action="{{ route('salinBuku') }}" method="POST" enctype="multipart/form-data">@csrf 
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">DAFTAR BUKU</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content">                            
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="hidden" id="id" name="id">                                
                            </div>
                            <div class="form-group">                                
                                <div class="block-content">                                                                            
                                    <p class="text-center text-danger border-bottom">BUKU SAYA</p>                                    
                                    {{-- @foreach ($data_book as $item_book)
                                    @if ($item_book->user_id === $data_kursus->user_id)
                                    <div class="form-group">
                                        <input type="hidden" name="kursus_id" value="{{ $data_kursus->id }}">
                                        <input type="checkbox" name="book_id[]" value="{{ $item_book->id }}">
                                        <label>{{ $item_book->book_name }}</label>
                                        <a href="{{ route('download', $item_book->book_file) }}" class="form-group float-right text-right">download</a>
                                    </div>
                                    @else
                                    @endif                                    
                                    @endforeach --}}
                                </div>
                            </div>
                        </div>
                        <div class="form-group float-right">
                            <button class="btn btn-primary" type="submit">salin</button>
                        </div>
                    </div>                                                               
                </div>                        
            </form>                   
        </div>            
    </div>
</div> 

<!--end modal salin bukuku-->
<!--modal salin bukuku-->
<div class="modal fade" id="modal-fromright-removebuku" tabindex="-1" role="dialog" aria-labelledby="modal-fromrigt" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-salin-kuis" class="form-horizontal" action="{{ route('removeArtikel') }}" method="POST" enctype="multipart/form-data">@csrf 
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-danger">
                        <h3 class="block-title">REMOVE</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content">                            
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="hidden" id="id" name="id">
                                <input type="hidden" name="kursus_id" value="{{ $data_kursus->id }}">
                            </div>
                            <div class="form-group">                                
                                <div class="block-content">                                                                            
                                    <p class="text-center text-danger border-bottom"> anda dapat menyalin artikel ini lagi</p>
                                    <p class="text-center"> Yakin akan menghapus artikel ini ?</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-outline-danger fa fa-trash" type="submit"> HAPUS</button>
                        </div>
                    </div>                                                               
                </div>                        
            </form>                   
        </div>            
    </div>
</div>
<!--end modal salin bukuku-->

@endsection

@section('script')

    <script>
    function getslug(){
        var judul   =   document.getElementById('kuis_name').value;
        var data    =   document.getElementById('user_id').value;
        var slug    =   judul +'/'+ data;
        document.getElementById('slug').value = slug;
    }    
    </script>
    <script>
        
    </script>

    <script>
        var table;
        $(document).ready(function(){    
            table= $('#table_siswas').DataTable({});        
        });
        var table2;
        $(document).ready(function(){    
            table2= $('#table_salin_kuis').DataTable({});        
        });
        var table4;
        $(document).ready(function(){    
            table4= $('#table_salin_artikel').DataTable({});        
        });
         
        var table3;
        $(document).ready(function(){    
            table3= $('#addsis').DataTable({});        
        });

    </script>

    <script>        
        var data = $("#playvideo").attr('src');
        // play video
        $(document).on('click','.view-video',function(){
            console.log($(this).attr('data-video_link'));            
            $("#playvideo").attr('src', $(this).attr('data-video_link'));
        });                                                                  
    </script>    

    <script>
        $('#modal-fromleft-update-video').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var video_name = button.data('video_name')
            var video_link = button.data('video_link')
            var modal = $(this)
            modal.find('.block-content #video_name').val(video_name);
            modal.find('.block-content #video_link').val(video_link);
            modal.find('.block-content #id').val(id);
        })
    </script>

    <script>
        $('#modal-fromright').on('show.bs.modal', function(event){
            var button  = $(event.relatedTarget)
            var id      = button.data('id')
            var kuis_name = button.data('kuis_name')
            var kuis_desc = button.data('kuis_desc')
            var modal = $(this)        
            modal.find('.block-content #id').val(id);
            modal.find('.block-content #kuis_name').val(kuis_name);
            modal.find('.block-content #kuis_desc').val(kuis_desc);
        })
    </script>

    <script>
        $('#modal-fromleft-remove-video').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var kursus_id = button.data('kursus_id')
            var modal = $(this)        
            modal.find('.block-content #id').val(id);
            modal.find('.block-content #kursus_id').val(kursus_id);
        })
    </script>

    <script>
        $('#modal-fromleft-remove-kuis').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var kursus_id = button.data('kursus_id')
            var modal = $(this)        
            modal.find('.block-content #id').val(id);
            modal.find('.block-content #kursus_id').val(kursus_id);
        })
    </script>

    <script>
        $('#modal-removesiswa').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget)
            var profile_id = button.data('profile_id')
            var kursus_id = button.data('kursus_id')
            var modal = $(this)        
            modal.find('.block-content #profile_id').val(profile_id);
            modal.find('.block-content #kursus_id').val(kursus_id);
        })
    </script>
        
    <script>
        $('#modal-addsiswa').on('show.bs.modal', function(event){
            console.log('dor');
            
        })
    </script>

<script>
    $('#modal-fromright-removebuku').on('show.bs.modal', function(event){
        var button  = $(event.relatedTarget)
        var id      = button.data('id')        
        var modal = $(this)        
        modal.find('.block-content #id').val(id);        
    })
</script>
@endsection