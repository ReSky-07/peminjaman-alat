@include('peminjam.layout.header')

<body class="sb-nav-fixed">
    @include('peminjam.layout.navbar')

    <div id="layoutSidenav">
        @include('peminjam.layout.sidebar')

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">

                    <h1 class="mt-4">Data Peminjaman</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Peminjaman</li>
                    </ol>

                    <a href="{{ route('peminjam.peminjaman.create') }}" class="btn btn-primary mb-4">
                        <i class="fas fa-plus me-1"></i> Ajukan Peminjaman
                    </a>

                    <div class="card shadow-sm">
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover align-middle text-center">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Alat</th>
                                            <th>Tgl Pinjam</th>
                                            <th>Tanggal Kembali</th>
                                            <th>Jumlah</th>
                                            <th>Unit Rusak</th>
                                            <th>Denda</th>
                                            <th>Status</th>
                                            <th>Pembayaran</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse($peminjamans as $p)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $p->alat->nama_alat }}</td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d-m-Y') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($p->tanggal_harus_kembali)->format('d-m-Y') }}</td>
                                            <td>{{ $p->jumlah }}</td>

                                            {{-- UNIT RUSAK --}}
                                            <td>
                                                @if($p->jumlah_rusak > 0)
                                                <span class="text-danger fw-bold">
                                                    {{ $p->jumlah_rusak }} unit
                                                </span>
                                                @else
                                                <span class="badge bg-success">0</span>
                                                @endif
                                            </td>

                                            {{-- DENDA --}}
                                            <td>
                                                @if($p->denda > 0)
                                                <span class="text-danger fw-bold">
                                                    Rp {{ number_format($p->denda, 0, ',', '.') }}
                                                </span>
                                                @else
                                                <span class="badge bg-success">Tidak Ada</span>
                                                @endif
                                            </td>

                                            {{-- STATUS PINJAM --}}
                                            <td>
                                                @if($p->status == 'pending')
                                                <span class="badge bg-warning">Pending</span>

                                                @elseif($p->status == 'disetujui')
                                                <span class="badge bg-primary">Disetujui</span>

                                                @elseif($p->status == 'menunggu_pembayaran')
                                                <span class="badge bg-danger">Ada Denda</span>

                                                @elseif($p->status == 'dikembalikan')
                                                <span class="badge bg-success">Selesai</span>

                                                @else
                                                <span class="badge bg-secondary">{{ $p->status }}</span>
                                                @endif
                                            </td>

                                            {{-- PEMBAYARAN --}}
                                            <td style="width: 250px;">

                                                {{-- SUDAH BAYAR --}}
                                                @if($p->status_pembayaran == 'sudah_bayar')

                                                <span class="badge bg-success">
                                                    Lunas
                                                </span>

                                                @elseif($p->status_pembayaran == 'menunggu_verifikasi')

                                                <span class="badge bg-danger">
                                                    Belum Bayar
                                                </span>


                                                {{-- DEFAULT --}}
                                                @else
                                                <span class="badge bg-secondary">
                                                    -
                                                </span>
                                                @endif

                                            </td>
                                        </tr>

                                        @empty
                                        <tr>
                                            <td colspan="7">Tidak ada data</td>
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