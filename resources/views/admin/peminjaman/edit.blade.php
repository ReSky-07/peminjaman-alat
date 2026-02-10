@include('admin.layout.header')

<body class="sb-nav-fixed">
    @include('admin.layout.navbar')

    <div id="layoutSidenav">
        @include('admin.layout.sidebar')

        <div class="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Edit Peminjaman</h1>

                    <form action="{{ route('admin.peminjaman.update', $peminjaman->id) }}"
                        method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label>Peminjam</label>
                            <select name="user_id" class="form-control">
                                @foreach($users as $u)
                                <option value="{{ $u->id }}"
                                    {{ old('user_id', $peminjaman->user_id) == $u->id ? 'selected' : '' }}>
                                    {{ $u->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Alat</label>
                            <select name="alat_id" class="form-control">
                                @foreach($alats as $a)
                                <option value="{{ $a->id }}"
                                    {{ old('alat_id', $peminjaman->alat_id) == $a->id ? 'selected' : '' }}>
                                    {{ $a->nama_alat }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Tanggal Pinjam</label>
                            <input type="date" name="tanggal_pinjam"
                                value="{{ old('tanggal_pinjam', $peminjaman->tanggal_pinjam) }}"
                                class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Tanggal Kembali</label>
                            <input type="date" name="tanggal_kembali"
                                value="{{ old('tanggal_kembali', $peminjaman->tanggal_kembali) }}"
                                class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Jumlah</label>
                            <input type="number" name="jumlah"
                                value="{{ old('jumlah', $peminjaman->jumlah) }}"
                                class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                @foreach(['pending','disetujui','ditolak'] as $s)
                                <option value="{{ $s }}"
                                    {{ old('status', $peminjaman->status) == $s ? 'selected' : '' }}>
                                    {{ ucfirst($s) }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <button class="btn btn-primary">Update</button>
                        <a href="{{ route('admin.peminjaman.index') }}"
                            class="btn btn-secondary">Kembali</a>
                    </form>

                </div>
            </main>

            @include('admin.layout.footer')
        </div>
    </div>
</body>

</html>