<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
 
use App\User;
use PDF;
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class LaporanController extends Controller
{
    public function userExcel()
    {
        $nama_file = 'laporan_user_'.date('Y-m-d_H-i-s').'.xlsx';
        // return Excel::download(new SiswaExport, 'siswa.xlsx');
        return Excel::download(new UserExport, $nama_file);
    }

    public function userPDF()
    {
        $data_user = User::all();
 
    	$pdf = PDF::loadview('admin.daftarUser.user_pdf',['data_user'=>$data_user]);
    	return $pdf->stream('laporan-user-pdf');
    }
}
