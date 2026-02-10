@include('admin.layout.header')

<body class="sb-nav-fixed">
    @include('admin.layout.navbar')
    <div id="layoutSidenav">
        @include('admin.layout.sidebar')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">

                    <h1 class="mt-4">Tambah User</h1>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-user-plus me-1"></i>
                            Form Tambah User
                        </div>

                        <div class="card-body">
                            <form action="{{ route('admin.user.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label>Nama</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label>Role</label>
                                    <select name="role" class="form-control" required>
                                        <option value="admin">Admin</option>
                                        <option value="petugas">Petugas</option>
                                        <option value="peminjam">Peminjam</option>
                                    </select>
                                </div>

                                <button class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan
                                </button>

                                <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
                                    Kembali
                                </a>

                            </form>
                        </div>
                    </div>

                </div>
            </main>

            @include('admin.layout.footer')
        </div>
    </div>
</body>

</html>