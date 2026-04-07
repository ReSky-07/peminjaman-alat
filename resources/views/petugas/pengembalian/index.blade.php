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

                    {{-- ================= MENUNGGU KONFIRMASI PENGEMBALIAN ================= --}}
                    <h5 class="mt-5">Menunggu Konfirmasi Pengembalian</h5>

                    <div class="card mb-5 shadow-sm">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover align-middle text-center">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pengguna</th>
                                            <th>Nama Alat</th>
                                            <th>Jumlah</th>
                                            <th>Tanggal Pinjam</th>
                                            <th>Tanggal Kembali</th>
                                            <th style="width: 250px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($aktif as $p)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
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
                                                <div class="d-flex flex-column gap-2">

                                                    {{-- tombol approve --}}
                                                    <form action="{{ route('petugas.pengembalian.konfirmasi', $p->id) }}" method="POST">
                                                        @csrf
                                                        <button class="btn btn-success btn-sm w-100">
                                                            ✔ Setujui
                                                        </button>
                                                    </form>

                                                    {{-- form rusak --}}
                                                    <form action="{{ route('petugas.pengembalian.rusak', $p->id) }}" method="POST">
                                                        @csrf
                                                        <div class="input-group input-group-sm mb-1">
                                                            <input type="number" name="jumlah_rusak"
                                                                class="form-control"
                                                                placeholder="Jumlah Rusak" required>
                                                        </div>
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
                                            <td colspan="7">Tidak ada data</td>
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
                                        <th>Unit Rusak</th>
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
                                        <td>
                                            @if($p->jumlah_rusak > 0)
                                            <span class="text-danger fw-bold">
                                                {{ $p->jumlah_rusak }} unit
                                            </span>
                                            @else
                                            <span class="badge bg-success">0</span>
                                            @endif
                                        </td>
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