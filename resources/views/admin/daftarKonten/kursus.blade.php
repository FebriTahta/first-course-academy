@extends('layouts.admin_layouts.master')

@section('content')
<!-- Hero -->
<div class="bg-image bg-image-bottom" style="background-image: url({{ asset('assets/media/photos/photo34@2x.jpg') }});">
    <div class="bg-primary-dark-op">
        <div class="content content-top text-center overflow-hidden">
            <div class="pb-10">
                <h1 class="font-w700 text-white mb-10 invisible" data-toggle="appear" data-class="animated fadeInUp">DAFTAR KURSUS</h1>
                <h2 class="h4 font-w400 text-white-op invisible" data-toggle="appear" data-class="animated fadeInUp"></h2>
            </div>
        </div>
    </div>
</div>
<!-- END Hero -->
    <div class="content">
        <div class="content-heading"><label>DAFTAR KURSUS SAYA</label></div>            
                @if (Session::has('pesan'))
                    <div class="alert alert-info text-bold">{{ Session::get('pesan') }}</div>
                @endif
                @if (Session::has('pesan-peringatan'))
                    <div class="alert alert-warning text-bold">{{ Session::get('pesan-peringatan') }}</div>
                @endif
                @if (Session::has('pesan-bahaya'))
                    <div class="alert alert-danger text-bold">{{ Session::get('pesan-bahaya') }}</div>
                @endif
                @if (Session::has('pesan-sukses'))
                    <div class="alert alert-success text-bold">{{ Session::get('pesan-sukses') }}</div>
                @endif            
            <!--end alert--> 
        <div class="row">
            <div class="col-xl-12">            
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <div class="block-content text-center">
                            KURSUS SAYA
                        </div>
                    </div>
                    <div class="block-content">
                        <table class="table table-stripped" id="daftar_kursus">
                            <thead>
                                <tr>
                                    <th>mapel</th>
                                    <th>kelas</th>
                                    <th class="text-right">option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (auth()->user()->kursus as $item)                            
                                    <tr>
                                        <td>{{ $item->mapel->mapel_name }}</td>
                                        <td class="text-left">{{ $item->kelas->kelas_name }}</td>
                                        <td class="text-right">
                                            <a href="/kursus/{{ $item->slug }}">check</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>                        
                        </table>                                            
                    </div>            
                </div>        
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    var table2;
    $(document).ready(function(){    
        table2= $('#daftar_kursus').DataTable({});        
    });
</script>
@endsection