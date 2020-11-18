@extends('layouts.admin_layouts.master')

@section('content')
<!-- Hero -->
<div class="bg-image bg-image-bottom" style="background-image: url({{ asset('assets/media/photos/photo34@2x.jpg') }});">
    <div class="bg-primary-dark-op">
        <div class="content content-top text-center overflow-hidden">
            <h5 class="h4 font-w400 text-white-op invisible" data-toggle="appear" data-class="animated fadeInUp">DASHBOARD <br> <small class="text-white">welcome to your dashboard</small></h5>
        </div>
    </div>
</div>
<!-- END Hero -->
<div class="content">
    @if (auth()->user()->role=='admin')
    <div class="row">
        <div class="col-xl-12">
            <h2 class="content-heading">DASHBOARD <small> pusat informasi</small></h2>
            @if (Session::has('pesan-bahaya'))
            <div class="alert alert-danger text-bold">{{ Session::get('message') }}</div>                
            @endif
            @if (Session::has('pesan-peringatan'))
                    <div class="alert alert-warning text-bold">{{ Session::get('pesan-peringatan') }}</div>                
            @endif
            @if (Session::has('pesan-info'))
                <div class="alert alert-info text-bold">{{ Session::get('pesan-sukses') }}</div>
            @endif
        </div>
        <div class="col-6 col-xl-3">
            <a class="block block-link-pop text-right bg-primary" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix border-black-op-b border-3x">
                    <div class="float-left mt-10 d-none d-sm-block">
                        <i class="si si-bar-chart fa-3x text-primary-light"></i>
                    </div>
                    <div class="font-size-h3 font-w600 text-white" data-toggle="countTo" data-speed="1000" data-to="{{ $data_kursus->count() }}"></div>
                    <div class="font-size-sm font-w600 text-uppercase text-white-op">Kursus</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-xl-3">
            <a class="block block-link-pop text-right bg-earth" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix border-black-op-b border-3x">
                    <div class="float-left mt-10 d-none d-sm-block">
                        <i class="fa fa-film fa-3x text-earth-light"></i>
                    </div>
                    <div class="font-size-h3 font-w600 text-white"><span data-toggle="countTo" data-speed="1000" data-to="{{ $data_video->count() }}"></span></div>
                    <div class="font-size-sm font-w600 text-uppercase text-white-op">Video</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-xl-3">
            <a class="block block-link-pop text-right bg-elegance" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix border-black-op-b border-3x">
                    <div class="float-left mt-10 d-none d-sm-block">
                        <i class="fa fa-pencil fa-3x text-elegance-light"></i>
                    </div>
                    <div class="font-size-h3 font-w600 text-white" data-toggle="countTo" data-speed="1000" data-to="{{ $data_kuis->count() }}"></div>
                    <div class="font-size-sm font-w600 text-uppercase text-white-op">Kuis</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-xl-3">
            <a class="block block-link-pop text-right bg-corporate" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix border-black-op-b border-3x">
                    <div class="float-left mt-10 d-none d-sm-block">
                        <i class="fa fa-book fa-3x text-corporate-light"></i>
                    </div>
                    <div class="font-size-h3 font-w600 text-white" data-toggle="countTo" data-speed="1000" data-to="{{ $data_buku->count() }}"></div>
                    <div class="font-size-sm font-w600 text-uppercase text-white-op">Buku</div>
                </div>
            </a>
        </div>
    </div>
    <div class="row invisible" data-toggle="appear">
        <!-- Row #4 -->
        <div class="col-md-4">
            <div class="block">
                <div class="block-content block-content-full">
                    <div class="py-20 text-center">
                        <div class="mb-20">
                            <i class="fa fa-group fa-3x text-success"></i>
                        </div>
                        <div class="font-size-h4 font-w600">{{ $data_instruktur->count() }} Instruktur</div>
                        <div class="text-muted">Instruktur aktif</div>
                        <div class="pt-20">
                            <a class="btn btn-rounded btn-alt-success" href="{{ route('daftar_user.index') }}">
                                <i class="fa fa-check mr-5"></i> cek detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="block">
                <div class="block-content block-content-full">
                    <div class="py-20 text-center">
                        <div class="mb-20">
                            <i class="fa fa-group fa-3x text-warning"></i>
                        </div>
                        <div class="font-size-h4 font-w600">{{ $data_siswa->count() }} Siswa</div>
                        <div class="text-muted">Siswa Aktif</div>
                        <div class="pt-20">
                            <a class="btn btn-rounded btn-alt-warning" href="{{ route('daftar_user.index') }}">
                                <i class="fa fa-check mr-5"></i> cek detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="block">
                <div class="block-content block-content-full">
                    <div class="py-20 text-center">
                        <div class="mb-20">
                            <i class="fa fa-group fa-3x text-info"></i>
                        </div>
                        <div class="font-size-h4 font-w600">{{ $data_user_non_acc->count() }} non aktif</div>
                        <div class="text-muted">pengguna non aktif / belum di setujui.</div>
                        <div class="pt-20">
                            <a class="btn btn-rounded btn-alt-info" href="{{ route('daftar_user.index') }}">
                                <i class="fa fa-check mr-5"></i> cek detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Row #4 -->
    </div>
    @else
    <div class="row">
        <div class="col-xl-12">
            <div class="content-heading"><a href="/">Homepage </a>| Dashboard</div>
            @if (Session::has('pesan-bahaya'))
            <div class="alert alert-danger text-bold">{{ Session::get('message') }}</div>                
            @endif
            @if (Session::has('pesan-peringatan'))
                    <div class="alert alert-warning text-bold">{{ Session::get('pesan-peringatan') }}</div>                
            @endif
            @if (Session::has('pesan-info'))
                <div class="alert alert-info text-bold">{{ Session::get('pesan-sukses') }}</div>
            @endif
        </div>
        <div class="col-6 col-xl-3">
            <a class="block block-link-pop text-right bg-primary" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix border-black-op-b border-3x">
                    <div class="float-left mt-10 d-none d-sm-block">
                        <i class="si si-bar-chart fa-3x text-primary-light"></i>
                    </div>
                    <div class="font-size-h3 font-w600 text-white" data-toggle="countTo" data-speed="1000" data-to="{{ auth()->user()->kursus->count() }}"></div>
                    <div class="font-size-sm font-w600 text-uppercase text-white-op">Kursus</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-xl-3">
            <a class="block block-link-pop text-right bg-earth" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix border-black-op-b border-3x">
                    <div class="float-left mt-10 d-none d-sm-block">
                        <i class="fa fa-film fa-3x text-earth-light"></i>
                    </div>
                    <div class="font-size-h3 font-w600 text-white"><span data-toggle="countTo" data-speed="1000" data-to="{{ auth()->user()->video->count() }}"></span></div>
                    <div class="font-size-sm font-w600 text-uppercase text-white-op">Video</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-xl-3">
            <a class="block block-link-pop text-right bg-elegance" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix border-black-op-b border-3x">
                    <div class="float-left mt-10 d-none d-sm-block">
                        <i class="fa fa-pencil fa-3x text-elegance-light"></i>
                    </div>
                    <div class="font-size-h3 font-w600 text-white" data-toggle="countTo" data-speed="1000" data-to="{{ auth()->user()->kuis->count() }}"></div>
                    <div class="font-size-sm font-w600 text-uppercase text-white-op">Kuis</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-xl-3">
            <a class="block block-link-pop text-right bg-corporate" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix border-black-op-b border-3x">
                    <div class="float-left mt-10 d-none d-sm-block">
                        <i class="fa fa-book fa-3x text-corporate-light"></i>
                    </div>
                    <div class="font-size-h3 font-w600 text-white" data-toggle="countTo" data-speed="1000" data-to="100"></div>
                    <div class="font-size-sm font-w600 text-uppercase text-white-op">Buku</div>
                </div>
            </a>
        </div>                                                        

        <div class="col-xl-6">            
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <div class="block-content text-center">
                        KURSUS SAYA
                    </div>
                </div>
                <div class="block-content">
                    <table class="table table-stripped" id="daftar_kursus">
                        <thead>
                            <tr>
                                <th>mapel</th>
                                <th>kelas</th>
                                <th class="text-right">option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (auth()->user()->kursus as $item)                            
                                <tr>
                                    <td>{{ $item->mapel->mapel_name }}</td>
                                    <td class="text-left">{{ $item->kelas->kelas_name }}</td>
                                    <td class="text-right">
                                        <a href="/kursus/{{ $item->slug }}">check</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>                        
                    </table>                                            
                </div>            
            </div>        
        </div>

        <div class="col-xl-6">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <div class="block-content text-center">
                        PENGAJUAN RESET HASIL KUIS
                    </div>
                </div>
                <div class="block-content">
                    <table table class="table table-stripped" id="daftar_reset">
                        <thead>
                            <tr>
                                <th>NAMA</th>
                                <th class="text-right">PENGAJUAN</th>
                            </tr>
                        </thead>
                        <tbody>                                                        
                            @foreach (auth()->user()->reset as $item)
                                @if ($item->count() == 0)                                
                                @else
                                    <tr>
                                        <td>{{ $item->profile->user->name }}</td>                                        
                                        <td class="text-right">
                                            <a href="#" class="text-warning" data-toggle="modal" data-target="#modal-fromleft-reset"
                                            data-user_id="{{ $item->profile->user->id }}" data-kuis_id="{{ $item->kuis_id }}" data-id="{{ $item->id }}"><i class="fa fa-warning"></i> reset</a>
                                            <a href="/detail-result-siswa/{{ $item->kuis->slug }}/{{ $item->profile->user->id }}"><i class="fa fa-check"></i> detail</a>
                                        </td>
                                    </tr>
                                @endif                                
                            @endforeach                            
                        </tbody>
                    </table>                    
                </div>                
            </div>
        </div>        
    </div>
    @endif
</div>
<!--modal dajukan reset-->
<div class="modal fade" id="modal-fromleft-reset" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('resetkuis') }}" method="POST" enctype="multipart/form-data">@csrf
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-danger">
                        <h3 class="block-title">RESET</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>                    
                    <div class="block-content">                            
                        <div class="form-group">                            
                            <div class="block-content text-center">                                
                                <p>Anda yakin ingin mereset hasil kuis ini ? </p>
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="kuis_id" id="kuis_id">                                
                                <input type="hidden" name="user_id" id="user_id">
                            </div>
                        </div>                        
                        <div class="form-group float-left">
                            <button type="submit" class="btn btn-outline-warning">reset</button>
                        </div>                        
                    </div>                                                             
                </div>                        
            </form>                   
        </div>
    </div>
</div>
<!--end modal ajukan reset-->

@endsection

@section('script')
    <script>
    var table2;
    var table;
    $(document).ready(function(){    
        table2= $('#daftar_reset').DataTable({});        
    });
    $(document).ready(function(){    
        table= $('#daftar_kursus').DataTable({});        
    });    
    </script>

    <script>
        $('#modal-fromleft-reset').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget) 
        var id = button.data('id')               
        var kuis_id = button.data('kuis_id')
        var user_id = button.data('user_id') 
        var modal = $(this)
        modal.find('.block-title').text('RESET HASIL KUIS');
        modal.find('.block-content #id').val(id);    
        modal.find('.block-content #kuis_id').val(kuis_id);    
        modal.find('.block-content #user_id').val(user_id);
    });
    </script>
    
@endsection