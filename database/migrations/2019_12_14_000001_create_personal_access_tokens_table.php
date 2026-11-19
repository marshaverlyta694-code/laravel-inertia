<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Membuat tabel token personal yang digunakan Laravel Sanctum untuk autentikasi API.
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            // Relasi polimorfik menghubungkan token ke berbagai jenis model yang dapat memilikinya.
            $table->morphs('tokenable');
            $table->string('name');
            // Token unik disimpan bersama hak akses dan informasi penggunaan/kedaluwarsanya.
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    // Menghapus tabel token personal jika migration dibatalkan.
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};
