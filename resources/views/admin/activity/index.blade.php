@include('admin.layout.header')

<body class="sb-nav-fixed">
    @include('admin.layout.navbar')

    <div id="layoutSidenav">
        @include('admin.layout.sidebar')

        <div id="layoutSidenav_content">
            <main class="container-fluid px-4">

                <h1 class="mt-4">Log Aktivitas</h1>

                <div class="card mb-4">
                    <div class="card-body">

                        <table id="userTable" class="table table-bordered table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>User</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                    <th>Deskripsi</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logs as $i => $log)
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td>{{ $log->user->name }}</td>
                                    <td>
                                        <span class="badge bg-secondary">
                                            {{ ucfirst($log->role) }}
                                        </span>
                                    </td>
                                    <td>{{ $log->aksi }}</td>
                                    <td>{{ $log->deskripsi }}</td>
                                    <td>{{ $log->created_at->format('d-m-Y H:i') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

            </main>
            @include('admin.layout.footer')
        </div>
    </div>
</body>

</html>