@extends('layouts.admin_layouts.master')

@section('content')
<!-- Hero -->
<div class="bg-image bg-image-bottom" style="background-image: url({{ asset('assets/media/photos/photo34@2x.jpg') }});">
    <div class="bg-primary-dark-op">
        <div class="content content-top text-center overflow-hidden">
            <h5 class="h4 font-w400 text-white-op invisible" data-toggle="appear" data-class="animated fadeInUp">Welcome to your detail quiz page!</h5>
        </div>
    </div>
</div>
<!-- END Hero -->

<div class="content">
    
        <h2 class="content-heading">Detail Soal <small>form control untuk lembar dan edit soal</small></h2>
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
        <div class="col-md-4">
            <div class="block shadow">
                <div class="block-content block-rounded ">                    
                </div>                
                <div class="block-content border-bottom block-rounded text-center">
                    <p>total soal : {{ $total_soal }}</p>
                </div>
                <div class="block-content">
                    Kuis : <p>{{ $data_kuis->kuis_name }}</p>
                    Kuis : <p>{{ $data_kuis->kuis_desc }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="block">
                <div class="block-header block-header-default">
                    <div class="block-content text-center">
                        <label for="nomor">DETAIL KUIS | " {{ $data_kuis->kuis_name }} "</label>
                    </div>                    
                </div>                
                <?php $i=1?>
                    @foreach ($data_pertanyaan as $item)
                    <div class="block-content">
                        <div class="soal">
                            <p class="border-bottom border-top">soal nomor : <?=$i?>
                                <a href="{{ route('editSoal', $item->id) }}" class="float-right"><i class="fa fa-edit"></i> edit</a>
                            </p>                            
                        </div>                        
                        <h5 class="">{!! $item->pertanyaan_name !!}</h5>
                    </div>
                    <div class="block-content">
                        <table>
                            <tbody>
                                @foreach ($item->answer as $key=>$ans)
                                    <tr>
                                        <td>{{ $key+1 }}). {!! $ans->answer !!} 
                                            @if ($ans->is_correct) &nbsp; &nbsp; &nbsp;
                                                <strong class="float-center badge badge-success"> benar</strong>
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
</div>
@endsection