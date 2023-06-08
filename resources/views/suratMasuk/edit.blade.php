@extends('template.master')
@section('title')
@section('content')
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Edit Surat</h3>
        </div>
        <form action="{{ route('surat.update', ['surat' => $surat->id]) }}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
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
                    <div class="row">
                        <div class="col-3">
                            <label for="">Nomor Surat</label>
                            <input type="text" class="form-control" placeholder="Nomor Surat" name="nomor_surat"
                                value="{{ old('nomor_surat') ?? $surat->nomor_surat }}">
                        </div>

                        <div class="col-3">
                            <label>Jenis Surat</label>
                            <select class="form-control select2" style="width: 100%;" name="jenis_surat">
                                <option value="{{ $surat->jenis_surat }}">{{ $surat->jenis_surat }}</option>
                                <option value=""></option>
                                <option value="Surat Masuk">Surat Masuk</option>
                                <option value="Surat Keluar">Surat Keluar</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Pengirim</label>
                    <input type="text" class="form-control" id="" placeholder="Masukkan Nama Pengirim"
                        name="pengirim" value="{{ old('pengirim') ?? $surat->pengirim }}">
                </div>
                <div class="form-group">
                    <label for="">Penerima</label>
                    <input type="text" class="form-control" id="" placeholder="Masukkan Nama Penerima"
                        name="penerima" value="{{ old('penerima') ?? $surat->penerima }}">
                </div>
                <div class="form-group">
                    <label for="">Perihal</label>
                    <input type="text" class="form-control" id="" placeholder="Masukkan Perihal" name="perihal"
                        value="{{ old('perihal') ?? $surat->perihal }}">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Kategori Surat</label>
                                <select class="form-control select2" style="width: 100%;" name="klasifikasi_id">
                                    <option value="">Pilih</option>
                                    @foreach ($dataKlasifikasi as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == $surat->klasifikasi_id ? 'selected' : null }}>
                                            {{ $item->judul_klasifikasi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <label for="">Tanggal Surat</label>
                            <input type="date" class="form-control" id="" placeholder="Masukkan Tanggal Surat"
                                name="tanggal_surat" value="{{ old('tanggal_surat') ?? $surat->tanggal_surat }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" rows="3" placeholder="Keterangan" name="keterangan">{{ old('keterangan') ?? $surat->keterangan }}</textarea>
                </div>
                <div class="form-group">

                </div>
                <div class="form-group">
                    <label for="">File Surat</label>
                    <div class="custom-file">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="file_surat"
                            value="{{ old('file_surat') ?? $surat->file_surat }}">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>

@endsection
