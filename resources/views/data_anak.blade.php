@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-r from-[#63BE9A] to-[#06B3BF] p-6">
    <div class="max-w-5xl mx-auto relative">
        <h2 class="text-2xl font-bold text-black absolute top-0 left-0">Data Anak</h2>
        <nav class="text-gray-500 text-sm absolute top-10 right-0">
            <a href="{{ route('dashboard') }}" class="text-blue-600">Dashboard</a> / Data Anak
        </nav>
    </div>
    
    @if(isset($action) && $action == 'create')
        <!-- Form Create -->
        <div class="w-full max-w-5xl bg-white rounded-lg shadow-lg p-6 mx-auto mt-16">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold">Tambah Data Anak</h3>
                <a href="{{ route('anak.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Kembali</a>
            </div>
            
            <div class="bg-gray-100 p-4 rounded-lg">
                <form action="{{ route('anak.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold">NIK*</label>
                            <input type="text" name="nik" class="w-full p-2 border rounded-lg @error('nik') border-red-500 @enderror" 
                                   placeholder="Masukkan NIK" value="{{ old('nik') }}" maxlength="16">
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
                            <label class="block text-sm font-semibold">Tempat Lahir*</label>
                            <input type="text" name="tempat_lahir" class="w-full p-2 border rounded-lg @error('tempat_lahir') border-red-500 @enderror" 
                                   placeholder="Tempat Lahir" value="{{ old('tempat_lahir') }}">
                            @error('tempat_lahir')
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
                                   placeholder="Usia" value="{{ old('usia') }}" maxlength="10">
                            @error('usia')
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
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @elseif(isset($action) && $action == 'edit')
        <!-- Form Edit -->
        <div class="w-full max-w-5xl bg-white rounded-lg shadow-lg p-6 mx-auto mt-16">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold">Edit Data Anak</h3>
                <a href="{{ route('anak.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Kembali</a>
            </div>
            
            <div class="bg-gray-100 p-4 rounded-lg">
                <form action="{{ route('anak.update', $anak->nik) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold">NIK</label>
                            <input type="text" class="w-full p-2 border rounded-lg bg-gray-200" value="{{ $anak->nik }}" readonly>
                            <p class="text-gray-500 text-xs mt-1">NIK tidak dapat diubah</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Nama Ibu*</label>
                            <input type="text" name="nama_ibu" class="w-full p-2 border rounded-lg @error('nama_ibu') border-red-500 @enderror" 
                                   placeholder="Nama Ibu" value="{{ old('nama_ibu', $anak->nama_ibu) }}">
                            @error('nama_ibu')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Nama Anak*</label>
                            <input type="text" name="nama_anak" class="w-full p-2 border rounded-lg @error('nama_anak') border-red-500 @enderror" 
                                   placeholder="Nama Anak" value="{{ old('nama_anak', $anak->nama_anak) }}">
                            @error('nama_anak')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Tempat Lahir*</label>
                            <input type="text" name="tempat_lahir" class="w-full p-2 border rounded-lg @error('tempat_lahir') border-red-500 @enderror" 
                                   placeholder="Tempat Lahir" value="{{ old('tempat_lahir', $anak->tempat_lahir) }}">
                            @error('tempat_lahir')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Tanggal Lahir*</label>
                            <input type="date" name="tanggal_lahir" class="w-full p-2 border rounded-lg @error('tanggal_lahir') border-red-500 @enderror" 
                                   value="{{ old('tanggal_lahir', $anak->tanggal_lahir->format('Y-m-d')) }}">
                            @error('tanggal_lahir')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Usia*</label>
                            <input type="text" name="usia" class="w-full p-2 border rounded-lg @error('usia') border-red-500 @enderror" 
                                   placeholder="Contoh: 2 bulan" value="{{ old('usia', $anak->usia) }}" maxlength="10">
                            @error('usia')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Jenis Kelamin*</label>
                            <select name="jenis_kelamin" class="w-full p-2 border rounded-lg @error('jenis_kelamin') border-red-500 @enderror">
                                <option value="">-Pilih-</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin', $anak->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $anak->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                            Perbarui Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @elseif(isset($action) && $action == 'show')
        <!-- Detail View -->
        <div class="w-full max-w-5xl bg-white rounded-lg shadow-lg p-6 mx-auto mt-16">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold">Detail Data Anak</h3>
                <a href="{{ route('anak.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Kembali</a>
            </div>
            
            <div class="bg-gray-100 p-4 rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-semibold">NIK</p>
                        <p class="p-2 bg-white rounded-lg">{{ $anak->nik }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">Nama Ibu</p>
                        <p class="p-2 bg-white rounded-lg">{{ $anak->nama_ibu }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">Nama Anak</p>
                        <p class="p-2 bg-white rounded-lg">{{ $anak->nama_anak }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">Tempat Lahir</p>
                        <p class="p-2 bg-white rounded-lg">{{ $anak->tempat_lahir }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">Tanggal Lahir</p>
                        <p class="p-2 bg-white rounded-lg">{{ $anak->tanggal_lahir->format('d F Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">Usia</p>
                        <p class="p-2 bg-white rounded-lg">{{ $anak->usia }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">Jenis Kelamin</p>
                        <p class="p-2 bg-white rounded-lg">{{ $anak->jenis_kelamin }}</p>
                    </div>
                </div>

                <div class="mt-6 flex space-x-4">
                    <a href="{{ route('anak.edit', $anak->nik) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">
                        Edit
                    </a>
                    <form action="{{ route('anak.destroy', $anak->nik) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <!-- Index View (List) -->
        <div class="w-full max-w-5xl bg-white rounded-lg shadow-lg p-6 mx-auto mt-16">
            <div class="bg-gray-100 p-4 rounded-lg">
                <div class="flex space-x-2 my-4">
                    <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded">Cetak</a>
                    <a href="{{ route('anak.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">Tambah</a>
                    <a href="#" class="bg-purple-500 text-white px-4 py-2 rounded">Grafik</a>
                    
                    <form action="{{ route('anak.index') }}" method="GET" class="flex-grow">
                        <div class="flex">
                            <input type="text" name="search" placeholder="Pencarian......" class="border p-2 rounded-l w-full" value="{{ $search ?? '' }}">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r">Cari</button>
                            @if(isset($search) && $search)
                                <a href="{{ route('anak.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Reset</a>
                            @endif
                        </div>
                    </form>
                </div>

                @if(isset($search) && $search)
                    <div class="mb-4 p-2 bg-blue-100 text-blue-700 rounded-lg">
                        Menampilkan hasil pencarian untuk: <strong>{{ $search }}</strong> ({{ $anak->total() }} hasil)
                    </div>
                @endif

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Row Page Selector -->
                <div class="flex justify-end mb-4">
                    <form action="{{ route('anak.index') }}" method="GET" class="flex items-center">
                        <input type="hidden" name="search" value="{{ $search ?? '' }}">
                        <label for="perPage" class="mr-2 text-sm">Tampilkan:</label>
                        <select name="perPage" id="perPage" class="border rounded p-1 text-sm" onchange="this.form.submit()">
                            <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                        <span class="ml-2 text-sm">data per halaman</span>
                    </form>
                </div>

                <!-- Wrapper untuk Scroll Horizontal -->
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[1000px] border-collapse border border-gray-300 text-left">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="border border-gray-300 p-2 w-16">No</th>
                                <th class="border border-gray-300 p-2">NIK</th>
                                <th class="border border-gray-300 p-2">Nama Ibu</th>
                                <th class="border border-gray-300 p-2">Nama Anak</th>
                                <th class="border border-gray-300 p-2">Tempat Lahir</th>
                                <th class="border border-gray-300 p-2">Tanggal Lahir</th>
                                <th class="border border-gray-300 p-2">Usia</th>
                                <th class="border border-gray-300 p-2">Jenis Kelamin</th>
                                <th class="border border-gray-300 p-2 w-32">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($anak as $index => $a)
                                <tr>
                                    <td class="border border-gray-300 p-2">{{ ($anak->currentPage() - 1) * $anak->perPage() + $index + 1 }}</td>
                                    <td class="border border-gray-300 p-2">{{ $a->nik }}</td>
                                    <td class="border border-gray-300 p-2">{{ $a->nama_ibu }}</td>
                                    <td class="border border-gray-300 p-2">{{ $a->nama_anak }}</td>
                                    <td class="border border-gray-300 p-2">{{ $a->tempat_lahir }}</td>
                                    <td class="border border-gray-300 p-2">{{ $a->tanggal_lahir->format('d F Y') }}</td>
                                    <td class="border border-gray-300 p-2">{{ $a->usia }}</td>
                                    <td class="border border-gray-300 p-2">{{ $a->jenis_kelamin }}</td>
                                    <td class="border border-gray-300 p-2">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('anak.show', $a->nik) }}" class="bg-blue-500 text-white px-2 py-1 rounded text-xs">Detail</a>
                                            <a href="{{ route('anak.edit', $a->nik) }}" class="bg-yellow-500 text-white px-2 py-1 rounded text-xs">Edit</a>
                                            <form action="{{ route('anak.destroy', $a->nik) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded text-xs">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="border border-gray-300 p-2 text-center">
                                        @if(isset($search) && $search)
                                            Tidak ada data anak yang sesuai dengan pencarian
                                        @else
                                            Tidak ada data anak
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                            
                            @if(count($anak) > 0 && count($anak) < 4)
                                @for($i = 0; $i < 4 - count($anak); $i++)
                                    <tr>
                                        <td class="border border-gray-300 p-2 h-12" colspan="9"></td>
                                    </tr>
                                @endfor
                            @endif
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4 flex justify-between items-center">
                    <div class="text-sm text-gray-600">
                        Menampilkan {{ $anak->firstItem() ?? 0 }} sampai {{ $anak->lastItem() ?? 0 }} dari {{ $anak->total() }} data
                    </div>
                    <div>
                        {{ $anak->appends(['search' => $search ?? '', 'perPage' => request('perPage') ?? 10])->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
