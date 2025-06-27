<?php

namespace App\Http\Controllers;

use App\Models\LowonganKerja; // <-- Pastikan ini di-import
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama (homepage) aplikasi.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Ambil 4 lowongan kerja terbaru untuk ditampilkan di halaman utama
        $latestLokers = LowonganKerja::latest()->take(4)->get();

        // Kirim data loker tersebut ke view 'welcome'
        return view('welcome', compact('latestLokers'));
    }
}
