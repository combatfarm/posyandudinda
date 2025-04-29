<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Stunting;
use Illuminate\Http\Request;

class StuntingApiController extends Controller
{
    /**
     * GET /api/stunting
     * Mengembalikan semua data stunting dalam JSON
     */
    public function index()
    {
        $data = Stunting::orderBy('tanggal', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->get();

        return response()->json([
            'status' => 'success',
            'data'   => $data
        ], 200);
    }

    /**
     * POST /api/stunting
     * Simpan data stunting baru dan kembalikan JSON-nya
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_anak'     => 'required|string|max:100',
            'tanggal'       => 'required|date',
            'usia'          => 'required|string|max:10',
            'berat_badan'   => 'required|numeric|min:0|max:999.99',
            'tinggi_badan'  => 'required|numeric|min:0|max:999.99',
            'lingkar_kepala'=> 'required|numeric|min:0|max:999.99',
            'catatan'       => 'nullable|string',
            'status'        => 'required|string|max:50',
        ]);

        $stunting = Stunting::create($validated);

        return response()->json([
            'status' => 'success',
            'data'   => $stunting
        ], 201);
    }
}
