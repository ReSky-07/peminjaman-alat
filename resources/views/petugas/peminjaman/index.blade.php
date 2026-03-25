@include('petugas.layout.header')

<body class="sb-nav-fixed">
    @include('petugas.layout.navbar')

    <div id="layoutSidenav">
        @include('petugas.layout.sidebar')

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">

                    <h1 class="mt-4">Peminjaman Alat</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Petugas</li>
                    </ol>

                    {{-- ================= MENUNGGU PERSETUJUAN ================= --}}
                    <h5 class="mt-4">Menunggu Persetujuan</h5>

                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped align-middle text-center">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Peminjam</th>
                                            <th>Alat</th>
                                            <th>Jumlah</th>
                                            <th>Tanggal Pinjam</th>
                                            <th>Jatuh Tempo</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($pending as $index => $p)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $p->user->name }}</td>
                                            <td>{{ $p->alat->nama_alat }}</td>
                                            <td>{{ $p->jumlah }}</td>
                                            <td>{{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d-m-Y') }}</td>

                                            {{-- kolom tanggal jatuh tempo --}}
                                            <td>
                                                <form action="{{ route('petugas.peminjaman.approve', $p->id) }}" method="POST" class="m-0 p-0">
                                                    @csrf
                                                    <input type="date"
                                                        name="tanggal_harus_kembali"
                                                        class="form-control form-control-sm text-center"
                                                        required>
                                            </td>

                                            {{-- kolom aksi --}}
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button type="submit" class="btn btn-success btn-sm px-3">
                                                        <i class="fas fa-check">Oke</i>
                                                    </button>
                                                    </form>

                                                    <form action="{{ route('petugas.peminjaman.reject', $p->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Tolak peminjaman ini?')">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm px-3">
                                                            <i class="fas fa-times">Gak</i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-muted text-center py-3">
                                                Tidak ada peminjaman menunggu persetujuan
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    {{-- ================= PEMINJAMAN AKTIF ================= --}}
                    <h5 class="mt-5">Peminjaman Aktif</h5>

                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <table class="table table-bordered table-striped align-middle text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Peminjam</th>
                                        <th>Alat</th>
                                        <th>Jumlah</th>
                                        <th>Tgl Pinjam</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Status</th>
                                        <th>Denda</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($aktif as $index => $p)
                                    @php
                                    $dendaSementara = 0;
                                    $tarifPerHari = 5000; // sesuaikan dengan kebijakan kamu
                                    if ($p->tanggal_harus_kembali && now()->gt($p->tanggal_harus_kembali)) {
                                    $hariTerlambat = now()->diffInDays($p->tanggal_harus_kembali);
                                    $dendaSementara = $hariTerlambat * $tarifPerHari;
                                    }
                                    @endphp

                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $p->user->name }}</td>
                                        <td>{{ $p->alat->nama_alat }}</td>
                                        <td>{{ $p->jumlah }}</td>
                                        <td>{{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d-m-Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($p->tanggal_harus_kembali)->format('d-m-Y') }}</td>
                                        <td>
                                            @if($p->tanggal_harus_kembali && now()->gt($p->tanggal_harus_kembali))
                                            <span class="badge bg-danger">Terlambat</span>
                                            @else
                                            <span class="badge bg-success">Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($dendaSementara > 0)
                                            <span class="text-danger fw-bold">Rp {{ number_format($dendaSementara, 0, ',', '.') }}</span>
                                            @else
                                            <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">Tidak ada peminjaman aktif</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- ================= MENUNGGU KONFIRMASI PENGEMBALIAN ================= --}}
                    <h5 class="mt-5">Menunggu Konfirmasi Pengembalian</h5>

                    <div class="card mb-5 shadow-sm">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover align-middle text-center">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Nama Pengguna</th>
                                            <th>Nama Alat</th>
                                            <th style="width: 250px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($konfirmasi as $p)
                                        <tr>
                                            <td>{{ $p->user->name }}</td>
                                            <td>{{ $p->alat->nama_alat }}</td>
                                            <td>
                                                <div class="d-flex flex-column gap-2">

                                                    {{-- tombol approve --}}
                                                    <form action="{{ route('petugas.peminjaman.konfirmasi', $p->id) }}" method="POST">
                                                        @csrf
                                                        <button class="btn btn-success btn-sm w-100">
                                                            ✔ Setujui
                                                        </button>
                                                    </form>

                                                    {{-- form rusak --}}
                                                    <form action="{{ route('petugas.peminjaman.rusak', $p->id) }}" method="POST">
                                                        @csrf
                                                        <div class="input-group input-group-sm">
                                                            <input type="number" name="denda"
                                                                class="form-control"
                                                                placeholder="Denda" required>
                                                            <button class="btn btn-danger">
                                                                Rusak
                                                            </button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3">Tidak ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- ================= PEMINJAMAN DIKEMBALIKAN ================= --}}
                    <h5 class="mt-5">Peminjaman Dikembalikan</h5>

                    <div class="card mb-5 shadow-sm">
                        <div class="card-body">
                            <table class="table table-bordered table-striped align-middle text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Peminjam</th>
                                        <th>Alat</th>
                                        <th>Jumlah</th>
                                        <th>Tgl Pinjam</th>
                                        <th>Tgl Kembali</th>
                                        <th>Denda</th> {{-- ✅ Tambahkan kolom ini --}}
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($dikembalikan as $index => $p)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $p->user->name }}</td>
                                        <td>{{ $p->alat->nama_alat }}</td>
                                        <td>{{ $p->jumlah }}</td>
                                        <td>{{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d-m-Y') }}</td>
                                        <td>
                                            {{ $p->tanggal_kembali
                                ? \Carbon\Carbon::parse($p->tanggal_kembali)->format('d-m-Y')
                                : '-' }}
                                        </td>
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
                                        <td><span class="badge bg-primary">Dikembalikan</span></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">Belum ada alat yang dikembalikan</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </main>

            @include('petugas.layout.footer')
        </div>
    </div>
</body>

</html>