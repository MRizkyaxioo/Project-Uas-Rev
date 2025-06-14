<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MahasiswaApiController extends Controller
{
    public function index()
    {
        return Mahasiswa::all();
    }

    public function show($id)
    {
        return Mahasiswa::where('Nim', $id)->firstOrFail();
    }

    public function store(Request $request)
    {
$validated = $request->validate([
        'Nim' => 'required|unique:sim_nama,Nim',
        'Nama_Lengkap' => 'required|string|max:255',
        'Tanggal_Lahir' => 'required|date',
        'Id_Jk' => 'nullable|integer',
        'Id_Agama' => 'nullable|integer',
        'Id_Provinsi' => 'nullable|integer',
        'Id_Kabupaten' => 'nullable|integer',
        'Id_Kecamatan' => 'nullable|integer',
        'Id_Kelurahan' => 'nullable|integer',
        'Alamat' => 'nullable|string',
        'Email' => 'nullable|email',
        'Foto_Profil' => 'nullable|file|image|max:2048',
    ]);

    if ($request->hasFile('foto_profil')) {
        $validated['Foto_Profil'] = $request->file('foto_profil')->store('foto_profil', 'public');
    }
$mhs = Mahasiswa::create($validated);
$mhs->Foto_Profil = asset('storage/' . $mhs->Foto_Profil); // generate full URL
    return response()->json($mhs, 201);
    }

public function update(Request $request, $id)
{
    $mhs = Mahasiswa::where('Nim', $id)->firstOrFail(); // Ini penting

    $validated = $request->validate([
        'Nama_Lengkap' => 'required|string|max:255',
        'Tanggal_Lahir' => 'required|date',
        'Id_Jk' => 'nullable|integer',
        'Id_Agama' => 'nullable|integer',
        'Id_Provinsi' => 'nullable|integer',
        'Id_Kabupaten' => 'nullable|integer',
        'Id_Kecamatan' => 'nullable|integer',
        'Id_Kelurahan' => 'nullable|integer',
        'Alamat' => 'nullable|string',
        'Email' => 'nullable|email',
        'foto_profil' => 'nullable|file|image|max:2048',
    ]);

    if ($request->hasFile('foto_profil')) {
        // Hapus foto lama jika ada
        if ($mhs->Foto_Profil && Storage::disk('public')->exists($mhs->Foto_Profil)) {
            Storage::disk('public')->delete($mhs->Foto_Profil);
        }
        // Simpan foto baru
        $validated['Foto_Profil'] = $request->file('foto_profil')->store('foto_profil', 'public');
    }

    $mhs->update($validated);

    // Ubah path ke URL penuh jika perlu ditampilkan
    $mhs->Foto_Profil = $mhs->Foto_Profil ? asset('storage/' . $mhs->Foto_Profil) : null;

    return response()->json([
        'message' => 'Data berhasil diupdate',
        'data' => $mhs,
    ]);
}


    public function destroy($id)
    {
        $mhs = Mahasiswa::where('Nim', $id)->firstOrFail();

        if ($mhs->Foto_Profil && Storage::disk('public')->exists($mhs->Foto_Profil)) {
            Storage::disk('public')->delete($mhs->Foto_Profil);
        }
        $mhs->delete();
        return response()->json(['message' => 'Berhasil dihapus']);
    }
}
