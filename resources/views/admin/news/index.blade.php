@extends('layouts.admin_layouts.master')

@section('content')
    <!-- Hero -->
<div class="bg-image bg-image-bottom" style="background-image: url({{ asset('assets/media/photos/photo34@2x.jpg') }});">
    <div class="bg-primary-dark-op">
        <div class="content content-top text-center overflow-hidden">
            <h5 class="h4 font-w400 text-white-op invisible" data-toggle="appear" data-class="animated fadeInUp">Welcome to your News page!</h5>
        </div>
    </div>
</div>
<!-- END Hero -->
<div class="content">
    <h2 class="content-heading">News | <small>tampilkan berita pada menu utama</small></h2>
        @if (Session::has('message'))
        <div class="alert alert-danger text-bold">{{ Session::get('message') }}</div>                
        @endif
        @if (Session::has('pesan-peringatan'))
                <div class="alert alert-warning text-bold">{{ Session::get('pesan-peringatan') }}</div>                
        @endif
        @if (Session::has('pesan-sukses'))
            <div class="alert alert-info text-bold">{{ Session::get('pesan-sukses') }}</div>
        @endif

    <div class="row">
        <div class="col-xl-4">
            <div class="block">
                <div class="block-header block-header-default"> 
                    <h3 type="button" class="block-title btn-block-option" data-toggle="block-option" data-action="content_toggle"></h3>                   
                </div>
                <div class="block-content">
                    <table class="table table-borderless">
                        <tbody>
                            @if (count($news)===0)
                                <p class="text-center text-primary"> BELUM ADA NEWS</p>
                            @endif
                            @foreach ($news as $item)
                                <tr>
                                    <td>{{ $item->news_tittle }}</td>
                                    <td class="text-right">
                                        <a href="#" class="fa fa-trash text-danger" type="button" data-id="{{ $item->id }}" data-toggle="modal" data-target="#modal-fromleft-remove"> </a> &nbsp;&nbsp;&nbsp;
                                        <a href="{{ route('editNews', $item->id) }}" class="fa fa-pencil"> </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 type="button" class="block-title btn-block-option" data-toggle="block-option" data-action="content_toggle"></h3>
                </div>

                <div class="block-content">
                    <form action="{{ route('postNews') }}" method="POST" enctype="multipart/form-data">@csrf
                        <div class="form-group">
                            <input type="hidden" id="id" name="id">
                            <input class="form-control" id="val-tittle" type="text" name="news_tittle" placeholder="judul berita" required>                            
                        </div>
                        <div class="form-group">                            
                            <textarea class="js-summernote" name="news_desc" id="val-desc" cols="30" rows="10" placeholder="deskripsi berita" required> Deskripsi Berita! <br>
                                Jika anda mengunggah gambar Pastikan Gambar anda memiliki kualitas yang baik. Apabila gambar anda terlalu besar untuk dapat di tampilkan maka resize gambar anda ke 75% atau 50%.
                                Jangan lupa untuk memberi "Jarak baris" antara gambar / tulisan dengan "enter". 
                            </textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-outline-primary">post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!--modal remove news-->
<div class="modal fade" id="modal-fromleft-remove" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('removeNews') }}" method="POST" enctype="multipart/form-data">@csrf                    
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-danger">
                        <h3 class="block-title">REMOVE</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">                            
                        <div class="form-group">
                            <input type="hidden" id="id" name="id">
                            <div class="form-group text-danger text-center border-bottom">
                                <p>NEWS AKAN DIHAPUS PERMANEN DARI SISTEM</p>
                            </div>
                            <div class="form-group text-center">
                                <p>Yakin akan menghapus kuis ini ?</p>
                            </div>                            
                        </div>
                        <div class="form-group">
                            <button class="btn btn-outline-danger fa fa-trash" type="submit"> HAPUS</button>
                        </div>
                    </div>                                                               
                </div>                        
            </form>                   
        </div>            
    </div>
</div>
<!--end modal remove news-->
@endsection

@section('script')
<script>
    $('#modal-fromleft-remove').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget)        
        var id = button.data('id')        
        var modal = $(this)
        modal.find('.block-title').text('HAPUS NEWS');        
        modal.find('.block-content #id').val(id);
    })
</script>
@endsection