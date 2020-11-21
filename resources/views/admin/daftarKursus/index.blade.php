@extends('layouts.admin_layouts.master')

@section('head')
    {{-- <link rel="stylesheet" href="{{ asset('css/card_instruktur1.css') }}">     --}}
@endsection

@section('content')
<!-- Hero -->
<div class="bg-image bg-image-bottom" style="background-image: url({{ asset('assets/media/photos/photo34@2x.jpg') }});">
    <div class="bg-primary-dark-op">
        <div class="content content-top text-center overflow-hidden">
            <div class="pb-20">
                <h1 class="font-w700 text-white mb-10 invisible" data-toggle="appear" data-class="animated fadeInUp">Kursus Management</h1>
                <h2 class="h4 font-w400 text-white-op invisible" data-toggle="appear" data-class="animated fadeInUp">Welcome to your Kursus management page!</h2>
            </div>
        </div>
    </div>
</div>
<!-- END Hero -->
<div class="content">
    <!-- Files Filtering -->
    <h2 class="content-heading">KURSUS <small>tambahkan kursus dan instruktur baru pada kategori yang ada</small></h2>
    @if (Session::has('message'))
        <div class="alert alert-danger text-bold">{{ Session::get('message') }}</div>                
    @endif
    @if (Session::has('pesan-peringatan'))
            <div class="alert alert-warning text-bold">{{ Session::get('pesan-peringatan') }}</div>                
    @endif
    @if (Session::has('pesan-sukses'))
        <div class="alert alert-info text-bold">{{ Session::get('pesan-sukses') }}</div>
    @endif
    <!-- Content Filtering (.js-filter class is initialized in Helpers.contentFilter()) -->
    <!-- You can set the animation duration through data-speed="speed_in_ms" -->
    <div class="js-filter" data-speed="400">
        <div class="p-10 bg-white push">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="#" data-category-link="info">
                        <i class="fa fa-fw fa-folder-open-o mr-5"></i>
                    </a>
                </li>
                @foreach ($data_kelas as $item)
                    @foreach ($item->mapel as $item2)
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-category-link="{{ $item->kelas_name }}|{{ $item2->mapel_name }}">
                            <i class="fa fa-fw fa-book mr-5"></i>{{ $item->kelas_name }} {{ $item2->mapel_name }}
                        </a>
                    </li>
                    @endforeach
                @endforeach                
            </ul>
        </div>
        <div class="row">
            <!--custom button add-->
            @foreach ($data_kelas as $item_k)
                @foreach ($item_k->mapel as $item_m)
                <?php 
                $this_kelas=$item_k->slug;
                $this_mapel=$item_m->slug;
                $slug = $this_kelas.'-'.$this_mapel.'-instruktur-';
                ?>
                <div class="col-md-4 col-xl-12 mb-10 " data-category="{{ $item_k->kelas_name }}|{{ $item_m->mapel_name }}" style="display: none">
                    <button class="btn btn-alt-primary" data-toggle="modal" data-target="#modal-fromleft"
                    data-kelas_id="{{ $item_k->id }}" data-mapel_id="{{ $item_m->id }}" data-slug="{{ $slug }}"
                    ><i class="fa fa-plus"></i> instruktur</button>
                </div><br>
                @endforeach
            @endforeach
            <!--end custom button add-->

            <!--custom card instruktur-->
            @foreach ($data_kursus as $item)
                
                <div class="col-md-6 col-xl-4 js-appear-enabled animated fadeIn" data-category="{{ $item->kelas->kelas_name }}|{{ $item->mapel->mapel_name }}" style="display: none" data-toggle="appear">
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
                            @if ($item->status=='aktif')                            
                            <form action="{{ route('nonaktifkan') }}" method="POST">@csrf
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <input type="hidden" name="status" value="nonaktif">
                                <button type="submit" class="btn btn-otline-primary text-danger">non aktifkan</button>
                            </form>
                            @else
                            <form action="{{ route('aktifkan') }}" method="POST">@csrf
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <input type="hidden" name="status" value="aktif">
                                <button type="submit" class="btn btn-otline-primary text-primary">aktifkan</button>
                            </form>
                            @endif                            
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
                                                <a href="#" class="btn btn-outline-warning"> ANDA SEDANG TIDAK AKTIF</a>
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
                                    <div class="block-content">
                                        <a href="#" data-toggle="modal" data-target="#modal-fromleft-remove" class="btn btn-outline-danger fa fa-trash text-danger" data-id="{{ $item->id }}"> HAPUS</a>
                                        <a href="{{ route('kursus', $item->slug) }}" class="btn btn-outline-primary fa fa-check"> PERGI</a>                                        
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
            <!--end custom card instruktur-->

            <!--info-->
            @if ($data_kursus==null)
                <div class="col-md-12 col-xl-12" data-category="info">                
                    <div class="block block-content bg-transparent text-center">
                        <h5>belum ada kategori kursus yang tersedia. silahakan buat kategori kursus berdasarkan mapel dan kelas yang ada</h5>
                    </div>
                </div>
                @else
                <div class="col-md-12 col-xl-12" data-category="info">                
                    <div class="block block-content bg-transparent text-center">
                        <h5>Tambahkan Instruktur pada setiap kategori yang ada dan aktifkan kursus tersebut agar dapat ditampilkan dihalaman depan</h5>
                    </div>
                </div>            
            @endif
            <!--end info-->
        </div>
    </div>
    <!-- END Files Filtering -->
</div>

<!--modal add kursus-->
<div class="modal fade" id="modal-fromleft" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('addKursus') }}" method="POST" enctype="multipart/form-data">@csrf
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">menambahkan instruktur pada kursus</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content">                            
                        <div class="form-group">
                            <div class="col-sm-12 form-group">
                                <input type="hidden" class="form-control" id="kelas_id" name="kelas_id"
                                    value="" required>
                                <input type="hidden" class="form-control" id="mapel_id" name="mapel_id"
                                    value="" required>
                            </div>                            
                            <div class="col-sm-12 form-group">
                                <select name="user_id" id="" class="form-control" required>
                                    <option value=""> == pilih instruktur == </option>
                                    @foreach ($data_instruktur as $item_i)
                                        <option value="{{ $item_i->id }}" checked>{{ $item_i->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 form-group">
                                <input class="form-control" type="file" name="kursus_pict" id="kursus_pict" required>
                            </div>
                            <div class="col-sm-12 form-group">
                                <input type="hidden" name="slug" id="slug" value="" required>
                            </div>
                            <div class="col-sm-4 form-group">
                                <button class="btn btn-primary" type="submit">tambahkan</button>
                            </div>
                        </div>                                                                                                                   
                    </div>                                                             
                </div>                        
            </form>                   
        </div>
    </div>
</div>
<!--end modal add kursus-->

<!--modal add kursus-->
<div class="modal fade" id="modal-fromleft-remove" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('removeKursus') }}" method="POST" enctype="multipart/form-data">@csrf
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">menambahkan instruktur pada kursus</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content">                            
                        <div class="form-group">
                            <div class="col-sm-12 form-group">
                                <input type="hidden" class="form-control" id="id" name="id"
                                    value="" required>
                                <p>Apa anda yakin akan menghapus kursus tersebut ? </p>
                            </div>                            
                            <div class="col-sm-4 form-group">
                                <button class="btn btn-danger" type="submit">hapus</button>
                            </div>
                        </div>
                    </div>                                                             
                </div>                        
            </form>                   
        </div>
    </div>
</div>
<!--end modal add kursus-->
@endsection

@section('script')
    <script>
        var table;
        $(document).ready(function(){    
            table= $('#daftar_kursus').DataTable({});        
        });
    </script>
    
    <script>
        $('#modal-fromleft').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget)
            var id =     button.data('id')
            var kelas_id = button.data('kelas_id')
            var mapel_id = button.data('mapel_id')
            var slug = button.data('slug')
            var modal = $(this)
            modal.find('.block-title').text('add instruktur untuk kursus');        
            modal.find('.block-content #kelas_id').val(kelas_id);
            modal.find('.block-content #mapel_id').val(mapel_id);
            modal.find('.block-content #slug').val(slug);
        }) 
    </script>

<script>
    $('#modal-fromleft-remove').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget)        
        var id = button.data('id')                
        var modal = $(this)
        modal.find('.block-title').text('HAPUS KURSUS');        
        modal.find('.block-content #id').val(id);
    }) 
</script>
@endsection