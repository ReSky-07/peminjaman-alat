@include('peminjam.layout.header')

<body class="sb-nav-fixed">
    @include('peminjam.layout.navbar')

    <div id="layoutSidenav">
        @include('peminjam.layout.sidebar')

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 mt-4">
                    <h3 class="mb-3">Peminjaman Saya</h3>

                    <a href="{{ route('peminjam.peminjaman.create') }}" class="btn btn-primary mb-4">
                        <i class="fas fa-plus me-1"></i> Ajukan Peminjaman
                    </a>

                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <i class="fas fa-box me-1"></i> Daftar Peminjaman
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped align-middle text-center">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Alat</th>
                                            <th>Tanggal Pinjam</th>
                                            <th>Jumlah</th>
                                            <th>Denda</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($peminjamans as $index => $p)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $p->alat->nama_alat }}</td>
                                            <td>{{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d-m-Y') }}</td>
                                            <td>{{ $p->jumlah }}</td>
                                            <td>
                                                @if(!is_null($p->denda) && $p->denda != 0)
                                                <span class="text-danger fw-bold">
                                                    Rp {{ number_format(abs($p->denda), 0, ',', '.') }}
                                                </span>
                                                @elseif($p->denda == 0)
                                                <span class="badge bg-success">Tidak Ada</span>
                                                @else
                                                <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($p->status == 'pending')
                                                <span class="badge bg-warning text-dark">Menunggu</span>
                                                @elseif ($p->status == 'disetujui')
                                                <span class="badge bg-success">Disetujui</span>
                                                @elseif ($p->status == 'dikembalikan')
                                                <span class="badge bg-primary">Dikembalikan</span>
                                                @elseif ($p->status == 'ditolak')
                                                <span class="badge bg-danger">Ditolak</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($p->status === 'disetujui')
                                                <form action="{{ route('peminjam.peminjaman.kembalikan', $p->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Kembalikan alat ini?')"
                                                    class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-undo"></i> Kembalikan
                                                    </button>
                                                </form>
                                                @elseif($p->status === 'dikembalikan')
                                                <span class="text-muted fst-italic">Selesai</span>
                                                @else
                                                <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">
                                                Tidak ada data peminjaman.
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