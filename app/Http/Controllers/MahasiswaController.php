<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
     public function index() {
         $mahasiswa = Mahasiswa::all();
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

    if ($request->hasFile('foto_profil')) {
        $data['Foto_Profil'] = $request->file('foto_profil')->store('foto_profil', 'public');
    }

    Mahasiswa::where('Nim', $nim)->update($data);

    return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    public function destroy($nim)
    {
        Mahasiswa::where('Nim', $nim)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function show($nim)
    {
        $data = Mahasiswa::where('Nim', $nim)->firstOrFail();
        return view('mahasiswa.detail', compact('data'));
    }
}
