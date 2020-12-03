@extends('layouts.client_layouts.master')

@section('content')
<!-- Hero -->
<div class="bg-image bg-image-bottom" style="background-image: url({{ asset('assets/media/photos/photo34@2x.jpg') }});">
    <div class="bg-primary-dark-op">
        <div class="content content-top text-center overflow-hidden">
            <h5 class="h4 font-w400 text-white-op invisible" data-toggle="appear" data-class="animated fadeInUp">{{ $data_kursus->mapel->mapel_name }} | {{ $data_kursus->kelas->kelas_name }}</h5>
        </div>
    </div>
</div>
<!-- END Hero -->
<div class="container">    
    <div class="row">
        <div class="col-xl-12">
            <h2 class="content-heading"><a href="{{ route('home') }}"> DASHBOARD </a><small>| Kursus</small></h2>
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
        <div class="col-xl-8">
            <!--video frame-->
            <div class="block block-rounded">                
                <div class="block-content text-center bg-secondary text-white">
                    <p>putar video yang tersedia pada daftar video</p>
                </div>                 
                <iframe id="playvideo" src="" frameborder="0" allowfullscreen width="100%" height="380" position="absolute"></iframe>                            
            </div>
            <!--video frame-->

            <!--konten-->
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    
                </div>
                <div class="block-content">
                    <div class="js-filter" data-speed="400">
                        <!--navbar konten-->
                        <div class="p-10 bg-white">
                            <div class="block-header border-bottom push">                            
                                {{-- <div class="col-3 col-xl-3 nav nav-pills">
                                    <div class="nav-item text-center" style="width: 100%">                        
                                        <a class="nav-link active" href="#" data-category-link="info">
                                        <i class="fa fa-fw fa-info-circle mr-5"></i> info</a>
                                    </div>                    
                                </div> --}}
                                <div class="col-6 col-xl-6 nav nav-pills">
                                    <div class="nav-item text-center" style="width: 100%">
                                        <a class="nav-link" href="#" data-category-link="kuis">
                                        <i class="fa fa-fw fa-edit mr-5"></i> kuis</a>
                                    </div>                    
                                </div>
                                <div class="col-6 col-xl-6 nav nav-pills">
                                    <div class="nav-item text-center" style="width: 100%">
                                        <a class="nav-link" href="#" data-category-link="book">
                                        <i class="fa fa-fw fa-book mr-5"></i> book</a>
                                    </div>                    
                                </div>                                                                               
                            </div>                                              
                        </div>                    
                        <!--end navbar konten-->

                        <!--info-->
                        

                        <!--kuis-->
                        <div class="col-md-4 col-xl-12 mb-10" data-category="kuis">                        
                            <table class="table table-borderless">                            
                                <tbody>
                                    @foreach ($data_kursus->kuis as $kuis_item)
                                    <tr>
                                        <td class="border-bottom"><i class="fa fa-fw fa-edit"></i>&nbsp; {{ $kuis_item->kuis_name }}</td>
                                        <td class="border-bottom"> &nbsp; {{ $kuis_item->pertanyaan->count() }} soal</td>                                        
                                        <?php $sudah_dikerjakan = App\Result::where('user_id', auth()->user()->id)->where('kuis_id', $kuis_item->id)->first()?>
                                        
                                        @if ($sudah_dikerjakan===null)
                                        <td class="border-bottom text-right"><a href="/kuis-form/{{ $kuis_item->id }}"> start</a></td>
                                        @else
                                        <td class="border-bottom text-right"><a href="/kuis-form/{{ $kuis_item->id }}"> selesai </a></td>
                                        @endif                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--kuis-->

                        <!--buku-->
                        <div class="col-md-4 col-xl-12 mb-10" data-category="book" style="display: none">                        
                            <table class="table table-borderless">                            
                                <tbody>
                                    @foreach ($data_kursus->book as $book_item)
                                    <tr>
                                        <td class="border-bottom"><i class="fa fa-fw fa-edit"></i>&nbsp; {{ $book_item->book_name }}</td>  
                                        <td class="border-bottom text-right"> <input type="hidden" name="book_name" value="{{ $book_item->book_name }}"> <a href="{{ route('download', $book_item->book_file) }}"> unduh </a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--buku-->
                    </div>                    
                </div>
            </div>
            <!--konten-->
        </div>

        <div class="col-xl-4">            
            <div class="block block-rounded">
                <div class="block-header block-header-default text-center">
                    <h3 class="block-title">
                        <i class="fa fa-fw fa-info"></i>
                        About
                    </h3>
                </div>
                <div class="block-content">
                    <div class="block-content text-center">
                        <div class="push">
                            @if ($data_kursus->user->profile->photo==null)
                            <img class="img-avatar" src="{{ asset('assets/media/photos/photo34@2x.jpg') }}" alt="{{ $data_kursus->user->name }}">
                            @else
                            <img class="img-avatar" src="{{ asset('photo/'.$data_kursus->user->profile->photo) }}" alt="{{ $data_kursus->user->name }}">
                            @endif                            
                        </div>
                        <label for="">{{ $data_kursus->user->name }}</label>
                        <div class="font-size-sm text-muted text-center mb-20">
                            (Instruktur)
                        </div>
                    </div>
                    <table class="table table-borderless table-striped">
                        <tbody>
                            <tr>
                                <td>
                                    <i class="fa fa-fw fa-tags mr-10"></i>
                                    <a class="badge badge-primary" href="javascript:void(0)">{{ $data_kursus->kelas->kelas_name }}</a>
                                    <a class="badge badge-primary" href="javascript:void(0)">{{ $data_kursus->mapel->mapel_name }}</a>                                    
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="fa fa-heart mr-10 text-danger"></i> {{ $data_kursus->profile->count() }} Siswa
                                </td>
                            </tr>                            
                            <tr>
                                <td>
                                    <i class="si si-control-play mr-10"></i> {{ $data_kursus->video->count() }} Video                              
                                </td>                                
                            </tr>
                            <tr>
                                <td>
                                    <i class="fa fa-edit mr-10"> </i> {{ $data_kursus->kuis->count() }} Kuis                              
                                </td>                                
                            </tr>
                            <tr>
                                <td>
                                    <i class="fa fa-book mr-10"> </i> 2 Buku                              
                                </td>                                
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="block block-rounded block-mode-pinned">
                <div class="block-header block-header-default ">
                    <h3 type="button" class="block-title btn-block-option" data-toggle="block-option" data-action="content_toggle"></h3>
                    <div class="block-options">                    
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="pinned_toggle">
                            <i class="si si-pin"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <p class="text-center">DAFTAR VIDEO</p>
                    <table class="table table-borderless border-top">
                        <tbody>
                            @foreach ($data_kursus->video as $video_item)
                            <tr>
                                <td><a type="button" class="si si-control-play view-video" data-video_link="{{ $video_item->video_link }}">&nbsp;&nbsp;&nbsp;&nbsp;{{ $video_item->video_name }}</a></td>
                            </tr>
                            @endforeach                            
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection

@section('script')
<script>        
    var data = $("#playvideo").attr('src');
    // play video
    $(document).on('click','.view-video',function(){
        console.log($(this).attr('data-video_link'));            
        $("#playvideo").attr('src', $(this).attr('data-video_link'));
    });                                                                  
</script>
@endsection