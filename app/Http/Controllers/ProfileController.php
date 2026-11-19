<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    // Menampilkan formulir profil dengan status verifikasi email dan pesan sesi.
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            // Menentukan apakah tampilan perlu meminta pengguna memverifikasi email.
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            // Mengirim status sementara dari sesi, misalnya setelah tindakan sebelumnya.
            'status' => session('status'),
        ]);
    }

    // Menyimpan informasi profil yang sudah lolos validasi pada ProfileUpdateRequest.
    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Mengisi atribut pengguna hanya dengan data yang telah dinyatakan valid.
        $request->user()->fill($request->validated());

        // Perubahan email membatalkan verifikasi lama sehingga alamat baru perlu diverifikasi.
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Menyimpan perubahan dan mengembalikan pengguna ke halaman edit profil.
        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    // Memeriksa kata sandi, lalu menghapus akun beserta sesi login pengguna.
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Penghapusan akun hanya diizinkan setelah kata sandi saat ini benar.
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Mengakhiri autentikasi sebelum menghapus record pengguna.
        Auth::logout();

        $user->delete();

        // Membatalkan sesi lama dan membuat token CSRF baru sebelum kembali ke halaman utama.
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
