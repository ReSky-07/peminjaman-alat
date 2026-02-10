@include('admin.layout.header')

<body class="sb-nav-fixed">
    @include('admin.layout.navbar')

    <div id="layoutSidenav">
        @include('admin.layout.sidebar')

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Tambah Peminjaman</h1>

                    <form action="{{ route('admin.peminjaman.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label>Peminjam</label>
                            <select name="user_id" class="form-control">
                                <option value="">-- Pilih Peminjam --</option>
                                @foreach($users as $u)
                                <option value="{{ $u->id }}"
                                    {{ old('user_id') == $u->id ? 'selected' : '' }}>
                                    {{ $u->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('user_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Alat</label>
                            <select name="alat_id" class="form-control">
                                <option value="">-- Pilih Alat --</option>
                                @foreach($alats as $a)
                                <option value="{{ $a->id }}"
                                    {{ old('alat_id') == $a->id ? 'selected' : '' }}>
                                    {{ $a->nama_alat }}
                                </option>
                                @endforeach
                            </select>
                            @error('alat_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Tanggal Pinjam</label>
                            <input type="date" name="tanggal_pinjam"
                                value="{{ old('tanggal_pinjam') }}"
                                class="form-control">
                            @error('tanggal_pinjam') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Jumlah</label>
                            <input type="number" name="jumlah"
                                value="{{ old('jumlah') }}"
                                class="form-control">
                            @error('jumlah') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <button class="btn btn-primary">Simpan</button>
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