<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalApiController extends Controller
{

    public function index()
    {
        $data = Jadwal::orderBy('tanggal','desc')
                      ->orderBy('waktu','desc')
                      ->get();
        return response()->json($data, 200);
    }

    public function show($id)
    {
        $jadwal = Jadwal::find($id);
        if (! $jadwal) {
            return response()->json(['message'=>'Jadwal tidak ditemukan'], 404);
        }
        return response()->json($jadwal, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'waktu'   => 'required|date_format:H:i',
        ]);

        $jadwal = Jadwal::create($validated);
        return response()->json($jadwal, 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'waktu'   => 'required|date_format:H:i',
        ]);

        $jadwal = Jadwal::find($id);
        if (! $jadwal) {
            return response()->json(['message'=>'Jadwal tidak ditemukan'], 404);
        }

        $jadwal->update($validated);
        return response()->json($jadwal, 200);
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::find($id);
        if (! $jadwal) {
            return response()->json(['message'=>'Jadwal tidak ditemukan'], 404);
        }

        $jadwal->delete();
        return response()->json(null, 204);
    }
}
