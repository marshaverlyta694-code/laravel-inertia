<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    // Mengganti kata sandi pengguna yang sedang login.
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        // Pastikan kata sandi lama benar dan kata sandi baru terkonfirmasi serta memenuhi aturan.
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        // Hash kata sandi sebelum menyimpannya agar teks asli tidak disimpan di database.
        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        // Kembali ke halaman sebelumnya setelah kata sandi berhasil diperbarui.
        return back();
    }
}
