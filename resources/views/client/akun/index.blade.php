@extends('layouts.client_layouts.master')

@section('content')
<!-- Hero -->
<div class="bg-image bg-image-bottom" style="background-image: url({{ asset('assets/media/photos/photo34@2x.jpg') }});">
    <div class="bg-primary-dark-op">
        <div class="content content-top text-center overflow-hidden">
            <h5 class="h4 font-w400 text-white-op invisible" data-toggle="appear" data-class="animated fadeInUp">Akun Saya</h5>
        </div>
    </div>
</div>
<!-- END Hero -->

    <div class="container">
        <div class="row">
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
                        <form class="border-bottom" action="{{ route('storeProfile') }}" method="POST">@csrf
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
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-primary">update</button>
                            </div>
                        </form>
                        {{-- <div class="block-rounded text-danger">
                            <div class="row">
                                <div class="col-6 col-sm-6 mb-10">
                                    <div class="block-content text-center ">
                                        <a>ubah email ?</a>
                                    </div>                            
                                </div>
                                <div class="col-6 col-sm-6 mb-10">
                                    <div class="block-content text-center">
                                        <a href="#" class="text-danger">ubah password ?</a>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
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
                            @foreach (auth()->user()->profile->kursus as $item)
                                <tr>
                                    <td class=""><img class="img-avatar" src="{{ asset('kursus_picture/'.$item->kursus_pict) }}" alt=""></td>
                                    <td class="text-center">{{ $item->mapel->mapel_name }} {{ $item->kelas->kelas_name }}</td>
                                    <td class="float-right">
                                        <a href="/my-course/{{ $item->slug }}" type="button" class="btn btn-outline-primary">pergi</a>
                                    </td>                                    
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

                <div class="block">
                    <div class="block-header block-header-default">
                    {{-- block nafigasi --}}
                    </div>
                    <div class="block-content border-bottom">
                        <p class="text-center">FORUM DISKUSI</p>
                    </div>
                    <div class="block-content">
                        <table class="table table-borderless">
                            <tr>
                                <td><i class="fa fa-question"></i></td>
                                <td>PERTANYAAN SAYA</td>                                
                                <td>5 KOMENTAR</td>
                                <td class="float-right"><button class="btn btn-outline-primary">pergi</button></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection