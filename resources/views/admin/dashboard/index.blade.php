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
            <a class="block block-link-pop text-right bg-earth" href="{{ route('my-video') }}">
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
            <a class="block block-link-pop text-right bg-primary" href="{{ route('my-kursus') }}">
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
            <a class="block block-link-pop text-right bg-earth" href="{{ route('my-video') }}">
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
            <a class="block block-link-pop text-right bg-elegance" href="{{ route('my-kuis') }}">
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
            <a class="block block-link-pop text-right bg-corporate" href="{{ route('my-book') }}">
                <div class="block-content block-content-full clearfix border-black-op-b border-3x">
                    <div class="float-left mt-10 d-none d-sm-block">
                        <i class="fa fa-book fa-3x text-corporate-light"></i>
                    </div>
                    <div class="font-size-h3 font-w600 text-white" data-toggle="countTo" data-speed="1000" data-to="{{ auth()->user()->book->count() }}"></div>
                    <div class="font-size-sm font-w600 text-uppercase text-white-op">Buku</div>
                </div>
            </a>
        </div>                                                        

        <div class="col-xl-6">
            <div class="block block-mode-hidden">
                <div class="block-header block-header-default">
                {{-- nafigasi block --}}
                </div>
                <div class="block-conten border-bottom">                        
                    <div class="col-xl-12">
                        <a class="block block-link-shadow" href="javascript:void(0)">
                            <div class="block-content block-content-full clearfix">
                                <div class="text-right float-right mt-10">
                                    <div class="font-w600 mb-5">{{ auth()->user()->name }}</div>
                                    <div class="font-size-sm text-muted">{{ auth()->user()->email }}</div>
                                </div>
                                <div class="float-left">
                                    @if (auth()->user()->profile->photo==null)
                                    <img class="img-avatar" src="{{ asset('assets/media/avatars/avatar14.jpg') }}" alt="">
                                    @else
                                    <img class="img-avatar" src="{{ asset('photo/'.auth()->user()->profile->photo) }}" alt="">
                                    @endif                                        
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                
                <div class="block-header block-header-default ">
                    <h3 class="block-title">DATA DIRI</h3>
                    <div class="block-options">
                        <!-- To toggle block's content, just add the following properties to your button: data-toggle="block-option" data-action="content_toggle" -->
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                    </div>
                </div>
                <div class="block-content">
                    <form class="border-bottom" action="{{ route('storeProfile') }}" method="POST" enctype="multipart/form-data">@csrf
                        <div class="form-group">
                            <div class="form-material mb-10">
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <input type="text" class="form-control" id="val-alamat" name="alamat" placeholder="Alamat sekarang" value="{{ auth()->user()->profile->alamat }}" required>
                                <label for="val-alamat">Alamat</label>
                            </div>
                            <div class="form-material mb-10">
                                <input type="number" class="form-control" id="val-telp" name="telp" placeholder="Nomor Telepon" value="{{ auth()->user()->profile->telp }}" required>
                                <label for="val-telp">No.Telp</label>
                            </div>
                            <div class="form-material mb-10">
                                <select class="js-select2 form-control js-select2-enabled select2-hidden-accessible" id="val-gender" name="gender" style="width: 100%;" data-placeholder="Choose one.." data-select2-id="val-gender" tabindex="-1" aria-hidden="true" required>
                                    <option data-select2-id="5">{{ auth()->user()->profile->gender }}</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                    <option value="Yang lain">Yang Lain</option>
                                </select>
                                <label for="val-select2">Gender</label>
                            </div>
                            <div class="form-material mb-10">
                                <input type="text" class="form-control" id="val-alumni" name="alumni" placeholder="Alumni / Sekolah" value="{{ auth()->user()->profile->alumni }}" required>
                                <label for="val-alumni">Sekolah</label>
                            </div>
                            <div class="form-material mb-10">
                                <input type="file" class="form-control" id="val-photo" name="photo" accept=".jpg,.jpeg,.png">
                                <label for="val-photo">Photo</label>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-outline-primary">update</button>
                        </div>
                    </form>                        
                </div>
                <div class="block block-content bg-transparent">
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot / Reset Your Password?') }}
                    </a>
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