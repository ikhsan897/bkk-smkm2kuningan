<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/xxxx_xx_xx_xxxxxx_create_lowongan_kerjas_table.php
public function up(): void
{
    Schema::create('lowongan_kerjas', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->string('perusahaan');
        $table->text('deskripsi');
        $table->text('kualifikasi');
        $table->string('lokasi');
        $table->string('gambar')->nullable();
        $table->date('batas_waktu');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongan_kerjas');
    }
};
