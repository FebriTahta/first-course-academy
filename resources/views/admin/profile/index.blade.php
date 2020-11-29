@extends('layouts.admin_layouts.master')
@section('content')
<!-- Hero -->
<div class="bg-image bg-image-bottom" style="background-image: url({{ asset('assets/media/photos/photo34@2x.jpg') }});">
    <div class="bg-primary-dark-op">
        <div class="content content-top text-center overflow-hidden">
            <h5 class="h4 font-w400 text-white-op invisible" data-toggle="appear" data-class="animated fadeInUp">PROFILE <br> <small class="text-white">data pribadi pengguna sistem</small></h5>
        </div>
    </div>
</div>
<!-- END Hero -->

<div class="content">
    <div class="row">
        @if ($data_profile->user->role=='instruktur')
        <div class="col-xl-12">
            <h2 class="content-heading"><a href="{{ route('home') }}"> DASHBOARD </a><small>| Akun</small></h2>
            @if (Session::has('message'))
            <div class="alert alert-danger text-bold">{{ Session::get('message') }}</div>                
            @endif
            @if (Session::has('pesan-peringatan'))
                    <div class="alert alert-warning text-bold">{{ Session::get('pesan-peringatan') }}</div>                
            @endif
            @if (Session::has('pesan-sukses'))
                <div class="alert alert-info text-bold">{{ Session::get('pesan-sukses') }}</div>
            @endif
        </div>

        <div class="col-xl-4">
            <div class="block block-mode-hidden">
                <div class="block-header block-header-default">
                {{-- nafigasi block --}}
                </div>
                <div class="block-conten border-bottom">
                    <div class="block-conten border-bottom">                        
                        <div class="col-xl-12">
                            <a class="block block-link-shadow" href="javascript:void(0)">
                                <div class="block-content block-content-full clearfix">
                                    <div class="text-right float-right mt-10">
                                        <div class="font-w600 mb-5">{{ $data_profile->user->name }}</div>
                                        <div class="font-size-sm text-muted">{{ $data_profile->user->email }}</div>
                                    </div>
                                    <div class="float-left">
                                        @if ($data_profile->photo==null)
                                        <img class="img-avatar" src="{{ asset('assets/media/avatars/avatar14.jpg') }}" alt="">
                                        @else
                                        <img class="img-avatar" src="{{ asset('photo/'.$data_profile->photo) }}" alt="">
                                        @endif                                        
                                    </div>
                                </div>
                                <div class="block-content">
                                    <label class="css-control css-control-success css-switch">
                                        <input data-id="{{ $data_profile->user_id }}" type="checkbox" class="css-control-input" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Inactive" {{ $data_profile->user->stat ? 'checked' : '' }}>
                                        <span class="css-control-indicator"></span>
                                    </label>
                                    <p class="float-right"> ubah status</p>
                                </div>
                                <div class="block-content mt-10"></div>
                            </a>
                        </div>
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
                                <input type="hidden" name="user_id" value="{{ $data_profile->user_id }}">
                                <input type="text" class="form-control" id="val-alamat" name="alamat" placeholder="Alamat sekarang" value="{{ $data_profile->alamat }}" required>
                                <label for="val-alamat">Alamat</label>
                            </div>
                            <div class="form-material mb-10">
                                <input type="number" class="form-control" id="val-telp" name="telp" placeholder="Nomor Telepon" value="{{ $data_profile->telp }}" required>
                                <label for="val-telp">No.Telp</label>
                            </div>
                            <div class="form-material mb-10">
                                <select class="js-select2 form-control js-select2-enabled select2-hidden-accessible" id="val-gender" name="gender" style="width: 100%;" data-placeholder="Choose one.." data-select2-id="val-gender" tabindex="-1" aria-hidden="true" required>
                                    <option data-select2-id="5">{{ $data_profile->gender }}</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                    <option value="Yang lain">Yang Lain</option>
                                </select>
                                <label for="val-select2">Gender</label>
                            </div>
                            <div class="form-material mb-10">
                                <input type="text" class="form-control" id="val-alumni" name="alumni" placeholder="Alumni / Sekolah" value="{{ $data_profile->alumni }}" required>
                                <label for="val-alumni">Alumni</label>
                            </div>
                            <div class="form-material mb-10">
                                <input type="file" class="form-control" id="val-photo" name="photo" accept=".jpg,.jpeg,.png">
                                <label for="val-photo">Photo</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-primary">update</button>
                        </div>
                    </form>                   
                </div>                                        
            </div>
            <div class="row">
                <div class="col-6 col-xl-6">
                    <a class="block block-link-pop text-right bg-primary" href="javascript:void(0)">
                        <div class="block-content block-content-full clearfix border-black-op-b border-3x">
                            <div class="float-left mt-10 d-none d-sm-block">
                                <i class="si si-bar-chart fa-3x text-primary-light"></i>
                            </div>
                            <div class="font-size-h3 font-w600 text-white" data-toggle="countTo" data-speed="1000" data-to="{{ $data_profile->user->kursus->count() }}"></div>
                            <div class="font-size-sm font-w600 text-uppercase text-white-op">Kursus</div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-xl-6">
                    <a class="block block-link-pop text-right bg-earth" href="javascript:void(0)">
                        <div class="block-content block-content-full clearfix border-black-op-b border-3x">
                            <div class="float-left mt-10 d-none d-sm-block">
                                <i class="fa fa-film fa-3x text-earth-light"></i>
                            </div>
                            <div class="font-size-h3 font-w600 text-white"><span data-toggle="countTo" data-speed="1000" data-to="{{ $data_profile->user->video->count() }}"></span></div>
                            <div class="font-size-sm font-w600 text-uppercase text-white-op">Video</div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-xl-6">
                    <a class="block block-link-pop text-right bg-elegance" href="javascript:void(0)">
                        <div class="block-content block-content-full clearfix border-black-op-b border-3x">
                            <div class="float-left mt-10 d-none d-sm-block">
                                <i class="fa fa-pencil fa-3x text-elegance-light"></i>
                            </div>
                            <div class="font-size-h3 font-w600 text-white" data-toggle="countTo" data-speed="1000" data-to="{{ $data_profile->user->kuis->count() }}"></div>
                            <div class="font-size-sm font-w600 text-uppercase text-white-op">Kuis</div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-xl-6">
                    <a class="block block-link-pop text-right bg-corporate" href="javascript:void(0)">
                        <div class="block-content block-content-full clearfix border-black-op-b border-3x">
                            <div class="float-left mt-10 d-none d-sm-block">
                                <i class="fa fa-book fa-3x text-corporate-light"></i>
                            </div>
                            <div class="font-size-h3 font-w600 text-white" data-toggle="countTo" data-speed="1000" data-to="{{ $data_profile->user->book->count() }}"></div>
                            <div class="font-size-sm font-w600 text-uppercase text-white-op">Buku</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="block">
                <div class="block-header block-header-default">
                {{-- nafigasi block --}}
                </div>

                <div class="block-content border-bottom">
                    <p class="text-center">KURSUS</p>
                </div>
                <div class="block-content">
                    <table class="table table-borderless">
                        @foreach ($data_profile->user->kursus as $item)
                            <tr>
                                <td class=""><img class="img-avatar" src="{{ asset('kursus_picture/'.$item->kursus_pict) }}" alt=""></td>
                                <td class="text-center">{{ $item->mapel->mapel_name }} {{ $item->kelas->kelas_name }}</td>
                                <td class="float-right">
                                    <a href="{{ route('kursus', $item->slug) }}" type="button" class="btn btn-outline-primary">pergi</a>
                                </td>                                    
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

            
        </div>
        @elseif($data_profile->user->role=='siswa')
        <div class="col-xl-12">
            <h2 class="content-heading"><a href="{{ route('home') }}"> DASHBOARD </a><small>| Akun</small></h2>
            @if (Session::has('message'))
            <div class="alert alert-danger text-bold">{{ Session::get('message') }}</div>                
            @endif
            @if (Session::has('pesan-peringatan'))
                    <div class="alert alert-warning text-bold">{{ Session::get('pesan-peringatan') }}</div>                
            @endif
            @if (Session::has('pesan-sukses'))
                <div class="alert alert-info text-bold">{{ Session::get('pesan-sukses') }}</div>
            @endif
        </div>

        <div class="col-xl-4">
            <div class="block block-mode-hidden">
                <div class="block-header block-header-default">
                {{-- nafigasi block --}}
                </div>
                <div class="block-conten border-bottom">
                    <div class="block-conten border-bottom">                        
                        <div class="col-xl-12">
                            <a class="block block-link-shadow" href="javascript:void(0)">
                                <div class="block-content block-content-full clearfix">
                                    <div class="text-right float-right mt-10">
                                        <div class="font-w600 mb-5">{{ $data_profile->user->name }}</div>
                                        <div class="font-size-sm text-muted">{{ $data_profile->user->email }}</div>
                                    </div>
                                    <div class="float-left">
                                        @if ($data_profile->photo==null)
                                        <img class="img-avatar" src="{{ asset('assets/media/avatars/avatar14.jpg') }}" alt="">
                                        @else
                                        <img class="img-avatar" src="{{ asset('photo/'.$data_profile->photo) }}" alt="">
                                        @endif                                        
                                    </div>
                                </div>
                                <div class="block-content">
                                    <label class="css-control css-control-success css-switch">
                                        <input data-id="{{ $data_profile->user_id }}" type="checkbox" class="css-control-input" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Inactive" {{ $data_profile->user->stat ? 'checked' : '' }}>
                                        <span class="css-control-indicator"></span>
                                    </label>
                                    <p class="float-right"> ubah status</p>
                                </div>
                                <div class="block-content mt-10"></div>
                            </a>
                        </div>
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
                                <input type="hidden" name="user_id" value="{{ $data_profile->user_id }}">
                                <input type="text" class="form-control" id="val-alamat" name="alamat" placeholder="Alamat sekarang" value="{{ $data_profile->alamat }}" >
                                <label for="val-alamat">Alamat</label>
                            </div>
                            <div class="form-material mb-10">
                                <input type="number" class="form-control" id="val-telp" name="telp" placeholder="Nomor Telepon" value="{{ $data_profile->telp }}" >
                                <label for="val-telp">No.Telp</label>
                            </div>
                            <div class="form-material mb-10">
                                <select class="js-select2 form-control js-select2-enabled select2-hidden-accessible" id="val-gender" name="gender" style="width: 100%;" data-placeholder="Choose one.." data-select2-id="val-gender" tabindex="-1" aria-hidden="true" required>
                                    <option data-select2-id="5">{{ $data_profile->gender }}</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                    <option value="Yang lain">Yang Lain</option>
                                </select>
                                <label for="val-select2">Gender</label>
                            </div>
                            <div class="form-material mb-10">
                                <input type="text" class="form-control" id="val-alumni" name="alumni" placeholder="Alumni / Sekolah" value="{{ $data_profile->alumni }}">
                                <label for="val-alumni">Sekolah</label>
                            </div>
                            <div class="form-material mb-10">
                                <input type="file" class="form-control" id="val-photo" name="photo">
                                <label for="val-photo">Photo</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-primary">update</button>
                        </div>
                    </form>                  
                </div>                
            </div>                        
        </div>

        <div class="col-xl-8">
            <div class="block">
                <div class="block-header block-header-default">
                {{-- nafigasi block --}}
                </div>

                <div class="block-content border-bottom">
                    <p class="text-center"></p>
                </div>
                <div class="block-content">
                    <table class="table table-borderless">
                        @foreach ($data_profile->kursus as $item)
                            <tr>
                                <td class=""><img class="img-avatar" src="{{ asset('kursus_picture/'.$item->kursus_pict) }}" alt=""></td>
                                <td class="">{{ $item->mapel->mapel_name }} {{ $item->kelas->kelas_name }}</td>                                    
                                <td class="float-right">
                                    <a href="{{ route('kursus', $item->slug) }}" type="button" class="btn btn-outline-primary">pergi</a>
                                </td>                                    
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            
            <div class="block">
                @foreach ($data_profile->kursus as $item)                                    
                    <div class="block-header block-header-default">
                        <p>Kuis : {{ $item->mapel->mapel_name }} {{ $item->kelas->kelas_name }}</p>
                    </div>
                    <div class="block-content">
                        @foreach ($item->kuis as $items)                                                    
                        <ul>
                            <li>{{ $items->kuis_name }}
                                <?php $sudah_dikerjakan = App\Result::where('user_id', $data_profile->user_id)->where('kuis_id', $items->id)->first()?>
                                @if ($sudah_dikerjakan==null)
                                    <a class="float-right text-danger" href="#"> belum</a>
                                @else
                                    <a class="float-right" href="#"> sudah</a>
                                @endif                                
                            </li>                            
                        </ul>                        
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>        
        @else
        <div class="col-xl-12">
            <h2 class="content-heading"><a href="{{ route('home') }}"> DASHBOARD </a><small>| Akun</small></h2>
            @if (Session::has('message'))
            <div class="alert alert-danger text-bold">{{ Session::get('message') }}</div>                
            @endif
            @if (Session::has('pesan-peringatan'))
                    <div class="alert alert-warning text-bold">{{ Session::get('pesan-peringatan') }}</div>                
            @endif
            @if (Session::has('pesan-sukses'))
                <div class="alert alert-info text-bold">{{ Session::get('pesan-sukses') }}</div>
            @endif
        </div>

        <div class="col-xl-4">
            <div class="block block-mode-hidden">
                <div class="block-header block-header-default">
                {{-- nafigasi block --}}
                </div>
                <div class="block-conten border-bottom">
                    <div class="block-conten border-bottom">                        
                        <div class="col-xl-12">
                            <a class="block block-link-shadow" href="javascript:void(0)">
                                <div class="block-content block-content-full clearfix">
                                    <div class="text-right float-right mt-10">
                                        <div class="font-w600 mb-5">{{ $data_profile->user->name }}</div>
                                        <div class="font-size-sm text-muted">{{ $data_profile->user->email }}</div>
                                    </div>
                                    <div class="float-left">
                                        @if ($data_profile->photo==null)
                                        <img class="img-avatar" src="{{ asset('assets/media/avatars/avatar14.jpg') }}" alt="">
                                        @else
                                        <img class="img-avatar" src="{{ asset('photo/'.$data_profile->photo) }}" alt="">
                                        @endif                                        
                                    </div>
                                </div>
                                <div class="block-content">
                                    <label class="css-control css-control-success css-switch">
                                        <input data-id="{{ $data_profile->user_id }}" type="checkbox" class="css-control-input" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Inactive" {{ $data_profile->user->stat ? 'checked' : '' }}>
                                        <span class="css-control-indicator"></span>
                                    </label>
                                    <p class="float-right"> ubah status</p>
                                </div>
                                <div class="block-content mt-10"></div>
                            </a>
                        </div>
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
                                <input type="hidden" name="user_id" value="{{ $data_profile->user_id }}">
                                <input type="text" class="form-control" id="val-alamat" name="alamat" placeholder="Alamat sekarang" value="{{ $data_profile->alamat }}" >
                                <label for="val-alamat">Alamat</label>
                            </div>
                            <div class="form-material mb-10">
                                <input type="number" class="form-control" id="val-telp" name="telp" placeholder="Nomor Telepon" value="{{ $data_profile->telp }}" >
                                <label for="val-telp">No.Telp</label>
                            </div>
                            <div class="form-material mb-10">
                                <select class="js-select2 form-control js-select2-enabled select2-hidden-accessible" id="val-gender" name="gender" style="width: 100%;" data-placeholder="Choose one.." data-select2-id="val-gender" tabindex="-1" aria-hidden="true" required>
                                    <option data-select2-id="5">{{ $data_profile->gender }}</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                    <option value="Yang lain">Yang Lain</option>
                                </select>
                                <label for="val-select2">Gender</label>
                            </div>
                            <div class="form-material mb-10">
                                <input type="text" class="form-control" id="val-alumni" name="alumni" placeholder="Alumni / Sekolah" value="{{ $data_profile->alumni }}">
                                <label for="val-alumni">Sekolah</label>
                            </div>
                            <div class="form-material mb-10">
                                <input type="file" class="form-control" id="val-photo" name="photo">
                                <label for="val-photo">Photo</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-primary">update</button>
                        </div>
                    </form>                  
                </div>                                        
            </div>                
        </div>

        <div class="col-xl-8">
            <div class="block">
                <div class="block-header block-header-default">
                {{-- nafigasi block --}}
                </div>

                <div class="block-content border-bottom">
                    <p class="text-center">KURSUS SAYA</p>
                </div>
                <div class="block-content">
                    <table class="table table-borderless">
                        @foreach ($data_profile->kursus as $item)
                            <tr>
                                <td class=""><img class="img-avatar" src="{{ asset('kursus_picture/'.$item->kursus_pict) }}" alt=""></td>
                                <td class="text-center">{{ $item->mapel->mapel_name }} {{ $item->kelas->kelas_name }}</td>
                                <td class="float-right">
                                    <a href="{{ route('kursus', $item->slug) }}" type="button" class="btn btn-outline-primary">pergi</a>
                                </td>                                    
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

            
        </div>
        @endif               
    </div>
</div>
@endsection

@section('script')
<script>
    var table2;
    var table;
    $(document).ready(function(){    
        table2= $('#daftar_reset').DataTable({});        
    });
    $(document).ready(function(){    
        table= $('#forum').DataTable({});        
    });    
    </script>
    <script>
        $(function(){
            $('.css-control-input').change(function(){
                var stat = $(this).prop('checked')==true ? 1 : 0;
                var user_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "{{ route('changestatus') }}",
                    data: {'stat': stat, 'user_id': user_id},
                    success: function(data){
                        console.log(data.success)
                    }
                });
            })
        })
    </script>
@endsection