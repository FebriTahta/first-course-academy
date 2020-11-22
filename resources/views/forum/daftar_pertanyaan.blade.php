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
        <div class="col-12"><h2 class="content-heading"><a href="{{ route('home') }}"> DASHBOARD </a><small>|<a href="{{ route('forum') }}"> Forum </a>| {{ $data_kelas->kelas_name }} {{ $data_mapel->mapel_name }}</small></h2>
            @if (Session::has('pesan-sukses'))
            <div class="alert alert-info text-bold">{{ Session::get('pesan-sukses') }}</div>
            @endif
        </div>
        <div class="col-xl-5">
            <div class="block">
                <div class="block-header block-header-default"></div>
                <div class="block-content">
                    @auth
                    <p class="text-right"><a href="javascript:void(0);" class="add_button" type="button"><i class="fa fa-plus"></i></a></p>
                    
                    @endauth                    
                           
                    <div class="content_pertanyaan">
                        {{-- form pertanyaan --}}                        
                    </div>

                    @auth
                    {{-- user login yang belom verifiaksi --}}
                    @if (auth()->user()->email_verified_at === null)
                        <div class="block-content text-center mb-20">
                            <a href="{{ route('home') }}" class="button btn btn-outline-primary">lakukan verifikasi email</a>
                        </div>                    
                    @else
                        @if (count(auth()->user()->forum)==0)
                        <p class="text-center text-primary">BELUM ADA PERTANYAAN</p>
                        @else
                            <table class="table table-borderless">
                                <tbody>
                                    @foreach ($pertanyaanku as $item)
                                        <tr>
                                            <td><a href="/forum-detail-pertanyaan/{{ $item->slug }}">{{ $item->judul_pertanyaan }}</a></td>                                            
                                        </tr>                                        
                                    @endforeach
                                </tbody>                                
                            </table>
                            <div class="block block-content"></div>
                        @endif
                    @endif
                    {{-- pengguna tidak login --}}
                    @else
                    <div class="block-content text-center mb-20">
                        <a href="{{ route('login') }}" class="button btn btn-outline-primary">login untuk bertanya</a>
                    </div>
                    @endauth                                        
                </div>
            </div>
        </div>
        <div class="col-xl-7">            
            <div class="block">
                <div class="block-header block-header-default">                    
                </div>
                <div class="block-content text-center border-bottom">
                    <div></div>
                    <p>DAFTAR PERTANYAAN</p>
                </div>
                <div class="block-content">
                    @if (count($data_forum)==0)
                        <div class="block-content text-center">
                            <p> BELUM ADA PERTANYAAN </p>
                        </div>
                    @else                                               
                        <div class="block-content">                            
                            <div id="accordion" role="tablist" aria-multiselectable="true">
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
                    @endif                                                      
                </div>                                
            </div>    
        </div> 
    </div>    
</div>
@endsection

@section('script')

<script>
function getslug(){
    var judul   =   document.getElementById('judul').value;
    var data    =   document.getElementById('user_id').value;
    var slug    =   judul +"-"+ data;
    document.getElementById('slug').value = slug;
}    
</script>

<script>                
    $(document).ready(function(){
        
        var maxfield    =   2;        
        var addButton   =   $('.add_button'); 
        var content     =   $('.content_pertanyaan');
        var contenthapus=   $('.content_hapus');
        var formPertanyaan  =   '@auth<div><button class="form-group float-right btn btn-outline-danger cancel_form fa fa-minus"></button><form action="/pertanyaan" method="POST" class="border-bottom" enctype="multipart/form-data">@csrf<div class="form-group"><input type="hidden" name="slug" id="slug" value=""><input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}"><input type="hidden" name="kelas_id" value="{{ $data_kelas->id }}"><input type="hidden" name="mapel_id" value="{{ $data_mapel->id }}"><input type="text" class="form-control" name="judul_pertanyaan" id="judul" onkeyup="getslug();" placeholder="Judul Pertanyaan" required></div><div class="form-group"><textarea class="js-summernote form-control" name="desc_pertanyaan" id="desc" cols="30" rows="10">jika menggunggah gambar. pastikan ukuran tidak lebih dari 1mb dan perkecil ukuran 50%.</textarea></div><div class="form-group text-right"><button class="btn btn-outline-primary" type="submit">POST</button></div></form></div>@endauth';
        var max         =   1;
        $(addButton).click(function(){
            if(max < maxfield){
                jQuery(function(){ Codebase.helpers(['summernote', 'ckeditor', 'simplemde']); });
                max++;                
                $(content).append(formPertanyaan);
                console.log('tambah'+'_'+max);
            }            
        });
        $(content).on('click','.cancel_form', function(e){
            e.preventDefault();            
            $(this).parent('div').remove();
            max--;
            console.log('hapus'+'_'+max);           
        });
    });                                                                  
</script>
@endsection