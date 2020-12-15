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
            @auth                            
            <div class="col-xl-12">
                <div class="block">
                    <div class="block-header block-header-default">
                    {{-- nafigasi block --}}
                    <p>FORUM PREMIUM</p>
                    </div>
                    <div class="block-content border-bottom">
                        <p class=""></p>
                    </div>
                    <div class="block-content">
                        <table class="table table-borderless" id="daftar_forum">
                            <thead>
                                <tr>                                    
                                    <th>FORUM</th>                                    
                                    <th class="float-right">_</th>
                                </tr>
                            </thead>
                            <tbody>                            
                            {{-- @foreach ($data_mapel as $dm)
                                @foreach ($dm->kelas as $dk)
                                <tr>                                    
                                    <td class="">{{ $dm->mapel_name }}</td>
                                    <td>{{ $dk->kelas_name }}</td>
                                    <td class="float-right">
                                        <a href="/forum-daftar-pertanyaan/{{ $dk->slug }}/{{ $dm->slug }}" class="">start</a>
                                    </td>                                    
                                </tr>
                                @endforeach
                            @endforeach --}}
                            @if (auth()->user()->role=='siswa')
                                @foreach (auth()->user()->profile->kursus as $item)
                                <?php $punya = App\kursus_profile::where('kursus_id', $item->id)->where('profile_id', auth()->user()->profile->id)->first()?>
                                        <tr>
                                            @if ($punya == null)
                                                @else
                                                <td>{{ $item->mapel->mapel_name }} {{ $item->kelas->kelas_name }}</td>                                                
                                                <td class="float-right">
                                                    <a href="/forum-daftar-pertanyaan/premium/{{ $item->kelas->slug }}/{{ $item->mapel->slug }}" class="">start</a>
                                                </td>
                                            @endif                                            
                                        </tr>
                                @endforeach
                            @elseif(auth()->user()->role=='instruktur')
                                @foreach (auth()->user()->kursus as $item)
                                <?php $punya = App\kursus_profile::where('kursus_id', $item->id)->where('profile_id', auth()->user()->profile->id)->first()?>
                                        <tr>
                                            @if ($punya == null)
                                                @else
                                                <td>{{ $item->mapel->mapel_name }} {{ $item->kelas->kelas_name }}</td>                                                
                                                <td class="float-right">
                                                    <a href="/forum-daftar-pertanyaan/premium/{{ $item->kelas->slug }}/{{ $item->mapel->slug }}" class="">start</a>
                                                </td>
                                            @endif                                            
                                        </tr>
                                @endforeach
                            @elseif(auth()->user()->role=='admin')
                                @foreach ($data_forum as $item)
                                <tr>
                                    <td>{{ $item->mapel->mapel_name }} {{ $item->kelas->kelas_name }}</td>                                                
                                        <td class="float-right">
                                            <a href="/forum-daftar-pertanyaan/premium/{{ $item->kelas->slug }}/{{ $item->mapel->slug }}" class="">start</a>
                                    </td>                                                                                                                                        
                                </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>                        
                    </div>                    
                </div>
            </div>
            @endauth
            <div class="col-xl-12">
                <div class="block">
                    <div class="block-header block-header-default">
                    {{-- nafigasi block --}}
                    <p class="">FORUM REGULER</p>
                    </div>
                    <div class="block-content border-bottom">
                        <p></p>
                    </div>
                    <div class="block-content">
                        <table class="table table-borderless" id="daftar_forum">
                            <thead>
                                <tr>                                    
                                    <th>FORUM</th>                                    
                                    <th class="float-right">_</th>
                                </tr>
                            </thead>
                            <tbody>                            
                            @foreach ($data_mapel as $dm)
                                @foreach ($dm->kelas as $dk)
                                <tr>                                    
                                    <td class="">{{ $dm->mapel_name }} {{ $dk->kelas_name }}</td>                                    
                                    <td class="float-right">
                                        <a href="/forum-daftar-pertanyaan/{{ $dk->slug }}/{{ $dm->slug }}" class="">start</a>
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