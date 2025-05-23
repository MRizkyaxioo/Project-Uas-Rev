<h2>Detail Mahasiswa: {{ $data->Nama_Lengkap }}</h2>
<p><strong>NIM:</strong> {{ $data->Nim }}</p>
<p><strong>Tanggal Lahir:</strong> {{ $data->Tanggal_Lahir }}</p>
<p><strong>Alamat:</strong> {{ $data->Alamat }}</p>
<p><strong>Email:</strong> {{ $data->Email }}</p>
<p><strong>Foto Profil:</strong><br>
    @if($data->Foto_Profil)
        <img src="{{ asset('storage/' . $data->Foto_Profil) }}" alt="Foto Profil" width="150" class="img-thumbnail">
    @else
        Tidak ada foto
    @endif
</p>

<p><strong>Jenis Kelamin:</strong>
                {{ $data->Id_Jk !== null ? $data->Id_Jk : 'Undefined' }}
            </p>
            <p><strong>Agama:</strong>
                {{ $data->Id_Agama !== null ? $data->Id_Agama : 'Undefined' }}
            </p>
            <p><strong>Provinsi:</strong>
                {{ $data->Id_Provinsi !== null ? $data->Id_Provinsi : 'Undefined' }}
            </p>
            <p><strong>Kabupaten:</strong>
                {{ $data->Id_Kabupaten !== null ? $data->Id_Kabupaten : 'Undefined' }}
            </p>
            <p><strong>Kecamatan:</strong>
                {{ $data->Id_Kecamatan !== null ? $data->Id_Kecamatan : 'Undefined' }}
            </p>
            <p><strong>Kelurahan:</strong>
                {{ $data->Id_Kelurahan !== null ? $data->Id_Kelurahan : 'Undefined' }}
            </p>
<!-- Tambahkan informasi lainnya -->
<a href="/mahasiswa">Kembali</a>
