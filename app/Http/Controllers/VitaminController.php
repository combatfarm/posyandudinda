<?php

namespace App\Http\Controllers;

use App\Models\Vitamin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VitaminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('perPage', 10); // Default 10 data per halaman
        
        $query = Vitamin::query();
        
        if ($search) {
            $query->where('nama_anak', 'like', "%{$search}%")
                  ->orWhere('vitamin', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%");
        }
        
        $vitamin = $query->orderBy('created_at', 'desc')->paginate($perPage);
        
        return view('vitamin', compact('vitamin', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $action = 'create';
        return view('vitamin', compact('action'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_anak' => 'required|string|max:100',
            'tanggal_vitamin' => 'required|date',
            'vitamin' => 'required|string|max:100',
            'status' => 'required|in:Selesai,Tidak Selesai',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Vitamin::create($request->all());

        return redirect()->route('vitamin.index')
            ->with('success', 'Data vitamin berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vitamin = Vitamin::findOrFail($id);
        $action = 'show';
        return view('vitamin', compact('vitamin', 'action'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vitamin = Vitamin::findOrFail($id);
        $action = 'edit';
        return view('vitamin', compact('vitamin', 'action'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_anak' => 'required|string|max:100',
            'tanggal_vitamin' => 'required|date',
            'vitamin' => 'required|string|max:100',
            'status' => 'required|in:Selesai,Tidak Selesai',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $vitamin = Vitamin::findOrFail($id);
        $vitamin->update($request->all());

        return redirect()->route('vitamin.index')
            ->with('success', 'Data vitamin berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vitamin = Vitamin::findOrFail($id);
        $vitamin->delete();

        return redirect()->route('vitamin.index')
            ->with('success', 'Data vitamin berhasil dihapus!');
    }
}
