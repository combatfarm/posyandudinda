@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-r from-[#63BE9A] to-[#06B3BF] p-6">
    <div class="max-w-5xl mx-auto relative">
        <h2 class="text-2xl font-bold text-black absolute top-0 left-0">Data Imunisasi</h2>
        <nav class="text-gray-500 text-sm absolute top-10 right-0">
            <a href="{{ route('dashboard') }}" class="text-blue-600">Dashboard</a> / Data Imunisasi
        </nav>
    </div>
    
    @if(isset($action) && $action == 'create')
        <!-- Form Create -->
        <div class="w-full max-w-5xl bg-white rounded-lg shadow-lg p-6 mx-auto mt-16">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold">Tambah Data Imunisasi</h3>
                <a href="{{ route('imunisasi.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Kembali</a>
            </div>
            
            <div class="bg-gray-100 p-4 rounded-lg">
                <form action="{{ route('imunisasi.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold">Nama Anak*</label>
                            <input type="text" name="nama_anak" class="w-full p-2 border rounded-lg @error('nama_anak') border-red-500 @enderror" 
                                   placeholder="Nama Anak" value="{{ old('nama_anak') }}">
                            @error('nama_anak')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Tanggal Imunisasi*</label>
                            <input type="date" name="tanggal_imunisasi" class="w-full p-2 border rounded-lg @error('tanggal_imunisasi') border-red-500 @enderror" 
                                   value="{{ old('tanggal_imunisasi') }}">
                            @error('tanggal_imunisasi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Imunisasi*</label>
                            <input type="text" name="imunisasi" class="w-full p-2 border rounded-lg @error('imunisasi') border-red-500 @enderror" 
                                   placeholder="Jenis Imunisasi" value="{{ old('imunisasi') }}">
                            @error('imunisasi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Status*</label>
                            <select name="status" class="w-full p-2 border rounded-lg @error('status') border-red-500 @enderror">
                                <option value="">-Pilih-</option>
                                <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="Tidak Selesai" {{ old('status') == 'Tidak Selesai' ? 'selected' : '' }}>Tidak Selesai</option>
                            </select>
                            @error('status')
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
                <h3 class="text-xl font-bold">Edit Data Imunisasi</h3>
                <a href="{{ route('imunisasi.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Kembali</a>
            </div>
            
            <div class="bg-gray-100 p-4 rounded-lg">
                <form action="{{ route('imunisasi.update', $imunisasi->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold">Nama Anak*</label>
                            <input type="text" name="nama_anak" class="w-full p-2 border rounded-lg @error('nama_anak') border-red-500 @enderror" 
                                   placeholder="Nama Anak" value="{{ old('nama_anak', $imunisasi->nama_anak) }}">
                            @error('nama_anak')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Tanggal Imunisasi*</label>
                            <input type="date" name="tanggal_imunisasi" class="w-full p-2 border rounded-lg @error('tanggal_imunisasi') border-red-500 @enderror" 
                                   value="{{ old('tanggal_imunisasi', $imunisasi->tanggal_imunisasi->format('Y-m-d')) }}">
                            @error('tanggal_imunisasi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Imunisasi*</label>
                            <input type="text" name="imunisasi" class="w-full p-2 border rounded-lg @error('imunisasi') border-red-500 @enderror" 
                                   placeholder="Jenis Imunisasi" value="{{ old('imunisasi', $imunisasi->imunisasi) }}">
                            @error('imunisasi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Status*</label>
                            <select name="status" class="w-full p-2 border rounded-lg @error('status') border-red-500 @enderror">
                                <option value="">-Pilih-</option>
                                <option value="Selesai" {{ old('status', $imunisasi->status) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="Tidak Selesai" {{ old('status', $imunisasi->status) == 'Tidak Selesai' ? 'selected' : '' }}>Tidak Selesai</option>
                            </select>
                            @error('status')
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
                <h3 class="text-xl font-bold">Detail Imunisasi</h3>
                <a href="{{ route('imunisasi.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Kembali</a>
            </div>
            
            <div class="bg-gray-100 p-4 rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-white p-3 rounded-lg">
                        <h3 class="text-sm font-semibold text-gray-500">Nama Anak</h3>
                        <p class="text-lg">{{ $imunisasi->nama_anak }}</p>
                    </div>
                    <div class="bg-white p-3 rounded-lg">
                        <h3 class="text-sm font-semibold text-gray-500">Tanggal Imunisasi</h3>
                        <p class="text-lg">{{ $imunisasi->tanggal_imunisasi->format('d F Y') }}</p>
                    </div>
                    <div class="bg-white p-3 rounded-lg">
                        <h3 class="text-sm font-semibold text-gray-500">Imunisasi</h3>
                        <p class="text-lg">{{ $imunisasi->imunisasi }}</p>
                    </div>
                    <div class="bg-white p-3 rounded-lg">
                        <h3 class="text-sm font-semibold text-gray-500">Status</h3>
                        <p class="text-lg">{{ $imunisasi->status }}</p>
                    </div>
                    <div class="md:col-span-2 bg-white p-3 rounded-lg">
                        <h3 class="text-sm font-semibold text-gray-500">Terdaftar Pada</h3>
                        <p class="text-lg">{{ $imunisasi->created_at->format('d F Y H:i') }}</p>
                    </div>
                </div>

                <div class="mt-6 flex space-x-4">
                    <a href="{{ route('imunisasi.edit', $imunisasi->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">
                        Edit
                    </a>
                    <form action="{{ route('imunisasi.destroy', $imunisasi->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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
                    <a href="{{ route('imunisasi.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">Tambah</a>
                    
                    <form action="{{ route('imunisasi.index') }}" method="GET" class="flex-grow">
                        <div class="flex">
                            <input type="text" name="search" placeholder="Pencarian......" class="border p-2 rounded-l w-full" value="{{ $search ?? '' }}">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r">Cari</button>
                            @if(isset($search) && $search)
                                <a href="{{ route('imunisasi.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Reset</a>
                            @endif
                        </div>
                    </form>
                </div>

                @if(isset($search) && $search)
                    <div class="mb-4 p-2 bg-blue-100 text-blue-700 rounded-lg">
                        Menampilkan hasil pencarian untuk: <strong>{{ $search }}</strong> ({{ $imunisasi->total() }} hasil)
                    </div>
                @endif

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Row Page Selector -->
                <div class="flex justify-end mb-4">
                    <form action="{{ route('imunisasi.index') }}" method="GET" class="flex items-center">
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
                                <th class="border border-gray-300 p-2">Nama Anak</th>
                                <th class="border border-gray-300 p-2">Tanggal Imunisasi</th>
                                <th class="border border-gray-300 p-2">Imunisasi</th>
                                <th class="border border-gray-300 p-2">Status</th>
                                <th class="border border-gray-300 p-2 w-32">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($imunisasi as $index => $i)
                                <tr>
                                    <td class="border border-gray-300 p-2">{{ ($imunisasi->currentPage() - 1) * $imunisasi->perPage() + $index + 1 }}</td>
                                    <td class="border border-gray-300 p-2">{{ $i->nama_anak }}</td>
                                    <td class="border border-gray-300 p-2">{{ $i->tanggal_imunisasi->format('d F Y') }}</td>
                                    <td class="border border-gray-300 p-2">{{ $i->imunisasi }}</td>
                                    <td class="border border-gray-300 p-2">{{ $i->status }}</td>
                                    <td class="border border-gray-300 p-2">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('imunisasi.show', $i->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded text-xs">Detail</a>
                                            <a href="{{ route('imunisasi.edit', $i->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded text-xs">Edit</a>
                                            <form action="{{ route('imunisasi.destroy', $i->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded text-xs">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="border border-gray-300 p-2 text-center">
                                        @if(isset($search) && $search)
                                            Tidak ada data imunisasi yang sesuai dengan pencarian
                                        @else
                                            Tidak ada data imunisasi
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                            
                            @if(count($imunisasi) > 0 && count($imunisasi) < 4)
                                @for($i = 0; $i < 4 - count($imunisasi); $i++)
                                    <tr>
                                        <td class="border border-gray-300 p-2 h-12" colspan="6"></td>
                                    </tr>
                                @endfor
                            @endif
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4 flex justify-between items-center">
                    <div class="text-sm text-gray-600">
                        Menampilkan {{ $imunisasi->firstItem() ?? 0 }} sampai {{ $imunisasi->lastItem() ?? 0 }} dari {{ $imunisasi->total() }} data
                    </div>
                    <div>
                        {{ $imunisasi->appends(['search' => $search ?? '', 'perPage' => request('perPage') ?? 10])->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
