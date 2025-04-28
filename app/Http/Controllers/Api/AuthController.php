<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $pengguna = Pengguna::where('nik', $request->nik)->first();

        if (!$pengguna || !Hash::check($request->password, $pengguna->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'NIK atau password salah',
            ], 401);
        }

        // Generate token or session logic here

        return response()->json([
            'status' => 'success',
            'message' => 'Login berhasil',
            'pengguna' => $pengguna,
        ]);
    }

    public function logout(Request $request)
    {
        // Logic untuk logout pengguna

        return response()->json([
            'status' => 'success',
            'message' => 'Logout berhasil',
        ]);
    }
}
