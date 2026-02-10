@include('admin.layout.header')

<body class="sb-nav-fixed">
    @include('admin.layout.navbar')
    <div id="layoutSidenav">
        @include('admin.layout.sidebar')

        <div id="layoutSidenav_content">
            <main class="container-fluid px-4">

                <h1 class="mt-4">Tambah Kategori</h1>

                <form action="{{ route('admin.kategori.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label>Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control"
                            value="{{ old('nama_kategori') }}">
                    </div>

                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Kembali</a>

                </form>

            </main>
            @include('admin.layout.footer')
        </div>
    </div>
</body>