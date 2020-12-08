@extends('layouts.admin_layouts.master')
@section('head')

@endsection
@section('content')
<!-- Hero -->
<div class="bg-image bg-image-bottom" style="background-image: url({{ asset('assets/media/photos/photo34@2x.jpg') }});">
    <div class="bg-primary-dark-op">
        <div class="content content-top text-center overflow-hidden">
            <h5 class="h4 font-w400 text-white-op invisible" data-toggle="appear" data-class="animated fadeInUp">Form Soal!</h5>
        </div>
    </div>
</div>
<!-- END Hero -->

<div class="content">
    <div class="col-xl-12">
        <h2 class="content-heading">Create Soal | <small>form control untuk membuat soal         
    </div>
    
    @if (Session::has('message'))
    <div class="alert alert-danger text-bold">{{ Session::get('message') }}</div>                
    @endif
    @if (Session::has('pesan-peringatan'))
            <div class="alert alert-warning text-bold">{{ Session::get('pesan-peringatan') }}</div>                
    @endif
    @if (Session::has('pesan-sukses'))
        <div class="alert alert-info text-bold">{{ Session::get('pesan-sukses') }}</div>
    @endif

    <div class="row">        
        <div class="col-md-4">
            <div class="block shadow">
                <div class="block-content block-rounded ">                    
                </div>                
                <div class="block-content border-bottom block-rounded text-center">
                    <p>total soal : {{ $data->pertanyaan->count() }}</p>
                </div>
                <div class="block-content">
                    Kuis : <p> {{ $data->kuis_name }}</p>
                    Deskripsi : <p> {{ $data->kuis_desc }}</p>
                </div>                
            </div>            
        </div>
    
        <div class="col-md-8">                            
            <div class="block block-content block-content-full">
                <!-- Summernote Container -->
                <form action="{{ route('storeSoal') }}" method="post" enctype="multipart/form-data">@csrf
                    <div class="col-md-12">
                        <div class="dor">
                            <h5>soal</h5>
                            <input type="hidden" name="kuis_id" value="{{ $data_id }}">
                            <textarea id="js-summernote" class="js-summernote text-danger" name="pertanyaan_name">Jika anda mengunggah gambar Pastikan Gambar anda memiliki kualitas yang baik. Apabila gambar anda terlalu besar untuk dapat di tampilkan maka resize gambar anda ke 50%.
                                Jangan lupa untuk memberi "Jarak baris" antara gambar / tulisan dengan "enter". 
                            </textarea>
                        </div>
                        <div class="dor mt-10">
                            <h5>pilihan ganda</h5>
                            <div class="form-group ml-15">                            
                                <div class="row">
                                    @for($i=0;$i<4;$i++)
                                    <textarea type="text" name="options[]" class="js-summernote form-group form-control col-md-8 span7 @error('name') border-red @enderror" placeholder=" options {{$i+1}}" required> jika menggunakan gambar. resize hingga 50%</textarea>                                    
                                    &nbsp; &nbsp; &nbsp; &nbsp;<input class="form-group" type="radio" name="correct_answer" value="{{$i}}" required> &nbsp; &nbsp; <span> Benar</span>
                                    @endfor
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

@section('script')
    
@endsection