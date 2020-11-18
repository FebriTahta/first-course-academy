@extends('layouts.admin_layouts.master')

@section('content')
<!-- Hero -->
<div class="bg-image bg-image-bottom" style="background-image: url({{ asset('assets/media/photos/photo34@2x.jpg') }});">
    <div class="bg-primary-dark-op">
        <div class="content content-top text-center overflow-hidden">
            <div class="pb-10">
                <h1 class="font-w700 text-white mb-10 invisible" data-toggle="appear" data-class="animated fadeInUp">DAFTAR KUIS SAYA</h1>
                <h2 class="h4 font-w400 text-white-op invisible" data-toggle="appear" data-class="animated fadeInUp"></h2>
            </div>
        </div>
    </div>
</div>
<!-- END Hero -->
    <div class="content">
        <div class="content-heading"><label>KUIS SAYA</label></div>            
                @if (Session::has('pesan'))
                    <div class="alert alert-info text-bold">{{ Session::get('pesan') }}</div>
                @endif
                @if (Session::has('pesan-peringatan'))
                    <div class="alert alert-warning text-bold">{{ Session::get('pesan-peringatan') }}</div>
                @endif
                @if (Session::has('pesan-sukses'))
                    <div class="alert alert-success text-bold">{{ Session::get('pesan-sukses') }}</div>
                @endif            
            <!--end alert-->
        <div class="row">
            <div class="col-12">
                <div class="block">
                    <div class="block-header block-header-default">
                        <div class="block-content text-center">
                            
                        </div>
                    </div>
                    <div class="block-content">
                        <table class="table table-stripped" id="daftar_video">
                            <thead>
                                <tr>
                                    <th>VIDEO NAME</th>
                                    <th class="text-right">TONTON VIDEO</th>
                                    <th class="text-right border-bottom">EDIT</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($video as $video_item)
                                <tr>
                                    <td><a type="button" class="si si-control-play view-video" data-video_link="{{ $video_item->video_link }}">&nbsp;&nbsp;&nbsp;&nbsp; {{ $video_item->video_name }}</a></td>
                                    <td class="text-right">
                                        <a type="button" ><i class="fa fa-eye text-info" data-id="{{ $video_item->id }}" data-video_link="{{ $video_item->video_link }}" data-toggle="modal" data-target="#modal-popout-videoku"></i> VIEW</a>                                
                                    </td>
                                    <td class="text-right">                                        
                                        <a href="#" type="button" data-toggle="modal" data-target="#" data-id="{{ $video_item->id }}"
                                            data-video_name="{{ $video_item->video_name }}" data-video_link="{{ $video_item->video_link }}"><i class="fa fa-pencil"></i> EDIT</a>                                                                       
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

    <!--modal copy videoku-->
<div class="modal fade" id="modal-popout-videoku" tabindex="-1" role="dialog" aria-labelledby="modal-popout" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popout" role="document">
        <form action="#" method="post"> @csrf
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">video yang sudah ada</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <p class="text-center text-danger border-bottom">VIDEOKU</p>
                        <iframe id="playvideo" src="" frameborder="0" allowfullscreen width="100%" height="380" position="absolute"></iframe>
                    </div>
                </div>               
            </div>
        </form>        
    </div>
</div>
<!--end modal copy videoku-->
@endsection

@section('script')
<script>
    var table2;
    $(document).ready(function(){    
        table2= $('#daftar_video').DataTable({});        
    });
</script>


@endsection