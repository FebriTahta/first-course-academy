<!DOCTYPE html>
<html>
<head>
 <title>Mari Belajar Coding</title>
</head>
<body>
 <div align="center">
  <h2 align="center">Laporan Data User</h2>
  <table align="center" width="80%" border="1">
   <thead>
    <tr>
     <th>Nama</th>
     <th>Email</th>
     <th>Role</th>
     <th>Status</th>          
    </tr>
   </thead>
   <tbody>
        @foreach ($data_user as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->role }}</td>
                <td>
                    @if ($item->stat == 1)
                        aktif
                    @else
                        non aktif
                    @endif
                </td>                                
            </tr>
        @endforeach
   </tbody>
  </table>
 </div>
</body>
</html>