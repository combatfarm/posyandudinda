<?php

namespace App\Http\Controllers;

use App\Models\Stunting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StuntingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('perPage', 10); // Default 10 data per halaman
        
        $query = Stunting::query();
        
        if ($search) {
            $query->where('nama_anak', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%")
                  ->orWhere('catatan', 'like', "%{$search}%");
        }
        
        $stunting = $query->orderBy('created_at', 'desc')->paginate($perPage);
        
        return view('stunting', compact('stunting', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $action = 'create';
        return view('stunting', compact('action'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_anak' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'usia' => 'required|string|max:10',
            'berat_badan' => 'required|numeric|min:0|max:999.99',
            'tinggi_badan' => 'required|numeric|min:0|max:999.99',
            'lingkar_kepala' => 'required|numeric|min:0|max:999.99',
            'catatan' => 'nullable|string',
            'status' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Stunting::create($request->all());

        return redirect()->route('stunting.index')
            ->with('success', 'Data stunting berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $stunting = Stunting::findOrFail($id);
        $action = 'show';
        return view('stunting', compact('stunting', 'action'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $stunting = Stunting::findOrFail($id);
        $action = 'edit';
        return view('stunting', compact('stunting', 'action'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_anak' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'usia' => 'required|string|max:10',
            'berat_badan' => 'required|numeric|min:0|max:999.99',
            'tinggi_badan' => 'required|numeric|min:0|max:999.99',
            'lingkar_kepala' => 'required|numeric|min:0|max:999.99',
            'catatan' => 'nullable|string',
            'status' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $stunting = Stunting::findOrFail($id);
        $stunting->update($request->all());

        return redirect()->route('stunting.index')
            ->with('success', 'Data stunting berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $stunting = Stunting::findOrFail($id);
        $stunting->delete();

        return redirect()->route('stunting.index')
            ->with('success', 'Data stunting berhasil dihapus!');
    }
}
