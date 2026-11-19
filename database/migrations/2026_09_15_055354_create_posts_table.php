<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Membuat tabel posts yang menyimpan judul, isi, dan waktu pencatatan post.
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            // Judul berukuran string, sedangkan isi memakai text agar dapat menyimpan konten lebih panjang.
            $table->string('title');
            $table->text('content');
            $table->timestamps();
        });
    }

    // Menghapus tabel posts jika migration ini dibatalkan.
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
