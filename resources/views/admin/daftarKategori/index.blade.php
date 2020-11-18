@extends('layouts.admin_layouts.master')

@section('content')
<!-- Hero -->
<div class="bg-image bg-image-bottom" style="background-image: url({{ asset('assets/media/photos/photo34@2x.jpg') }});">
    <div class="bg-primary-dark-op">
        <div class="content content-top text-center overflow-hidden">
            <div class="pb-10">
                <h1 class="font-w700 text-white mb-10 invisible" data-toggle="appear" data-class="animated fadeInUp">Kategori Management</h1>
                <h2 class="h4 font-w400 text-white-op invisible" data-toggle="appear" data-class="animated fadeInUp">Welcome to your Kategori management page!</h2>
            </div>
        </div>
    </div>
</div>
<!-- END Hero -->

<div class="content">
    <div class="row">
        <div class="col-xl-12">
            <!--alert-->
            <div class="content-heading"><label>Mapel > Kelas > Kategori</label></div>            
                @if (Session::has('pesan'))
                    <div class="alert alert-info text-bold">{{ Session::get('pesan') }}</div>
                @endif
                @if (Session::has('pesan-peringatan'))
                    <div class="alert alert-warning text-bold">{{ Session::get('pesan-peringatan') }}</div>
                @endif
                @if (Session::has('pesan-sukses'))
                    <div class="alert alert-success text-bold">{{ Session::get('pesan-sukses') }}</div>
                @endif            
            <!--end alert-->
        </div>
    <!--table-->
    <div class="col-sm-4">
        <div class="block">
            <div class="block-header block-header-default">                
                <h3 class="block-title"><a href="#" class="fa fa-plus" data-toggle="modal" data-target="#modal-fromleft-mapel" ></a></h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="daftar_mapel" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>mapel</th>
                                <th>aksi</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_mapel as $item_mapel)
                            <tr>                                    
                                <td>{{ $item_mapel->mapel_name }}</td>
                                <td>
                                    <button class="btn btn-outline-danger fa fa-trash" data-toggle="modal" data-target="#modal-fromleft-delmapel" data-id="{{ $item_mapel->id }}"></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>        
    </div>

    <div class="col-sm-4">
        <div class="block">
            <div class="block-header block-header-default">                
                <h3 class="block-title"><a href="#" class="fa fa-plus" data-toggle="modal" data-target="#modal-fromleft-kelas"></a></h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="daftar_kelas" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>kelas</th>
                                <th>aksi</th>                                
                            </tr>
                        </thead>
                        <tbody>                                                            
                            @foreach ($data_kelas as $item_kelas)
                                <tr>
                                    <td>{{ $item_kelas->kelas_name }}</td>
                                    <td>
                                        <button class="btn btn-outline-danger fa fa-trash" data-toggle="modal" data-target="#modal-fromleft-delkelas" data-id="{{ $item_kelas->id }}"></button>
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>        
    </div>

    <div class="col-sm-4">
        <div class="block">
            <div class="block-header block-header-default">                
                <h3 class="block-title"><a href="#" class="fa fa-plus" data-toggle="modal" data-target="#modal-fromleft-addkategori"></a></h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="daftar_kategori" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>kelas</th>
                                <th>mapel</th>
                                <th>aksi</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_kelas as $item)
                                @foreach ($item->mapel as $item2)
                                    <tr>
                                        <td>{{ $item->kelas_name }}</td>
                                        <td>{{ $item2->mapel_name }}</td>
                                        <td>
                                            <button class="btn btn-outline-danger fa fa-trash" data-toggle="modal" data-target="#modal-fromleft-delkategori" data-kelas_id="{{ $item->id }}" data-mapel_id="{{ $item2->id }}"></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>        
    </div>
    <!--end table-->
    </div>    
<!--modal add mapel-->
<div class="modal fade" id="modal-fromleft-mapel" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('addMapel') }}" method="POST" enctype="multipart/form-data">@csrf
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Mapel Baru</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content">                            
                        <div class="form-group">                            
                            <input type="text" name="mapel_name" class="form-control" placeholder="Matematika.." required>                                                        
                        </div>
                        <div class="form-group float-right">
                            <button class="btn btn-outline-primary" type="submit">tambahkan</button>
                        </div>
                    </div>                                                             
                </div>                        
            </form>                   
        </div>
    </div>
</div>
<!--end modal add mapel-->

<!--modal add kelas-->
<div class="modal fade" id="modal-fromleft-kelas" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('addKelas') }}" method="POST" enctype="multipart/form-data">@csrf
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Kelas Baru</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content">                            
                        <div class="form-group">                            
                            <input type="text" name="kelas_name" class="form-control" placeholder="IX SMP" required>                                                        
                        </div>
                        <div class="form-group float-right">
                            <button class="btn btn-outline-primary" type="submit">tambahkan</button>
                        </div>
                    </div>                                                             
                </div>                        
            </form>                   
        </div>
    </div>
</div>
<!--end modal add kelas-->

<!--modal add kategori-->
<div class="modal fade" id="modal-fromleft-addkategori" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('addKategori') }}" method="POST" enctype="multipart/form-data">@csrf
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Kategori Baru</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content">                            
                        <div class="form-group">                            
                            <select name="kelas_id" id="" class="form-control" required>
                                @foreach ($data_kelas as $item_k)                                
                                <option value="{{ $item_k->id }}">{{ $item_k->kelas_name }}</option>
                                @endforeach                                
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="mapel_id" id="" class="form-control" required>
                                @foreach ($data_mapel as $item_m)                                
                                <option value="{{ $item_m->id }}">{{ $item_m->mapel_name }}</option>
                                @endforeach                                
                            </select>
                        </div>
                        <div class="form-group float-right">
                            <button class="btn btn-outline-primary" type="submit">tambahkan</button>
                        </div>
                    </div>                                                             
                </div>                        
            </form>                   
        </div>
    </div>
</div>
<!--end modal add kategori-->

<!--modal delete kelas-->
<div class="modal fade" id="modal-fromleft-delkelas" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('dellKelas') }}" method="POST" enctype="multipart/form-data">@csrf
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-danger">
                        <h3 class="block-title">Hapus Kelas</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content">                            
                        <div class="form-group">                            
                            <div class="block-content text-center">
                                <p>Anda yakin akan menghapus kelas tersebut ?</p>
                                <input type="hidden" name="id" id="id">
                            </div>
                        </div>
                        <div class="form-group float-right">
                            <button class="btn btn-outline-danger" type="submit">Hapus</button>
                        </div>
                    </div>                                                             
                </div>                        
            </form>                   
        </div>
    </div>
</div>
<!--end modal delete kelas-->

<!--modal delete kelas-->
<div class="modal fade" id="modal-fromleft-delmapel" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('dellMapel') }}" method="POST" enctype="multipart/form-data">@csrf
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-danger">
                        <h3 class="block-title">Hapus mapel</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content">                            
                        <div class="form-group">                            
                            <div class="block-content text-center">
                                <p>Anda yakin akan menghapus mapel tersebut ?</p>
                                <input type="hidden" id="id" name="id">
                            </div>
                        </div>
                        <div class="form-group float-right">
                            <button class="btn btn-outline-danger" type="submit">Hapus</button>
                        </div>
                    </div>                                                             
                </div>                        
            </form>                   
        </div>
    </div>
</div>
<!--end modal delete kelas-->

<!--modal delete kategori-->
<div class="modal fade" id="modal-fromleft-delkategori" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('dellKategori') }}" method="POST" enctype="multipart/form-data">@csrf
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-danger">
                        <h3 class="block-title">Hapus Kategori</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content">                            
                        <div class="form-group">                            
                            <div class="block-content text-center">
                                <p>Anda yakin akan menghapus Kategori tersebut ?</p>
                                <input type="hidden" name="kelas_id" id="kelas_id">
                                <input type="hidden" name="mapel_id" id="mapel_id"> 
                            </div>
                        </div>
                        <div class="form-group float-right">
                            <button class="btn btn-outline-danger" type="submit">Hapus</button>
                        </div>
                    </div>                                                             
                </div>                        
            </form>                   
        </div>
    </div>
</div>
<!--end modal delete kategori-->
</div>
@endsection

@section('script')
<script>
    $('#modal-fromleft-delmapel').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget)        
        var id = button.data('id')                
        var modal = $(this)
        modal.find('.block-title').text('HAPUS MAPEL');
        modal.find('.block-content #id').val(id);
    });
    $('#modal-fromleft-delkelas').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget)        
        var id = button.data('id')                
        var modal = $(this)
        modal.find('.block-title').text('HAPUS KELAS');
        modal.find('.block-content #id').val(id);
    });
    $('#modal-fromleft-delkategori').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget)        
        var kelas_id = button.data('kelas_id')
        var mapel_id = button.data('mapel_id')
        var modal = $(this)
        modal.find('.block-title').text('HAPUS KATEGORI');
        modal.find('.block-content #kelas_id').val(kelas_id);
        modal.find('.block-content #mapel_id').val(mapel_id);
    });
</script>
@endsection