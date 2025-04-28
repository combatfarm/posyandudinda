@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-r from-[#63BE9A] to-[#06B3BF] p-6">
    <div class="max-w-5xl mx-auto relative">
        <h2 class="text-2xl font-bold text-black absolute top-0 left-0">Data Pengguna</h2>
        <nav class="text-gray-500 text-sm absolute top-10 right-0">
            <a href="{{ route('dashboard') }}" class="text-blue-600">Dashboard</a> / Data Pengguna
        </nav>
    </div>
    
    @if(isset($action) && $action == 'create')
        <!-- Form Create -->
        <div class="w-full max-w-5xl bg-white rounded-lg shadow-lg p-6 mx-auto mt-16">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold">Tambah Pengguna Baru</h3>
                <a href="{{ route('pengguna.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Kembali</a>
            </div>
            
            <div class="bg-gray-100 p-4 rounded-lg">
                <form action="{{ route('pengguna.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
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
                                       placeholder="Masukkan Password" id="password">
                                <span class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer" onclick="togglePasswordVisibility('password')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 3a7 7 0 00-7 7 7 7 0 0014 0 7 7 0 00-7-7zm0 12a5 5 0 110-10 5 5 0 010 10zm0-8a3 3 0 100 6 3 3 0 000-6z" />
                                    </svg>
                                </span>
                            </div>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="md:col-span-3">
                            <label class="block text-sm font-semibold">Alamat*</label>
                            <textarea name="alamat" class="w-full p-2 border rounded-lg @error('alamat') border-red-500 @enderror" 
                                      placeholder="Alamat" rows="3">{{ old('alamat') }}</textarea>
                            @error('alamat')
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
                <h3 class="text-xl font-bold">Edit Data Pengguna</h3>
                <a href="{{ route('pengguna.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Kembali</a>
            </div>
            
            <div class="bg-gray-100 p-4 rounded-lg">
                <form action="{{ route('pengguna.update', $pengguna->nik) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-semibold">NIK</label>
                            <input type="text" class="w-full p-2 border rounded-lg bg-gray-200" value="{{ $pengguna->nik }}" readonly>
                            <p class="text-gray-500 text-xs mt-1">NIK tidak dapat diubah</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Nama Ibu*</label>
                            <input type="text" name="nama_ibu" class="w-full p-2 border rounded-lg @error('nama_ibu') border-red-500 @enderror" 
                                   placeholder="Nama Ibu" value="{{ old('nama_ibu', $pengguna->nama_ibu) }}">
                            @error('nama_ibu')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Nama Anak*</label>
                            <input type="text" name="nama_anak" class="w-full p-2 border rounded-lg @error('nama_anak') border-red-500 @enderror" 
                                   placeholder="Nama Anak" value="{{ old('nama_anak', $pengguna->nama_anak) }}">
                            @error('nama_anak')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">No Telp*</label>
                            <input type="number" name="no_telp" class="w-full p-2 border rounded-lg @error('no_telp') border-red-500 @enderror" 
                                   placeholder="No Telp" value="{{ old('no_telp', $pengguna->no_telp) }}" inputmode="numeric" pattern="[0-9]*">
                            @error('no_telp')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Tanggal Lahir*</label>
                            <input type="date" name="tanggal_lahir" class="w-full p-2 border rounded-lg @error('tanggal_lahir') border-red-500 @enderror" 
                                   value="{{ old('tanggal_lahir', $pengguna->tanggal_lahir->format('Y-m-d')) }}">
                            @error('tanggal_lahir')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Usia*</label>
                            <input type="text" name="usia" class="w-full p-2 border rounded-lg @error('usia') border-red-500 @enderror" 
                                   placeholder="Usia" value="{{ old('usia', $pengguna->usia) }}">
                            @error('usia')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Tempat Lahir*</label>
                            <input type="text" name="tempat_lahir" class="w-full p-2 border rounded-lg @error('tempat_lahir') border-red-500 @enderror" 
                                   placeholder="Tempat Lahir" value="{{ old('tempat_lahir', $pengguna->tempat_lahir) }}">
                            @error('tempat_lahir')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Jenis Kelamin*</label>
                            <select name="jenis_kelamin" class="w-full p-2 border rounded-lg @error('jenis_kelamin') border-red-500 @enderror">
                                <option value="">-Pilih-</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin', $pengguna->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $pengguna->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Password</label>
                            <div class="relative">
                                <input type="password" name="password" class="w-full p-2 border rounded-lg @error('password') border-red-500 @enderror" 
                                       placeholder="Masukkan Password (Kosongkan jika tidak ingin mengubah)" id="edit-password">
                                <span class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer" onclick="togglePasswordVisibility('edit-password')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 3a7 7 0 00-7 7 7 7 0 0014 0 7 7 0 00-7-7zm0 12a5 5 0 110-10 5 5 0 010 10zm0-8a3 3 0 100 6 3 3 0 000-6z" />
                                    </svg>
                                </span>
                            </div>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="md:col-span-3">
                            <label class="block text-sm font-semibold">Alamat*</label>
                            <textarea name="alamat" class="w-full p-2 border rounded-lg @error('alamat') border-red-500 @enderror" 
                                      placeholder="Alamat" rows="3">{{ old('alamat', $pengguna->alamat) }}</textarea>
                            @error('alamat')
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
                <h3 class="text-xl font-bold">Detail Pengguna</h3>
                <a href="{{ route('pengguna.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Kembali</a>
            </div>
            
            <div class="bg-gray-100 p-4 rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-white p-3 rounded-lg">
                        <h3 class="text-sm font-semibold text-gray-500">NIK</h3>
                        <p class="text-lg">{{ $pengguna->nik }}</p>
                    </div>
                    <div class="bg-white p-3 rounded-lg">
                        <h3 class="text-sm font-semibold text-gray-500">Nama Ibu</h3>
                        <p class="text-lg">{{ $pengguna->nama_ibu }}</p>
                    </div>
                    <div class="bg-white p-3 rounded-lg">
                        <h3 class="text-sm font-semibold text-gray-500">Nama Anak</h3>
                        <p class="text-lg">{{ $pengguna->nama_anak }}</p>
                    </div>
                    <div class="bg-white p-3 rounded-lg">
                        <h3 class="text-sm font-semibold text-gray-500">No Telp</h3>
                        <p class="text-lg">{{ $pengguna->no_telp ?? '-' }}</p>
                    </div>
                    <div class="bg-white p-3 rounded-lg">
                        <h3 class="text-sm font-semibold text-gray-500">Tanggal Lahir</h3>
                        <p class="text-lg">{{ $pengguna->tanggal_lahir->format('d F Y') }}</p>
                    </div>
                    <div class="bg-white p-3 rounded-lg">
                        <h3 class="text-sm font-semibold text-gray-500">Usia</h3>
                        <p class="text-lg">{{ $pengguna->usia }}</p>
                    </div>
                    <div class="bg-white p-3 rounded-lg">
                        <h3 class="text-sm font-semibold text-gray-500">Tempat Lahir</h3>
                        <p class="text-lg">{{ $pengguna->tempat_lahir }}</p>
                    </div>
                    <div class="bg-white p-3 rounded-lg">
                        <h3 class="text-sm font-semibold text-gray-500">Jenis Kelamin</h3>
                        <p class="text-lg">{{ $pengguna->jenis_kelamin }}</p>
                    </div>
                    <div class="md:col-span-3 bg-white p-3 rounded-lg">
                        <h3 class="text-sm font-semibold text-gray-500">Alamat</h3>
                        <p class="text-lg">{{ $pengguna->alamat }}</p>
                    </div>
                    <div class="md:col-span-3 bg-white p-3 rounded-lg">
                        <h3 class="text-sm font-semibold text-gray-500">Terdaftar Pada</h3>
                        <p class="text-lg">{{ $pengguna->created_at->format('d F Y H:i') }}</p>
                    </div>
                </div>

                <div class="mt-6 flex space-x-4">
                    <a href="{{ route('pengguna.edit', $pengguna->nik) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">
                        Edit
                    </a>
                    <form action="{{ route('pengguna.destroy', $pengguna->nik) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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
                    <a href="{{ route('pengguna.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">Tambah</a>
                    
                    <form action="{{ route('pengguna.index') }}" method="GET" class="flex-grow">
                        <div class="flex">
                            <input type="text" name="search" placeholder="Pencarian......" class="border p-2 rounded-l w-full" value="{{ $search ?? '' }}">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r">Cari</button>
                            @if(isset($search) && $search)
                                <a href="{{ route('pengguna.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Reset</a>
                            @endif
                        </div>
                    </form>
                </div>

                @if(isset($search) && $search)
                    <div class="mb-4 p-2 bg-blue-100 text-blue-700 rounded-lg">
                        Menampilkan hasil pencarian untuk: <strong>{{ $search }}</strong> ({{ $pengguna->total() }} hasil)
                    </div>
                @endif

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Row Page Selector -->
                <div class="flex justify-end mb-4">
                    <form action="{{ route('pengguna.index') }}" method="GET" class="flex items-center">
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
                    <table class="w-full min-w-[1100px] border-collapse border border-gray-300 text-left">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="border border-gray-300 p-2 w-16">No</th>
                                <th class="border border-gray-300 p-2">NIK</th>
                                <th class="border border-gray-300 p-2">Nama Ibu</th>
                                <th class="border border-gray-300 p-2">Nama Anak</th>
                                <th class="border border-gray-300 p-2">Usia</th>
                                <th class="border border-gray-300 p-2">Jenis Kelamin</th>
                                <th class="border border-gray-300 p-2">No. Telp</th>
                                <th class="border border-gray-300 p-2 w-32">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pengguna as $index => $p)
                                <tr>
                                    <td class="border border-gray-300 p-2">{{ ($pengguna->currentPage() - 1) * $pengguna->perPage() + $index + 1 }}</td>
                                    <td class="border border-gray-300 p-2">{{ $p->nik }}</td>
                                    <td class="border border-gray-300 p-2">{{ $p->nama_ibu }}</td>
                                    <td class="border border-gray-300 p-2">{{ $p->nama_anak }}</td>
                                    <td class="border border-gray-300 p-2">{{ $p->usia }}</td>
                                    <td class="border border-gray-300 p-2">{{ $p->jenis_kelamin }}</td>
                                    <td class="border border-gray-300 p-2">{{ $p->no_telp }}</td>
                                    <td class="border border-gray-300 p-2">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('pengguna.show', $p->nik) }}" class="bg-blue-500 text-white px-2 py-1 rounded text-xs">Detail</a>
                                            <a href="{{ route('pengguna.edit', $p->nik) }}" class="bg-yellow-500 text-white px-2 py-1 rounded text-xs">Edit</a>
                                            <form action="{{ route('pengguna.destroy', $p->nik) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded text-xs">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="border border-gray-300 p-2 text-center">
                                        @if(isset($search) && $search)
                                            Tidak ada data pengguna yang sesuai dengan pencarian
                                        @else
                                            Tidak ada data pengguna
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                            
                            @if(count($pengguna) > 0 && count($pengguna) < 4)
                                @for($i = 0; $i < 4 - count($pengguna); $i++)
                                    <tr>
                                        <td class="border border-gray-300 p-2 h-12" colspan="8"></td>
                                    </tr>
                                @endfor
                            @endif
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4 flex justify-between items-center">
                    <div class="text-sm text-gray-600">
                        Menampilkan {{ $pengguna->firstItem() ?? 0 }} sampai {{ $pengguna->lastItem() ?? 0 }} dari {{ $pengguna->total() }} data
                    </div>
                    <div>
                        {{ $pengguna->appends(['search' => $search ?? '', 'perPage' => request('perPage') ?? 10])->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
function togglePasswordVisibility(id) {
    const passwordField = document.getElementById(id);
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);
}
</script>
@endsection 