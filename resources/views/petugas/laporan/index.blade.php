@include('petugas.layout.header')

<body class="sb-nav-fixed">
    @include('petugas.layout.navbar')

    <div id="layoutSidenav">
        @include('petugas.layout.sidebar')

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 mt-4">
                    <h3 class="mb-4">Laporan Pengembalian Alat</h3>

                    {{-- 🔹 Form Filter --}}
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <form action="{{ route('petugas.laporan.index') }}" method="GET" class="row g-3 align-items-end">
                                <div class="col-md-4">
                                    <label class="form-label">Tanggal Awal</label>
                                    <input type="date" name="tanggal_awal" value="{{ request('tanggal_awal') }}" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Tanggal Akhir</label>
                                    <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-filter me-1"></i> Tampilkan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- 🔹 Tombol Cetak --}}
                    <div class="mb-3">
                        <a href="{{ route('petugas.laporan.cetak', ['tanggal_awal' => request('tanggal_awal'), 'tanggal_akhir' => request('tanggal_akhir')]) }}"
                            target="_blank"
                            class="btn btn-danger">
                            <i class="fas fa-file-pdf me-2"></i> Cetak PDF
                        </a>
                    </div>

                    {{-- 🔹 Tabel Data --}}
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped align-middle text-center">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Peminjam</th>
                                            <th>Alat</th>
                                            <th>Jumlah</th>
                                            <th>Tgl Pinjam</th>
                                            <th>Tgl Kembali</th>
                                            <th>Denda</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($peminjamans as $index => $p)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $p->user->name }}</td>
                                            <td>{{ $p->alat->nama_alat }}</td>
                                            <td>{{ $p->jumlah }}</td>
                                            <td>{{ $p->tanggal_pinjam->format('d-m-Y') }}</td>
                                            <td>{{ $p->tanggal_kembali->format('d-m-Y') }}</td>
                                            <td>
                                                @if($p->denda > 0)
                                                Rp {{ number_format($p->denda, 0, ',', '.') }}
                                                @else
                                                -
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">Tidak ada data pengembalian</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            @include('petugas.layout.footer')
        </div>
    </div>
</body>

</html>