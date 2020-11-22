@extends('layouts.client_layouts.master')

@section('content')
<!-- Hero -->
<div class="bg-image bg-image-bottom" style="background-image: url({{ asset('assets/media/photos/photo34@2x.jpg') }});">
    <div class="bg-primary-dark-op">
        <div class="content content-top text-center overflow-hidden">
            <div class="pb-10">
                <h3 class="font-w700 text-white mb-10 invisible" data-toggle="appear" data-class="animated fadeInUp">FORUM</h3>
                <p class="font-w400 text-white-op invisible" data-toggle="appear" data-class="animated fadeInUp">{{ $data_kelas->kelas_name }} | {{ $data_mapel->mapel_name }}</p>
            </div>
        </div>
    </div>
</div>
<!-- END Hero -->
<div class="container">
    <div class="row">
        <div class="col-12"><h2 class="content-heading"><a href="{{ route('home') }}"> DASHBOARD </a><small>|<a href="{{ route('forum') }}"> Forum </a></small></h2>
            @if (Session::has('pesan-sukses'))
            <div class="alert alert-info text-bold">{{ Session::get('pesan-sukses') }}</div>
            @endif
        </div> 
        <div class="col-xl-7">
            <div class="block block-rounded border-bottom">
                <div class="block-header block-header-default">                    
                    <div class="block-options">                    
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-down"></i></button>
                    </div>
                </div>
                <div class="block-content border-bottom">
                    <p>Oleh : {{ $data_pertanyaan_forum->user->name }} <small class="float-right">{{ $data_pertanyaan_forum->created_at }}</small></p>
                    <h1 class="h4 font-w400">{{ $data_pertanyaan_forum->judul_pertanyaan }}</h1>
                </div>
                <div class="block-content border-bottom">
                    <p>{!! $data_pertanyaan_forum->desc_pertanyaan !!}</p>
                </div>
                <div class="komen">
                    <div class="block-content">
                        <p>{{ $data_pertanyaan_forum->komentar->count() }} komentar</p>
                    </div>
                    <div class="row">                        
                        @if (count($data_pertanyaan_forum->komentar) == 0)                        
                        <div class="col-10 col-md-10">
                            <div class="block-content text-left">
                                <p class="text-danger">BELUM ADA KOMENTAR PADA PERTANYAAN INI</p>
                            </div>
                        </div>
                        @else
                            @foreach ($komen as $item)
                            <div class="col-2 col-md-2">
                                <div class="block-content">
                                    @auth
                                        @if ($data_pertanyaan_forum->user_id == auth()->user()->id)
                                        <label class="css-control css-control-success css-switch">
                                            <input data-id="{{ $item->id }}" type="checkbox" class="css-control-input" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Inactive" {{ $item->status ? 'checked' : '' }}>
                                            <span class="css-control-indicator"></span>
                                        </label>
                                        @else
                                            @if ($item->status==1)
                                                <div class="block block-content">
                                                    <p class="fa fa-check"></p>
                                                </div>
                                            @endif
                                        @endif                                            
                                    @else
                                        @if ($item->status==1)
                                            <div class="block block-content">
                                                <p class="fa fa-check"></p>
                                            </div>
                                        @endif
                                    @endauth                                                                        
                                </div>
                            </div>                            
                            <div class="col-9 col-md-9 border-bottom flex-box">
                                <div class="block block-rounded">
                                    <div class="block-content text-left">
                                        <label><u>{{ $item->user->name }}</u></label>                                        
                                        <p>{!! $item->komen !!}</p>                                        
                                    </div>
                                </div>                                
                            </div>
                            @endforeach                        
                        @endif                        
                    </div>
                </div>
            </div>            

            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <p>komentar</p>
                </div>
                @auth
                    @if (auth()->user()->email_verified_at===null)
                    <div class="block-content text-center">
                        <a href="/home" class="btn btn-primary">Verifikasi email anda</a>
                    </div>
                    <div class="block-content"></div>
                    @else
                    <form action="{{ route('post-komentar') }}" method="POST" enctype="multipart/form-data">@csrf
                        <div class="block-content">
                            <div class="form-group">
                                <input type="hidden" name="forum_id" value="{{ $data_pertanyaan_forum->id }}">
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <textarea name="komen" id="komen" cols="30" rows="10" class="js-summernote form-control">Silahkan Isi Komentar Anda</textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-primary">post komentar</button>
                            </div>
                        </div>
                    </form>
                    @endif
                @else
                    <div class="block-content text-center">
                        <a href="/login" class="btn btn-primary">Silahkan Login untuk memberikan komentar</a>
                    </div>
                    <div class="block-content"></div>
                @endauth                                                                                    
            </div>
        </div>
        
        <div class="col-xl-5">
            <div class="block block-rounded">
                <div class="block-header block-header-default">                                        
                    <div class="block-options">                    
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-down"></i></button>
                    </div>
                </div>
                <div class="block-content">                            
                    <div id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="block-content text-center border-bottom"><p>daftar pertanyaan lain</p></div>
                        <?php $i=1?>
                        @foreach ($data_forum as $item)
                        <div class="block block-bordered block-rounded mb-2">
                            <div class="block-header" role="tab" id="accordion_h1">
                                <a class="font-w600 collapsed" data-toggle="collapse" data-parent="#accordion" href="#accordion_<?=$i?>" aria-expanded="false" aria-controls="accordion_q1">{{ $item->judul_pertanyaan }} </a> <a href="/forum-detail-pertanyaan/{{ $item->slug }}" class="float-right">detail</a>
                            </div>
                            <div id="accordion_<?=$i?>" class="collapse" role="tabpanel" aria-labelledby="accordion_h1" data-parent="#accordion" style="">
                                <div class="block-content">
                                    <p>{!! $item->desc_pertanyaan !!}</p>
                                </div>
                            </div>
                        </div>                                
                        <?php $i++?>
                        @endforeach                                
                    </div>                            
                </div>    
                <div class="block-content text-center">{{ $data_forum->links() }}</div>
            </div>
        </div>        
    </div>
</div>
@endsection

@section('script')    
<script>
    $(function(){
        $('.css-control-input').change(function(){
            var status = $(this).prop('checked')==true ? 1 : 0;
            var id = $(this).data('id');

            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{ route('benar') }}",
                data: {'status': status, 'id': id},
                success: function(data){
                    console.log(data.success)
                }
            });
        })
    })
</script>
@endsection