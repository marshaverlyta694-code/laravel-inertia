<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    // Mengirim ulang tautan verifikasi jika alamat email pengguna belum diverifikasi.
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        // Jika email sudah terverifikasi, tidak perlu mengirim tautan lagi.
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        // Laravel mengirim email berisi tautan verifikasi ke alamat pengguna.
        $request->user()->sendEmailVerificationNotification();

        // Kembali ke halaman sebelumnya dengan status agar tampilan dapat memberi konfirmasi.
        return back()->with('status', 'verification-link-sent');
    }
}
