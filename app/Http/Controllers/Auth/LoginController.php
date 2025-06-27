<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.[a-z])(?=.[A-Z])(?=.\d)(?=.[\W_]).+$/',
            ],
        ], [
            'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, angka, dan simbol.',
        ]);

        // ✅ Ambil konfigurasi dari config/services.php
        $origin         = config('services.mahasiswa_origin');
        $authUrl        = config('services.urls.admin_service') . '/login';
        $internalToken  = config('services.tokens.admin_service'); //

        $response = Http::withHeaders([
                'Accept'        => 'application/json',
                'Authorization' => 'Bearer ' . $internalToken,
                'X-Platform'    => 'web',
                'Origin'        => $origin,
            ])
            ->post($authUrl, [
                'email'    => $request->email,
                'password' => $request->password,
            ]);

        if ($response->successful()) {
            $data = $response->json();

            Session::put('token', $data['token']);
            Session::put('user',  $data['user']);

            return redirect('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        if (Session::has('token')) {
            $authUrl       = config('services.urls.admin_service') . '/logout';
            $internalToken = config('services.tokens.admin_service'); // ⬅️ pakai internal token juga

            Http::withHeaders([
                'Accept'        => 'application/json',
                'Authorization' => 'Bearer ' . $internalToken,
            ])->withToken(Session::get('token'))
              ->post($authUrl);
        }

        Session::flush();
        return redirect('/login');
    }
}
