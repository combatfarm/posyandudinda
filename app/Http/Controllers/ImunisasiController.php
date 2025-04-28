<?php

namespace App\Http\Controllers;

use App\Models\Imunisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImunisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('perPage', 10); // Default 10 data per halaman
        
        $query = Imunisasi::query();
        
        if ($search) {
            $query->where('nama_anak', 'like', "%{$search}%")
                  ->orWhere('imunisasi', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%");
        }
        
        $imunisasi = $query->orderBy('created_at', 'desc')->paginate($perPage);
        
        return view('imunisasi', compact('imunisasi', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $action = 'create';
        return view('imunisasi', compact('action'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_anak' => 'required|string|max:100',
            'tanggal_imunisasi' => 'required|date',
            'imunisasi' => 'required|string|max:100',
            'status' => 'required|in:Selesai,Tidak Selesai',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Imunisasi::create($request->all());

        return redirect()->route('imunisasi.index')
            ->with('success', 'Data imunisasi berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $imunisasi = Imunisasi::findOrFail($id);
        $action = 'show';
        return view('imunisasi', compact('imunisasi', 'action'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $imunisasi = Imunisasi::findOrFail($id);
        $action = 'edit';
        return view('imunisasi', compact('imunisasi', 'action'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_anak' => 'required|string|max:100',
            'tanggal_imunisasi' => 'required|date',
            'imunisasi' => 'required|string|max:100',
            'status' => 'required|in:Selesai,Tidak Selesai',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $imunisasi = Imunisasi::findOrFail($id);
        $imunisasi->update($request->all());

        return redirect()->route('imunisasi.index')
            ->with('success', 'Data imunisasi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $imunisasi = Imunisasi::findOrFail($id);
        $imunisasi->delete();

        return redirect()->route('imunisasi.index')
            ->with('success', 'Data imunisasi berhasil dihapus!');
    }
}
