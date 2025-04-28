@extends('layouts.app')

@section('content')

{{-- Background Gradient --}}
<div class="min-h-screen bg-gradient-to-r from-[#63BE9A] to-[#06B3BF] p-6">

    {{-- Dashboard - Menghapus bagian atas kotak --}}
    <div class="p-6">
        <h1 class="text-2xl font-bold text-black">Dashboard</h1>
        <div class="mt-3 inline-block bg-white px-10 py-2 rounded-lg shadow-md">
            <h1 class="text-2xl font-semibold text-black">Selamat Datang Admin</h1>
        </div>

        {{-- Grid Menu dengan Tampilan Fleksibel --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 mt-6">
            @php
                $menuItems = [
                    ['image' => 'perkembangan.png', 'title' => 'Perkembangan Anak', 'route' => 'perkembangan.index'],
                    ['image' => 'imunisasi.png', 'title' => 'Imunisasi', 'route' => 'imunisasi.index'],
                    ['image' => 'ibu.png', 'title' => 'Data Orang Tua', 'route' => 'orangtua.index'],
                    ['image' => 'bayi.png', 'title' => 'Data Anak', 'route' => 'anak.index'],
                    ['image' => 'vitamin.png', 'title' => 'Vitamin', 'route' => 'vitamin.index'],
                    ['image' => 'stunting.png', 'title' => 'Stunting', 'route' => 'stunting.index'],
                ];
            @endphp

            @foreach ($menuItems as $item)
                <a href="{{ route($item['route']) }}" class="block p-4 bg-white rounded-lg text-center shadow-md hover:bg-gray-200">
                    <img src="{{ asset('images/' . $item['image']) }}" class="mx-auto w-16">
                    <p class="mt-2 font-semibold">{{ $item['title'] }}</p>
                </a>
            @endforeach
        </div>
    </div>

    {{-- Form Pendaftaran --}}
    <div class="mt-6 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-xl font-bold">Form Pendaftaran Baru</h2>
        <p class="text-gray-500">Form pendaftaran baru digunakan untuk menginput data pasien di aplikasi mobile</p>

        @if(session('success'))
            <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('dashboard.store') }}" method="POST" class="mt-4">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-semibold">NIK*</label>
                    <input type="text" name="nik" class="w-full p-2 border rounded-lg @error('nik') border-red-500 @enderror" 
                           placeholder="Masukkan NIK" value="{{ old('nik') }}" pattern="\d{16}" title="NIK harus terdiri dari 16 digit" maxlength="16">
                    @error('nik')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold">Nama Ibu*</label>
                    <input type="text" name="nama_ibu" class="w-full p-2 border rounded-lg @error('nama_ibu') border-red-500 @enderror" 
                           placeholder="Nama Ibu" value="{{ old('nama_ibu') }}">
                    @error('nama_ibu')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold">Nama Anak*</label>
                    <input type="text" name="nama_anak" class="w-full p-2 border rounded-lg @error('nama_anak') border-red-500 @enderror" 
                           placeholder="Nama Anak" value="{{ old('nama_anak') }}">
                    @error('nama_anak')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold">No Telp*</label>
                    <input type="number" name="no_telp" class="w-full p-2 border rounded-lg @error('no_telp') border-red-500 @enderror" 
                           placeholder="No Telp" value="{{ old('no_telp') }}" inputmode="numeric" pattern="[0-9]*">
                    @error('no_telp')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold">Tanggal Lahir*</label>
                    <input type="date" name="tanggal_lahir" class="w-full p-2 border rounded-lg @error('tanggal_lahir') border-red-500 @enderror" 
                           value="{{ old('tanggal_lahir') }}">
                    @error('tanggal_lahir')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold">Usia*</label>
                    <input type="text" name="usia" class="w-full p-2 border rounded-lg @error('usia') border-red-500 @enderror" 
                           placeholder="Usia" value="{{ old('usia') }}">
                    @error('usia')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold">Tempat Lahir*</label>
                    <input type="text" name="tempat_lahir" class="w-full p-2 border rounded-lg @error('tempat_lahir') border-red-500 @enderror" 
                           placeholder="Tempat Lahir" value="{{ old('tempat_lahir') }}">
                    @error('tempat_lahir')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold">Alamat*</label>
                    <input type="text" name="alamat" class="w-full p-2 border rounded-lg @error('alamat') border-red-500 @enderror" 
                           placeholder="Alamat" value="{{ old('alamat') }}">
                    @error('alamat')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold">Jenis Kelamin*</label>
                    <select name="jenis_kelamin" class="w-full p-2 border rounded-lg @error('jenis_kelamin') border-red-500 @enderror">
                        <option value="">-Pilih-</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold">Password*</label>
                    <div class="relative">
                        <input type="password" name="password" class="w-full p-2 border rounded-lg @error('password') border-red-500 @enderror" 
                               placeholder="Masukkan Password" id="dashboard-password">
                        <span class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer" onclick="togglePasswordVisibility('dashboard-password')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 3a7 7 0 00-7 7 7 7 0 0014 0 7 7 0 00-7-7zm0 12a5 5 0 110-10 5 5 0 010 10zm0-8a3 3 0 100 6 3 3 0 000-6z" />
                            </svg>
                        </span>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <button type="submit" class="mt-4 px-6 py-2 bg-gradient-to-r from-[#06B3BF] to-[#63BE9A] text-black font-semibold rounded-lg shadow-md hover:opacity-90 transition">
                Tambah
            </button>
        </form>
    </div>
</div>

<script>
function togglePasswordVisibility(id) {
    const passwordField = document.getElementById(id);
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);
}
</script>

@endsection
