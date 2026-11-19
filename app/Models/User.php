<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// Trait untuk membuat factory, mengirim notifikasi, dan mengelola token API Sanctum.
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// Model akun pengguna; Authenticatable membuat model ini dapat dipakai oleh sistem login Laravel.
class User extends Authenticatable
{
    // Menambahkan fitur factory, notifikasi, dan token API ke model User.
    use HasApiTokens, HasFactory, Notifiable;

    // Kolom yang boleh diisi sekaligus ketika membuat atau memperbarui pengguna.
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Kolom sensitif yang tidak boleh ikut tampil saat model diubah menjadi array atau JSON.
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Mengubah tipe data tertentu saat dibaca dari atau disimpan ke database.
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // Waktu verifikasi email diperlakukan sebagai objek tanggal.
        'email_verified_at' => 'datetime',
        // Kata sandi otomatis di-hash oleh cast Laravel.
        'password' => 'hashed',
    ];
}
