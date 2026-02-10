@include('peminjam.layout.header')

<body>
    @include('peminjam.layout.navbar')
    <div id="layoutSidenav">
        @include('peminjam.layout.sidebar')
        <div id="layoutSidenav_content">

            <div class="container mt-4">
                <h3>Ajukan Peminjaman</h3>

                <form action="{{ route('peminjam.peminjaman.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label>Alat</label>
                        <select name="alat_id" class="form-control">
                            @foreach ($alats as $alat)
                            <option value="{{ $alat->id }}">
                                {{ $alat->nama_alat }} (stok: {{ $alat->stok }})
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Tanggal Pinjam</label>
                        <input type="date" name="tanggal_pinjam" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" min="1">
                    </div>

                    <button class="btn btn-success">Kirim Pengajuan</button>
                </form>
            </div>
        </div>
    </div>

    @include('peminjam.layout.footer')
</body>