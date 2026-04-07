@include('admin.layout.header')

<body class="sb-nav-fixed">
    @include('admin.layout.navbar')

    <div id="layoutSidenav">
        @include('admin.layout.sidebar')

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Data Peminjaman</h1>

                    <a href="{{ route('admin.peminjaman.create') }}"
                        class="btn btn-primary mb-3">
                        Tambah Peminjaman
                    </a>

                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <table id="userTable" class="table table-bordered table-striped align-middle">
                        <thead>
                            <tr>
                                <th>Peminjam</th>
                                <th>Penyetuju</th>
                                <th>Alat</th>
                                <th>Tanggal Pinjam</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peminjamans as $p)
                            <tr>
                                <td>{{ $p->user->name }}</td>
                                <td>
                                    {{ $p->approved_at ? $p->approver->name : '-' }}
                                </td>
                                <td>{{ $p->alat->nama_alat }}</td>
                                <td>{{ $p->tanggal_pinjam }}</td>
                                <td>{{ $p->jumlah }}</td>
                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $p->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.peminjaman.edit', $p->id) }}"
                                        class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.peminjaman.destroy', $p->id) }}"
                                        method="POST"
                                        style="display:inline-block">
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

                </div>
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

</html>