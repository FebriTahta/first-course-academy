@extends('layouts.client_layouts.master')

@section('content')
<!-- Hero -->
<div class="bg-image bg-image-bottom" style="background-image: url({{ asset('assets/media/photos/photo34@2x.jpg') }});">
    <div class="bg-primary-dark-op">
        <div class="content content-top text-center overflow-hidden">
            <h5 class="h4 font-w400 text-white-op invisible" data-toggle="appear" data-class="animated fadeInUp">"{{ $data_kuis->kuis_name }}" <small class="text-white"> {{ $data_kuis->mapel->mapel_name }} | {{ $data_kuis->kelas->kelas_name }}</small></h5>
        </div>
    </div>
</div>
<!-- END Hero -->

<div class="container">    
    <div class="row">
        <div class="col-xl-12">
            <h2 class="content-heading"><a href="{{ route('home') }}"> DASHBOARD </a><small>| Kuis</small></h2>
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
 
        @if (count($data_result) >  0)
        <div class="col-xl-4">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <div class="block-content text-center">
                        <label>JAWABAN SAYA</label>
                    </div>
                </div>
                <div class="block-content text-center">
                    <h3 class="text-primary">NILAI : {{ $nilai }}</h3><br>
                    @if (count($data_reset)==0)
                    <button class="btn btn-outline-warning fa fa-warning" data-toggle="modal" data-target="#modal-fromleft-ajukan" data-user_id="{{ $data_kuis->user->id }}" data-kuis_id="{{ $data_kuis->id }}" data-profile_id="{{ auth()->user()->profile->id }}"> IZIN RESET</button>
                    @else
                    <p class="text-warning">anda telah mengajukan reset hasil kuis</p>
                    @endif                                                         
                </div>
                <div class="block-content border-bottom">                    
                    <label for="">JUMLAH SOAL : {{ $jumlah_soal }}</label><br>
                    <label for="">SALAH : {{ $salah }}</label>
                    <label for="" class="float-right">BENAR : {{ $benar }}</label>
                </div>

                <div class="block-content">
                    <table class="table table-borderless"><?php $a=1?>
                        @foreach ($data_result as $item)                        
                        <tr>
                            <td>jawaban soal. <?=$a?> <br> {{ $item->answer->answer }}</td>
                            <td class="text-right float-right"><br>
                                @if ($item->answer->is_correct)
                                &nbsp;&nbsp;&nbsp;&nbsp; <strong class="float-center badge badge-primary">benar</strong>
                                @else
                                &nbsp;&nbsp;&nbsp;&nbsp; <strong class="float-center badge badge-danger">salah&nbsp;</strong>
                                @endif
                            </td>
                        </tr><?php $a++?>
                        @endforeach
                    </table>                    
                </div>
                
                <div class="block-content">

                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <div class="block-content text-center">
                        <label>KUNCI JAWABAN | "{{ $data_kuis->kuis_name }}"</label>
                    </div>
                </div>

                <div class="block-content">
                    <?php $i=1?>
                    @foreach ($data_pertanyaan_R as $item)
                    <div class="block-content">
                        <div class="soal">
                            <p class="border-bottom border-top">soal nomor : <?=$i?></p>
                        </div>                        
                        <h5 class="">{!! $item->pertanyaan_name !!}</h5>
                    </div>
                    <div class="block-content">
                        <table>
                            <tbody>
                                @foreach ($item->answer as $key=>$ans)                                    
                                    <tr>
                                        <td>
                                            {{ $key+1 }}). {{ $ans->answer }}
                                            @if ($ans->is_correct)  &nbsp; &nbsp; &nbsp;
                                                <strong class="float-center badge badge-success">kunci</strong>
                                            @endif                                            
                                        </td>                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>                    
                    <?php $i++?>
                    @endforeach
                    <div class="block-content"></div>
                </div>
            </div>
        </div>
        @else
            <div class="col-xl-4">
                <div class="block">
                    <div class="block-header block-header-default">                        
                    </div>
        
                    <div class="block-content">
                        <h5 class="text-center border-bottom">
                            CATATAN
                        </h5>
                        <p class="text-danger">{{ $data_kuis->kuis_desc }}</p>                
                    </div>
                </div>            
            </div>

            <div class="col-xl-8">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                    </div>
    
                    <div class="block-content">
                        <h5 class="text-center border-bottom">
                            KUIS / LATIHAN SOAL
                        </h5>
                        <form action="{{ route('submit-kuis') }}" method="POST">@csrf
                            <?php $i=1 ?>
                            @foreach ($data_pertanyaan as $pertanyaan_item)
                            <div class="row border-bottom mb-10">
                                <div class="form-group">
                                    <div class="form-group ml-50 mt-10">
                                        <strong>Soal <?=$i?>.<br />{!! nl2br($pertanyaan_item->pertanyaan_name) !!}</strong>
                                        <input type="hidden" name="pertanyaans[<?=$i?>]" value="{{ $pertanyaan_item->id }}">
                                        <input type="hidden" name="kuis_id" value="{{ $pertanyaan_item->kuis_id }}">
                                        @foreach($pertanyaan_item->answer as $ans)
                                            <br>
                                            <label class="radio-inline">
                                                <input
                                                    type="radio"
                                                    name="answers[{{ $pertanyaan_item->id }}]"
                                                    value="{{ $ans->id }}" required>
                                                {{ $ans->answer }}
                                            </label>
                                        @endforeach                            
                                    </div>
                                </div>
                            </div>
                            <?php $i++ ?>
                            @endforeach
                            <div class="form-group">
                                <div class="block block-content text-right">
                                    <button type="submit" class="btn btn-outline-primary">submit</button>
                                </div>                            
                            </div>
                        </form>                    
                    </div>
                </div>            
            </div>
        @endif                
    </div>
</div>
<!--modal dajukan reset-->
<div class="modal fade" id="modal-fromleft-ajukan" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-tambah-quiz" name="form-tambah-quiz" class="form-horizontal" action="{{ route('ajukan-reset') }}" method="POST" enctype="multipart/form-data">@csrf
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-danger">
                        <h3 class="block-title">Hapus Kategori</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content">                            
                        <div class="form-group">                            
                            <div class="block-content text-center">
                                <p>Anda akan meminta izin kepada instuktur untuk mereset hasil kuis</p>
                                <p>Anda yakin ingin mereset hasil kuis ini ?</p>
                                <input type="hidden" name="kuis_id" id="kuis_id">
                                <input type="hidden" name="profile_id" id="profile_id">
                                <input type="hidden" name="user_id" id="user_id">
                            </div>
                        </div>
                        <div class="form-group float-right">
                            <button class="btn btn-outline-danger" type="submit">Ajukan</button>
                        </div>
                    </div>                                                             
                </div>                        
            </form>                   
        </div>
    </div>
</div>
<!--end modal ajukan reset-->
@endsection

@section('script')
    <script>
        $('#modal-fromleft-ajukan').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget)                
        var kuis_id = button.data('kuis_id')
        var profile_id = button.data('profile_id')       
        var user_id = button.data('user_id') 
        var modal = $(this)
        modal.find('.block-title').text('AJUKAN RESET KUIS');
        modal.find('.block-content #kuis_id').val(kuis_id);
        modal.find('.block-content #profile_id').val(profile_id);
        modal.find('.block-content #user_id').val(user_id);
    });
    </script>
@endsection