<?php

namespace App\Http\Controllers;

use App\Models\Klasifikasi;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratMasukController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->authorize('roleAdmin', $this->user);
        return view('suratMasuk.index', [
            'dataSuratMasuk' => SuratMasuk::all()
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
            $surat = new SuratMasuk();
            $surat->nomor_surat = $validatedData['nomor_surat'];
            $surat->tanggal_surat = $validatedData['tanggal_surat'];
            $surat->perihal = $validatedData['perihal'];
            $surat->klasifikasi_id = $validatedData['klasifikasi_id'];
            $surat->file_surat = $fileName; // Nama file disimpan dalam field 'file_surat'
            $surat->keterangan = $validatedData['keterangan'];
            $surat->pengirim = $validatedData['pengirim'];
            $surat->users_id = Auth::user()->id;
            $surat->save();

            // Proses lainnya setelah menyimpan data surat

            return redirect()->route('surat-masuk.index')->with('success', 'Surat berhasil ditambahkan.');
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
    public function show(SuratMasuk $suratMasuk)
    {
        //
        $this->authorize('roleAdmin', $this->user);
        return view('suratMasuk.show', [
            'dataSuratMasuk' => $suratMasuk
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratMasuk $suratMasuk)
    {
        //
        $this->authorize('roleAdmin', $this->user);
        return view('suratMasuk.edit',[
            'dataKlasifikasi' => Klasifikasi::all(),
        ])->with('suratMasuk', $suratMasuk);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratMasuk $suratMasuk)
    {
        //
        $this->authorize('roleAdmin', $this->user);
        $surat = SuratMasuk::find($suratMasuk->id);
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
                'perihal' => $request['perihal'],
                'klasifikasi_id' => $request['klasifikasi_id'],
                'keterangan' => $request['keterangan'],
                'pengirim' => $request['pengirim'],
            ]);
        }
        session()->flash('success', 'Data Surat Masuk berhasil di edit');
        return redirect()->route('surat-masuk.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratMasuk $suratMasuk)
    {
        //
        $this->authorize('roleAdmin', $this->user);
        $suratMasuk->delete();
        return redirect()->route('surat-masuk.index')->with('success', "Data Surat $suratMasuk->nomor_surat berhasil dihapus");
    }
}
