@extends('template.master')
@section('title', 'Laporan Surat Masuk')
@section('content')
@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('laporan-surat-masuk') }}">
                @csrf
                <div class="row">
                    <h5>Filter Laporan Surat Masuk</h5>
                </div>
                <div class="row d-flex align-items-end">
                    <div class="col-3">
                        <label for="">Dari Tanggal</label>
                        <input type="date" class="form-control" id="" placeholder="Masukkan Tanggal Surat"
                            name="dari_tanggal_surat">
                    </div>
                    <div class="col-3">
                        <label for="">Sampai Tanggal</label>
                        <input type="date" class="form-control" id="" placeholder="Masukkan Tanggal Surat"
                            name="sampai_tanggal_surat">
                    </div>
                    {{-- <div class="col-3">
                        <label for="">Jenis Surat</label>
                        <select class="form-control select2" style="width: 100%;" name="jenis_surat">
                                <option value=""></option>
                                <option value="Surat Masuk">Surat Masuk</option>
                                <option value="Surat Keluar">Surat Keluar</option>
                            </select>
                    </div> --}}
                    <div class="col-3 items-center">
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body">
            <table id="example1" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Surat</th>
                        <th>Kode Klasifikasi</th>
                        <th>Pengirim</th>
                        <th>Tanggal Surat</th>
                        <th>Kategori</th>
                        <th>Perihal</th>
                        <th>File Surat</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataSuratMasuk as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nomor_surat }}</td>
                            <td>{{ $item->klasifikasi->kode_klasifikasi }}</td>
                            <td>{{ $item->pengirim }}</td>
                            <td>{{ $item->tanggal_surat }}</td>
                            <td>{{ $item->klasifikasi->judul_klasifikasi }}</td>
                            <td>{{ $item->perihal }}</td>
                            <td>
                                <a href="{{ asset('storage/uploads/' . $item->file_surat) }}"
                                    download>{{ $item->file_surat }}</a>
                            </td>
                            <td>{{ $item->keterangan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @push('scriptDataTable')
        <script>
            $(function() {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            });
        </script>
    @endpush
@endsection
