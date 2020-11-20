@extends('layouts.admin_layouts.master')

@section('content')
<!-- Hero -->
<div class="bg-image bg-image-bottom" style="background-image: url({{ asset('assets/media/photos/photo34@2x.jpg') }});">
    <div class="bg-primary-dark-op">
        <div class="content content-top text-center overflow-hidden">
            <div class="pb-10">
                <h1 class="font-w700 text-white mb-10 invisible" data-toggle="appear" data-class="animated fadeInUp">DAFTAR VIDEO</h1>
                <h2 class="h4 font-w400 text-white-op invisible" data-toggle="appear" data-class="animated fadeInUp"></h2>
            </div>
        </div>
    </div>
</div>
<!-- END Hero -->
    <div class="content">
        <div class="content-heading"><label>DAFTAR VIDEO</label></div>            
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
                <button class="btn btn-outline-primary fa fa-plus mb-10" data-toggle="modal" data-target="#modal-fromleft"> UPLOAD</button>
                <div class="block">
                    <div class="block-header block-header-default">
                        <div class="block-content text-center">
                            DAFTAR VIDEO
                        </div>
                    </div>
                    <div class="block-content">
                        <table class="table table-stripped" id="daftar_video">
                            <thead>
                                <tr>
                                    <th>VIDEO NAME</th>
                                    <th>KATEGORI</th>
                                    <th>UPLOADER</th>
                                    <th class="text-right border-bottom">OPSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($videos as $video_item)
                                <tr>
                                    <td><a type="button" class="si si-control-play view-video" data-video_link="{{ $video_item->video_link }}">&nbsp;&nbsp;&nbsp;&nbsp; {{ $video_item->video_name }}</a></td>                                    
                                    <td>{{ $video_item->mapel->mapel_name }} {{ $video_item->kelas->kelas_name }}</td>
                                    <td 
                                        @if ($video_item->user->role=='admin')
                                        class="text-success"
                                        @else
                                        class="text-primary"
                                        @endif 
                                    >   @if ($video_item->user->role=='admin')
                                        {{ $video_item->user->name }}
                                        @else
                                        <a href="/profile/{{ $video_item->user->id }}"> {{ $video_item->user->name }}</a>
                                        @endif</td>
                                    <td class="text-right">                                        
                                        <a href="#" class="fa fa-trash text-danger" type="button" data-toggle="modal" data-target="#modal-fromleft-remove" data-id="{{ $video_item->id }}"> HAPUS</a> &nbsp; &nbsp;
                                        <a href="#" type="button" data-toggle="modal" data-target="#modal-fromleft-edit" data-id="{{ $video_item->id }}"
                                            data-video_name="{{ $video_item->video_name }}" data-video_link="{{ $video_item->video_link }}" data-user_id="{{ $video_item->user_id }}"><i class="fa fa-pencil"></i> EDIT</a>                                        
                                    </td>
                                </tr>
                            @endforeach  
                            </tbody>
                        </table>
                    </div>
                </div> 
                @else
                <button class="btn btn-outline-primary fa fa-plus mb-10" data-toggle="modal" data-target="#modal-fromleft"> UPLOAD</button>
                <div class="block">
                    <div class="block-header block-header-default">
                        <div class="block-content text-center">
                            DAFTAR VIDEO
                        </div>
                    </div>
                    <div class="block-content">
                        <table class="table table-stripped" id="daftar_video">
                            <thead>
                                <tr>
                                    <th>VIDEO NAME</th>
                                    <th>KATEGORI</th>
                                    <th class="text-right border-bottom">EDIT</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($video as $video_item)
                                <tr>
                                    <td><a type="button" class="si si-control-play view-video" data-video_link="{{ $video_item->video_link }}">&nbsp;&nbsp;&nbsp;&nbsp; {{ $video_item->video_name }}</a></td>                                    
                                    <td>{{ $video_item->mapel->mapel_name }} {{ $video_item->kelas->kelas_name }}</td>
                                    <td class="text-right">                                        
                                        <a href="#" type="button" data-toggle="modal" data-target="#modal-fromleft-edit" data-id="{{ $video_item->id }}"
                                            data-video_name="{{ $video_item->video_name }}" data-video_link="{{ $video_item->video_link }}" data-user_id="{{ $video_item->user_id }}"><i class="fa fa-pencil"></i> EDIT</a>                                                                       
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
    <!--MODAL PLAY VIDEOS-->    
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
    <!--END MODAL PLAY VIDEOS-->    
<!--modal add video-->
<div class="modal fade" id="modal-fromleft" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('addVideo') }}" method="POST" enctype="multipart/form-data">@csrf                    
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
                                <input type="hidden" class="form-control" id="kursus_id" name="kursus_id"
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
                                <label for="name" class="control-label">video link ( embeded )</label>
                                
                                    <textarea class="form-control" name="video_link" id="video_link" rows="6" minlength="5" maxlength="500" required></textarea>                                    
                                
                            </div>
                            <label for="name" class="control-label">video name</label>
                            
                                <input type="text" class="form-control" id="video_name" name="video_name"
                                    value="" required>
                            
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
<!--end modal add video-->
<!--modal edit video-->
<div class="modal fade" id="modal-fromleft-edit" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('addVideo') }}" method="POST" enctype="multipart/form-data">@csrf                    
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">EDIT</h3>
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
                                <input type="hidden" class="form-control" id="kursus_id" name="kursus_id"
                                    value="" required>                                
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
                                <label for="name" class="control-label">video link ( embeded )</label>
                                
                                    <textarea class="form-control" name="video_link" id="video_link" rows="6" minlength="5" maxlength="500" required></textarea>                                    
                                
                            </div>
                            <label for="name" class="control-label">video name</label>
                            
                                <input type="text" class="form-control" id="video_name" name="video_name"
                                    value="" required>
                            
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
<!--end modal edit video-->
<!--modal edit video-->
<div class="modal fade" id="modal-fromleft-remove" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('removeVideoPermanen') }}" method="POST" enctype="multipart/form-data">@csrf                    
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
                            <div class="col-sm-12">
                                <input type="hidden" id="id" name="id">                                                             
                            </div>                            
                            <div class="form-group text-center text-danger border-bottom">
                                <p>VIDEO AKAN DIHAPUS PERMANEN DARI SISTEM!</p>
                            </div>
                            <div class="form-group text-center">
                                <p>Yakin akan menghapus video ini ?</p>
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
<!--end modal edit video-->
@endsection

@section('script')
<script>
    var table2;
    $(document).ready(function(){    
        table2= $('#daftar_video').DataTable({});        
    });
</script>

<script>
    $('#modal-fromleft-edit').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget)        
        var id = button.data('id')
        var user_id = button.data('user_id')
        var video_name = button.data('video_name')
        var video_link = button.data('video_link')
        var modal = $(this)
        modal.find('.block-title').text('HAPUS BUKU');        
        modal.find('.block-content #id').val(id);
        modal.find('.block-content #user_id').val(user_id);
        modal.find('.block-content #video_name').val(video_name);
        modal.find('.block-content #video_link').val(video_link);
    })
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

<script>
    var data = $("#playvideo").attr('src');
    //open modal and play video
    $(document).on('click','.view-video',function(){
        console.log($(this).attr('data-video_link'));
        $('#myModal').modal();
        $("#playvideo").attr('src', $(this).attr('data-video_link'));                  
        $('.block-title').text('Menonton');
    })      
    //close modal and stop play video
    $("#myModal").on('hide.bs.modal', function(){
            $("#playvideo").attr('src', '');
        });            
</script>
@endsection