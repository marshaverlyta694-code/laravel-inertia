<?php

// Mengimpor controller, model, dan utilitas yang dipakai untuk mendefinisikan route web.
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Post;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman awal menampilkan landing page dan informasi fitur serta versi aplikasi.
Route::get('/', function () {
    return Inertia::render('Landing', [
        // Nilai ini memungkinkan landing page menampilkan tautan sesuai route yang tersedia.
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        // Versi Laravel dan PHP dikirim untuk ditampilkan pada halaman.
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Dashboard hanya dapat diakses pengguna login dan email terverifikasi; data post terbaru ikut dikirim.
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'posts' => Post::latest()->get()
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

// Route dalam grup ini hanya dapat diakses setelah pengguna login.
Route::middleware('auth')->group(function () {
    // Membuat route daftar, buat, simpan, edit, perbarui, dan hapus post secara otomatis.
    Route::resource('posts', PostController::class);

    // Route untuk menampilkan, memperbarui, dan menghapus profil pengguna.
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Memuat route autentikasi tambahan seperti login, pendaftaran, dan reset kata sandi.
require __DIR__.'/auth.php';