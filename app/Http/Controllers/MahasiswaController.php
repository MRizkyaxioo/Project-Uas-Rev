<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
     public function index() {
        $max_data = 5;

        if(request('search')) {
            $data = Mahasiswa::where('Nama_Lengkap','like','%'.request('search').'%')->paginate($max_data)
            ->withQueryString();
        }else {
            $data = Mahasiswa::orderBy('Nama_Lengkap','asc')->paginate($max_data);
        }
        $mahasiswa = $data;
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

    if ($request->hasFile('foto_profil')) {
        $data['Foto_Profil'] = $request->file('foto_profil')->store('foto_profil', 'public');
    }

    Mahasiswa::create($data);

    return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $nim)
    {
        $data = $request->except('_token');
        $mahasiswa = Mahasiswa::where('Nim', $nim)->first();

    if ($request->hasFile('foto_profil')) {
       // Hapus foto lama jika ada
        if ($mahasiswa->Foto_Profil && Storage::disk('public')->exists($mahasiswa->Foto_Profil)) {
            Storage::disk('public')->delete($mahasiswa->Foto_Profil);
        }
        // Simpan foto baru
        $data['Foto_Profil'] = $request->file('foto_profil')->store('foto_profil', 'public');
    }

    $mahasiswa->update($data);

    return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    public function destroy($nim)
    {
       $mahasiswa = Mahasiswa::where('Nim', $nim)->first();

    // Hapus foto profil jika ada
    if ($mahasiswa && $mahasiswa->Foto_Profil && Storage::disk('public')->exists($mahasiswa->Foto_Profil)) {
        Storage::disk('public')->delete($mahasiswa->Foto_Profil);
    }

    // Hapus data mahasiswa
    Mahasiswa::where('Nim', $nim)->delete();

    return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function show($nim)
    {
        $data = Mahasiswa::where('Nim', $nim)->firstOrFail();
        return view('mahasiswa.detail', compact('data'));
    }
}
