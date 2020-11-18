@extends('layouts.client_layouts.master')

@section('content')
<!-- Hero -->
<div class="bg-image bg-image-bottom" style="background-image: url({{ asset('assets/media/photos/photo34@2x.jpg') }});">
    <div class="bg-primary-dark-op">
        <div class="content content-top text-center overflow-hidden">
            <h5 class="h4 font-w400 text-white-op invisible" data-toggle="appear" data-class="animated fadeInUp">Kursus Saya</h5>
        </div>
    </div>
</div>
<!-- END Hero -->

    <div class="content">
        <div class="row">
            <div class="col-12">
                <h2 class="content-heading"><a href="/">Home | </a>Halaman Utama</h2>
            </div>
            <div class="col-xl-4">
                <div class="block">
                    <div class="block-header block-header-default">
                    {{-- nafigasi block --}}
                    </div>
                    <div class="block-content border-bottom">
                        <p class="text-center">WELCOME</p>
                    </div>
                    <div class="block-content">                        
                        <p>gunakan fitur <a href="{{ route('forum') }}">FORUM</a> untuk saling membantu dan bertanya apabila ada kesulitan</p>
                        <p>Cek detail data anda di <a href="{{ route('akun') }}">AKUN</a></p>
                        <p><u>Selamat belajar</u></p>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                
                <div class="block">
                    <div class="block-header block-header-default">
                    {{-- nafigasi block --}}
                    </div>

                    <div class="block-content border-bottom">
                        <p class="text-center">KURSUS SAYA</p>
                    </div>
                    <div class="block-content">
                        <table class="table table-borderless">
                            @foreach (auth()->user()->profile->kursus as $item)
                                <tr>
                                    <td class="push"><img class="img-avatar" src="{{ asset('kursus_picture/'.$item->kursus_pict) }}" alt=""></td>
                                    <td class=""><p>{{ $item->mapel->mapel_name }} {{ $item->kelas->kelas_name }} </p></td>
                                    <td class="float-right">
                                        <a href="/my-course/{{ $item->slug }}" type="button" class="btn btn-outline-primary">pergi</a>
                                    </td>                                    
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection