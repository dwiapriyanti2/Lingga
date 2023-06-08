<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\Klasifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
    }
    public function surat(Request $request) {
        $this->authorize('rolePimpinan', $this->user);
        if($request->has('jenis_surat')) {
            $dataSuratKeluar = Surat::where('jenis_surat', $request->jenis_surat)->get();
        }
        else {
            $dataSuratKeluar = Surat::all();
        }
        

        return view('laporan.surat-keluar',[
            'dataSuratKeluar' => $dataSuratKeluar
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // $this->authorize('roleAdmin', $this->user);
        // return view('suratMasuk.index', [
        //     'dataSuratMasuk' => Surat::all()
        // ]);

        if($request->has('jenis_surat')) {
            $dataSuratMasuk = Surat::where('jenis_surat', $request->jenis_surat)->get();
        }
        else {
            $dataSuratMasuk = Surat::all();
        }
        
        return view('suratMasuk.index',[
            'dataSuratMasuk' => $dataSuratMasuk
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->authorize('roleAdmin', $this->user);
        return view('suratMasuk.create', [
            'dataKlasifikasi' => Klasifikasi::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->authorize('roleAdmin', $this->user);
        $validatedData = $request->validate([
            'nomor_surat' => 'required',
            'tanggal_surat' => 'required',
            'jenis_surat' => 'required',
            'penerima' => 'required',
            'perihal' => 'required',
            'klasifikasi_id' => 'required',
            'file_surat' => 'required|mimes:pdf|max:2048',
            'keterangan' => 'required',
            'pengirim' => 'required',
        ]);

        if ($request->hasFile('file_surat')) {
            // Mengambil file yang diunggah
            $file = $request->file('file_surat');

            // Mengenerate nama file unik dengan timestamp
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Menyimpan file ke direktori yang diinginkan (misalnya, public/uploads)
            $file->storeAs('public/uploads', $fileName);

            // Proses selanjutnya untuk menyimpan data surat beserta nama file

            // Contoh: menyimpan nama file ke dalam field 'nama_file' pada tabel 'surat'
            $surat = new Surat();
            $surat->nomor_surat = $validatedData['nomor_surat'];
            $surat->jenis_surat = $validatedData['jenis_surat'];
            $surat->penerima = $validatedData['penerima'];
            $surat->tanggal_surat = $validatedData['tanggal_surat'];
            $surat->perihal = $validatedData['perihal'];
            $surat->klasifikasi_id = $validatedData['klasifikasi_id'];
            $surat->file_surat = $fileName; // Nama file disimpan dalam field 'file_surat'
            $surat->keterangan = $validatedData['keterangan'];
            $surat->pengirim = $validatedData['pengirim'];
            $surat->users_id = Auth::user()->id;
            $surat->save();

            // Proses lainnya setelah menyimpan data surat

            return redirect()->route('surat.index')->with('success', 'Surat berhasil ditambahkan.');
        } else {
            // Jika tidak ada file yang dikirim, tampilkan pesan error atau lakukan tindakan yang sesuai
            return response()->json(['error' => 'File surat tidak ditemukan.'], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function show(Surat $surat)
    {
        //
        $this->authorize('roleAdmin', $this->user);
        return view('suratMasuk.show', [
            'dataSuratMasuk' => $surat
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function edit(Surat $surat)
    {
        //
        $this->authorize('roleAdmin', $this->user);
        return view('suratMasuk.edit',[
            'dataKlasifikasi' => Klasifikasi::all(),
        ])->with('surat', $surat);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Surat $surat)
    {
        //
        $this->authorize('roleAdmin', $this->user);
        $surat = Surat::find($surat->id);
        $validatedData = $request->validate([
            'file_surat' => 'mimes:pdf|max:2048',
        ]);

        if($request->has('file_surat')){
            $file = $validatedData['file_surat'];

            // Mengenerate nama file unik dengan timestamp
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Menyimpan file ke direktori yang diinginkan (misalnya, public/uploads)
            $file->storeAs('public/uploads', $fileName);

            $surat->update([
                'nomor_surat' => $request['nomor_surat'],
                'tanggal_surat' => $request['tanggal_surat'],
                'jenis_surat' => $request['jenis_surat'],
                'penerima' => $request['penerima'],
                'perihal' => $request['perihal'],
                'klasifikasi_id' => $request['klasifikasi_id'],
                'keterangan' => $request['keterangan'],
                'pengirim' => $request['pengirim'],
                'file_surat' => $fileName,
            ]);
        } else{
            $surat->update([
                'nomor_surat' => $request['nomor_surat'],
                'tanggal_surat' => $request['tanggal_surat'],
                'jenis_surat' => $request['jenis_surat'],
                'penerima' => $request['penerima'],
                'perihal' => $request['perihal'],
                'klasifikasi_id' => $request['klasifikasi_id'],
                'keterangan' => $request['keterangan'],
                'pengirim' => $request['pengirim'],
            ]);
        }
        session()->flash('success', 'Data Surat Masuk berhasil di edit');
        return redirect()->route('surat.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Surat $surat)
    {
        //
        $this->authorize('roleAdmin', $this->user);
        $surat->delete();
        return redirect()->route('surat.index')->with('success', "Data Surat $surat>nomor_surat berhasil dihapus");
    }
}
