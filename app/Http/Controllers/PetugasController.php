<?php

namespace App\Http\Controllers;

use App\Models\Petugas; // Pastikan ini ada
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function index(Request $request)
    {
        $query = Petugas::query(); // Buat query builder

        // Cek apakah ada input pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('username', 'like', '%' . $request->search . '%'); // Filter berdasarkan username
        }

        // Ambil data dari tabel petugas dan urutkan berdasarkan created_at secara menurun
        $petugas = $query->orderBy('created_at', 'desc')->get(); // Pastikan kolom created_at ada di tabel
        return view('petugas', compact('petugas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:petugas',
            'password' => 'required|string|min:8',
        ]);

        try {
            // Debugging: Tampilkan data yang diterima
            \Log::info('Data yang diterima:', $request->all());

            Petugas::create([
                'username' => $request->username,
                'password' => bcrypt($request->password),
            ]);

            return redirect()->route('petugas')->with('success', 'Petugas berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Debugging: Tampilkan pesan kesalahan
            \Log::error('Kesalahan saat menyimpan petugas: ' . $e->getMessage());
            return redirect()->route('petugas')->with('error', 'Gagal menambahkan petugas: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:petugas,username,'.$id,
            'password' => 'nullable|string|min:8',
        ]);

        try {
            $petugas = Petugas::findOrFail($id);
            
            $petugas->username = $request->username;
            
            // Update password hanya jika diisi
            if ($request->filled('password')) {
                $petugas->password = bcrypt($request->password);
            }
            
            $petugas->save();

            return redirect()->route('petugas')->with('success', 'Petugas berhasil diperbarui.');
        } catch (\Exception $e) {
            \Log::error('Kesalahan saat memperbarui petugas: ' . $e->getMessage());
            return redirect()->route('petugas')->with('error', 'Gagal memperbarui petugas: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $petugas = Petugas::findOrFail($id); // Temukan petugas berdasarkan ID
            $petugas->delete(); // Hapus petugas

            return redirect()->route('petugas')->with('success', 'Petugas berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('petugas')->with('error', 'Gagal menghapus petugas: ' . $e->getMessage());
        }
    }
}
