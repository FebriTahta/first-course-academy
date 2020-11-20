@extends('layouts.admin_layouts.master')

@section('content')
<!-- Hero -->
<div class="bg-image bg-image-bottom" style="background-image: url({{ asset('assets/media/photos/photo34@2x.jpg') }});">
    <div class="bg-primary-dark-op">
        <div class="content content-top text-center overflow-hidden">
            <div class="pb-10">
                <h1 class="font-w700 text-white mb-10 invisible" data-toggle="appear" data-class="animated fadeInUp">DAFTAR BUKU</h1>
                <h2 class="h4 font-w400 text-white-op invisible" data-toggle="appear" data-class="animated fadeInUp"></h2>
            </div>
        </div>
    </div>
</div>
<!-- END Hero -->

    <div class="content">
        <div class="col-12">
            <div class="content-heading"><label>DAFTAR BUKU</label></div>            
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

            @if ($users->role === 'instruktur')
            <button class="btn btn-outline-info fa fa-plus mb-10" data-toggle="modal" data-target="#modal-fromright_book"> UPLOAD</button>
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <div class="block-content text-center">
                        MY BOOK
                    </div>
                </div>
                <div class="block-content">
                    <table table class="table table-stripped" id="table_book_kursus">
                        <thead>
                            <tr>
                                <th>BOOK NAME</th>
                                <th>KATEGORI</th>
                                <th class="text-right">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>                                                        
                            @foreach ($book as $item)
                                @if ($item->count() == 0)                             
                                @else
                                    <tr>
                                        <td>{{ $item->book_name }}</td>
                                        <td>{{ $item->mapel->mapel_name }} {{ $item->kelas->kelas_name }}</td>
                                        <td class="text-right">                                            
                                            <a href="{{ route('download', $item->book_file) }}"><i class="fa fa-check"></i> UNDUH</a>
                                        </td>
                                    </tr>
                                @endif                                
                            @endforeach                            
                        </tbody>
                    </table>                    
                </div>                
            </div>
            @else            
            <button class="btn btn-outline-info fa fa-plus mb-10" data-toggle="modal" data-target="#modal-fromright_book"> UPLOAD</button>
            <div class="block block-rounded">                
                <div class="block-header block-header-default">
                    <div class="block-content text-center">
                        DAFTAR BUKU
                    </div>
                </div>
                <div class="block-content">
                    <table table class="table table-stripped" id="table_book_kursuss">
                        <thead>
                            <tr>
                                <th>BOOK NAME</th>
                                <th>KATEGORI</th>
                                <th>UPLOADER</th>
                                <th class="text-right">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>                                                        
                            @foreach ($books as $item)
                                @if ($item->count() == 0)                             
                                @else
                                    <tr>
                                        <td>{{ $item->book_name }}</td>
                                        <td>{{ $item->mapel->mapel_name }} {{ $item->kelas->kelas_name }}</td>
                                        <td 
                                            @if ($item->user->role=='admin') 
                                                class="text-success"
                                            @else
                                                class="text-primary"
                                            @endif >
                                                @if ($item->user->role=='admin')
                                                    {{ $item->user->name }}
                                                @else
                                                <a href="/profile/{{ $item->user->id }}">{{ $item->user->name }}</a>
                                                @endif 
                                        </td>
                                        <td class="text-right">
                                            <a href="#" class="fa fa-trash text-danger" data-toggle="modal" data-target="#modal-fromleft-remove" data-id="{{ $item->id }}"> hapus</a> &nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="{{ route('download', $item->book_file) }}"><i class="fa fa-check"></i> unduh</a>
                                        </td>
                                    </tr>
                                @endif                                
                            @endforeach                            
                        </tbody>
                    </table>                    
                </div>                
            </div>
            @endif            
        </div>
    </div>

    {{-- modal upload --}}    
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
                                    value="{{ $user }}" required>
                                <input type="hidden" class="form-control" id="kursus_id" name="kursus_id"
                                    value="" required>                                
                            </div>
                            <div class="form-group">
                                <select name="kelas_id" class="form-control" id="kelas_id">
                                    @foreach ($kelass as $items)
                                        <option value="{{ $items->id }}">{{ $items->kelas_name }}</option>
                                    @endforeach                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="mapel_id" class="form-control" id="mapel_id">
                                    @foreach ($mapels as $items)
                                        <option value="{{ $items->id }}">{{ $items->mapel_name }}</option>
                                    @endforeach                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name" class="control-label">JUDUL</label>
                                
                                    <input type="text" class="form-control" id="book_name" name="book_name"
                                        value="" required>
                                
                            </div>
                            <div class="form-group">
                                <label for="name" class="control-label">FILE</label>
                                
                                    <input type="file" class="form-control" name="book_file" id="book_file" accept=".docx,.pdf">
                                
                            </div>
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
<!--end modal add file-->
    {{-- modal hapus --}}
    <div class="modal fade" id="modal-fromleft-remove" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
        <div class="modal-dialog modal-dialog-fromleft" role="document">                            
            <div class="modal-content">
                <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('hapusBukuPermanen') }}" method="POST" enctype="multipart/form-data">@csrf
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-danger">
                            <h3 class="block-title">HAPUS BUKU</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
    
                        <div class="block-content">                            
                            <div class="form-group">
                                <div class="form-group text-center">
                                    <p class="text-danger">BUKU TERSEBUT AKAN DIHAPUS PERMANEN DARI SISTEM!</p>
                                </div>
                                <div class="col-sm-12 form-group text-center border-bottom">
                                    <input type="hidden" class="form-control" id="id" name="id"
                                        value="" required>
                                    <p>Yakin akan menghapus buku tersebut ?</p>
                                </div>                            
                                <div class="col-sm-4 form-group">
                                    <button class="btn btn-outline-danger fa fa-trash" type="submit"> hapus</button>
                                </div>
                            </div>
                        </div>                                                             
                    </div>                        
                </form>                   
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    var table2;
    $(document).ready(function(){    
        table2= $('#table_book_kursus').DataTable({});        
    });
    var table;
    $(document).ready(function(){    
        table= $('#table_book_kursuss').DataTable({});        
    });
</script>

<script>
    $('#modal-fromleft-remove').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget)        
        var id = button.data('id')                
        var modal = $(this)
        modal.find('.block-title').text('HAPUS BUKU');        
        modal.find('.block-content #id').val(id);
    })
</script>
@endsection

