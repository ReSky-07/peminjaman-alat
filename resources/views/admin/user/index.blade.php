@include('admin.layout.header')

<body class="sb-nav-fixed">
    @include('admin.layout.navbar')

    <div id="layoutSidenav">
        @include('admin.layout.sidebar')

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">

                    <h1 class="mt-4">Data User</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">User</li>
                    </ol>

                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-users me-1"></i>
                            Data User
                            <a href="{{ route('admin.user.create') }}"
                                class="btn btn-primary btn-sm float-end">
                                <i class="fas fa-plus"></i> Tambah User
                            </a>
                        </div>

                        <div class="card-body">
                            <table id="userTable" class="table table-bordered table-striped align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th width="150">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span class="badge
                                {{ $user->role == 'admin' ? 'bg-danger' :
                                   ($user->role == 'petugas' ? 'bg-warning' : 'bg-success') }}">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.user.edit',$user->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit">Edit</i>
                                            </a>

                                            <form action="{{ route('admin.user.destroy',$user->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm btn-delete">
                                                    <i class="fas fa-trash">Hapus</i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </main>

            @include('admin.layout.footer')

            <script>
                document.querySelectorAll('.btn-delete').forEach(button => {
                    button.addEventListener('click', function() {
                        let form = this.closest("form");

                        Swal.fire({
                            title: 'Yakin?',
                            text: 'Data tidak bisa dikembalikan!',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya, hapus!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                });
            </script>

        </div>
    </div>

</body>

</html>