@extends('layouts.new_layouts.master')
@section('head')
<link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" id="css-main" href="{{ asset('assets/css/codebase.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/js/plugins/summernote/summernote-bs4.css') }}">
@endsection

@section('content')
<div class="w3l-homeblock2 w3l-homeblock6 ">
    <div class="container-fluid px-sm-5" style="padding: 5%">
        <div class="header" style="margin-bottom: 20px">
            <p class="section-title-left mb-sm-4"> FORUM </p>
        </div>

        <div class="row">
            <div class="col-xl-8" style="margin-bottom: 50px">
                <div class="block bg-clr-white">
                    <div class="block-content">
                        <p class="text-center" style="margin-bottom: 20px" > <small id="jam"></small></p>
                        <div class="block-content" style="padding: 3%; margin-bottom: 10px; margin-top: 10px; min-height: 300px; max-width: 100%">
                            <h5 class="text-uppercase" style="margin-bottom: 20px">{{ $data_pertanyaan_forum->judul_pertanyaan }}</h5>
                            <p>{!! $data_pertanyaan_forum->desc_pertanyaan !!}</p>
                        </div>
                        <div class="block-content" style="padding: 3%; margin-bottom: 10px; margin-top: 10px; min-height: 100px; max-width: 100%">
                            <p>{{ $data_pertanyaan_forum->komentar->count() }} komentar</p>
                            <div class="row">
                                @if (count($data_pertanyaan_forum->komentar) == 0)                        
                                <div class="col-10 col-md-10">
                                    <p class="text-danger">BELUM ADA KOMENTAR PADA PERTANYAAN INI</p>
                                </div>
                                @else
                                    @foreach ($komen as $item)
                                    <div class="col-2 col-sm-2 block-content">
                                        @auth
                                            @if ($data_pertanyaan_forum->user_id == auth()->user()->id)
                                                <label class="css-control css-control-sm css-control-primary css-switch">
                                                    <input data-id="{{ $item->id }}" type="checkbox" class="css-control-input" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Inactive" {{ $item->status ? 'checked' : '' }}>
                                                    <span class="css-control-indicator"></span>
                                                </label>
                                                @else
                                                    @if ($item->status==1)
                                                        <p class="fa fa-check"></p>
                                                    @endif
                                                @endif                                            
                                            @else
                                                @if ($item->status==1)
                                                    <p class="fa fa-check"></p>
                                                @endif
                                        @endauth
                                    </div>                            
                                    <div class="col-10 col-sm-10 border-bottom flex-box">
                                        <label><u>{{ $item->user->name }}</u> <small>< {{ $item->user->role }} ></small></label>                                        
                                        <p> <small>{!! $item->komen !!} </small></p>                                         
                                    </div>
                                    @endforeach    
                                @endif                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="bg-clr-white">
                    <div class="block-content">
                        @auth
                            @if (count($data_forum)==0)
                                <div class="block-content" style="text-align: center ;padding: 5%; margin-bottom: 10px; margin-top: 10px">
                                    <p class=""> BELUM ADA PERTANYAAN </p>
                                    <small class=""><a href="javascript:void(0);" onclick="komentarscroll()" class="add_button" type="button"></a></small>
                                </div>
                            @else                                               
                                <div class="block-content" style="padding: 5%; margin-bottom: 10px; margin-top: 10px">
                                    <div style="text-align: center">
                                        <small class="text-center"><a href="javascript:void(0);" onclick="komentarscroll()" class="add_button" type="button"></a></small>
                                        <p class="text-uppercase"> #pertanyaanku# </p>
                                    </div>
                                    {{-- <div class="content_pertanyaan" style="margin-bottom: 30px">
                                        form pertanyaan
                                    </div> --}}

                                    <div id="accordion" style="margin-top: 15px" role="tablist" aria-multiselectable="true">
                                        <?php $i=1?>
                                        @foreach ($pertanyaanku as $key=>$item)
                                        <div class="card block-bordered block-rounded mb-2" style="margin-bottom: 10px; padding: 3%">
                                            <div class="block-header" role="tab" id="" style="margin-bottom: 5px">
                                                <a class="font-w600 collapsed" href="{{ route('forums-detail',$item->slug) }}" aria-expanded="false" aria-controls="accordion_q1"> #{{ $key+1 }} . {{ $item->judul_pertanyaan }} </a> 
                                            </div>
                                            <div id="" class="card-body collapse" role="tabpanel" aria-labelledby="" data-parent="" style="max-width: 100%">
                                                <div class="block-content col-12 col-md-12" style="text-align: justify;">
                                                    {!! nl2br($item->desc_pertanyaan) !!}
                                                </div>
                                                <div class="block-content col-12 col-md-12" style="margin-top: 20px">
                                                    <small> <u>{{ $item->komentar->count() }}</u> komentar</small>
                                                    <small><a href="/forums-detail-pertanyaan/{{ $item->slug }}" class="float-right fa fa-check"> DETAIL</a></small>
                                                </div>
                                            </div>
                                        </div>                                
                                        <?php $i++?>
                                        @endforeach                                
                                    </div>                            
                                </div>
                                <div class="block-content text-center" style="padding: 2%">
                                    <p>{{ $pertanyaanku->links() }}</p>
                                </div>                    
                            @endif
                        @else
                            <div class="block-content text-center" style="padding: 2%; margin-bottom: 10px; margin-top: 10px">
                                <small class="text-danger">silahkan login terlebih dahulu untuk bertanya</small><br>
                                <a href="{{ route('login') }}" class="btn btn-sm btn-primary" style="margin-top: 20px">Login</a>
                            </div>
                        @endauth                                                      
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
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