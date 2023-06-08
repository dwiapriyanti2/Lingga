@extends('template/master')
@section('title', 'Surat Keluar')
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
                        <td>No Surat</td>
                        <td>{{ $dataSuratKeluar->nomor_surat }}</td>
                    </tr>
                    <tr>
                        <td>Kategori</td>
                        <td>{{ $dataSuratKeluar->klasifikasi->judul_klasifikasi }}</td>
                    </tr>
                    <tr>
                        <td>Kode Klasifikasi</td>
                        <td>{{ $dataSuratKeluar->klasifikasi->kode_klasifikasi }}</td>
                    </tr>
                    <tr>
                        <td>Perihal</td>
                        <td>{{ $dataSuratKeluar->perihal }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Surat</td>
                        <td>{{ $dataSuratKeluar->tanggal_surat }}</td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td>{{ $dataSuratKeluar->keterangan }}</td>
                    </tr>
                    <tr>
                        <td>File Surat</td>
                        <td><a href="{{ asset('storage/uploads/' . $dataSuratKeluar->file_surat) }}"
                                download>{{ $dataSuratKeluar->file_surat }}</a></td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
