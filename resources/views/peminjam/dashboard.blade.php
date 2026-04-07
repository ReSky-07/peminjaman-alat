@include('peminjam.layout.header')

<body class="sb-nav-fixed">
    @include('peminjam.layout.navbar')
    <div id="layoutSidenav">
        @include('peminjam.layout.sidebar')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">
                                    <h5>{{ $pending }}</h5>
                                    <p class="mb-0">Pending</p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="{{ route('peminjam.peminjaman.index') }}">
                                        Lihat Data
                                    </a>
                                    <div class="small text-white"><i class="fas fa-users"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">
                                    <h5>{{ $disetujui }}</h5>
                                    <p class="mb-0">Disetujui</p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="{{ route('peminjam.peminjaman.index') }}">
                                        Lihat Data
                                    </a>
                                    <div class="small text-white"><i class="fas fa-users"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">
                                    <h5>{{ $dikembalikan }}</h5>
                                    <p class="mb-0">Dikembalikan</p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="{{ route('peminjam.peminjaman.index') }}">
                                        Lihat Data
                                    </a>
                                    <div class="small text-white"><i class="fas fa-users"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">
                                    <h5>{{ $total }}</h5>
                                    <p class="mb-0">Total</p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="{{ route('peminjam.peminjaman.index') }}">
                                        Lihat Data
                                    </a>
                                    <div class="small text-white"><i class="fas fa-users"></i></div>
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
    @include('peminjam.layout.footer')
</body>

</html>