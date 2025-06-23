<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Presensi;
use Carbon\Carbon;

class AbsenController extends Controller
{
public function absen(Request $request)
{
$request->validate([
'id_kelas_mhs' => 'required|integer',
]);

// Cek ke service admin apakah pertemuan sudah dibuka
$response = Http::get('http://ti054e01.admin.local/api/cek-presensi/' . $request->id_kelas_mhs);

if (!$response->ok() || !$response['aktif']) {
return response()->json(['message' => $response['message']], 403);
}

$id_presensi_dsn = $response['id_presensi_dsn'];
$tanggal = Carbon::now()->toDateString();

// Cegah presensi ganda
$cek = Presensi::where('id_presensi_dsn', $id_presensi_dsn)
->where('id_kelas_mhs', $request->id_kelas_mhs)
->where('tanggal', $tanggal)
->first();

if ($cek) {
return response()->json(['message' => 'Sudah melakukan presensi'], 409);
}

$presensi = Presensi::create([
'id_presensi_dsn' => $id_presensi_dsn,
'id_kelas_mhs' => $request->id_kelas_mhs,
'waktu_presensi' => now(),
'tanggal' => $tanggal,
'status' => 'H'
]);

return response()->json(['message' => 'Presensi berhasil', 'data' => $presensi], 201);
}
}
