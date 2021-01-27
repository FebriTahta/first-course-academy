@extends('layouts.new_layouts.master')
@section('head')
<link rel="stylesheet" href="{{ asset('assets/js/plugins/summernote/summernote-bs4.css') }}">
@endsection

@section('content')
<div class="w3l-homeblock2 w3l-homeblock6 ">
    <div class="container-fluid px-sm-5" style="padding: 5%">
        <div class="left-right" id="forum">
            <p class="section-title-left mb-sm-4"> FORUM </p>
            <small class="" id="waktu"></small>
        </div>
        <div class="row">
            <div class="col-xl-8" style="margin-bottom: 50px">
                <div class="block bg-clr-white">
                    <div class="block-content">
                        @if (count($data_forum)==0)
                            <div class="block-content text-center text-danger" style="padding: 2%; margin-bottom: 10px; margin-top: 10px; min-height: 300px">
                                <small>{{ $data_mapel->mapel_name }} {{ $data_kelas->kelas_name }}</small>
                                <p id="jam"></p>
                                <p> BELUM ADA PERTANYAAN </p>
                            </div>
                        @else                                               
                            <div class="block-content" style="padding: 2%; margin-bottom: 10px; margin-top: 10px">
                                <div class="block-content text-center">
                                    <small class=" text-uppercase" id="jam"></small><br>
                                    <small class=" text-uppercase"> {{ $data_mapel->mapel_name }} {{ $data_kelas->kelas_name }}</small>
                                </div>
                                <div id="accordion" style="margin-top: 20px" class="tablist" role="tablist" aria-multiselectable="true">
                                    <?php $i=1?>
                                    @foreach ($data_forum as $item)
                                    <div class="card block-bordered block-rounded mb-2" style="margin-bottom: 10px; padding: 3%">
                                        <div class="block-header" role="tab" id="accordion_h1" style="margin-bottom: 5px">
                                            <a class="font-w600 collapsed" data-toggle="collapse" data-parent="#accordion" href="#accordion_<?=$i?>" aria-expanded="false" aria-controls="accordion_q1">{{ $item->judul_pertanyaan }} </a> 
                                        </div>
                                        <div id="accordion_<?=$i?>" class="card-body collapse" role="tabpanel" aria-labelledby="accordion_h1" data-parent="#accordion" style="max-width: 100%">
                                            <div class="block-content col-12 col-md-12" style="text-align: justify;">
                                                {!! nl2br($item->desc_pertanyaan) !!}
                                            </div>
                                            <div class="block-content col-12 col-md-12" style="margin-top: 20px">
                                                <small> <u>{{ $item->komentar->count() }}</u> komentar</small>
                                                <small><a href="{{ route('forums-detail',$item->slug) }}" class="float-right fa fa-check"> DETAIL</a></small>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $i++?>
                                    @endforeach
                                </div>                            
                            </div>    
                            <div class="block-content text-center" style="padding: 2%">
                                {{-- <p>{{ $pertanyaanku->links() }}</p> --}}
                            </div>                    
                        @endif                                                      
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
                                    <small class=""><a href="javascript:void(0);" onclick="komentarscroll()" class="add_button" type="button"><i class="fa fa-plus"></i> Buat Pertanyaan</a></small>
                                </div>
                            @else                                               
                                <div class="block-content" style="padding: 5%; margin-bottom: 10px; margin-top: 10px">
                                    <div style="text-align: center">
                                        <small class="text-center"><a href="javascript:void(0);" onclick="komentarscroll()" class="add_button" type="button"><i class="fa fa-plus"></i> Buat Pertanyaan</a></small>
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
                                    {{-- <p>{{ $data_forum->links() }}</p> --}}
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
    <div id="komentarscroll" class="content_pertanyaan" style="text-align: center ;padding: 2%; margin-bottom: 10px; margin-top: 10px">
        {{-- form pertanyaan --}}
    </div>
</div>

@endsection

@section('script')
<script>
    function komentarscroll()
    {
        var skrollke = document.getElementById("komentarscroll");
        skrollke.scrollIntoView();
    }
    function forum()
    {
        var skrollke = document.getElementById("forum");
        skrollke.scrollIntoView();
    }
</script>
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
        jQuery(function(){ Codebase.helpers(['summernote', 'ckeditor', 'simplemde']); });
        var maxfield    =   2;        
        var addButton   =   $('.add_button'); 
        var content     =   $('.content_pertanyaan');
        var contenthapus=   $('.content_hapus');
        var formPertanyaan  =   '@auth<div><button class="form-group float-right btn btn-outline-danger cancel_form fa fa-minus" onclick="forum()"></button><form action="/pertanyaan" method="POST" class="border-bottom" enctype="multipart/form-data">@csrf<div class="form-group"><input type="hidden" name="status" id="status" value="premium"><input type="hidden" name="slug" id="slug" value=""><input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}"><input type="hidden" name="kelas_id" value="{{ $data_kelas->id }}"><input type="hidden" name="mapel_id" value="{{ $data_mapel->id }}"><input type="text" class="form-control" name="judul_pertanyaan" id="judul" onkeyup="getslug();" placeholder="Judul Pertanyaan" required></div><div class="form-group"><textarea class="js-summernote form-control" name="desc_pertanyaan" id="desc" cols="30" rows="10">jika menggunggah gambar perkecil ukuran ke 50%.</textarea></div><div class="form-group text-right"><button class="btn btn-outline-primary" type="submit">POST</button></div></form></div>@endauth';
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