<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua data jadwal dari database dan urutkan berdasarkan tanggal dan waktu
        $query = Jadwal::orderBy('tanggal', 'desc')->orderBy('waktu', 'desc');

        // Jika ada parameter pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('tanggal', 'like', "%{$search}%")
                  ->orWhere('waktu', 'like', "%{$search}%");
        }

        $jadwal = $query->get(); // Mengambil semua data dari tabel jadwal

        return view('jadwal', compact('jadwal'));
    }

    public function store(Request $request)
    {
        \Log::info('Data yang diterima:', $request->all());

        $request->validate([
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i',
        ]);

        try {
            Jadwal::create([
                'tanggal' => $request->tanggal,
                'waktu' => $request->waktu,
            ]);

            \Log::info('Jadwal berhasil ditambahkan:', ['tanggal' => $request->tanggal, 'waktu' => $request->waktu]);

            return redirect()->route('jadwal')->with('success', 'Jadwal berhasil ditambahkan.');
        } catch (\Exception $e) {
            \Log::error('Gagal menambahkan jadwal: ' . $e->getMessage());
            return redirect()->route('jadwal')->with('error', 'Gagal menambahkan jadwal: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $jadwal = Jadwal::findOrFail($id);
            $jadwal->delete();

            return redirect()->route('jadwal')->with('success', 'Jadwal berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('jadwal')->with('error', 'Gagal menghapus jadwal: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        return view('edit_jadwal', compact('jadwal')); // Buat view edit_jadwal.blade.php
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i',
        ]);

        try {
            $jadwal = Jadwal::findOrFail($id);
            $jadwal->update([
                'tanggal' => $request->tanggal,
                'waktu' => $request->waktu,
            ]);

            return redirect()->route('jadwal')->with('success', 'Jadwal berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('jadwal')->with('error', 'Gagal memperbarui jadwal: ' . $e->getMessage());
        }
    }
}
