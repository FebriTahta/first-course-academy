@extends('layouts.new_layouts.master')
@section('head')
    
@endsection

@section('content')
<div class="w3l-homeblock2 w3l-homeblock6 py-5">
    <div class="container-fluid px-sm-5 py-lg-5 py-md-4" style="padding: 5%">
        <div class="left-right">
            <p class="section-title-left mb-sm-4 mb-2"> FORUM <small>{{ $data_mapel->mapel_name }} {{ $data_kelas->kelas_name }}</small></p>
        </div>
        <div class="row">
            <div class="col-xl-8" style="margin-bottom: 50px">            
                <div class="block bg-clr-white">
                    <div class="block-content">
                        @if (count($data_forum)==0)
                            <div class="block-content text-center">
                                <p> BELUM ADA PERTANYAAN </p>
                            </div>
                        @else                                               
                            <div class="block-content" style="padding: 2%; margin-bottom: 10px; margin-top: 10px">
                                <div id="accordion" role="tablist" aria-multiselectable="true">
                                    <?php $i=1?>
                                    @foreach ($data_forum as $item)
                                    <div class="card block-bordered block-rounded mb-2" style="margin-bottom: 10px; padding: 3%">
                                        <div class="block-header" role="tab" id="accordion_h1" style="margin-bottom: 5px">
                                            <a class="font-w600 collapsed" data-toggle="collapse" data-parent="#accordion" href="#accordion_<?=$i?>" aria-expanded="false" aria-controls="accordion_q1">{{ $item->judul_pertanyaan }} </a> 
                                        </div>
                                        <div id="accordion_<?=$i?>" class="card-body collapse" role="tabpanel" aria-labelledby="accordion_h1" data-parent="#accordion" style="max-width: 100%">
                                            <div class="block-content" style="text-align: justify;">
                                                <div style="text-align: justify; grid-auto-flow: inherit">{!! nl2br($item->desc_pertanyaan) !!}</div>
                                            </div>
                                            <div class="block-content" style="margin-top: 20px">
                                                <small> <u>{{ $item->komentar->count() }}</u> komentar</small>
                                                <small><a href="/forum-detail-pertanyaan/{{ $item->slug }}" class="float-right fa fa-check"> DETAIL</a></small>
                                            </div>
                                        </div>
                                    </div>                                
                                    <?php $i++?>
                                    @endforeach                                
                                </div>                            
                            </div>    
                            <div class="block-content text-center" style="padding: 2%">
                                <p>{{ $data_forum->links() }}</p>
                            </div>                    
                        @endif                                                      
                    </div>                                
                </div>    
            </div>
            <div class="col-xl-4">
                <div class="bg-clr-white">
                    aaa
                    @foreach ($pertanyaanku as $item)
                        {{ $item->pertanyaan_name }}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    
@endsection