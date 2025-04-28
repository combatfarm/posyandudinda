<?php

namespace App\Http\Controllers;

use App\Models\DataAnak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataAnakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('perPage', 10); // Default 10 data per halaman
        
        $query = DataAnak::query();
        
        if ($search) {
            $query->where('nik', 'like', "%{$search}%")
                  ->orWhere('nama_ibu', 'like', "%{$search}%")
                  ->orWhere('nama_anak', 'like', "%{$search}%")
                  ->orWhere('tempat_lahir', 'like', "%{$search}%");
        }
        
        $anak = $query->orderBy('created_at', 'desc')->paginate($perPage);
        
        return view('data_anak', compact('anak', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $action = 'create';
        return view('data_anak', compact('action'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|string|max:16|unique:data_anak,nik',
            'nama_ibu' => 'required|string|max:100',
            'nama_anak' => 'required|string|max:100',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'usia' => 'required|string|max:10',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DataAnak::create($request->all());

        return redirect()->route('anak.index')
            ->with('success', 'Data anak berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $nik)
    {
        $anak = DataAnak::findOrFail($nik);
        $action = 'show';
        return view('data_anak', compact('anak', 'action'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $nik)
    {
        $anak = DataAnak::findOrFail($nik);
        $action = 'edit';
        return view('data_anak', compact('anak', 'action'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $nik)
    {
        $validator = Validator::make($request->all(), [
            'nama_ibu' => 'required|string|max:100',
            'nama_anak' => 'required|string|max:100',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'usia' => 'required|string|max:10',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $anak = DataAnak::findOrFail($nik);
        $anak->update($request->all());

        return redirect()->route('anak.index')
            ->with('success', 'Data anak berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $nik)
    {
        $anak = DataAnak::findOrFail($nik);
        $anak->delete();

        return redirect()->route('anak.index')
            ->with('success', 'Data anak berhasil dihapus!');
    }
}
