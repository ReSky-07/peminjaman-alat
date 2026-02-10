@include('peminjam.layout.header')

<body class="sb-nav-fixed">
    @include('peminjam.layout.navbar')

    <div id="layoutSidenav">
        @include('peminjam.layout.sidebar')

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 mt-4">
                    <h3 class="mb-3">Daftar Alat</h3>

                    <div class="card shadow-sm">
                        <div class="card-header bg-success text-white">
                            <i class="fas fa-toolbox me-1"></i> Informasi Alat
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped align-middle text-center">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Alat</th>
                                            <th>Kategori</th>
                                            <th>Stok</th>
                                            <th>Gambar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($alats as $index => $alat)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $alat->nama_alat }}</td>
                                            <td>{{ $alat->kategori->nama_kategori ?? '-' }}</td>
                                            <td>
                                                @if ($alat->stok > 0)
                                                <span class="badge bg-success">{{ $alat->stok }}</span>
                                                @else
                                                <span class="badge bg-danger">Habis</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($alat->gambar)
                                                <img src="{{ asset('storage/' . $alat->gambar) }}"
                                                    alt="{{ $alat->nama_alat }}"
                                                    width="80"
                                                    height="80"
                                                    class="rounded shadow-sm border">
                                                @else
                                                <span class="text-muted fst-italic">Tidak ada gambar</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">
                                                Belum ada data alat.
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            @include('peminjam.layout.footer')
        </div>
    </div>
</body>

</html>