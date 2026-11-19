<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    // Menampilkan formulir login dan memberi tahu tampilan apakah fitur reset kata sandi tersedia.
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    // Memeriksa kredensial login, memperbarui ID sesi, lalu mengarahkan ke tujuan pengguna.
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // LoginRequest melakukan validasi sekaligus autentikasi dengan kredensial yang dikirim.
        $request->authenticate();

        // Mencegah session fixation dengan mengganti ID sesi setelah berhasil login.
        $request->session()->regenerate();

        return redirect()->intended(route('posts.index'));
    }

    // Mengakhiri sesi login, membersihkan data sesi, lalu mengarahkan ke halaman utama.
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Keluar dari guard web agar autentikasi pengguna saat ini dihapus.
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        // Mengganti token CSRF supaya token dari sesi yang berakhir tidak dapat digunakan kembali.
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
