@extends('layouts.new_layouts.master')

@section('head')
<link rel="stylesheet" id="css-main" href="{{ asset('assets/css/codebase.min.css') }}">
@endsection

@section('content')
<div class="content">
    @if (Session::has('pesan-bahaya'))
        <div class="alert alert-danger text-bold">{{ Session::get('pesan-bahaya') }}</div>                
        @endif
        @if (Session::has('pesan-peringatan'))
                <div class="alert alert-warning text-bold">{{ Session::get('pesan-peringatan') }}</div>                
        @endif
        @if (Session::has('pesan-info'))
            <div class="alert alert-info text-bold">{{ Session::get('pesan-info') }}</div>
        @endif
    <div class="w3l-homeblock2 w3l-homeblock6 py-5">
        <div class="container-fluid px-sm-5 py-lg-5 py-md-4">
            <!-- block -->
                <h3 class="section-title-left mb-4"> Form Latihan Soal ({{ auth()->user()->name }})</h3>
            <div class="row">
                <div class="col-lg-6" style="margin-bottom: 20px" >
                    <div class="bg-clr-white" style="min-height: 233px; max-height: 233px;">
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-5 card-body blog-details align-self">
                                <span class="label-blue">Latihan Soal</span>
                                <a class="blog-desc">{{ $data_kuis->mapel->mapel_name }} | {{ $data_kuis->kelas->kelas_name }}
                                </a>
                                {{-- <p>Lorem ipsum dolor sit amet consectetur ipsum adipisicing elit. Quis
                                    vitae sit.</p> --}}
                                <div class="author align-items-center mt-3">
                                    <img 
                                        @if ($data_kuis->user->profile->photo==null)
                                            src="{{ asset('assets/assets/images/a1.jpg') }}"
                                        @else
                                        src="{{ asset('photo/'.$data_kuis->user->profile->photo) }}"
                                        @endif alt="" class="img-fluid rounded-circle">
                                    <ul class="blog-meta">
                                        <li>
                                            @if (auth()->user()->role=='instruktur')
                                                <a>{{ $data_kuis->user->name }}</a> 
                                            @else
                                                <a>{{ $data_kursus->user->name }}</a>
                                            @endif                                        
                                        </li>
                                        <li class="meta-item blog-lesson">
                                            <span class="meta-value"> {{ $data_kuis->user->role }} </span>. @if(auth()->user()->role=='instruktur')<span class="meta-value ml-2 fa fa-check">owner latihan soal</span>@endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                {{-- <a>
                                    <img class="card-img-bottom d-block radius-image-full" src="{{ asset('kursus_picture/'.$data_kursus->kursus_pict) }}" style="min-height: 263px" alt="Card image cap">
                                </a> --}}
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-lg-6" style="margin-bottom: 20px">
                    <div class="bg-clr-white" style="min-height: 233px; max-height: 233px;">
                        <div class="align-self card-body ml-10">
                            <span class="label-blue">{{ $data_kuis->kuis_name }} </span>
                            <p class="blog-desc" style="padding: 5px; margin-top: 10px" >{{ $data_kuis->kuis_desc }}</p>
                        </div>
                    </div>
                </div>
                @if (count($data_result)>0)
                <div class="col-lg-4 trending" style="margin-top: 50px">
                    <div class="bg-clr-white text-uppercase" style="padding: 5%">                    
                        <h2 class="text-primary">TOTAL : {{ $data_kuis->pertanyaan->count() }} SOAL</h2>
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>Latihan#</th>
                                    <th class="text-right">nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hasil as $key=>$item)
                                <tr>
                                    <td>#{{ $key+1 }}</td>
                                    <td class="text-right"><a href="" @if($item->nilai < 70) class="badge badge-danger" @else class="badge badge-primary" @endif> {{ $item->nilai }} </a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @else
                <div class="col-lg-4 trending" style="margin-top: 50px">
                    <div class="bg-clr-white text-uppercase" style="padding: 5%">                    
                        <h2 class="text-primary">TOTAL : {{ $data_kuis->pertanyaan->count() }} SOAL</h2>
                    </div>
                </div>
                @endif
                
                
                <div class="col-lg-8 trending">
                    <div class="left-right bg-clr-white p-3" style="margin-top: 50px;">
                        <div class="block-content">
                            <h5 class="text-center border-bottom" style="padding: 10px">
                                LATIHAN SOAL 
                                <?php $tes = App\Nilai::where('kuis_id',$data_kuis->id)->where('profile_id',auth()->user()->id)->get()?>
                                UJI KE#{{ count($tes)+1 }}
                            </h5>
                            
                            <div class="form">
                                <form action="{{ route('submit-kuis') }}" method="POST">@csrf
                                    <?php $i=1 ?>
                                    <input type="hidden" name="user_id" value="{{ $data_kursus->user->id }}">
                                    @foreach ($data_pertanyaan as $pertanyaan_item)
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="form-group ml-10 mt-10">
                                                    <strong># <?=$i?>.<br /></strong>
                                                    <div class="pertanyaan" style="margin-left: 35px" style="max-width: 500px">
                                                        {!! $pertanyaan_item->pertanyaan_name !!}
                                                    </div>
                                                    <input type="hidden" name="ke" value="{{ count($tes)+1 }}">
                                                    <input type="hidden" name="pertanyaans[<?=$i?>]" value="{{ $pertanyaan_item->id }}">
                                                    <input type="hidden" name="kuis_id" value="{{ $pertanyaan_item->kuis_id }}">
                                                    @foreach($pertanyaan_item->answer as $ans)
                                                    <div class="jawaban" style="margin-left: 35px; max-width: 500px;">
                                                        <label class="css-control css-control-info css-radio" >
                                                            <input type="radio" class="css-control-input" name="answers[{{ $pertanyaan_item->id }}]" value="{{ $ans->id }}" required>
                                                            <span class="css-control-indicator" style="padding: 10px"></span>&nbsp;&nbsp;&nbsp;{!! nl2br($ans->answer) !!}
                                                        </label><br>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    <?php $i++ ?>
                                    @endforeach
                                    <div class="form-group  text-right">
                                        <button type="submit" class="btn btn-outline-primary">submit</button>
                                    </div>                                
                                </form>
                            </div>
                            {{-- @endif --}}
                        </div>                                   
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection