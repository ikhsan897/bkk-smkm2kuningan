<?php

namespace App\Http\Controllers;

use App\Models\Lamaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    /**
     * Menampilkan halaman riwayat lamaran milik pengguna.
     */
    public function riwayatLamaran()
    {
        // Ambil ID pengguna yang sedang login
        $userId = Auth::id();

        // Ambil semua data lamaran milik pengguna tersebut.
        // Gunakan 'with' untuk eager loading data relasi (lebih efisien).
        $lamarans = Lamaran::where('user_id', $userId)
                            ->with('lowonganKerja')
                            ->latest()
                            ->paginate(10);

        // Kirim data lamarans ke view
        return view('profil.lamaran', compact('lamarans'));
    }
}
