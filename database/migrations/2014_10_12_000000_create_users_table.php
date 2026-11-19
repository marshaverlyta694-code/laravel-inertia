<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Membuat tabel users beserta kolom akun dan waktu pencatatannya.
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            // ID unik otomatis, nama, dan email unik untuk tiap akun.
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            // Waktu verifikasi boleh kosong sampai pengguna memverifikasi emailnya.
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            // Token untuk fitur "ingat saya", lalu kolom waktu dibuat dan diperbarui.
            $table->rememberToken();
            $table->timestamps();
        });
    }

    // Membatalkan migration dengan menghapus tabel users jika ada.
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
