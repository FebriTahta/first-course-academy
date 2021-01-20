@extends('layouts.new_layouts.master')

@section('content')

<div class="w3l-homeblock2 py-5">
    <div class="container py-lg-5 py-md-4">
        <!-- block -->
        <div class="left-right" style="margin-bottom: 20px">
            <h3 class="section-title-left mb-sm-4 mb-2"> Semua Kursus</h3>
            {{-- <a href="{{ route('allkursus') }}" class="more btn btn-small mb-sm-0 mb-4">Lihat lebih banyak kursus</a> --}}
            <p><small>Terdapat {{ count($kursus) }} kursus aktif yang tersedia</small></p>
        </div>
        <div class="row">
            @foreach ($kursus as $item)
            <div class="col-lg-4 col-md-6 item" style="margin-bottom: 50px">
                <div class="card">
                    <div class="card-header p-0 position-relative">
                        <a href="#blog-single.html">
                            <img class="card-img-bottom d-block radius-image-full" style="max-height: 250px" src="{{ asset('kursus_picture/'.$item->kursus_pict) }}"
                                alt="Card image cap">
                        </a>
                    </div>
                    <div class="card-body blog-details">
                        <a href="#blog-single.html" class="blog-desc">{{ $item->mapel->mapel_name }} | {{ $item->kelas->kelas_name }}
                        </a>
                        <div class="author align-items-center">
                            <img 
                                @if ($item->user->profile->photo==null)
                                        src="{{ asset('assets/assets/images/a1.jpg') }}"
                                    @else
                                        src="{{ asset('photo/'.$item->user->profile->photo) }}"
                                @endif 
                            alt="" class="img-fluid rounded-circle" />
                            <ul class="blog-meta">
                                <li>
                                    <a href="author.html">{{ $item->user->name }}</a> </a>
                                </li>
                                <li class="meta-item blog-lesson">
                                    <span class="meta-value"> July 13, 2020 </span>. <span
                                        class="meta-value ml-2"><span class="fa fa-clock-o"></span> 1 min</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach 
            
        </div>
    </div>
</div>  
@endsection