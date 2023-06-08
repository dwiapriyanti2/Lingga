@extends('template/master')
@section('title', 'Edit Klasifikasi')
@section('content')
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Edit Data Klasifikasi</h3>
        </div>
        <form action="{{ route('klasifikasi.update', ['klasifikasi' => $klasifikasi->id]) }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="">Kode Klasifikasi</label>
                    <input type="text" class="form-control" id="kode_klasifikasi" placeholder="Masukkan Kode Klasifikasi"
                        name="kode_klasifikasi" value="{{ old('kode_klasifikasi') ?? $klasifikasi->kode_klasifikasi }}">
                </div>
                <div class="form-group">
                    <label for="">Judul Klasifikasi</label>
                    <input type="text" class="form-control" id="judul_klasifikasi" placeholder="Masukkan Judul Klasifikasi"
                        name="judul_klasifikasi"  value="{{ old('judul_klasifikasi') ?? $klasifikasi->judul_klasifikasi }}">
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
        </form>
    </div>
@endsection
