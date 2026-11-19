<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    // Menampilkan formulir pendaftaran akun.
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    // Memvalidasi data, membuat akun, memicu event pendaftaran, lalu langsung login.
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Memastikan nama, email unik, dan kata sandi terkonfirmasi serta sesuai aturan.
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Membuat akun baru; kata sandi disimpan dalam bentuk hash.
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Memberi tahu sistem bahwa akun baru telah didaftarkan (misalnya untuk proses verifikasi).
        event(new Registered($user));

        // Login otomatis setelah pendaftaran berhasil.
        Auth::login($user);

        // Arahkan akun baru ke tujuan utama aplikasi.
        return redirect(RouteServiceProvider::HOME);
    }
}
