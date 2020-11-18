@extends('layouts.admin_layouts.master')

@section('content')
<!-- Hero -->
<div class="bg-image bg-image-bottom" style="background-image: url({{ asset('assets/media/photos/photo34@2x.jpg') }});">
    <div class="bg-primary-dark-op">
        <div class="content content-top text-center overflow-hidden">
            <div class="pb-10">
                <h1 class="font-w700 text-white mb-10 invisible" data-toggle="appear" data-class="animated fadeInUp">DAFTAR BUKU SAYA</h1>
                <h2 class="h4 font-w400 text-white-op invisible" data-toggle="appear" data-class="animated fadeInUp"></h2>
            </div>
        </div>
    </div>
</div>
<!-- END Hero -->

    <div class="content">
        <div class="col-12">
            <div class="content-heading"><label>MY BOOK</label></div>            
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
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <div class="block-content text-center">
                        MY BOOK
                    </div>
                </div>
                <div class="block-content">
                    <table table class="table table-stripped" id="table_book_kursus">
                        <thead>
                            <tr>
                                <th>BOOK NAME</th>
                                <th class="text-right">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>                                                        
                            @foreach ($book as $item)
                                @if ($item->count() == 0)                             
                                @else
                                    <tr>
                                        <td>{{ $item->book_name }}</td>                                        
                                        <td class="text-right">                                            
                                            <a href="{{ route('download', $item->book_file) }}"><i class="fa fa-check"></i> UNDUH</a>
                                        </td>
                                    </tr>
                                @endif                                
                            @endforeach                            
                        </tbody>
                    </table>                    
                </div>                
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    var table2;
    $(document).ready(function(){    
        table2= $('#table_book_kursus').DataTable({});        
    });
</script>
@endsection

