<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
    }

    //
    public function surat_masuk(Request $request){
        $this->authorize('rolePimpinan', $this->user);
        if($request->has('dari_tanggal_surat') && $request->has('sampai_tanggal_surat')) {
            $dataSuratMasuk = Surat::whereBetween('tanggal_surat', [$request->dari_tanggal_surat, $request->sampai_tanggal_surat])
            ->where('jenis_surat', 'Surat Masuk')->get();
        } else {
            $dataSuratMasuk = Surat::where('jenis_surat', 'Surat Masuk')->get();
        }

        return view('laporan.surat-masuk',[
            'dataSuratMasuk' => $dataSuratMasuk
        ]);
    }

    public function surat_keluar(Request $request) {
        $this->authorize('rolePimpinan', $this->user);
        if($request->has('dari_tanggal_surat') && $request->has('sampai_tanggal_surat')) {
            $dataSuratKeluar = Surat::whereBetween('tanggal_surat', [$request->dari_tanggal_surat, $request->sampai_tanggal_surat])
            ->where('jenis_surat', 'Surat Keluar')->get();
        } else {
            $dataSuratKeluar = Surat::where('jenis_surat', 'Surat Keluar')->get();
        }

        return view('laporan.surat-keluar',[
            'dataSuratKeluar' => $dataSuratKeluar
        ]);
    }
}
