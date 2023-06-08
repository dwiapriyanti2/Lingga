@extends('template/master')
@section('title', 'Surat Keluar')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{ route('surat-keluar.create') }}" class="btn btn-primary">Tambah</a>
            </h3>
        </div>

        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Surat</th>
                        {{-- <th>Pengirim</th> --}}
                        <th>Tanggal Surat</th>
                        <th>Kategori</th>
                        <th>Perihal</th>
                        <th>File Surat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataSuratKeluar as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nomor_surat }}</td>
                            {{-- <td>{{ $item->pengirim }}</td> --}}
                            <td>{{ $item->tanggal_surat }}</td>
                            <td>{{ $item->klasifikasi->judul_klasifikasi }}</td>
                            <td>{{ $item->perihal }}</td>
                            <td>
                                <a href="{{ asset('storage/uploads/' . $item->file_surat) }}"
                                    download>{{ $item->file_surat }}</a>
                            </td>
                            <td>
                                <div class="d-flex justify content between">
                                    <a href="{{ url('surat-keluar/' . $item->id) }}" class="btn btn-info mx-1">Show</a>
                                    <a href="{{ url('surat-keluar/' . $item->id . '/edit') }}"
                                        class="btn btn-warning mx-1">Edit</a>
                                    {{-- <form action="{{ url('surat-keluar/' . $item->id) }} " method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-danger">Hapus</button>
                                </form> --}}
                                    <form action="{{ url('surat-keluar/' . $item->id) }} " method="POST">
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
                        title: 'Apakah Anda yakin ingin menghapus data surat keluar ' + name + '?',
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
