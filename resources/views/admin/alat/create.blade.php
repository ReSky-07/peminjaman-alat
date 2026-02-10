@include('admin.layout.header')

<body class="sb-nav-fixed">
    @include('admin.layout.navbar')
    <div id="layoutSidenav">
        @include('admin.layout.sidebar')

        <div id="layoutSidenav_content">
            <main class="container-fluid px-4">

                <h1 class="mt-4">Tambah Alat</h1>

                <form action="{{ route('admin.alat.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label>Nama Alat</label>
                        <input type="text" name="nama_alat" class="form-control"
                            value="{{ old('nama_alat') }}">
                    </div>

                    <div class="mb-3">
                        <label>Kategori</label>
                        <select name="kategori_id" class="form-control">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}"
                                {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Stok</label>
                        <input type="number" name="stok" class="form-control"
                            value="{{ old('stok') }}">
                    </div>

                    <div class="mb-3">
                        <label>Gambar</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>

                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.alat.index') }}" class="btn btn-secondary">Kembali</a>

                </form>

            </main>
            @include('admin.layout.footer')
        </div>
    </div>
</body>