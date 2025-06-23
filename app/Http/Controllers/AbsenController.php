<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Presensi;
use Carbon\Carbon;

class AbsenController extends Controller
{
public function index()
{
// Menampilkan daftar presensi mahasiswa
$presensis = Presensi::with('kelasMahasiswa.kelas')->whereDate('tanggal', Carbon::today())->get();
return view('mahasiswa.presensi.index', compact('presensis'));
}

public function absen(Request $request)
{
$request->validate([
'id_kelas_mhs' => 'required|integer',
]);

$response = Http::get('http://ti054e01.admin.local/api/cek-presensi/' . $request->id_kelas_mhs);

if (!$response->ok() || !$response['aktif']) {
return redirect()->back()->withErrors(['message' => $response['message']]);
}

$id_presensi_dsn = $response['id_presensi_dsn'];
$tanggal = Carbon::now()->toDateString();

$cek = Presensi::where('id_presensi_dsn', $id_presensi_dsn)
->where('id_kelas_mhs', $request->id_kelas_mhs)
->where('tanggal', $tanggal)
->first();

if ($cek) {
return redirect()->back()->with('status', 'Sudah melakukan presensi');
}

Presensi::create([
'id_presensi_dsn' => $id_presensi_dsn,
'id_kelas_mhs' => $request->id_kelas_mhs,
'waktu_presensi' => now(),
'tanggal' => $tanggal,
'status' => 'H'
]);

return redirect()->back()->with('status', 'Presensi berhasil');
}

public function edit($id)
{
$presensi = Presensi::findOrFail($id);
return view('mahasiswa.presensi.edit', compact('presensi'));
}

public function update(Request $request, $id)
{
$request->validate([
'status' => 'required|in:H,S,I,A'
]);

$presensi = Presensi::findOrFail($id);
$presensi->status = $request->status;
$presensi->save();

return redirect()->route('mahasiswa.presensi.index')->with('status', 'Presensi diperbarui');
}
}
