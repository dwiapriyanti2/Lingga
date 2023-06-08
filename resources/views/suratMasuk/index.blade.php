@extends('template/master')
@section('title', 'Surat Masuk dan Keluar')
@section('content')
    <div class="card">
        {{-- <div class="card-header">
            <div class="row">
                <div class="col--sm-3">
                    <h3 class="card-title">
                        <a href="{{ route('surat-masuk.create') }}" class="btn btn-primary">Tambah</a>
                    </h3>
                </div>
                <div class="col-sm-6">
                    <form action="{{ route('laporan-surat-keluar') }}">
                    @csrf
                        <div class="col-sm-3">
                            <label for="">Jenis Surat</label>
                            <select class="form-control select2" style="width: 100%;" name="jenis_surat">
                                    <option value=""></option>
                                    <option value="Surat Masuk">Surat Masuk</option>
                                    <option value="Surat Keluar">Surat Keluar</option>
                                </select>
                        </div>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-primary">Tampilkan</button>
                        </div>
                    </form>
                </div>

            </div>


        </div> --}}

        <div class="card-header">
            <form action="{{ route('surat.index') }}">
                @csrf
                <div class="row">
                    <h5>Filter Surat Masuk dan Keluar</h5>
                </div>
                <div class="row d-flex align-items-end">
                    <div class="col-3">
                        <a href="{{ route('surat-masuk.create') }}" class="btn btn-primary">Tambah</a>
                    </div>
                    <form action="{{ route('laporan-surat-keluar') }}">
                        @csrf
                        <div class="col-3">
                            <select class="form-control select2" style="width: 100%;" name="jenis_surat">
                                <option value="">Pilih Jenis Surat</option>
                                <option value="Surat Masuk">Surat Masuk</option>
                                <option value="Surat Keluar">Surat Keluar</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <button type="submit" class="btn btn-primary">Tampilkan</button>
                        </div>
                    </form>
                </div>
            </form>
        </div>

        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Surat</th>
                        <th>Jenis Surat</th>
                        <th>Pengirim</th>
                        <th>Tanggal Surat</th>
                        <th>Kategori</th>
                        <th>Perihal</th>
                        <th>File Surat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataSuratMasuk as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nomor_surat }}</td>
                            <td>{{ $item->jenis_surat }}</td>
                            <td>{{ $item->pengirim }}</td>
                            <td>{{ $item->tanggal_surat }}</td>
                            <td>{{ $item->klasifikasi->judul_klasifikasi }}</td>
                            <td>{{ $item->perihal }}</td>
                            <td>
                                <a href="{{ asset('storage/uploads/' . $item->file_surat) }}"
                                    download>{{ $item->file_surat }}</a>
                            </td>
                            <td>
                                <div class="d-flex justify content between">
                                    <a href="{{ url('surat/' . $item->id) }}" class="btn btn-info mx-1">Show</a>
                                    <a href="{{ url('surat/' . $item->id . '/edit') }}"
                                        class="btn btn-warning mx-1">Edit</a>
                                    {{-- <form action="{{ url('surat-masuk/' . $item->id) }} " method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-danger">Hapus</button>
                                </form> --}}
                                    <form action="{{ url('surat/' . $item->id) }} " method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger show_confirm"
                                            data-name="{{ $item->nomor_surat }}" data-toggle="tooltip"
                                            title='Delete'>Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- Delete Modal --}}
    @push('modalDelete')
        <script type="text/javascript">
            $('.show_confirm').click(function(event) {
                var form = $(this).closest("form");
                var name = $(this).data("name");
                event.preventDefault();
                swal({
                        title: 'Apakah Anda yakin ingin menghapus data surat masuk' + name + '?',
                        text: "Jika anda melanjutkan penghapusan data, maka data akan hilang selamanya.",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        }
                    });
            });
        </script>
    @endpush

    @push('scriptDataTable')
        <script>
            $(function() {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": []
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
