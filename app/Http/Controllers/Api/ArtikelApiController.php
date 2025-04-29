<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ArtikelApiController extends Controller
{
    public function index()
    {
        // Ambil semua artikel, terbaru dulu
        $artikels = Artikel::orderBy('tanggal', 'desc')
                           ->orderBy('created_at', 'desc')
                           ->get();

        // Map ke format yang sama seperti show()
        $data = $artikels->map(function($artikel) {
            $path = $artikel->gambar_artikel
                ? Storage::url('artikel/' . $artikel->gambar_artikel)
                : null;
            $base = config('app.url');
            $gambarUrl = $path ? rtrim($base, '/') . $path : null;

            return [
                'id'          => $artikel->id,
                'judul'       => $artikel->judul,
                'isi_artikel' => $artikel->isi_artikel,
                'tanggal'     => Carbon::parse($artikel->tanggal)->toDateString(),
                'gambar_url'  => $gambarUrl,
                'created_at'  => $artikel->created_at->toDateTimeString(),
                'updated_at'  => $artikel->updated_at->toDateTimeString(),
            ];
        });

        return response()->json([
            'status' => 'success',
            'data'   => $data
        ], 200);
    }

    public function show($id)
    {
        $artikel = Artikel::find($id);

        if (! $artikel) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Artikel tidak ditemukan'
            ], 404);
        }

        $gambarUrl = $artikel->gambar_artikel
            ? Storage::url('artikel/' . $artikel->gambar_artikel)
            : null;

        return response()->json([
            'status' => 'success',
            'data'   => [
                'id'             => $artikel->id,
                'judul'          => $artikel->judul,
                'isi_artikel'    => $artikel->isi_artikel,
                'tanggal'    => Carbon::parse($artikel->tanggal)->toDateString(),
                'gambar_url'     => asset($gambarUrl),
                'created_at'     => $artikel->created_at->toDateTimeString(),
                'updated_at'     => $artikel->updated_at->toDateTimeString(),
            ]
        ], 200);
    }
}
