@extends('layouts.admin_layouts.master')

@section('content')
<!-- Hero -->
<div class="bg-image bg-image-bottom" style="background-image: url({{ asset('assets/media/photos/photo34@2x.jpg') }});">
    <div class="bg-primary-dark-op">
        <div class="content content-top text-center overflow-hidden">
            <h5 class="h4 font-w400 text-white-op invisible" data-toggle="appear" data-class="animated fadeInUp">DETAIL RESULT</h5>
        </div>
    </div>
</div>
<!-- END Hero -->

<div class="container">        
    <div class="row">
        <div class="col-xl-12">
            <div class="content-heading"><a href="{{ route('dashboard') }}">Dashboard </a>| siswa kuis</div>
            @if (Session::has('pesan-bahaya'))
            <div class="alert alert-danger text-bold">{{ Session::get('message') }}</div>                
            @endif
            @if (Session::has('pesan-peringatan'))
                    <div class="alert alert-warning text-bold">{{ Session::get('pesan-peringatan') }}</div>                
            @endif
            @if (Session::has('pesan-info'))
                <div class="alert alert-info text-bold">{{ Session::get('pesan-sukses') }}</div>
            @endif
        </div>

        <div class="col-xl-4">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <div class="block-content text-center">
                        HASIL TES KUIS
                    </div>
                </div>                                
                <div class="block-content">
                    @if (auth()->user()->role==='siswa')
                    <div class="block-content">
                        <p>dari <u>{{ $data_pertanyaan->count() }} soal </u>
                           kamu berhasil menjawab <u>{{ $data_result_benar }} pertanyaan </u> dengan benar
                        </p>
                        <form action="{{ route('resetkuis') }}" method="POST">@csrf
                            <input type="hidden" name="kuis_id" id="kuis_id" value="{{ $data_kuis->id }}">
                            <p><u class="text-primary"> nilai :  {{ $nilai }}</u> | <button type="submit" class="btn btn-outline-danger">reset kuis</button></p>
                        </form>
                    </div>
                    @else
                    <div class="block-content border-bottom text-center">
                        <p>{{ $result_siswa->user->name }}</p>
                        <p class="badge badge-success">{{ $nilai }}</p>
                    </div>
                    <div class="block-content">
                        <table class="table table-borderless">
                            <tbody><?php $a=1?>
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
                            </tbody>
                        </table>
                    </div>
                    @endif
                    
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <div class="block-content text-center">
                        <label>DETAIL RESULT | "{{ $data_kuis->kuis_name }}"</label>
                    </div>
                </div>

                <div class="block-content">
                    <?php $i=1?>
                    @foreach ($data_pertanyaan as $item)
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
                                        {{-- <td>
                                            @if ($ans->result->count()) &nbsp; &nbsp; &nbsp;
                                                @if ($ans->is_correct != $ans->result->count())
                                                <strong class="float-center badge badge-danger">jawabanku salah</strong>
                                                @else
                                                <strong class="float-center badge badge-primary">jawabanku benar</strong>
                                                @endif
                                            @endif
                                        </td> --}}
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
    </div>
</div>
@endsection