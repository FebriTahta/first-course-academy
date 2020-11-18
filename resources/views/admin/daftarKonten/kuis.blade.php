@extends('layouts.admin_layouts.master')

@section('content')
<!-- Hero -->
<div class="bg-image bg-image-bottom" style="background-image: url({{ asset('assets/media/photos/photo34@2x.jpg') }});">
    <div class="bg-primary-dark-op">
        <div class="content content-top text-center overflow-hidden">
            <div class="pb-10">
                <h1 class="font-w700 text-white mb-10 invisible" data-toggle="appear" data-class="animated fadeInUp">DAFTAR KUIS SAYA</h1>
                <h2 class="h4 font-w400 text-white-op invisible" data-toggle="appear" data-class="animated fadeInUp"></h2>
            </div>
        </div>
    </div>
</div>
<!-- END Hero -->
    <div class="content">
        <div class="content-heading"><label>KUIS SAYA</label></div>            
                @if (Session::has('pesan'))
                    <div class="alert alert-info text-bold">{{ Session::get('pesan') }}</div>
                @endif
                @if (Session::has('pesan-peringatan'))
                    <div class="alert alert-warning text-bold">{{ Session::get('pesan-peringatan') }}</div>
                @endif
                @if (Session::has('pesan-sukses'))
                    <div class="alert alert-success text-bold">{{ Session::get('pesan-sukses') }}</div>
                @endif            
            <!--end alert-->
        <div class="row">
            <div class="col-12">
                <div class="block">
                    <div class="block-header block-header-default">
                        <div class="block-content text-center">
                            
                        </div>
                    </div>
                    <div class="block-content">
                        <table class="table table-stripped" id="daftar_kuis">
                            <thead>
                                <tr>
                                    <th>KUIS NAME</th>
                                    <th>JUMLAH SOAL</th>
                                    <th class="text-right border-bottom">VIEW</th>
                                    <th class="text-right border-bottom">TAMBAH SOAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kuis as $kuis_item)
                                <tr>
                                    <td class="border-bottom"><i class="fa fa-fw fa-edit"></i>&nbsp; {{ $kuis_item->kuis_name }}</td>
                                    <td class="border-bottom">{{ $kuis_item->pertanyaan->count() }} soal</td>                                    
                                    @if (auth()->user()->role=='student')
                                    <td class="text-right border-bottom"><i></i>&nbsp; <a href="">start</a></td>
                                    @else
                                    <td class="text-right border-bottom"><i></i>&nbsp; <a href="{{ route('detailSoal', $kuis_item->slug) }}">detail</a></td>    
                                    <td class="text-right border-bottom"><i></i>&nbsp; <a href="{{ route('createSoal', $kuis_item->slug) }}"><i class="fa fa-plus"></i> soal</a></td>                                                               
                                    @endif                                    
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
        table2= $('#daftar_kuis').DataTable({});        
    });
</script>
@endsection