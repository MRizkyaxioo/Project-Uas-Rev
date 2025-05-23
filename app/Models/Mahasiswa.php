<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    //
    protected $table = 'sim_nama';

    protected $primaryKey = 'Nim';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    // add fillable
    protected $fillable = [
        'Nim',
        'Nama_Lengkap',
        'Tanggal_Lahir',
        'Id_Jk',
        'Id_Agama',
        'Id_Provinsi',
        'Id_Kabupaten',
        'Id_Kecamatan',
        'Id_Kelurahan',
        'Alamat',
        'Email',
        'Foto_Profil',
    ];

    protected $casts = [
    'Foto_Profil' => 'string',
];


}
