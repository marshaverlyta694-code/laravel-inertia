<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class ConfirmablePasswordController extends Controller
{
    // Menampilkan formulir yang meminta konfirmasi kata sandi pengguna.
    /**
     * Show the confirm password view.
     */
    public function show(): Response
    {
        return Inertia::render('Auth/ConfirmPassword');
    }

    // Memastikan kata sandi benar sebelum menandai sesi sebagai terkonfirmasi.
    /**
     * Confirm the user's password.
     */
    public function store(Request $request): RedirectResponse
    {
        // Memeriksa kata sandi terhadap akun yang sedang login; gagal berarti tampilkan error validasi.
        if (! Auth::guard('web')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        // Menyimpan waktu konfirmasi agar fitur yang membutuhkan konfirmasi ulang dapat memeriksanya.
        $request->session()->put('auth.password_confirmed_at', time());

        // Kembali ke URL tujuan sebelumnya, atau ke halaman utama aplikasi jika tidak ada.
        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
