<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LowonganKerja; // Pastikan ini adalah model yang benar untuk Lowongan Kerja

class LokerController extends Controller
{
    public function index()
    {
        $lokers = LowonganKerja::latest()->paginate(9);
        return view('loker.index', compact('lokers'));
    }

    public function show(LowonganKerja $loker)
    {
        // Inisialisasi relatedLokers sebagai koleksi kosong
        $relatedLokers = collect();

        // Coba ambil lowongan lain berdasarkan kategori yang sama (jika ada kategori_id)
        // Pastikan model LowonganKerja memiliki kolom 'kategori_id'
        if ($loker->kategori_id) {
            $relatedLokers = LowonganKerja::where('id', '!=', $loker->id)
                                            ->where('kategori_id', $loker->kategori_id)
                                            ->limit(4) // Ambil maksimal 4 dari kategori yang sama
                                            ->get();
        }

        // Jika kurang dari 4 atau tidak ada dari kategori yang sama, ambil sisanya secara acak
        if ($relatedLokers->count() < 4) {
            $additionalLokers = LowonganKerja::where('id', '!=', $loker->id)
                                                ->whereNotIn('id', $relatedLokers->pluck('id')->toArray()) // Hindari duplikasi
                                                ->inRandomOrder()
                                                ->limit(4 - $relatedLokers->count()) // Ambil jumlah yang dibutuhkan untuk mencapai 4
                                                ->get();
            $relatedLokers = $relatedLokers->merge($additionalLokers);
        }

        // Jika Anda ingin hanya mengambil secara acak tanpa mempertimbangkan kategori:
        /*
        $relatedLokers = LowonganKerja::where('id', '!=', $loker->id)
                                        ->inRandomOrder()
                                        ->limit(4)
                                        ->get();
        */

        return view('loker.show', compact('loker', 'relatedLokers'));
    }
}
