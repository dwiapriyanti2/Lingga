<?php

namespace App\Http\Controllers;

use App\Models\Klasifikasi;
use Illuminate\Http\Request;

class KlasifikasiController extends Controller
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
        return view('klasifikasi/index', [
            'dataKlasifikasi' => Klasifikasi::all()
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
        return view('klasifikasi/create');
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
            'kode_klasifikasi' => 'required|unique:klasifikasis|max:255',
            'judul_klasifikasi' => 'required',
        ]);

        Klasifikasi::create($validatedData);

        return redirect('/klasifikasi')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Klasifikasi  $klasifikasi
     * @return \Illuminate\Http\Response
     */
    public function show(Klasifikasi $klasifikasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Klasifikasi  $klasifikasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Klasifikasi $klasifikasi)
    {
        //
        $this->authorize('roleAdmin', $this->user);
        return view('klasifikasi.edit')->with('klasifikasi', $klasifikasi);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Klasifikasi  $klasifikasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Klasifikasi $klasifikasi)
    {
        //
        $this->authorize('roleAdmin', $this->user);
        $validatedData = $request->validate([
            'kode_klasifikasi' => 'required|max:255',
            'judul_klasifikasi' => 'required'
        ]);

        Klasifikasi::where('id' , $klasifikasi->id)->update($validatedData);
        return redirect('/klasifikasi')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Klasifikasi  $klasifikasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Klasifikasi $klasifikasi)
    {
        //
        $klasifikasi->delete();
        return redirect('/klasifikasi')->with('success', 'Data berhasil dihapus');
    }
}
