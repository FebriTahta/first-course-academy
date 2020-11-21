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
                                            {{-- <td class="text-right">                                                
                                                <a href="#" class="fa fa-pencil" data-toggle="modal" data-target="#modal-fromleft-edit" data-id="{{ $item->id }}"
                                                data-user_id="{{ $item->user_id }}" data-kelas_id="{{ $item->kelas_id }}" data-mapel_id="{{ $item->mapel_id }}" data-slug="{{ $item->slug }}"
                                                data-judul_pertanyaan="{{ $item->judul_pertanyaan }}" data-desc_pertanyaan="{{ $item->desc_pertanyaan }}"></a>
                                            </td> --}}
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

<!--modal edit pertanyaan-->
<div class="modal fade" id="modal-fromleft-edit" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('pertanyaan') }}" method="POST" enctype="multipart/form-data">@csrf                    
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">UPLOAD</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content">                            
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="text" id="id" name="id">
                                <input type="text" class="form-control" id="user_id" name="user_id"
                                    value="" required>
                                    <input type="text" class="form-control" id="kelas_id" name="kelas_id"
                                    value="" required>
                                    <input type="text" class="form-control" id="mapel_id" name="mapel_id"
                                    value="" required>
                                <input type="text" id="slug" name="slug">                          
                            </div>
                            
                            <div class="form-group">
                                <label for="name" class="control-label">Judul</label>
                                
                                    <input type="text" class="form-control" name="judul" id="judul_pertanyaan" required>
                                
                            </div>
                            <label for="name" class="control-label">Deskripsi Kuis</label>
                            
                                <textarea class="form-control js-summernote" name="desc" id="desc_pertanyaan" cols="30" rows="10"> Pesan / Deskripsi seputar kuis yang akan dibuat</textarea>
                            
                        </div>
                        <div class="form-group float-right">
                            <button class="btn btn-outline-primary fa fa-plus" type="submit"> UPLOAD</button>
                        </div>
                    </div>                                                               
                </div>                        
            </form>                   
        </div>            
    </div>
</div>
<!--end modal edit pertanyaan-->
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
        var formPertanyaan  =   '@auth<div><button class="form-group float-right btn btn-outline-danger cancel_form fa fa-minus"></button><form action="{{ route('pertanyaan') }}" method="POST" class="border-bottom" enctype="multipart/form-data">@csrf<div class="form-group"><input type="hidden" name="slug" id="slug" value=""><input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}"><input type="hidden" name="kelas_id" value="{{ $data_kelas->id }}"><input type="hidden" name="mapel_id" value="{{ $data_mapel->id }}"><input type="text" class="form-control" name="judul" id="judul" onkeyup="getslug();" placeholder="Judul Pertanyaan" required></div><div class="form-group"><textarea class="js-summernote form-control" name="desc" id="desc" cols="30" rows="10">Jika anda mengunggah gambar Pastikan Gambar anda memiliki kualitas yang baik. Apabila gambar anda terlalu besar untuk dapat di tampilkan maka resize gambar anda ke 75% atau 50%.</textarea></div><div class="form-group text-right"><button class="btn btn-outline-primary" type="submit">POST</button></div></form></div>@endauth';
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
<script>
    $('#modal-fromleft-edit').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget)        
        var id = button.data('id')
        var user_id = button.data('user_id')
        var kelas_id = button.data('kelas_id')
        var mapel_id = button.data('mapel_id')
        var judul_pertanyaan = button.data('judul_pertanyaan')
        var desc_pertanyaan = button.data('desc_pertanyaan')
        var slug = button.data('slug')
        var modal = $(this)
        modal.find('.block-title').text('EDIT KUIS');        
        modal.find('.block-content #id').val(id);
        modal.find('.block-content #user_id').val(user_id);
        modal.find('.block-content #kelas_id').val(kelas_id);
        modal.find('.block-content #mapel_id').val(mapel_id);
        modal.find('.block-content #judul_pertanyaan').val(judul_pertanyaan);
        modal.find('.block-content #desc_pertanyaan').val(desc_pertanyaan);
        modal.find('.block-content #slug').val(slug);
    })
</script>
@endsection