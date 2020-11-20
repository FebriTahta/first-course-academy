@extends('layouts.client_layouts.master')

@section('content')
<!-- Hero -->
<div class="bg-image bg-image-bottom" style="background-image: url({{ asset('assets/media/photos/photo34@2x.jpg') }});">
    <div class="bg-primary-dark-op">
        <div class="content content-top text-center overflow-hidden">
            <div class="pb-20">
                <h1 class="font-w700 text-white mb-10 invisible" data-toggle="appear" data-class="animated fadeInUp">FORUM</h1>
                <h2 class="h4 font-w400 text-white-op invisible" data-toggle="appear" data-class="animated fadeInUp"></h2>
            </div>
        </div>
    </div>
</div>
<!-- END Hero -->

    <div class="content">
        <div class="row">
            <div class="col-12"><h2 class="content-heading"><a href="{{ route('home') }}"> DASHBOARD </a><small>| Forum</small></h2></div>            
            <div class="col-xl-12">
                <div class="block">
                    <div class="block-header block-header-default">
                    {{-- nafigasi block --}}
                    </div>
                    <div class="block-content border-bottom">
                        <p class="text-center">DAFTAR FORUM</p>
                    </div>
                    <div class="block-content">
                        <table class="table table-borderless" id="daftar_forum">
                            <thead>
                                <tr>
                                    <th>_</th>
                                    <th>MAPEL</th>
                                    <th>KELAS</th>
                                    <th class="float-right">_</th>
                                </tr>
                            </thead>
                            <tbody>                            
                            @foreach ($data_mapel as $dm)
                                @foreach ($dm->kelas as $dk)
                                <tr>
                                    <td class=""><i class="fa fa-group"></i></td>
                                    <td class="">{{ $dm->mapel_name }}</td>
                                    <td>{{ $dk->kelas_name }}</td>
                                    <td class="float-right">
                                        <a href="/forum-daftar-pertanyaan/{{ $dk->slug }}/{{ $dm->slug }}" type="button" class="btn btn-outline-primary">cek</a>
                                    </td>                                    
                                </tr>
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>                        
                    </div>                    
                </div>
            </div>
        </div>        
    </div>
@endsection