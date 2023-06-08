@extends('template/master')
@section('title')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Lihat Surat
            </h3>
        </div>

        <div class="card-body">
            <table class="table" border="1">
                <thead>
                    <tr>
                        <td>Jenis Surat</td>
                        <td>{{ $dataSuratMasuk->jenis_surat }}</td>
                    </tr>
                    <tr>
                        <td>No Surat</td>
                        <td>{{ $dataSuratMasuk->nomor_surat }}</td>
                    </tr>
                    <tr>
                        <td>Kategori</td>
                        <td>{{ $dataSuratMasuk->klasifikasi->judul_klasifikasi }}</td>
                    </tr>
                    <tr>
                        <td>Kode Klasifikasi</td>
                        <td>{{ $dataSuratMasuk->klasifikasi->kode_klasifikasi }}</td>
                    </tr>
                    <tr>
                        <td>Pengirim</td>
                        <td>{{ $dataSuratMasuk->pengirim }}</td>
                    </tr>
                    <tr>
                        <td>Penerima</td>
                        <td>{{ $dataSuratMasuk->penerima }}</td>
                    </tr>
                    <tr>
                        <td>Perihal</td>
                        <td>{{ $dataSuratMasuk->perihal }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Surat</td>
                        <td>{{ $dataSuratMasuk->tanggal_surat }}</td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td>{{ $dataSuratMasuk->keterangan }}</td>
                    </tr>
                    <tr>
                        <td>File Surat</td>
                        <td><a href="{{ asset('storage/uploads/' . $dataSuratMasuk->file_surat) }}"
                                download>{{ $dataSuratMasuk->file_surat }}</a></td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
