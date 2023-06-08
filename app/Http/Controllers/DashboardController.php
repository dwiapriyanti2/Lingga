<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(){
        $total_surat_masuk = Surat::where('jenis_surat','Surat Masuk')->count();
        $total_surat_keluar = Surat::where('jenis_surat','Surat Keluar')->count();
        // $total_surat_keluar = SuratKeluar::count();
        // $total_user = User::where('level', '0')->count();
        $total_user = User::all()->count();
        return view('layouts.dasboard', [
            'totalSuratMasuk' => $total_surat_masuk,
            'totalSuratKeluar' => $total_surat_keluar,
            'totalUser' => $total_user,
        ]);
    }
}
