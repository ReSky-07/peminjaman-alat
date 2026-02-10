@include('admin.layout.header')

<body class="sb-nav-fixed">
@include('admin.layout.navbar')
<div id="layoutSidenav">
@include('admin.layout.sidebar')

<div id="layoutSidenav_content">
<main class="container-fluid px-4">

<h1 class="mt-4">Edit Alat</h1>

<form action="{{ route('admin.alat.update', $alat->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="mb-3">
    <label>Nama Alat</label>
    <input type="text" name="nama_alat" class="form-control"
        value="{{ old('nama_alat', $alat->nama_alat) }}">
</div>

<div class="mb-3">
    <label>Kategori</label>
    <select name="kategori_id" class="form-control">
        @foreach($kategoris as $kategori)
            <option value="{{ $kategori->id }}"
                {{ old('kategori_id', $alat->kategori_id) == $kategori->id ? 'selected' : '' }}>
                {{ $kategori->nama_kategori }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Stok</label>
    <input type="number" name="stok" class="form-control"
        value="{{ old('stok', $alat->stok) }}">
</div>

<div class="mb-3">
    <label>Gambar</label><br>
    @if($alat->gambar)
        <img src="{{ asset('storage/' . $alat->gambar) }}" width="100" class="mb-2">
    @endif
    <input type="file" name="gambar" class="form-control">
</div>

<button class="btn btn-warning">Update</button>
<a href="{{ route('admin.alat.index') }}" class="btn btn-secondary">Kembali</a>

</form>

</main>
@include('admin.layout.footer')
</div>
</div>
</body>
