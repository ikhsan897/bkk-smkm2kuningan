<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LowonganKerja extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'judul',
        'perusahaan',
        'deskripsi',
        'kualifikasi',
        'lokasi',
        'batas_waktu',
        'gambar',
    ];

    /**
     * Mendefinisikan relasi "hasMany" ke model Lamaran.
     * Ini memberitahu Laravel bahwa satu LowonganKerja dapat memiliki banyak Lamaran.
     * Nama fungsi ini (lamarans) harus sama dengan yang dipanggil di controller/view.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lamarans(): HasMany
    {
        return $this->hasMany(Lamaran::class);
    }
}
