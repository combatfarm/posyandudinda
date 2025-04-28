<?php

namespace App\Http\Controllers;

use App\Models\DataOrangTua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataOrangTuaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('perPage', 10); // Default 10 data per halaman
        
        $query = DataOrangTua::query();
        
        if ($search) {
            $query->where('nik', 'like', "%{$search}%")
                  ->orWhere('nama_ibu', 'like', "%{$search}%")
                  ->orWhere('nama_anak', 'like', "%{$search}%")
                  ->orWhere('no_telp', 'like', "%{$search}%");
        }
        
        $orangtua = $query->orderBy('created_at', 'desc')->paginate($perPage);
        
        return view('data_orangtua', compact('orangtua', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $action = 'create';
        return view('data_orangtua', compact('action'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|string|max:16|unique:data_orangtua,nik',
            'nama_ibu' => 'required|string|max:100',
            'nama_anak' => 'required|string|max:100',
            'no_telp' => 'nullable|string|max:15',
            'alamat' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DataOrangTua::create($request->all());

        return redirect()->route('orangtua.index')
            ->with('success', 'Data orang tua berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $nik)
    {
        $orangtua = DataOrangTua::findOrFail($nik);
        $action = 'show';
        return view('data_orangtua', compact('orangtua', 'action'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $nik)
    {
        $orangtua = DataOrangTua::findOrFail($nik);
        $action = 'edit';
        return view('data_orangtua', compact('orangtua', 'action'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $nik)
    {
        $validator = Validator::make($request->all(), [
            'nama_ibu' => 'required|string|max:100',
            'nama_anak' => 'required|string|max:100',
            'no_telp' => 'nullable|string|max:15',
            'alamat' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $orangtua = DataOrangTua::findOrFail($nik);
        $orangtua->update($request->all());

        return redirect()->route('orangtua.index')
            ->with('success', 'Data orang tua berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $nik)
    {
        $orangtua = DataOrangTua::findOrFail($nik);
        $orangtua->delete();

        return redirect()->route('orangtua.index')
            ->with('success', 'Data orang tua berhasil dihapus!');
    }
}
