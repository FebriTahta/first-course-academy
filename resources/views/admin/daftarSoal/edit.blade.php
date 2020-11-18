@extends('layouts.admin_layouts.master')

@section('content')
<!-- Hero -->
<div class="bg-image bg-image-bottom" style="background-image: url({{ asset('assets/media/photos/photo34@2x.jpg') }});">
    <div class="bg-primary-dark-op">
        <div class="content content-top text-center overflow-hidden">
            <h5 class="h4 font-w400 text-white-op invisible" data-toggle="appear" data-class="animated fadeInUp">Welcome to your update question page!</h5>
        </div>
    </div>
</div>
<!-- END Hero -->

<div class="content">
    <div class="col-xl-12">
        <h2 class="content-heading">Edit Soal <small>form control untuk audit soal</small></h2>
        @if (Session::has('message'))
        <div class="alert alert-danger text-bold">{{ Session::get('message') }}</div>                
        @endif
        @if (Session::has('pesan-peringatan'))
                <div class="alert alert-warning text-bold">{{ Session::get('pesan-peringatan') }}</div>                
        @endif
        @if (Session::has('pesan-sukses'))
            <div class="alert alert-info text-bold">{{ Session::get('pesan-sukses') }}</div>
        @endif
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="block shadow">
                <div class="block-content block-rounded ">
                    <a  href="#" class="mb-20 nafigasi"><i class="si si-action-undo"></i> &nbsp; back</a>                    
                </div>                
                <div class="block-content border-bottom block-rounded text-center">
                    <p>total soal : </p>
                </div>
            </div>
        </div>

        <div class="col-md-8">                            
            <div class="block block-content block-content-full">
                <!-- Summernote Container -->
                <form action="/update-soal/{{ $data_1->id }}" method="post" enctype="multipart/form-data">@csrf
                    <div class="col-md-12">
                        <div class="dor">
                            <h5>soal</h5>
                            <input type="hidden" name="kuis_id" value="">
                            <textarea id="js-summernote" class="js-summernote" name="pertanyaan_name">{!! $data_1->pertanyaan_name !!}</textarea>
                        </div>
                        <div class="dor mt-10">
                            <h5>pilihan ganda</h5>
                            <div class="form-group ml-15">                            
                                <div class="row">
                                    @foreach ($data_2 as $key=>$ans)
                                    <input type="text" class="form-control col-7 mb-5" name="options[]" value="{{ $ans->answer }}" required>
                                    <input type="radio" class="form-control col-2" name="correct_answer" id="correct_answer" value="{{ $key }}"@if ($ans->is_correct){{ 'checked' }}                                        
                                    @endif><span>Benar</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <button class="btn btn-outline-primary" type="submit">submit</button>
                    </div>
                </form>  
            </div>            
        </div>

    </div>
</div>
@endsection