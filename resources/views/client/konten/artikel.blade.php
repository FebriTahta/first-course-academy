@extends('layouts.new_layouts.master')

@section('head')
<link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" id="css-main" href="{{ asset('assets/css/codebase.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/js/plugins/summernote/summernote-bs4.css') }}">
@endsection

@section('content')
<div class="w3l-homeblock2 w3l-homeblock6 py-5">
    <div class="container-fluid px-sm-5 py-lg-5 py-md-4">
        <h3 class="section-title-left mb-4 text-uppercase"> My Artikel</h3>
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
        {{-- table artikel --}}
        <div class="w3l-homeblock2 w3l-homeblock6 py-5" id="daftarakuis">
            <div class="container-fluid px-sm-5 py-lg-5 py-md-4">
                <div class="bg-clr-white" style="padding: 5%">
                    <a href="{{ route('createArtikel',$kursus->slug) }}" class="btn btn-primary fa fa-plus hover-box" style="margin-bottom: 10px"> Tambah &nbsp;</a>
                    <table class="table table-stripped table-vcenter" id="myArtikel">
                        <thead class="text-uppercase">
                            <tr>
                                <th class="d-none d-sm-table-cell" style="width: 5%">#</th>
                                <th>artikel</th>
                                <th>kategori</th>
                                <th class="text-right">opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($artikels as $key=>$artikel_item)
                            <tr>
                                <td class="d-none d-sm-table-cell" style="width: 5%">{{ $key+1 }}</td>
                                <td><a href="/artikel/{{ $artikel_item->id }}/{{ $artikel_item->slug }}" type="button" class="text-primary">{{ $artikel_item->artikel_title }}</a></td>
                                <td>{{ $artikel_item->mapel->mapel_name }} | {{ $artikel_item->kelas->kelas_name }}</th>
                                <td class="text-right">                                        
                                    <a href="/artikel/edit/{{ $kursus->slug }}/{{ $artikel_item->slug }}" type="button" class="btn btn-sm btn-primary hover-box"><i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-danger hover-box" type="button" data-toggle="modal" data-target="#modal-fromleft-remove" data-id="{{ $artikel_item->id }}"><i class="fa fa-trash"></i>
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

<!--modal add artikel-->    
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-info">
                    <h3 class="block-title">BUAT ARTIKEL</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="{{ route('uploadArtikel') }}" method="POST" enctype="multipart/form-data">@csrf
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="kursus_id">
                            <input type="hidden" class="form-control" name="id">
                            <input type="hidden" class="form-control" name="user_id" value="{{ auth()->user()->id }}">
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="kelas_id" id="kelas_id">
                                @foreach (auth()->user()->kursus as $item)
                                    <option value="{{ $item->kelas->id }}">{{ $item->kelas->kelas_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="mapel_id" id="mapel_id">
                                @foreach (auth()->user()->kursus as $item)
                                    <option value="{{ $item->mapel->id }}">{{ $item->mapel->mapel_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control" name="artikel_pict" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="artikel_title" placeholder="JUDUL ARTIKEL" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control js-summernote" name="artikel_text" id="artikel_text" cols="30" rows="10">GUNAKAN MODE FULL-SCREEN UNTUK LEBIH DETAIL</textarea>
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
<!--end modal add artikel--> 

<!--modal edit artikel-->    
<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content block-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-info">
                    <h3 class="block-title">BUAT ARTIKEL</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="{{ route('uploadArtikel') }}" method="POST" enctype="multipart/form-data">@csrf
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="kursus_id">
                            <input type="text" class="form-control" name="id" id="id">
                            <input type="hidden" class="form-control" name="user_id" value="{{ auth()->user()->id }}">
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="kelas_id" id="kelas_id">
                                @foreach (auth()->user()->kursus as $item)
                                    <option value="{{ $item->kelas->id }}">{{ $item->kelas->kelas_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control" name="artikel_pict" required>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="mapel_id" id="mapel_id">
                                @foreach (auth()->user()->kursus as $item)
                                    <option value="{{ $item->mapel->id }}">{{ $item->mapel->mapel_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="artikel_title" name="artikel_title" placeholder="JUDUL ARTIKEL" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control js-summernote" name="artikel_text" id="artikel_text" cols="30" rows="10">GUNAKAN MODE FULL-SCREEN UNTUK LEBIH DETAIL</textarea>
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
<!--end modal edit artikel--> 

<div class="modal fade" id="modal-fromleft-remove" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('removeArtikelsP') }}" method="POST" enctype="multipart/form-data">@csrf
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-danger">
                        <h3 class="block-title">HAPUS ARTIKEL</h3>
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
                                <p>Yakin akan menghapus artikel tersebut ?</p>
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
    var table3;
    $(document).ready(function(){    
        table3= $('#myArtikel').DataTable({});        
    });
</script>
<script>
    $('#myModalEdit').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget)        
        var id = button.data('id')
        var user_id = button.data('user_id')
        var mapel_id = button.data('mapel_id');
        var kelas_id = button.data('kelas_id');
        var artikel_title = button.data('artikel_title')
        var artikel_text = button.data('artikel_text')
        var modal = $(this)
        modal.find('.block-title').text('EDIT VIDEO');        
        modal.find('.block-content #id').val(id);
        modal.find('.block-content #user_id').val(user_id);
        modal.find('.block-content #kelas_id').val(kelas_id);
        modal.find('.block-content #mapel_id').val(mapel_id);
        modal.find('.block-content #artikel_title').val(artikel_title);
        modal.find('.block-content #artikel_text').val(artikel_text);
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