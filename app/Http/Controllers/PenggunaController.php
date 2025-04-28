<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('perPage', 10); // Default 10 data per halaman
        
        $query = Pengguna::query();
        
        if ($search) {
            $query->where('nik', 'like', "%{$search}%")
                  ->orWhere('nama_ibu', 'like', "%{$search}%")
                  ->orWhere('nama_anak', 'like', "%{$search}%")
                  ->orWhere('no_telp', 'like', "%{$search}%");
        }
        
        $pengguna = $query->orderBy('created_at', 'desc')->paginate($perPage);
        
        return view('pengguna', compact('pengguna', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $action = 'create';
        return view('pengguna', compact('action'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|numeric|digits:16|unique:pengguna,nik',
            'nama_ibu' => 'required|string|max:100',
            'nama_anak' => 'required|string|max:100',
            'no_telp' => 'nullable|numeric|digits_between:1,15',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'usia' => 'required|string|max:50',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        Pengguna::create($data);

        return redirect()->route('pengguna.index')
            ->with('success', 'Data pengguna berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $nik)
    {
        $pengguna = Pengguna::findOrFail($nik);
        $action = 'show';
        return view('pengguna', compact('pengguna', 'action'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $nik)
    {
        $pengguna = Pengguna::findOrFail($nik);
        $action = 'edit';
        return view('pengguna', compact('pengguna', 'action'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $nik)
    {
        $validator = Validator::make($request->all(), [
            'nama_ibu' => 'required|string|max:100',
            'nama_anak' => 'required|string|max:100',
            'no_telp' => 'nullable|numeric|digits_between:1,15',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'usia' => 'required|string|max:50',
            'password' => 'nullable|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $pengguna = Pengguna::findOrFail($nik);
        $pengguna->update($request->all());

        return redirect()->route('pengguna.index')
            ->with('success', 'Data pengguna berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $nik)
    {
        $pengguna = Pengguna::findOrFail($nik);
        $pengguna->delete();

        return redirect()->route('pengguna.index')
            ->with('success', 'Data pengguna berhasil dihapus!');
    }
} 