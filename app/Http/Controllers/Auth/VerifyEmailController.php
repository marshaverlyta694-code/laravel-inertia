<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    // Menandai email pengguna sebagai terverifikasi setelah tautan valid dibuka.
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        // Jika verifikasi sudah pernah dilakukan, langsung kembali dengan penanda berhasil.
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        }

        // Simpan waktu verifikasi; jika berhasil, kirim event agar proses terkait dapat dijalankan.
        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        // Arahkan ke tujuan pengguna dengan parameter yang menandakan email telah diverifikasi.
        return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    }
}
