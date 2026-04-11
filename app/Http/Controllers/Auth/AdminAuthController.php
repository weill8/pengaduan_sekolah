<?php
// app/Http/Controllers/Auth/AdminAuthController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use App\Http\Requests\Auth\AdminRegisterRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    // ==================== LOGIN ====================

    public function showLoginForm()
    {
        return view('auth.admin.login');
    }

    public function login(AdminLoginRequest $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Selamat datang, ' . Auth::guard('admin')->user()->username . '!');
        }

        return back()
            ->withInput($request->only('username'))
            ->withErrors(['username' => 'Username atau password salah.']);
    }

    // ==================== REGISTER ====================

    // public function showRegisterForm()
    // {
    //     return view('auth.admin.register');
    // }

    // public function register(AdminRegisterRequest $request)
    // {
    //     $admin = Admin::create([
    //         'username' => $request->username,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     Auth::guard('admin')->login($admin);
    //     $request->session()->regenerate();

    //     return redirect()->route('admin.dashboard')
    //         ->with('success', 'Akun admin berhasil dibuat!');
    // }

    // ==================== LOGOUT ====================

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'Berhasil logout.');
    }
}