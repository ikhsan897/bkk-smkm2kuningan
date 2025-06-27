<?php

namespace App\Http\Controllers;

use App\Models\Lamaran;
use App\Models\LowonganKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LamaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, LowonganKerja $loker)
    {
        $request->validate([
            'email' => 'required|email', // <-- Validasi untuk email
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'surat_lamaran' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $user = Auth::user();

        $existingLamaran = Lamaran::where('user_id', $user->id)
                                ->where('lowongan_kerja_id', $loker->id)
                                ->first();

        if ($existingLamaran) {
            return redirect()->back()->with('error', 'Anda sudah pernah melamar di lowongan ini.');
        }

        $cvPath = $request->file('cv')->store('cvs', 'public');
        $suratLamaranPath = $request->hasFile('surat_lamaran') ? $request->file('surat_lamaran')->store('surat_lamaran', 'public') : null;

        Lamaran::create([
            'user_id' => $user->id,
            'email' => $request->input('email'), // <-- Menyimpan email dari form
            'lowongan_kerja_id' => $loker->id,
            'cv_path' => $cvPath,
            'surat_lamaran_path' => $suratLamaranPath,
        ]);

        return redirect()->back()->with('success', 'Lamaran berhasil dikirim! Notifikasi akan dikirim ke email yang Anda masukkan.');
    }
}
