@include('admin.layout.header')

<body class="sb-nav-fixed">
    @include('admin.layout.navbar')
    <div id="layoutSidenav">
        @include('admin.layout.sidebar')

        <div id="layoutSidenav_content">
            <main class="container-fluid px-4">

                <h1 class="mt-4">Data Alat</h1>

                <a href="{{ route('admin.alat.create') }}" class="btn btn-primary mb-3">
                    + Tambah Alat
                </a>

                <table id="userTable" class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($alats as $alat)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $alat->nama_alat }}</td>
                            <td>{{ $alat->kategori->nama_kategori }}</td>
                            <td>{{ $alat->stok }}</td>
                            <td>
                                @if($alat->gambar)
                                <img src="{{ asset('storage/' . $alat->gambar) }}" width="80">
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.alat.edit', $alat->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.alat.destroy', $alat->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm btn-delete">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>


            </main>
            @include('admin.layout.footer')
            <script>
                document.querySelectorAll('.btn-delete').forEach(button => {
                    button.addEventListener('click', function() {
                        let form = this.closest("form");

                        Swal.fire({
                            title: 'Yakin?',
                            text: 'Data tidak bisa dikembalikan!',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya, hapus!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                });
            </script>
        </div>
    </div>
</body>