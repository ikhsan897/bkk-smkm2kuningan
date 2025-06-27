<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lamaran extends Model
{
    use HasFactory;

    /**
     * Properti $fillable digunakan untuk menentukan kolom mana saja
     * yang boleh diisi secara massal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'lowongan_kerja_id',
        'email', // <-- INI BAGIAN YANG PALING PENTING
        'cv_path',
        'surat_lamaran_path',
        'status',
    ];

    /**
     * Mendefinisikan relasi ke model User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mendefinisikan relasi ke model LowonganKerja.
     */
    public function lowonganKerja(): BelongsTo
    {
        return $this->belongsTo(LowonganKerja::class);
    }
}
