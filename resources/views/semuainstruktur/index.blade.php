@extends('layouts.new_layouts.master')

@section('content')

<div class="w3l-homeblock2 py-5">
    <div class="container py-lg-5 py-md-4">
        <!-- block -->
        <div class="left-right" style="margin-bottom: 20px">
            <h3 class="section-title-left mb-sm-4 mb-2"> Daftar Instruktur</h3>
            {{-- <a href="{{ route('allkursus') }}" class="more btn btn-small mb-sm-0 mb-4">Lihat lebih banyak kursus</a> --}}
            <p><small>Terdapat {{ count($instruktur) }} instuktur aktif </small></p>
        </div>
        <div class="row">
            @foreach ($instruktur as $item)
            <div class="col-lg-4">
                <div class="bg-clr-white hover-box" style="max-height: 150px; margin-bottom: 10px">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        {{-- <div class="col-sm-5 position-relative" >
                            <a href="#blog-single.html" class="image-mobile" >
                                <img class="card-img-bottom d-block radius-image-full" style="max-height: 150px; max-width: 150px" src="{{ asset('assets/assets/images/beauty1.jpg') }}" alt="Card image cap">
                            </a>
                        </div> --}}
                        <div class="col-sm-11 card-body blog-details align-self" >
                            {{-- <a href="#blog-single.html" class="blog-desc">{{ $item->name }}
                            </a> --}}
                            <div class="author align-items-center">
                                <img @if($item->profile->photo===null) src="{{ asset('assets/assets/images/a1.jpg') }}" @else src="{{ asset('photo/'.$item->profile->photo) }}" @endif alt="" class="img-fluid rounded-circle">
                                <ul class="blog-meta">
                                    <li>
                                        <a href="{{ route('detailInstruktur',$item->id) }}">{{ $item->name }}</a> 
                                    </li>
                                    <li class="meta-item blog-lesson">
                                        <span class="meta-value"> @if($item->profile->alumni==null)@else{{ $item->profile->alumni }} @endif </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach 
        </div>
    </div>
</div>  
@endsection