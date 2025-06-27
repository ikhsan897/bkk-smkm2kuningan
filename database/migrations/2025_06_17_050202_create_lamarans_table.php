<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        // Perintah untuk membuat tabel 'lamarans' dengan struktur final
        Schema::create('lamarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('lowongan_kerja_id')->constrained()->onDelete('cascade');
            
            // Kolom email untuk notifikasi, tidak unik
            $table->string('email');
            
            $table->string('cv_path');
            $table->string('surat_lamaran_path')->nullable();
            $table->enum('status', ['pending', 'dilihat', 'dipertimbangkan', 'diterima', 'ditolak'])->default('pending');
            $table->timestamps();

            // Kunci unik berdasarkan user dan lowongan, agar 1 user hanya bisa melamar 1x
            $table->unique(['user_id', 'lowongan_kerja_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('lamarans');
    }
};
