@extends('template/master')
@section('title', 'Create Pengguna')
@section('content')
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Tambah Data Pengguna</h3>
        </div>
        <form action="{{ route('users.store') }}" method="POST">
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
                    <label for="">Nama</label>
                    <input type="text" class="form-control" id="name" placeholder="Masukkan nama"
                        name="name">
                </div>
                <div class="form-group">
                    <label for="">E-mail</label>
                    <input type="text" class="form-control" id="email" placeholder="Masukkan email"
                        name="email">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Masukkan password"
                        name="password">
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
        </form>
    </div>
@endsection
