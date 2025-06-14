<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2 class="text-center">DATA MAHASISWA</h2>

    <form id="todo-form" action="/mahasiswa" method="get">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="search" value="{{ request
                                ('search') }}"
                                    placeholder="Masukkan Nama">
                                <button class="btn btn-secondary" type="submit">
                                    Cari
                                </button>
                            </div>
    </form>


    <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#tambahModal">TAMBAH</button>

    @foreach($mahasiswa as $m)
        <div class="d-flex justify-content-between border p-2 mb-2">
            <div>
                <strong>{{ $m->Nama_Lengkap }}</strong> — {{ $m->Nim }}
            </div>
            <div>
                <form method="POST" action="/mahasiswa/delete/{{ $m->Nim }}" style="display:inline-block;"
                      onsubmit="return confirm('Yakin ingin menghapus?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">HAPUS</button>
                </form>

                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                        data-bs-target="#editModal{{ $m->Nim }}">EDIT</button>

                <a href="/{{ $m->Nim }}" class="btn btn-info btn-sm">DETIL</a>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="editModal{{ $m->Nim }}" tabindex="-1">
            <div class="modal-dialog">
                <form class="modal-content" method="POST" action="/mahasiswa/update/{{ $m->Nim }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Mahasiswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input class="form-control mb-2" name="Nama_Lengkap" value="{{ $m->Nama_Lengkap }}">
                        <input class="form-control mb-2" name="Tanggal_Lahir" type="date" value="{{ $m->Tanggal_Lahir }}">
                        <select class="form-control mb-2" name="Id_Jk">
    <option value="">-- Jenis Kelamin --</option>
<option value="">Undefined</option>
</select>

<select class="form-control mb-2" name="Id_Agama">
    <option value="">-- Agama --</option>
</select>

<select class="form-control mb-2" name="Id_Provinsi">
    <option value="">-- Provinsi --</option>
</select>

<select class="form-control mb-2" name="Id_Kabupaten">
    <option value="">-- Kabupaten --</option>
</select>

<select class="form-control mb-2" name="Id_Kecamatan">
    <option value="">-- Kecamatan --</option>
</select>

<select class="form-control mb-2" name="Id_Kelurahan">
    <option value="">-- Kelurahan --</option>
</select>

<textarea class="form-control mb-2" name="Alamat" placeholder="Alamat">{{ $m->Alamat }}</textarea>
<input class="form-control mb-2" name="Email" placeholder="Email" value="{{ $m->Email }}">
<input class="form-control" name="foto_profil" type="file">
@if ($m->Foto_Profil)
    <div class="mt-2">
        <img src="{{ asset('storage/' . $m->Foto_Profil) }}" alt="Foto Profil" width="100">
        <p><small>Foto saat ini</small></p>
    </div>
@endif

                        <!-- Tambahkan input lainnya sesuai field -->
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
    <p class="text-center text-muted">
    Menampilkan {{ $mahasiswa->firstItem() }}–{{ $mahasiswa->lastItem() }} dari {{ $mahasiswa->total() }} mahasiswa
    </p>

    <!-- Navigasi pagination -->
    <div class="d-flex justify-content-center mt-3">
        {{ $mahasiswa->links() }}
    </div>


    <!-- Modal Tambah -->
    <div class="modal fade" id="tambahModal" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="/mahasiswa/store" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
<input class="form-control mb-2" name="Nim" placeholder="NIM">
<input class="form-control mb-2" name="Nama_Lengkap" placeholder="Nama Lengkap">
<input class="form-control mb-2" name="Tanggal_Lahir" type="date">

<select class="form-control mb-2" name="Id_Jk">
    <option value="">-- Jenis Kelamin --</option>
<option value="">Undefined</option>
</select>

<select class="form-control mb-2" name="Id_Agama">
    <option value="">-- Agama --</option>
</select>

<select class="form-control mb-2" name="Id_Provinsi">
    <option value="">-- Provinsi --</option>
</select>

<select class="form-control mb-2" name="Id_Kabupaten">
    <option value="">-- Kabupaten --</option>
</select>

<select class="form-control mb-2" name="Id_Kecamatan">
    <option value="">-- Kecamatan --</option>
</select>

<select class="form-control mb-2" name="Id_Kelurahan">
    <option value="">-- Kelurahan --</option>
</select>

<textarea class="form-control mb-2" name="Alamat" placeholder="Alamat"></textarea>
<input class="form-control mb-2" name="Email" placeholder="Email" type="email">
<input class="form-control mb-2" name="foto_profil" type="file" placeholder="Foto Profil (path)">
                    <!-- Tambahkan input lainnya sesuai field -->
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
