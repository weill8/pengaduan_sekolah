<?php
// app/Http/Controllers/Auth/SiswaAuthController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SiswaLoginRequest;
use App\Http\Requests\Auth\SiswaRegisterRequest;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SiswaAuthController extends Controller
{
    // ==================== LOGIN ====================

    public function showLoginForm()
    {
        return view('auth.siswa.login');
    }

    public function login(SiswaLoginRequest $request)
    {
        $credentials = [
            'nis'      => $request->nis,
            'password' => $request->password,
        ];

        if (Auth::guard('siswa')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('siswa.dashboard'))
                ->with('success', 'Selamat datang!');
        }

        return back()
            ->withInput($request->only('nis'))
            ->withErrors(['nis' => 'NIS atau password salah.']);
    }

    // ==================== REGISTER ====================

    public function showRegisterForm()
    {
        // Kirim data kelas untuk dropdown
        $kelasList = Kelas::select('id', 'nama_kelas')->get();

        return view('auth.siswa.register', compact('kelasList'));
    }

    public function register(SiswaRegisterRequest $request)
    {
        $siswa = Siswa::create([
            'nis'      => $request->nis,
            'nama'     => $request->nama,
            'id_kelas' => $request->id_kelas,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('siswa')->login($siswa);
        $request->session()->regenerate();

        return redirect()->route('siswa.dashboard')
            ->with('success', 'Akun siswa berhasil dibuat!');
    }

    // ==================== LOGOUT ====================

    public function logout(Request $request)
    {
        Auth::guard('siswa')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('siswa.login')
            ->with('success', 'Berhasil logout.');
    }
}