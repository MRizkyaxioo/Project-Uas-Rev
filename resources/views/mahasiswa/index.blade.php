<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap & SweetAlert -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .object-fit-cover {
            object-fit: cover;
        }
    </style>
</head>
<body class="container mt-4">

    <h2 class="text-center mb-4">DATA MAHASISWA</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

    <script>
        // Buka modal tambah otomatis jika ada error saat tambah
        document.addEventListener("DOMContentLoaded", function () {
            const modalTambah = new bootstrap.Modal(document.getElementById('tambahModal'));
            modalTambah.show();
        });
    </script>
@endif


    <!-- Form Pencarian -->
    <form id="todo-form" action="/mahasiswa" method="get">
        <div class="input-group mb-4">
            <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Masukkan Nama">
            <button class="btn btn-secondary" type="submit">Cari</button>
        </div>
    </form>

    <!-- Tombol Tambah -->
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
            <i class="bi bi-plus-circle"></i> Tambah
        </button>
    </div>

    <!-- List Mahasiswa -->
    <div class="row row-cols-1 row-cols-md-2 g-3">
        @foreach($mahasiswa as $m)
        <div class="col">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        @if($m->Foto_Profil)
                            <img src="{{ asset('storage/' . $m->Foto_Profil) }}" alt="Foto" width="70" height="70" class="rounded-circle shadow-sm object-fit-cover">
                        @else
                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center rounded-circle" style="width: 70px; height: 70px;">
                                <span class="fw-bold">?</span>
                            </div>
                        @endif
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="mb-1">{{ $m->Nama_Lengkap }}</h5>
                        <p class="text-muted mb-2">NIM: {{ $m->Nim }}</p>
                        <div class="d-flex gap-2">
                            <a href="/{{ $m->Nim }}" class="btn btn-sm btn-info">Detail</a>
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $m->Nim }}">Edit</button>
                            <form method="POST" action="/mahasiswa/delete/{{ $m->Nim }}" class="form-delete d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
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
                        <textarea class="form-control mb-2" name="Alamat">{{ $m->Alamat }}</textarea>
                        <input class="form-control mb-2" name="Email" value="{{ $m->Email }}">
                        <input class="form-control" name="foto_profil" type="file">
                        @if ($m->Foto_Profil)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $m->Foto_Profil) }}" alt="Foto Profil" width="100">
                                <p><small>Foto saat ini</small></p>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
    </div>

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
                    <input class="form-control mb-2" name="foto_profil" type="file">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const deleteForms = document.querySelectorAll('.form-delete');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data tidak bisa dikembalikan setelah dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Reset hanya input dan textarea, BUKAN select
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            modal.addEventListener('hidden.bs.modal', function () {
                const form = modal.querySelector('form');
                if (form) {
                    // Reset input (kecuali file)
                    form.querySelectorAll("input").forEach(el => {
                        if (el.type !== "file") el.value = el.defaultValue;
                    });

                    // Reset textarea
                    form.querySelectorAll("textarea").forEach(el => el.value = el.defaultValue);

                    // TIDAK reset select agar tidak menghapus isian blade kosong (undefined)
                    // form.querySelectorAll("select").forEach(el => el.value = el.defaultValue); ← DIHAPUS
                }
            });
        });
    });
</script>

</body>
</html>
