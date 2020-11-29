@extends('layouts.admin_layouts.master')

@section('content')
<!-- Hero -->
<div class="bg-image bg-image-bottom" style="background-image: url({{ asset('assets/media/photos/photo34@2x.jpg') }});">
    <div class="bg-primary-dark-op">
        <div class="content content-top text-center overflow-hidden">
            <div class="pb-20">
                <h1 class="font-w700 text-white mb-10 invisible" data-toggle="appear" data-class="animated fadeInUp">User Management</h1>
                <h2 class="h4 font-w400 text-white-op invisible" data-toggle="appear" data-class="animated fadeInUp">Welcome to your user management page!</h2>
            </div>
        </div>
    </div>
</div>
<!-- END Hero -->

<div class="content row">
    <!--form-->
    <div class="col-12">
        <nav class="breadcrumb push content-heading">
            {{-- <a class="breadcrumb-item" href="be_pages_elearning_courses.html">Courses</a> --}}
            <span class="breadcrumb-item active">User Management | <a href="{{ route('userExport') }}"> download</a> </span>
        </nav>
        {{-- <h2 class="content-heading breadcumb push">User Management</h2> --}}
        @if (Session::has('pesan-bahaya'))
        <div class="alert alert-danger text-bold">{{ Session::get('pesan-bahaya') }}</div>                
        @endif
        @if (Session::has('pesan-peringatan'))
                <div class="alert alert-warning text-bold">{{ Session::get('pesan-peringatan') }}</div>                
        @endif
        @if (Session::has('pesan-sukses'))
            <div class="alert alert-info text-bold">{{ Session::get('pesan-sukses') }}</div>
        @endif
    </div>
    <div class="col-md-4">
        <div class="block">
            <div class="block-header block-header-default">
                <h3 type="button" class="block-title btn-block-option" data-toggle="block-option" data-action="content_toggle"></h3>            
            </div>
            <div class="block-content text-primary">
                <ol>
                    <li>daftar pengguna disini hanya menampilkan pengguna yang sudah melakukan verifikasi email</li>
                    <li>pastikan anda mendaftarkan pengguna menggunakan email aktif</li>
                    <li>pengguna yang belum melakukan verifikasi email hanya dapat dilihat pada menu (dashboard:pengguna yang belum melakukan verifikasi)</li>
                </ol>
            </div>
        </div>    
        <div class="block">
        <div class="block-header block-header-default ">
            <h3 type="button" class="block-title btn-block-option" data-toggle="block-option" data-action="content_toggle"></h3>            
            <h3 class="block-title"></h3>
        </div>
        <div class="block-content">
            <form class="" action="{{ route('daftar_user.store') }}" method="post" > @csrf
                <div class="form-group">
                    <div class="form-material">
                        <input type="text" class="form-control" id="val-name" name="name" placeholder="Enter user name" required>
                        <label for="val-name">Nama</label>
                    </div>                    
                </div>
                <div class="form-group">
                    <div class="form-material">
                        <input type="email" class="form-control" id="val-email" name="email" placeholder="Your valid email.." required>
                        <label for="val-email">Email</label>
                    </div>
                </div> 
                <div class="form-group">
                    <div class="form-material">
                        <select class="js-select2 form-control js-select2-enabled select2-hidden-accessible" id="val-select22" name="role" style="width: 100%;" data-placeholder="Choose one.." data-select2-id="val-select22" tabindex="-1" aria-hidden="true" required>
                            <option data-select2-id="5"></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                            <option value="admin">admin</option>
                            <option value="instruktur">instruktur</option>
                            <option value="siswa">siswa</option>
                            
                        </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="4" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-val-select22-container"><span class="select2-selection__rendered" id="select2-val-select22-container" role="textbox" aria-readonly="true"><span class="select2-selection__placeholder">Choose one..</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        <label for="val-select2">Role</label>
                    </div>
                </div>                                   
                <div class="form-group">
                    <button type="submit" class="btn btn-alt-primary">Submit</button>
                </div>
            </form>
        </div>
      </div>
    </div>
    <!--end form-->
    <div class="col-md-8">
        <div class="block ">
            <div class="block-header block-header-default">                
                <h3 class="block-title">DAFTAR USER</h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="daftar_user" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>nama</th>
                                <th>role</th>
                                <th>status</th>                                
                                <th>email</th>
                                <th>aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_user as $item)
                                @if ($item->email_verified_at ===null)
                                @else
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->role }}</td>
                                    <td>
                                        {{-- <label class="css-control css-control-success css-switch">
                                            <input data-id="{{ $item->id }}" type="checkbox" class="css-control-input" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Inactive" {{ $item->stat ? 'checked' : '' }}>
                                            <span class="css-control-indicator"></span>
                                        </label> --}}
                                        @if ($item->stat==1)
                                            <span class="badge badge-primary">aktif</span>
                                        @else
                                        <span class="badge badge-danger">non aktif</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                      @if ($item->role=='admin')
                                      <button class="btn btn-outline-primary fa fa-pencil" data-toggle="modal" data-target="#modal-fromleft-edit"
                                      data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-email="{{ $item->email }}" data-stat="{{ $item->stat }}" data-role="{{ $item->role }}"></button>
                                      @else
                                      <a href="/profile/{{ $item->id }}" class="btn btn-outline-success fa fa-user"></a>
                                      <button class="btn btn-outline-primary fa fa-pencil" data-toggle="modal" data-target="#modal-fromleft-edit"
                                      data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-email="{{ $item->email }}" data-stat="{{ $item->stat }}" data-role="{{ $item->role }}"></button>
                                      <button class="btn btn-outline-danger fa fa-trash" data-toggle="modal" data-target="#modal-fromleftdel"
                                      data-name="{{ $item->name }}" data-id="{{ $item->id }}"></button>  
                                      @endif                                                                              
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
</div>

<!--modal edit user-->
<div class="modal fade" id="modal-fromleft" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-update-user" name="form-update-user" class="form-horizontal" action="{{ route('daftar_user.store') }}" method="POST" enctype="multipart/form-data">@csrf
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">ADD USER</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content">
                        <div class="form-group text-center border-bottom text-danger">
                            <p class="text-danger"> Perubahan data pengguna akan diberikan password baru berupa "secret" dan akan diinformasikan melalui email pengguna</p>
                        </div>
                        <div class="form-group border-bottom">
                            <input class="form-control" type="hidden" id="id" name="id" value="" required>
                            <label for="">Nama </label>               
                            <input class="form-control" type="text" id="name" name="name" value="" required>                            
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input class="form-control" type="email" id="email" name="email" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="">Role </label>
                            <select name="role" id="role" class="form-control" required>
                                <option value=""> == pilih role == </option>
                                <option value="admin">admin</option>
                                <option value="instruktur">instruktur</option>
                                <option value="siswa">siswa</option>
                            </select>
                        </div>
                        <div class="form-group float-right">
                            <button class="btn btn-outline-primary" type="submit">tambahkan</button>
                        </div>                                                                                                               
                    </div>                                                             
                </div>                        
            </form>                   
        </div>            
    </div>
</div>
<!--end modal edit user-->

<!--modal edit user-->
<div class="modal fade" id="modal-fromleft-edit" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-update-user" name="form-update-user" class="form-horizontal" action="{{ route('ubahpengguna') }}" method="POST" enctype="multipart/form-data">@csrf
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">ADD USER</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content">
                        <div class="form-group text-center border-bottom text-danger">
                            <p class="text-danger"> Perubahan data pengguna akan diberikan password baru berupa "secret" dan akan diinformasikan melalui email pengguna</p>
                        </div>
                        <div class="form-group border-bottom">
                            <input type="hidden" id="stat" name="stat">
                            <input class="form-control" type="hidden" id="id" name="id" value="" required>
                            <label for="">Nama </label>               
                            <input class="form-control" type="text" id="name" name="name" value="" required>                            
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input class="form-control" type="email" id="email" name="email" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="">Role </label>
                            <select name="role" id="role" class="form-control" required>
                                <option value=""> == pilih role == </option>
                                <option value="admin">admin</option>
                                <option value="instruktur">instruktur</option>
                                <option value="siswa">siswa</option>
                            </select>
                        </div>
                        <div class="form-group float-right">
                            <button class="btn btn-outline-primary" type="submit">tambahkan</button>
                        </div>                                                                                                               
                    </div>                                                             
                </div>                        
            </form>                   
        </div>            
    </div>
</div>
<!--end modal edit user-->

<!--modal delete user-->
<div class="modal fade" id="modal-fromleftdel" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft" role="document">                            
        <div class="modal-content">
            <form id="form-update-user" name="form-update-user" class="form-horizontal" action="{{ route('hapusUser') }}" method="POST" enctype="multipart/form-data">@csrf
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-danger">
                        <h3 class="block-title">HAPUS USER</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content">                            
                        <div class="form-group border-bottom mb-10">
                            <input type="hidden" id="id" name="id">
                            <div class="text-center text-danger">
                                <p>Anda yakin akan menghapus user tersebut ?</p>
                            </div>                            
                        </div>
                        <div class="form-group">
                            <button class="btn btn-outline-danger" type="submit">HAPUS</button>
                        </div>
                    </div>                                                             
                </div>                        
            </form>                   
        </div>            
    </div>
</div>
<!--end modal delete user-->
@endsection

@section('script')
<script>    
    var table2;
    $(document).ready(function(){    
        table2= $('#daftar_user').DataTable({});        
    });
    
</script>

<script>
    $('#modal-fromleft-edit').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var name = button.data('name')
        var email = button.data('email')
        var role = button.data('role')
        var stat = button.data('stat')
        var modal = $(this)
        modal.find('.block-title').text('Ubah data pengguna');
        modal.find('.block-content #id').val(id);
        modal.find('.block-content #name').val(name);
        modal.find('.block-content #email').val(email);
        modal.find('.block-content #role').val(role);
        modal.find('.block-content #stat').val(stat);
    })
</script>
<script>
    $('#modal-fromleftdel').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var name = button.data('name')        
        var modal = $(this)
        modal.find('.block-title').text('HAPUS USER');
        modal.find('.block-content #id').val(id);
        modal.find('.block-content #name').val(name);        
    })
</script>
@endsection