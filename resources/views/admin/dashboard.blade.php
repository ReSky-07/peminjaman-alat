@include('admin.layout.header')

<body class="sb-nav-fixed">
    @include('admin.layout.navbar')
    <div id="layoutSidenav">
        @include('admin.layout.sidebar')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <div class="row">

                        {{-- Jumlah User --}}
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">
                                    <h5>{{ $jumlahUser }}</h5>
                                    <p class="mb-0">Jumlah User</p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="{{ route('admin.user.index') }}">
                                        Lihat Data
                                    </a>
                                    <div class="small text-white"><i class="fas fa-users"></i></div>
                                </div>
                            </div>
                        </div>

                        {{-- Jumlah Alat --}}
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">
                                    <h5>{{ $jumlahAlat }}</h5>
                                    <p class="mb-0">Jumlah Alat</p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="{{ route('admin.alat.index') }}">
                                        Lihat Data
                                    </a>
                                    <div class="small text-white"><i class="fas fa-toolbox"></i></div>
                                </div>
                            </div>
                        </div>

                        {{-- Jumlah Kategori --}}
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">
                                    <h5>{{ $jumlahKategori }}</h5>
                                    <p class="mb-0">Jumlah Kategori</p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="{{ route('admin.kategori.index') }}">
                                        Lihat Data
                                    </a>
                                    <div class="small text-white"><i class="fas fa-tags"></i></div>
                                </div>
                            </div>
                        </div>

                        {{-- Jumlah Peminjaman --}}
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">
                                    <h5>{{ $jumlahPeminjaman }}</h5>
                                    <p class="mb-0">Total Peminjaman</p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="{{ route('admin.peminjaman.index') }}">
                                        Lihat Data
                                    </a>
                                    <div class="small text-white"><i class="fas fa-clipboard-list"></i></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card mb-4">
                    </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    @include('admin.layout.footer')
</body>

</html>