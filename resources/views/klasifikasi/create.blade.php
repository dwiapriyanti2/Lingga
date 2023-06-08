@extends('template/master')
@section('title', 'Create Klasifikasi')
@section('content')
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Tambah Data Klasifikasi</h3>
        </div>
        <form action="{{ route('klasifikasi.store') }}" method="POST">
            @csrf
            @if ($errors->any())
                <div class="alert
                    alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-body">
                <div class="form-group">
                    <label for="">Kode Klasifikasi</label>
                    <input type="text" class="form-control" id="" placeholder="Masukkan Kode Klasifikasi"
                        name="kode_klasifikasi">
                </div>
                <div class="form-group">
                    <label for="">Judul Klasifikasi</label>
                    <input type="text" class="form-control" id="" placeholder="Masukkan Judul Klasifikasi"
                        name="judul_klasifikasi">
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
        </form>
    </div>
@endsection
