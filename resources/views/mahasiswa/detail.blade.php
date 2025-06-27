<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-hover:hover {
            transform: scale(1.01);
            transition: 0.3s;
        }
        .ribbon {
            position: absolute;
            top: -10px;
            left: -10px;
            background: #0d6efd;
            color: white;
            padding: 5px 15px;
            font-weight: bold;
            transform: rotate(-10deg);
            box-shadow: 0 0 5px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="position-relative card shadow-sm card-hover">
            <div class="ribbon">{{ $data->Nama_Lengkap }}</div>
            <div class="card-header bg-primary text-white text-center">
                <h2>Detail Mahasiswa</h2>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-4 text-center">
                        @if($data->Foto_Profil)
                            <img src="{{ asset('storage/' . $data->Foto_Profil) }}" alt="Foto Profil" class="img-thumbnail rounded-circle" style="max-width: 180px;">
                        @else
                            <div class="text-muted">Tidak ada foto</div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong><i class="bi bi-person-badge"></i> NIM:</strong> {{ $data->Nim }}</li>
                            <li class="list-group-item"><strong><i class="bi bi-calendar"></i> Tanggal Lahir:</strong> {{ $data->Tanggal_Lahir }}</li>
                            <li class="list-group-item"><strong><i class="bi bi-geo-alt"></i> Alamat:</strong> {{ $data->Alamat }}</li>
                            <li class="list-group-item"><strong><i class="bi bi-envelope"></i> Email:</strong> {{ $data->Email }}</li>
                        </ul>
                    </div>
                </div>

                <div class="row text-center">
                    <div class="col-md-6">
                        <p><strong>Jenis Kelamin:</strong>
                            @if($data->Id_Jk)
                                {{ $data->Id_Jk }}
                            @else
                                <span class="badge bg-warning text-dark">Undefined</span>
                            @endif
                        </p>
                        <p><strong>Agama:</strong>
                            @if($data->Id_Agama)
                                {{ $data->Id_Agama }}
                            @else
                                <span class="badge bg-warning text-dark">Undefined</span>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Provinsi:</strong>
                            {{ $data->Id_Provinsi ?? 'Undefined' }}
                        </p>
                        <p><strong>Kabupaten:</strong>
                            {{ $data->Id_Kabupaten ?? 'Undefined' }}
                        </p>
                        <p><strong>Kecamatan:</strong>
                            {{ $data->Id_Kecamatan ?? 'Undefined' }}
                        </p>
                        <p><strong>Kelurahan:</strong>
                            {{ $data->Id_Kelurahan ?? 'Undefined' }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center bg-light">
                <a href="/mahasiswa" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left-circle"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS & Bootstrap Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</body>
</html>
