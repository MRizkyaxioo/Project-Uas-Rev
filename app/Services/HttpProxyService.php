<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HttpProxyService
{
    protected $baseUrl = 'http://localhost:8001/api/mahasiswa'; // Ganti sesuai service

    public function send(Request $request)
    {
        try {
            // Ambil sisa path setelah /proxy/
            $subPath = preg_replace('/^proxy\//', '', $request->path());
            $url = "{$this->baseUrl}/{$subPath}";

            // Metode HTTP: GET, POST, PUT, DELETE, dll
            $method = strtolower($request->method());

            // Kirim request ke microservice Mahasiswa
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                // Tambah token atau header lain di sini kalau butuh
            ])->send($method, $url, [
                'query' => $request->query(),
                'json' => $request->all(), // untuk POST/PUT
            ]);

            return [
                'body' => $response->body(),
                'status' => $response->status(),
                'headers' => $response->headers(),
            ];
        } catch (\Exception $e) {
            return [
                'error' => 'Proxy Error',
                'message' => $e->getMessage(),
                'status' => 500,
            ];
        }
    }
}
