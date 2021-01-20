@extends('layouts.new_layouts.master')
@section('head')
<link rel="stylesheet" id="css-main" href="{{ asset('assets/css/codebase.min.css') }}">
@endsection
@section('content')
    <div class="content">
        <section class="w3l-homeblock1 py-sm-5 py-4" style="min-height: 800px">
            <div class="row row-deck">
                <div class="col-md-4">
                    <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">
                                <i class="fa fa-user fa-fw mr-5 text-muted"></i> Account
                            </h3>
                        </div>
                        <div class="block-content block-content-full">
                            <label class="mb">
                                <strong>Hari ini:</strong> <p id="waktu"></p>
                                
                            </label>
                            <p class="float-right" id="jam">
                                <strong>:</strong> 
                            </p>                        
                            <p>
                                <strong>Name:</strong> {{ auth()->user()->name }}
                            </p>
                            <button type="button" onclick="scrollfu2()" class="btn btn-sm btn-primary mr-5">
                                Biodata
                            </button>
                            <a class="btn btn-sm btn-danger float-right" href="{{ route('password.request') }}">
                                {{ __('Forgot / Reset Your Password?') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">
                                <i class="fa fa-money fa-fw mr-5 text-muted"></i> Anggota @if (count(auth()->user()->kursus)==0)
                                    Reguler ({{ auth()->user()->role }})
                                @else
                                    Premium ({{ auth()->user()->role }})
                                @endif
                            </h3>
                        </div>
                        <div class="block-content block-content-full">
                            <p class="mb-5">
                                Bergabung Pada :  <strong class="float-right">{{ auth()->user()->created_at }}</strong>
                            </p>
                            <p class="text-muted">
                                @if (auth()->user()->role=='instruktur')
                                    @if (count(auth()->user()->kursus)==0)
                                        Anda belum memiliki kursus. Segera hubungi Admin untuk mendapatkan kursus
                                    @else
                                        Anda Mempunyai <strong>{{ count(auth()->user()->kursus) }} Kursus</strong>.<br>
                                        <small>Silahkan periksa dan atur materi pada daftar kursus anda</small><br>
                                        <button style="margin-top: 30px" class="btn btn-sm btn-success" onclick="scrollfu()">Daftar kursus anda</button>
                                    @endif
                                @else
                                    @if (count(auth()->user()->profile->kursus)==0)
                                        Anda belum memiliki kursus. Segera hubungi Admin untuk mendapatkan kursus dan akses materi bergengsi kami 
                                    @else
                                        Anda telah berlangganan <strong>{{ count(auth()->user()->profile->kursus) }} Kursus</strong>.<br>
                                        <small>Terimakasih telah berlangganan kursus pada kami</small>
                                        <button style="margin-top: 30px" class="btn btn-sm btn-success" onclick="scrollfu()">Daftar kursus anda</button>
                                    @endif
                                @endif                                
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">
                                <i class="fa fa-info fa-fw mr-5 text-muted"></i> Fitur
                            </h3>
                        </div>
                        <div class="block-content block-content-full">
                            <p>Fitur yang anda miliki</p>
                            @if (count(auth()->user()->profile->kursus)==0)
                            <ol>
                                <li class="mr-5 fa fa-times"> Forum Premium (berlangganan kursus)</li>
                                <li class="mr-5 fa fa-check"> Forum Reguler (semua pengguna)</li>
                                <li class="mr-5 fa fa-times"> Akses ke kursus yang dipilih</li>
                                <li class="mr-5 fa fa-times"> Video materi pada khusus</li>
                                <li class="mr-5 fa fa-times"> Multiple Choice latihan soal</li>
                                <li class="mr-5 fa fa-times"> Dokumen materi tertulis (downloadable)</li>
                            </ol>
                            @else
                            <ol>
                                <li class="mr-5 fa fa-check"> Forum Premium (berlangganan kursus)</li>
                                <li class="mr-5 fa fa-check"> Forum Reguler (semua pengguna)</li>
                                <li class="mr-5 fa fa-check"> Akses ke kursus yang dipilih</li>
                                <li class="mr-5 fa fa-check"> Video materi pada kursus</li>
                                <li class="mr-5 fa fa-check"> Multiple Choice latihan soal</li>
                                <li class="mr-5 fa fa-check"> Dokumen materi tertulis (downloadable)</li>
                            </ol>
                            @endif                                                        
                        </div>
                    </div>
                </div>
            </div>                        

            <div class="block">
                <div class="block-header block-header-default " id="daftarkursus">
                    <h3 class="block-title">Daftar Kursus</h3>
                </div>
                @if (auth()->user()->role=='instruktur')
                    @if (count(auth()->user()->kursus)==0)
                        <div class="block-content text-center">
                            <p class="text-danger">ADMIN SEDANG MEMPERSIAPKAN KURSUS ANDA</p>
                            <p><i class="fa fa-phone"></i> 081-329-146-514</p>
                        </div>
                    @else
                        <div class="block-content">
                            <p>Anda memiliki total ({{ count(auth()->user()->kursus) }} kursus )</p>
                            <table class="table table-striped table-vcenter">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 10%;"><i class="fa fa-university"></i></th>
                                        <th>Kursus</th>
                                        <th class="d-none d-sm-table-cell" style="width: 20%">Instruktur</th>
                                        <th class="d-none d-sm-table-cell" style="width: 20%">Siswa</th>
                                        <th class="d-none d-md-table-cell text-center" style="width: 15%;">Status</th>
                                        <th class="text-center" style="width: 100px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (auth()->user()->kursus as $item)
                                    <tr>
                                        <td class="text-center">
                                            <img class="img-avatar img-avatar48" src="{{ asset('kursus_picture/'.$item->kursus_pict) }}" alt="">
                                        </td>
                                        <td class="font-w800">{{ $item->mapel->mapel_name }} | {{ $item->kelas->kelas_name }}</td>
                                        <td class="d-none d-sm-table-cell">
                                            <img class="img-avatar img-avatar48" @if ($item->user->profile->photo==null)
                                                src="{{ asset('assets/assets/images/a1.jpg') }}"
                                            @else
                                                src="{{ asset('photo/'.$item->user->profile->photo) }}"
                                            @endif 
                                            alt="instruktur_photo">
                                            {{ $item->user->name }} 
                                        </td>
                                        <td class="d-none d-md-table-cell">
                                            <p><u>{{ count($item->profile) }} siswa</u></p>
                                        </td>
                                        <td class="d-none d-md-table-cell text-center">
                                            <p class="badge @if($item->status=='aktif') badge-primary @else badge-danger @endif">{{ $item->status }}</p>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                @if ($item->status == 'nonaktif')
                                                    <a href="{{ route('myCourse',$item->slug) }}" type="button" class="button btn btn-sm btn-danger uppercase"> Non Aktif </a>
                                                @else
                                                    <a href="{{ route('myCourse',$item->slug) }}" type="button" class="button btn btn-sm btn-success uppercase"> Start </a>
                                                @endif                                        
                                            </div>
                                        </td>
                                    </tr>  
                                    @endforeach                                                      
                                </tbody>
                            </table>
                        </div>
                    @endif
                @else
                    @if (count(auth()->user()->profile->kursus)==0)
                        <div class="block-content text-center">
                            <p class="text-danger">ADMIN SEDANG MEMPERSIAPKAN KURSUS ANDA</p>
                            <p><i class="fa fa-phone"></i> 081-329-146-514</p>
                        </div>
                    @else
                        <div class="block-content">
                            <p>Anda memiliki total ({{ count(auth()->user()->profile->kursus) }} kursus )</p>
                            <table class="table table-striped table-vcenter">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 100px;"><i class="fa fa-university"></i></th>
                                        <th>Kursus</th>
                                        <th class="d-none d-sm-table-cell" style="width: 30%;">Instruktur</th>
                                        <th class="d-none d-md-table-cell text-center" style="width: 15%;">Status</th>
                                        <th class="text-center" style="width: 100px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (auth()->user()->profile->kursus as $item)
                                    <tr>
                                        <td class="text-center">
                                            <img class="img-avatar img-avatar48" src="{{ asset('kursus_picture/'.$item->kursus_pict) }}" alt="">
                                        </td>
                                        <td class="font-w800">{{ $item->mapel->mapel_name }} | {{ $item->kelas->kelas_name }}</td>
                                        <td class="d-none d-sm-table-cell">
                                            <img class="img-avatar img-avatar48" @if ($item->user->profile->photo==null)
                                                src="{{ asset('assets/assets/images/a1.jpg') }}"
                                            @else
                                                src="{{ asset('photo/'.$item->user->profile->photo) }}"
                                            @endif 
                                            alt="instruktur_photo">
                                            {{ $item->user->name }}                                
                                        </td>
                                        <td class="d-none d-md-table-cell text-center">
                                            <p class="badge badge-primary">{{ $item->status }}</p>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                @if ($item->status == 'nonaktif')
                                                    <a href="#closed" type="button" class="button btn btn-danger uppercase"> Closed </a>
                                                @else
                                                    <a href="{{ route('myCourse',$item->slug) }}" type="button" class="button btn btn-success uppercase"> Start </a>
                                                @endif                                        
                                            </div>
                                        </td>
                                    </tr>  
                                    @endforeach                                                      
                                </tbody>
                            </table>
                        </div>
                    @endif
                @endif
            </div>

            
                <div class="container py-lg-5 py-md-4" id="profile">
                    <div class="block " >
                        <div class="block-header block-header-default">
                            <h3 class="block-title">
                                <i class="fa fa-pencil fa-fw mr-5 text-muted"></i> Profile
                            </h3>
                        </div>
                        <div class="block-content" >
                            <div class="row items-push">
                                <div class="col-lg-3">
                                    <p class="text-muted">
                                        Your account’s vital info. Isi sesuai dengan data diri anda
                                    </p>
                                </div>
                                <div class="col-lg-7 offset-lg-1">
                                    <form action="{{ route('storeProfile') }}" method="post" enctype="multipart/form-data"> @csrf
                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                        <div class="form-group">
                                            <label for="hosting-settings-profile-alamat">Alamat</label>
                                            <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control" placeholder="Jl Simo Jawar III / Rt 02. Rw 01. no. 104 Surabaya">{{ auth()->user()->profile->alamat }}</textarea>
                                        </div>                                        
                                        <div class="form-group">
                                            <label for="phone">Nomor Telephone</label>
                                            <input type="tel" class="form-control" id="phone" name="telp" placeholder="081-329-146-514" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}-[0-9]{3}" value="{{ auth()->user()->profile->telp }}" required>
                                            <small>Format: 081-329-146-514</small>
                                        </div>
                                        <div class="form-group">
                                            <label>
                                                @if (auth()->user()->role=='instruktur')
                                                    Alumni Perguruan Tinggi / Universitas
                                                @else
                                                    Asal Sekolah
                                                @endif 
                                            </label>
                                            <input type="text" name="alumni" class="form-control" placeholder="SMPN 4 Surabaya" value="{{ auth()->user()->profile->alumni }} "  required>
                                        </div>
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select name="gender" id="gender" class="form-control" required>
                                                <option value="">Pilih salah satu</option>
                                                <option value="Laki-Laki">Laki-Laki</option>
                                                <option value="Laki-Laki">Perempuan</option>                                                
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="photo">Photo</label><br>
                                            <input type="file" name="photo">
                                        </div>
                                        <div class="form-group float-right">
                                            <button type="submit" class="btn btn-primary">Update</button>                                        
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>             
        </section>                                        
    </div>
@endsection

@section('script')
    <script>
        function scrollfu()
        {
            var skrollke = document.getElementById("daftarkursus");
            skrollke.scrollIntoView();
        }        
    </script>
    <script>
        function scrollfu2()
        {
            var skrollke = document.getElementById("profile");
            skrollke.scrollIntoView();
        }
    </script>
    <script type="text/javascript">
        var months  =['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        var theDays =['Minggu','Senen','Selasa','Rabu','Kamis','Jumat','Sabtu'];
        var date    = new Date();
        var day     = date.getDate();
        var month   = date.getMonth();
        var thisDay = date.getDay(),
            thisDay = theDays[thisDay];
        var yy      = date.getYear();
        var year    = (yy<1000) ? yy + 1900: yy;
        document.write(thisDay+',' + day + '' + months[month] + '' + year);
        document.getElementById("waktu").innerHTML=(thisDay+', ' + day + '' + months[month] + '' + year);
    </script>
    <script>
        function showtime()
        {            
            var today       = new Date();
            var curr_hour   = today.getHours();
            var curr_minute = today.getMinutes();
            var curr_second = today.getSeconds();            
            curr_hour       = checkTime(curr_hour);
            curr_minute     = checkTime(curr_minute);
            curr_second     = checkTime(curr_second);
            document.getElementById("jam").innerHTML=curr_hour+ ":" + curr_minute + ":" + curr_second ;                        
        }
        function checkTime(i){            
            if(i == 60){
                i = 60;
            }
            return i;        
        }
        setInterval(showtime, 500);
    </script>
@endsection