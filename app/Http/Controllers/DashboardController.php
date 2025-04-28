<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

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

        return redirect()->back()->with('success', 'Data pengguna berhasil ditambahkan!');
    }
}
