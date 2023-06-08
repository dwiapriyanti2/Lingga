@extends('template/master')
@section('title', 'Klasifikasi')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{ route('klasifikasi.create') }}" class="btn btn-primary">Tambah</a>
            </h3>
        </div>

        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Klasifikasi</th>
                        <th>Judul Klasifikasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataKlasifikasi as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kode_klasifikasi }}</td>
                            <td>{{ $item->judul_klasifikasi }}</td>
                            <td>
                                <div class="d-flex justify content between">
                                    <a href="{{ url('klasifikasi/' . $item->id . '/edit') }}"
                                        class="btn btn-warning mx-1">Edit</a>
                                    <form action="{{ url('klasifikasi/' . $item->id) }} " method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger show_confirm"
                                            data-name="{{ $item->id }}" data-toggle="tooltip"
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
                        title: 'Apakah Anda yakin ingin menghapus data klasifikasi ' + name + '?',
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
@endsection
