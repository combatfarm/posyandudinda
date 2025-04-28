<?php

namespace App\Http\Controllers;

use App\Models\PerkembanganAnak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PerkembanganAnakController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('perPage', 10); // Default 10 data per halaman
        
        $query = PerkembanganAnak::query();
        
        if ($search) {
            $query->where('nama_anak', 'like', "%{$search}%")
                  ->orWhere('tanggal', 'like', "%{$search}%")
                  ->orWhere('ket_berat_badan', 'like', "%{$search}%")
                  ->orWhere('ket_tinggi_badan', 'like', "%{$search}%");
        }
        
        $perkembangan = $query->orderBy('created_at', 'desc')->paginate($perPage);
        
        return view('perkembangan_anak', compact('perkembangan', 'search'));
    }

    public function create()
    {
        $action = 'create';
        return view('perkembangan_anak', compact('action'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_anak' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'berat_badan' => 'required|numeric|between:0,999.99',
            'ket_berat_badan' => 'nullable|string|max:255',
            'tinggi_badan' => 'required|numeric|between:0,999.99',
            'ket_tinggi_badan' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        PerkembanganAnak::create($request->all());

        return redirect()->route('perkembangan.index')
            ->with('success', 'Data perkembangan anak berhasil ditambahkan!');
    }

    public function show($id)
    {
        $perkembangan = PerkembanganAnak::findOrFail($id);
        $action = 'show';
        return view('perkembangan_anak', compact('perkembangan', 'action'));
    }

    public function edit($id)
    {
        $perkembangan = PerkembanganAnak::findOrFail($id);
        $action = 'edit';
        return view('perkembangan_anak', compact('perkembangan', 'action'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_anak' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'berat_badan' => 'required|numeric|between:0,999.99',
            'ket_berat_badan' => 'nullable|string|max:255',
            'tinggi_badan' => 'required|numeric|between:0,999.99',
            'ket_tinggi_badan' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $perkembangan = PerkembanganAnak::findOrFail($id);
        $perkembangan->update($request->all());

        return redirect()->route('perkembangan.index')
            ->with('success', 'Data perkembangan anak berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $perkembangan = PerkembanganAnak::findOrFail($id);
        $perkembangan->delete();

        return redirect()->route('perkembangan.index')
            ->with('success', 'Data perkembangan anak berhasil dihapus!');
    }
}
