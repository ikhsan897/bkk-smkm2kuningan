<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LowonganKerja;
use App\Models\Lamaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LokerCrudController extends Controller
{
    /**
     * Menampilkan daftar semua lowongan kerja di halaman admin.
     */
    public function index()
    {
        $lokers = LowonganKerja::latest()->withCount('lamarans')->get();
        return view('admin.loker.index', compact('lokers'));
    }

    /**
     * Menampilkan form untuk membuat lowongan baru.
     * Ini adalah fungsi yang hilang dan menyebabkan error.
     */
    public function create()
    {
        // Pastikan Anda sudah membuat file view ini: resources/views/admin/loker/create.blade.php
        return view('admin.loker.create');
    }

    /**
     * Menyimpan lowongan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'perusahaan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kualifikasi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'batas_waktu' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $path = $request->hasFile('gambar')
            ? $request->file('gambar')->store('loker_images', 'public')
            : null;

        LowonganKerja::create($request->except('gambar') + ['gambar' => $path]);

        return redirect()->route('admin.loker.index')->with('success', 'Lowongan berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit lowongan.
     */
    public function edit(LowonganKerja $loker)
    {
        return view('admin.loker.edit', compact('loker'));
    }

    /**
     * Mengupdate data lowongan di database.
     */
    public function update(Request $request, LowonganKerja $loker)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'perusahaan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kualifikasi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'batas_waktu' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $path = $loker->gambar;
        if ($request->hasFile('gambar')) {
            if ($loker->gambar) {
                Storage::disk('public')->delete($loker->gambar);
            }
            $path = $request->file('gambar')->store('loker_images', 'public');
        }

        $loker->update($request->except('gambar') + ['gambar' => $path]);

        return redirect()->route('admin.loker.index')->with('success', 'Lowongan berhasil diperbarui.');
    }

    /**
     * Menghapus lowongan dari database.
     */
    public function destroy(LowonganKerja $loker)
    {
        if ($loker->gambar) {
            Storage::disk('public')->delete($loker->gambar);
        }
        $loker->delete();
        return redirect()->route('admin.loker.index')->with('success', 'Lowongan berhasil dihapus.');
    }

    /**
     * Menampilkan daftar pelamar untuk sebuah lowongan kerja.
     */
    public function lihatPelamar(LowonganKerja $loker)
    {
        $loker->load('lamarans.user');
        return view('admin.loker.pelamar', compact('loker'));
    }

    /**
     * Mengupdate status sebuah lamaran.
     */
    public function updateStatus(Request $request, Lamaran $lamaran)
    {
        $request->validate([
            'status' => 'required|in:pending,dilihat,dipertimbangkan,diterima,ditolak',
        ]);
        $lamaran->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Status lamaran berhasil diperbarui.');
    }
}
