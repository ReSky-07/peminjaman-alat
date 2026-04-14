@include('admin.layout.header')

<body class="sb-nav-fixed">
    @include('admin.layout.navbar')

    <div id="layoutSidenav">
        @include('admin.layout.sidebar')

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">

                    <h1 class="mt-4">Edit User</h1>

                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.user.index') }}">User</a>
                        </li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>

                    {{-- ERROR VALIDATION --}}
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-user-edit me-1"></i>
                            Form Edit User
                        </div>

                        <div class="card-body">
                            <form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label>Nama</label>
                                    <input type="text"
                                        name="name"
                                        class="form-control"
                                        value="{{ old('name', $user->name) }}"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email"
                                        name="email"
                                        class="form-control"
                                        value="{{ old('email', $user->email) }}"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label>No HP</label>
                                    <input type="text"
                                        name="no_hp"
                                        class="form-control"
                                        value="{{ old('no_hp', $user->no_hp) }}"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label>Alamat</label>
                                    <textarea name="alamat" class="form-control" required>{{ old('alamat', $user->alamat) }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label>Foto KTP</label>
                                    <input type="file" name="foto_ktp" class="form-control">

                                    @if($user->foto_ktp)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $user->foto_ktp) }}" width="120">
                                    </div>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label>Password (opsional)</label>
                                    <input type="password"
                                        name="password"
                                        class="form-control"
                                        placeholder="Kosongkan jika tidak diubah">
                                </div>

                                <div class="mb-3">
                                    <label>Role</label>
                                    <select name="role" class="form-control" required>
                                        <option value="admin"
                                            {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                                            Admin
                                        </option>

                                        <option value="petugas"
                                            {{ old('role', $user->role) == 'petugas' ? 'selected' : '' }}>
                                            Petugas
                                        </option>

                                        <option value="peminjam"
                                            {{ old('role', $user->role) == 'peminjam' ? 'selected' : '' }}>
                                            Peminjam
                                        </option>
                                    </select>
                                </div>

                                <button class="btn btn-primary">
                                    <i class="fas fa-save"></i> Update
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