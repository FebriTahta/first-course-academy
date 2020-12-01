@extends('layouts.admin_layouts.master')

@section('content')
<!-- Hero -->
<div class="bg-image bg-image-bottom" style="background-image: url({{ asset('assets/media/photos/photo34@2x.jpg') }});">
    <div class="bg-primary-dark-op">
        <div class="content content-top text-center overflow-hidden">
            <div class="pb-10">
                <h1 class="font-w700 text-white mb-10 invisible" data-toggle="appear" data-class="animated fadeInUp">DAFTAR KUIS</h1>
                <h2 class="h4 font-w400 text-white-op invisible" data-toggle="appear" data-class="animated fadeInUp"></h2>
            </div>
        </div>
    </div>
</div>
<!-- END Hero -->
    <div class="content">
        <div class="content-heading"><label>DAFTAR KUIS</label></div>            
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
            <!--end alert--> 
        <div class="row">
            <div class="col-12">
                @if ($users->role=='admin')
                <button class="fa fa-plus btn btn-outline-primary mb-10" data-toggle="modal" data-target="#modal-fromleft"> NEW KUIS</button>
                <div class="block">
                    <div class="block-header block-header-default">
                        <div class="block-content text-center">
                            
                        </div>
                    </div>
                    <div class="block-content">
                        <table class="table table-stripped" id="daftar_kuis">
                            <thead>
                                <tr>
                                    <th>KUIS</th>
                                    <th>KATEGORI</th>
                                    <th>UPLOADER</th>
                                    <th class="text-right border-bottom">OPSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kuiss as $kuis_item)
                                <tr>
                                    <td class="border-bottom"><i class="fa fa-fw fa-edit"></i> {{ $kuis_item->pertanyaan->count() }} soal &nbsp; <a href="{{ route('detailsSoal', $kuis_item->id) }}"> {{ $kuis_item->kuis_name }}</a></td>
                                    <td class="border-bottom">{{ $kuis_item->mapel->mapel_name }} {{ $kuis_item->kelas->kelas_name }}</td>
                                    <td 
                                    @if ($kuis_item->user->role=='admin')
                                        class="border-bottom text-success"
                                    @else
                                        class="border-bottom text-primary"
                                    @endif> 
                                        @if ($kuis_item->user->role=='admin')
                                            {{ $kuis_item->user->name }}
                                        @else
                                            <a href="/profile/{{ $kuis_item->user->id }}">{{ $kuis_item->user->name }}</a>
                                        @endif
                                    </td>
                                    <td class="text-right border-bottom"><i></i>&nbsp;
                                        <a href="#" type="button" class="fa fa-check text-success" data-target="#modal-fromleft-serahkan" data-toggle="modal" data-id="{{ $kuis_item->id }}" data-mapel_id="{{ $kuis_item->mapel_id }}" data-kelas_id="{{ $kuis_item->kelas_id }}" data-kuis_name="{{ $kuis_item->kuis_name }}" data-kuis_desc="{{ $kuis_item->kuis_desc }}" data-slug="{{ $kuis_item->slug }}"> serahkan</a>&nbsp;&nbsp;&nbsp;                             
                                        <a href="#" type="button" class="fa fa-trash text-danger" data-toggle="modal" data-target="#modal-fromleft-remove" data-id="{{ $kuis_item->id }}"> hapus</a> &nbsp;&nbsp;&nbsp;
                                        <a href="#" type="button" class="fa fa-pencil text-warning" data-toggle="modal" data-target="#modal-fromleft-edit" data-id="{{ $kuis_item->id }}" data-user_id="{{ $kuis_item->user_id }}" data-mapel_id="{{ $kuis_item->mapel_id }}" data-kelas_id="{{ $kuis_item->kelas_id }}" data-kuis_name="{{ $kuis_item->kuis_name }}" data-kuis_desc="{{ $kuis_item->kuis_desc }}"> edit</a> &nbsp;&nbsp;&nbsp;
                                        <a href="{{ route('createSoals',$kuis_item->id) }}" class="fa fa-plus"> soal</a>                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @else
                <button class="fa fa-plus btn btn-outline-primary mb-10" data-toggle="modal" data-target="#modal-fromleft"> NEW KUIS</button>
                <div class="block">                    
                    <div class="block-header block-header-default">
                        <div class="block-content text-center">
                            
                        </div>
                    </div>
                    <div class="block-content">
                        <table class="table table-stripped" id="daftar_kuis">
                            <thead>
                                <tr>
                                    <th>KUIS</th>
                                    <th>KATEGORI</th>                                    
                                    <th class="text-right border-bottom">OPSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kuis as $kuis_item)
                                <tr>
                                    <td class="border-bottom"><i class="fa fa-fw fa-edit"></i> {{ $kuis_item->pertanyaan->count() }} soal &nbsp; <a href="{{ route('detailsSoal', $kuis_item->id) }}"> {{ $kuis_item->kuis_name }}</a></td>
                                    <td class="border-bottom">{{ $kuis_item->mapel->mapel_name }} {{ $kuis_item->kelas->kelas_name }}</td>                                    
                                    <td class="text-right border-bottom"><i></i>&nbsp;
                                        <a href="#" type="button" class="fa fa-check text-success" data-target="#modal-fromleft-serahkan" data-toggle="modal" data-id="{{ $kuis_item->id }}" data-mapel_id="{{ $kuis_item->mapel_id }}" data-kelas_id="{{ $kuis_item->kelas_id }}" data-kuis_name="{{ $kuis_item->kuis_name }}" data-kuis_desc="{{ $kuis_item->kuis_desc }}" data-slug="{{ $kuis_item->slug }}"> serahkan</a>&nbsp;&nbsp;&nbsp;
                                        <a href="#" type="button" class="fa fa-trash text-danger" data-toggle="modal" data-target="#modal-fromleft-remove" data-id="{{ $kuis_item->id }}"> hapus</a> &nbsp;&nbsp;&nbsp;
                                        <a href="#" type="button" class="fa fa-pencil text-warning" data-toggle="modal" data-target="#modal-fromleft-edit" data-id="{{ $kuis_item->id }}" data-user_id="{{ $kuis_item->user_id }}" data-mapel_id="{{ $kuis_item->mapel_id }}" data-kelas_id="{{ $kuis_item->kelas_id }}" data-kuis_name="{{ $kuis_item->kuis_name }}" data-kuis_desc="{{ $kuis_item->kuis_desc }}" data-slug="{{ $kuis_item->slug }}"> edit</a> &nbsp;&nbsp;&nbsp;
                                        <a href="{{ route('createSoals',$kuis_item->id) }}" class="fa fa-plus"> soal</a>                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
                              
            </div>
        </div>
    </div>
<!--modal add KUIS-->
<div class="modal fade" id="modal-fromleft" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('addKuis') }}" method="POST" enctype="multipart/form-data">@csrf                    
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">UPLOAD</h3>
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
                                    value="{{ $user }}" required>                                
                            </div>
                            <div class="form-group">
                                <select name="kelas_id" class="form-control" id="kelas_id">
                                    @foreach ($kelass as $items)
                                        <option value="{{ $items->id }}"> {{ $items->kelas_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="mapel_id" class="form-control" id="mapel_id">
                                    @foreach ($mapels as $items)
                                        <option value="{{ $items->id }}"> {{ $items->mapel_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name" class="control-label">Nama Kuis</label>
                                
                                    <input type="text" class="form-control" name="kuis_name" id="kuis_name" onkeyup="getslug()" required>
                                
                            </div>
                            <label for="name" class="control-label">Deskripsi Kuis</label>
                            
                                <textarea class="form-control" name="kuis_desc" id="kuis_desc" cols="30" rows="10"> Pesan / Deskripsi seputar kuis yang akan dibuat</textarea>
                            <input type="text" id="slug" name="slug">
                        </div>
                        <div class="form-group float-right">
                            <button class="btn btn-outline-primary fa fa-plus" type="submit"> UPLOAD</button>
                        </div>
                    </div>                                                               
                </div>                        
            </form>                   
        </div>            
    </div>
</div>
<!--end modal add KUIS-->

<!--modal remove KUIS-->
<div class="modal fade" id="modal-fromleft-remove" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('hapusKuisPermanen') }}" method="POST" enctype="multipart/form-data">@csrf                    
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-danger">
                        <h3 class="block-title">HAPUS</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">                            
                        <div class="form-group">
                            <input type="hidden" id="id" name="id">
                            <div class="form-group text-danger text-center border-bottom">
                                <p>KUIS AKAN DIHAPUS PERMANEN DARI SISTEM</p>
                            </div>
                            <div class="form-group text-center">
                                <p>Yakin akan menghapus kuis ini ?</p>
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
<!--end modal remove KUIS-->

<!--modal serahkan KUIS-->
<div class="modal fade" id="modal-fromleft-serahkan" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('addKuis') }}" method="POST" enctype="multipart/form-data">@csrf                    
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-success">
                        <h3 class="block-title">BERIKAN KUIS</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">                            
                        <div class="form-group">
                            <input type="hidden" id="id" name="id">
                            <div class="form-group text-danger text-center border-bottom">
                                <p>BERIKAN KUIS ANDA KEPADA INSTRUKTUR LAIN</p>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="kelas_id" id="kelas_id">
                                <input type="hidden" name="mapel_id" id="mapel_id">
                                <input type="hidden" name="kuis_name" id="kuis_name">
                                <input type="hidden" name="kuis_desc" id="kuis_desc">
                                <input type="hidden" name="slug" id="slug">
                            </div>                            
                            <div class="form-group text-center">
                                <select name="user_id" id="user_id" class="form-control">
                                    @foreach ($instruktur as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach                                    
                                </select>
                            </div>                            
                        </div>
                        <div class="form-group float-right">
                            <button class="btn btn-outline-success fa fa-check" type="submit"> BERIKAN</button>
                        </div>
                    </div>                                                               
                </div>                        
            </form>                   
        </div>            
    </div>
</div>
<!--end modal serahkan KUIS-->

<!--modal edit KUIS-->
<div class="modal fade" id="modal-fromleft-edit" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('addKuis') }}" method="POST" enctype="multipart/form-data">@csrf                    
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">UPLOAD</h3>
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
                                    value="" required>
                            </div>
                            <div class="form-group">
                                <select name="kelas_id" class="form-control" id="kelas_id">
                                    @foreach ($kelass as $items)
                                        <option value="{{ $items->id }}" selected> {{ $items->kelas_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="mapel_id" class="form-control" id="mapel_id">
                                    @foreach ($mapels as $items)
                                        <option value="{{ $items->id }}" selected> {{ $items->mapel_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name" class="control-label">Nama Kuis</label>
                                
                                <input type="text" class="form-control" name="kuis_name" id="kuis_name" onkeyup="getslug()" required>
                                
                            </div>
                            <label for="name" class="control-label">Deskripsi Kuis</label>
                            
                                <textarea class="form-control" name="kuis_desc" id="kuis_desc" cols="30" rows="10"> Pesan / Deskripsi seputar kuis yang akan dibuat</textarea>                            
                                <input type="hidden" class="form-control" id="slug" name="slug"
                                value="" required>
                            </div>
                        <div class="form-group float-right">
                            <button class="btn btn-outline-primary fa fa-plus" type="submit"> EDIT</button>
                        </div>
                    </div>                                                               
                </div>                        
            </form>                   
        </div>            
    </div>
</div>
<!--end modal edit KUIS-->
@endsection

@section('script')
<script>
    var table2;
    $(document).ready(function(){    
        table2= $('#daftar_kuis').DataTable({});        
    });
</script>
<script>
    $('#modal-fromleft-remove').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget)        
        var id = button.data('id')        
        var modal = $(this)
        modal.find('.block-title').text('HAPUS KUIS');        
        modal.find('.block-content #id').val(id);        
    })
</script>
<script>
    $('#modal-fromleft-serahkan').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget)        
        var id = button.data('id')        
        var kelas_id = button.data('kelas_id')
        var mapel_id = button.data('mapel_id')
        var kuis_name = button.data('kuis_name')
        var kuis_desc = button.data('kuis_desc')
        var slug = button.data('slug')
        var modal = $(this)
        modal.find('.block-title').text('BERIKAN KUIS');        
        modal.find('.block-content #id').val(id);   
        modal.find('.block-content #kelas_id').val(kelas_id);
        modal.find('.block-content #mapel_id').val(mapel_id);
        modal.find('.block-content #kuis_name').val(kuis_name);
        modal.find('.block-content #kuis_desc').val(kuis_desc);
        modal.find('.block-content #slug').val(slug);     
    })
</script>
<script>
    $('#modal-fromleft-edit').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget)        
        var id = button.data('id')
        var user_id = button.data('user_id')
        var kelas_id = button.data('kelas_id')
        var mapel_id = button.data('mapel_id')
        var kuis_name = button.data('kuis_name')
        var kuis_desc = button.data('kuis_desc')
        var slug = button.data('slug')
        var modal = $(this)
        modal.find('.block-title').text('EDIT KUIS');        
        modal.find('.block-content #id').val(id);
        modal.find('.block-content #user_id').val(user_id);
        modal.find('.block-content #kelas_id').val(kelas_id);
        modal.find('.block-content #mapel_id').val(mapel_id);
        modal.find('.block-content #kuis_name').val(kuis_name);
        modal.find('.block-content #kuis_desc').val(kuis_desc);
        modal.find('.block-content #slug').val(slug);
    })
</script>
<script>
    function getslug(){
        var judul   =   document.getElementById('kuis_name').value;
        var data    =   document.getElementById('user_id').value;
        var slug    =   judul +'-'+ data;
        console.log('dor');
        document.getElementById('slug').value = slug;
    }    
</script>
@endsection