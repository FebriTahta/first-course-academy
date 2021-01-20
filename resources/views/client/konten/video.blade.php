@extends('layouts.new_layouts.master')

@section('head')
<link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" id="css-main" href="{{ asset('assets/css/codebase.min.css') }}">
@endsection

@section('content')
<div class="w3l-homeblock2 w3l-homeblock6 py-5">
    <div class="container-fluid px-sm-5 py-lg-5 py-md-4">
        <h3 class="section-title-left mb-4 text-uppercase"> My Video</h3>
        {{-- content header --}}
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
            <div class="col-lg-6 mb-50">
                <div class="bg-clr-white">
                    <div class="row">                        
                        <div class="col-sm-12 card-body blog-details align-self">
                            <div class="pad" style="margin-left: 10%">
                                <p class="blog-desc jam text-bold" id="jam" ></p>
                                <a class="blog-desc waktu" id="waktu"> </a>                                
                            </div>                            
                            <div class="author mt-3" style="margin-left: 10%">
                                <img 
                                    @if (auth()->user()->profile->photo==null)
                                        src="{{ asset('assets/assets/images/a1.jpg') }}"
                                    @else
                                    src="{{ asset('photo/'.auth()->user()->profile->photo) }}"
                                    @endif alt="" class="img-fluid rounded-circle">
                                <ul class="blog-meta">
                                    <li>
                                        <a >{{ auth()->user()->name }}</a> 
                                    </li>
                                    <li class="meta-item blog-lesson">
                                        <span class="meta-value"> {{ auth()->user()->role }} </span>. <span class="meta-value ml-2"><span class="fa fa-check"></span></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-50">
                <div class="bg-clr-white" style="min-height: 232px; max-height: 232px">
                    <div class="row">                        
                        <div class="col-sm-12 card-body blog-details align-self">
                            <div class="pad" style="margin-left: 10%">
                                <p class="blog-desc"> Anda memiliki {{ count(auth()->user()->kursus) }} kursus sebagai berikut :</p>
                                @foreach (auth()->user()->kursus as $item)
                                <ul>
                                    <ol class="fa fa-check"> <a href="{{ route('myCourse',$item->slug) }}">{{ $item->mapel->mapel_name }} | {{ $item->kelas->kelas_name }}</a></ol>
                                </ul>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- table video --}}
        <div class="w3l-homeblock2 w3l-homeblock6 py-5" id="daftarakuis">
            <div class="container-fluid px-sm-5 py-lg-5 py-md-4">
                <div class="bg-clr-white" style="padding: 5%">
                    <button class="btn btn-primary fa fa-plus hover-box" style="margin-bottom: 10px" data-toggle="modal" data-target="#modal-fromleft"> Tambah &nbsp;</button>
                    <table class="table table-stripped table-vcenter" id="myvideo">
                        <thead class="text-uppercase">
                            <tr>
                                <th class="d-none d-sm-table-cell" style="width: 5%">#</th>
                                <th>video</th>
                                <th>kategori</th>
                                <th class="text-right">opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($video as $key=>$video_item)
                            <tr>
                                <td class="d-none d-sm-table-cell" style="width: 5%">{{ $key+1 }}</td>
                                <td><a type="button" class="view-video text-primary" data-video_link="{{ $video_item->video_link }}">{{ $video_item->video_name }}</a></td>
                                <td>{{ $video_item->mapel->mapel_name }} | {{ $video_item->kelas->kelas_name }}</th>
                                <td class="text-right">                                        
                                    <a href="#" type="button" class="btn btn-sm btn-primary hover-box" data-toggle="modal" data-target="#modal-fromleft-edit" data-id="{{ $video_item->id }}"
                                        data-video_name="{{ $video_item->video_name }}" data-video_link="{{ $video_item->video_link }}" data-user_id="{{ $video_item->user_id }}"><i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-danger hover-box" type="button" data-toggle="modal" data-target="#modal-fromleft-remove" data-id="{{ $video_item->id }}"
                                        data-video_name="{{ $video_item->video_name }}" data-video_link="{{ $video_item->video_link }}" data-user_id="{{ $video_item->user_id }}"><i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach                            
                        </tbody>
                    </table>
                </div>                
            </div>
        </div>
    </div>
</div>

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

<!--modal add video-->
<div class="modal fade" id="modal-fromleft" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('addVideo') }}" method="POST" enctype="multipart/form-data">@csrf                    
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-light">
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
                                <input type="hidden" class="form-control" id="kelas_id" name="kelas_id" value="{{ $kursus->kelas->id }}">
                                <input type="hidden" class="form-control" id="mapel_id" name="mapel_id" value="{{ $kursus->mapel->id }}">
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
                                <input type="hidden" class="form-control" id="kelas_id" name="kelas_id" value="{{ $kursus->kelas->id }}">
                                <input type="hidden" class="form-control" id="mapel_id" name="mapel_id" value="{{ $kursus->mapel->id }}">
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

<!--modal hapus video-->
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
<!--end modal hapus video-->

@endsection

@section('script')
<script>    
    var table3;
    $(document).ready(function(){    
        table3= $('#myvideo').DataTable({});        
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
        modal.find('.block-title').text('EDIT VIDEO');        
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
        modal.find('.block-title').text('HAPUS VIDEO');        
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

<script type="text/javascript">
    var months  =['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    var theDays =['Minggu','Senen','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    var date    = new Date();
    var day     = date.getDate();
    var month   = date.getMonth();
    var thisDay = date.getDay(),
        thisDay = theDays[thisDay];
    var yy      = date.getYear();
    var year    = (yy<1000) ? yy + 1900: yy;
    document.write(thisDay+',' + day + '' + months[month] + '' + year);
    document.getElementById("waktu").innerHTML=(thisDay+', ' + day + '' + months[month] + '' + year);
</script>
<script>
    function showtime()
    {            
        var today       = new Date();
        var curr_hour   = today.getHours();
        var curr_minute = today.getMinutes();
        var curr_second = today.getSeconds();            
        curr_hour       = checkTime(curr_hour);
        curr_minute     = checkTime(curr_minute);
        curr_second     = checkTime(curr_second);
        document.getElementById("jam").innerHTML=curr_hour+ ":" + curr_minute + ":" + curr_second ;                        
    }
    function checkTime(i){            
        if(i == 60){
            i = 60;
        }
        return i;        
    }
    setInterval(showtime, 500);
</script>
@endsection