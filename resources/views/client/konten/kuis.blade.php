@extends('layouts.new_layouts.master')

@section('head')
<link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" id="css-main" href="{{ asset('assets/css/codebase.min.css') }}">
@endsection

@section('content')
<div class="w3l-homeblock2 w3l-homeblock6 py-5">
    <div class="container-fluid px-sm-5 py-lg-5 py-md-4">
        <h3 class="section-title-left mb-4 text-uppercase"> Latihan Soal</h3>
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
        {{-- table kuis --}}
        <div class="w3l-homeblock2 w3l-homeblock6 py-5" id="daftarakuis">
            <div class="container-fluid px-sm-5 py-lg-5 py-md-4">
                <div class="bg-clr-white" style="padding: 5%">
                    <button class="btn btn-primary fa fa-plus hover-box" style="margin-bottom: 10px" data-toggle="modal" data-target="#modal-fromleft"> Tambah &nbsp;</button>
                    <table class="table table-stripped table-vcenter" id="mykuis">
                        <thead class="text-uppercase">
                            <tr>
                                <th class="d-none d-sm-table-cell" style="width: 5%">#</th>
                                <th>Kuis</th>
                                <th>kategori</th>
                                <th class="d-none d-sm-table-cell">Soal</th>
                                <th class="text-right">opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kuis as $key=>$kuis_item)
                            <tr>
                                <td class="d-none d-sm-table-cell" style="width: 5%">{{ $key+1 }}</td>
                                <td><a href="/detail-latihan-soal/{{ $kuis_item->slug }}" class="text-primary">{{ $kuis_item->kuis_name }}</a></td>
                                <td>{{ $kuis_item->mapel->mapel_name }} | {{ $kuis_item->kelas->kelas_name }}</th>
                                <td class="d-none d-sm-table-cell">{{ $kuis_item->pertanyaan->count() }} Soal</td>
                                <td class="text-right">
                                    <a href="#" class="btn btn-sm btn-primary hover-box" type="button" data-toggle="modal" data-target="#modal-fromleft-edit" data-id="{{ $kuis_item->id }}"
                                        data-kuis_name="{{ $kuis_item->kuis_name }}" data-user_id="{{ $kuis_item->user_id }}" data-kuis_desc="{{ $kuis_item->kuis_desc }}" data-kelas_id="{{ $kuis_item->kelas->id }}" data-mapel_id="{{ $kuis_item->mapel->id }}"><i class="fa fa-pencil"></i> 
                                    </a>
                                    <a href="#" class="btn btn-sm btn-danger text-white hover-box" type="button" data-toggle="modal" data-target="#modal-fromleft-remove" data-id="{{ $kuis_item->id }}"
                                        data-kuis_name="{{ $kuis_item->kuis_name }}" data-user_id="{{ $kuis_item->user_id }}"><i class="fa fa-trash"></i> 
                                    </a>
                                    <a href="/buat-soal/{{ $kuis_item->id }}/{{ $kuis_item->slug }}" class="fa fa-plus text-uppercase btn btn-sm btn-success hover-box" type="button"> </a>
                                    <a href="#" class="fa fa-warning btn btn-sm btn-warning text-uppercase hover-box" data-target="#modal-fromleft-serahkan" data-toggle="modal" data-id="{{ $kuis_item->id }}" data-mapel_id="{{ $kuis_item->mapel_id }}" data-kelas_id="{{ $kuis_item->kelas_id }}" data-kuis_name="{{ $kuis_item->kuis_name }}" data-kuis_desc="{{ $kuis_item->kuis_desc }}" data-slug="{{ $kuis_item->slug }}"> </a>
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


<!--modal add kuis-->
<div class="modal fade" id="modal-fromleft" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('tambahkuis') }}" method="POST" enctype="multipart/form-data">@csrf                    
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
                                <label for="name" class="control-label">Kuis name</label>
                            
                                <input type="text" class="form-control" id="kuis_name" name="kuis_name"
                                    value="" required>
                            </div>

                            <div class="form-group">
                                <label for="name" class="control-label">Deskripsi singkat / catatan</label>
                                
                                    <textarea class="form-control" name="kuis_desc" rows="3" minlength="10" maxlength="255" required></textarea>
                                
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
<!--end modal add kuis-->

<!--modal edit kuis-->
<div class="modal fade" id="modal-fromleft-edit" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('tambahkuis') }}" method="POST" enctype="multipart/form-data">@csrf                    
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-light">
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
                                <input type="hidden" class="form-control" id="kelas_id" name="kelas_id">
                                <input type="hidden" class="form-control" id="mapel_id" name="mapel_id">
                            </div>

                            <div class="form-group">
                                <label for="name" class="control-label">kuis name</label>
                            
                                <input type="text" class="form-control" id="kuis_name" name="kuis_name"
                                    value="" required>
                            
                            </div>

                            <div class="form-group">
                                <label for="name" class="control-label">Deskripsi singkat / catatan </label>
                                
                                    <textarea class="form-control" name="kuis_desc" id="kuis_desc" rows="3" minlength="10" maxlength="255" required></textarea>                                    
                                
                            </div>                            
                            
                        </div>
                        <div class="form-group float-right">
                            <button class="btn btn-outline-primary fa fa-plus" type="submit"> UPDATE</button>
                        </div>
                    </div>                                                               
                </div>                        
            </form>                   
        </div>            
    </div>
</div>
<!--end modal edit kuis-->

<!--modal hapus kuis-->
<div class="modal fade" id="modal-fromleft-remove" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('hapuskuis') }}" method="POST" enctype="multipart/form-data">@csrf                    
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
                                <p>KUIS AKAN DIHAPUS PERMANEN DARI SISTEM!</p>
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
<!--end modal hapus kuis-->

<!--modal serahkan KUIS-->
<div class="modal fade" id="modal-fromleft-serahkan" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('addKuis') }}" method="POST" enctype="multipart/form-data">@csrf                    
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-warning">
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

@endsection

@section('script')
<script>    
    var table3;
    $(document).ready(function(){    
        table3= $('#mykuis').DataTable({});        
    });
</script>
<script>
    $('#modal-fromleft-edit').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget)        
        var id = button.data('id')
        var user_id = button.data('user_id')
        var kuis_name = button.data('kuis_name')
        var kuis_desc = button.data('kuis_desc')
        var kelas_id = button.data('kelas_id')
        var mapel_id = button.data('mapel_id')
        var modal = $(this)
        modal.find('.block-title').text('EDIT KUIS');        
        modal.find('.block-content #id').val(id);
        modal.find('.block-content #user_id').val(user_id);
        modal.find('.block-content #kuis_name').val(kuis_name);
        modal.find('.block-content #kuis_desc').val(kuis_desc);
        modal.find('.block-content #kelas_id').val(kelas_id);
        modal.find('.block-content #mapel_id').val(mapel_id);
    })
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