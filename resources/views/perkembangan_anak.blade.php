@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-r from-[#63BE9A] to-[#06B3BF] p-6">
    <div class="max-w-5xl mx-auto relative">
        <h2 class="text-2xl font-bold text-black absolute top-0 left-0">Data Perkembangan Anak</h2>
        <nav class="text-gray-500 text-sm absolute top-10 right-0">
            <a href="{{ route('dashboard') }}" class="text-blue-600">Dashboard</a> / Data Perkembangan Anak
        </nav>
    </div>
    
    @if(isset($action) && $action == 'create')
        <!-- Form Create -->
        <div class="w-full max-w-5xl bg-white rounded-lg shadow-lg p-6 mx-auto mt-16">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold">Tambah Data Perkembangan Anak</h3>
                <a href="{{ route('perkembangan.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Kembali</a>
            </div>
            
            <div class="bg-gray-100 p-4 rounded-lg">
                <form action="{{ route('perkembangan.store') }}" method="POST">
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
                            <label class="block text-sm font-semibold">Tanggal*</label>
                            <input type="date" name="tanggal" class="w-full p-2 border rounded-lg @error('tanggal') border-red-500 @enderror" 
                                   value="{{ old('tanggal') }}">
                            @error('tanggal')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Berat Badan (kg)*</label>
                            <input type="number" name="berat_badan" step="0.01" class="w-full p-2 border rounded-lg @error('berat_badan') border-red-500 @enderror" 
                                   placeholder="Berat Badan" value="{{ old('berat_badan') }}">
                            @error('berat_badan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Keterangan Berat Badan</label>
                            <input type="text" name="ket_berat_badan" class="w-full p-2 border rounded-lg @error('ket_berat_badan') border-red-500 @enderror" 
                                   placeholder="Keterangan Berat Badan" value="{{ old('ket_berat_badan') }}">
                            @error('ket_berat_badan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Tinggi Badan (cm)*</label>
                            <input type="number" name="tinggi_badan" step="0.01" class="w-full p-2 border rounded-lg @error('tinggi_badan') border-red-500 @enderror" 
                                   placeholder="Tinggi Badan" value="{{ old('tinggi_badan') }}">
                            @error('tinggi_badan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Keterangan Tinggi Badan</label>
                            <input type="text" name="ket_tinggi_badan" class="w-full p-2 border rounded-lg @error('ket_tinggi_badan') border-red-500 @enderror" 
                                   placeholder="Keterangan Tinggi Badan" value="{{ old('ket_tinggi_badan') }}">
                            @error('ket_tinggi_badan')
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
                <h3 class="text-xl font-bold">Edit Data Perkembangan Anak</h3>
                <a href="{{ route('perkembangan.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Kembali</a>
            </div>
            
            <div class="bg-gray-100 p-4 rounded-lg">
                <form action="{{ route('perkembangan.update', $perkembangan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold">Nama Anak*</label>
                            <input type="text" name="nama_anak" class="w-full p-2 border rounded-lg @error('nama_anak') border-red-500 @enderror" 
                                   placeholder="Nama Anak" value="{{ old('nama_anak', $perkembangan->nama_anak) }}">
                            @error('nama_anak')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Tanggal*</label>
                            <input type="date" name="tanggal" class="w-full p-2 border rounded-lg @error('tanggal') border-red-500 @enderror" 
                                   value="{{ old('tanggal', $perkembangan->tanggal->format('Y-m-d')) }}">
                            @error('tanggal')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Berat Badan (kg)*</label>
                            <input type="number" name="berat_badan" step="0.01" class="w-full p-2 border rounded-lg @error('berat_badan') border-red-500 @enderror" 
                                   placeholder="Berat Badan" value="{{ old('berat_badan', $perkembangan->berat_badan) }}">
                            @error('berat_badan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Keterangan Berat Badan</label>
                            <input type="text" name="ket_berat_badan" class="w-full p-2 border rounded-lg @error('ket_berat_badan') border-red-500 @enderror" 
                                   placeholder="Keterangan Berat Badan" value="{{ old('ket_berat_badan', $perkembangan->ket_berat_badan) }}">
                            @error('ket_berat_badan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Tinggi Badan (cm)*</label>
                            <input type="number" name="tinggi_badan" step="0.01" class="w-full p-2 border rounded-lg @error('tinggi_badan') border-red-500 @enderror" 
                                   placeholder="Tinggi Badan" value="{{ old('tinggi_badan', $perkembangan->tinggi_badan) }}">
                            @error('tinggi_badan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Keterangan Tinggi Badan</label>
                            <input type="text" name="ket_tinggi_badan" class="w-full p-2 border rounded-lg @error('ket_tinggi_badan') border-red-500 @enderror" 
                                   placeholder="Keterangan Tinggi Badan" value="{{ old('ket_tinggi_badan', $perkembangan->ket_tinggi_badan) }}">
                            @error('ket_tinggi_badan')
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
                <h3 class="text-xl font-bold">Detail Perkembangan Anak</h3>
                <a href="{{ route('perkembangan.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Kembali</a>
            </div>
            
            <div class="bg-gray-100 p-4 rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-white p-3 rounded-lg">
                        <h3 class="text-sm font-semibold text-gray-500">Nama Anak</h3>
                        <p class="text-lg">{{ $perkembangan->nama_anak }}</p>
                    </div>
                    <div class="bg-white p-3 rounded-lg">
                        <h3 class="text-sm font-semibold text-gray-500">Tanggal</h3>
                        <p class="text-lg">{{ $perkembangan->tanggal->format('d F Y') }}</p>
                    </div>
                    <div class="bg-white p-3 rounded-lg">
                        <h3 class="text-sm font-semibold text-gray-500">Berat Badan</h3>
                        <p class="text-lg">{{ $perkembangan->berat_badan }} kg</p>
                    </div>
                    <div class="bg-white p-3 rounded-lg">
                        <h3 class="text-sm font-semibold text-gray-500">Keterangan Berat Badan</h3>
                        <p class="text-lg">{{ $perkembangan->ket_berat_badan ?? '-' }}</p>
                    </div>
                    <div class="bg-white p-3 rounded-lg">
                        <h3 class="text-sm font-semibold text-gray-500">Tinggi Badan</h3>
                        <p class="text-lg">{{ $perkembangan->tinggi_badan }} cm</p>
                    </div>
                    <div class="bg-white p-3 rounded-lg">
                        <h3 class="text-sm font-semibold text-gray-500">Keterangan Tinggi Badan</h3>
                        <p class="text-lg">{{ $perkembangan->ket_tinggi_badan ?? '-' }}</p>
                    </div>
                    <div class="md:col-span-2 bg-white p-3 rounded-lg">
                        <h3 class="text-sm font-semibold text-gray-500">Terdaftar Pada</h3>
                        <p class="text-lg">{{ $perkembangan->created_at->format('d F Y H:i') }}</p>
                    </div>
                </div>

                <div class="mt-6 flex space-x-4">
                    <a href="{{ route('perkembangan.edit', $perkembangan->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">
                        Edit
                    </a>
                    <form action="{{ route('perkembangan.destroy', $perkembangan->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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
                    <a href="{{ route('perkembangan.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">Tambah</a>
                    
                    <form action="{{ route('perkembangan.index') }}" method="GET" class="flex-grow">
                        <div class="flex">
                            <input type="text" name="search" placeholder="Pencarian......" class="border p-2 rounded-l w-full" value="{{ $search ?? '' }}">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r">Cari</button>
                            @if(isset($search) && $search)
                                <a href="{{ route('perkembangan.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Reset</a>
                            @endif
                        </div>
                    </form>
                </div>

                @if(isset($search) && $search)
                    <div class="mb-4 p-2 bg-blue-100 text-blue-700 rounded-lg">
                        Menampilkan hasil pencarian untuk: <strong>{{ $search }}</strong> ({{ $perkembangan->total() }} hasil)
                    </div>
                @endif

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Row Page Selector -->
                <div class="flex justify-end mb-4">
                    <form action="{{ route('perkembangan.index') }}" method="GET" class="flex items-center">
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
                                <th class="border border-gray-300 p-2">Tanggal</th>
                                <th class="border border-gray-300 p-2">Berat Badan</th>
                                <th class="border border-gray-300 p-2">Ket. Berat</th>
                                <th class="border border-gray-300 p-2">Tinggi Badan</th>
                                <th class="border border-gray-300 p-2">Ket. Tinggi</th>
                                <th class="border border-gray-300 p-2 w-32">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($perkembangan as $index => $p)
                                <tr>
                                    <td class="border border-gray-300 p-2">{{ ($perkembangan->currentPage() - 1) * $perkembangan->perPage() + $index + 1 }}</td>
                                    <td class="border border-gray-300 p-2">{{ $p->nama_anak }}</td>
                                    <td class="border border-gray-300 p-2">{{ $p->tanggal->format('d-m-Y') }}</td>
                                    <td class="border border-gray-300 p-2">{{ $p->berat_badan }} kg</td>
                                    <td class="border border-gray-300 p-2">{{ $p->ket_berat_badan ?? '-' }}</td>
                                    <td class="border border-gray-300 p-2">{{ $p->tinggi_badan }} cm</td>
                                    <td class="border border-gray-300 p-2">{{ $p->ket_tinggi_badan ?? '-' }}</td>
                                    <td class="border border-gray-300 p-2">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('perkembangan.show', $p->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded text-xs">Detail</a>
                                            <a href="{{ route('perkembangan.edit', $p->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded text-xs">Edit</a>
                                            <form action="{{ route('perkembangan.destroy', $p->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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
                                            Tidak ada data perkembangan anak yang sesuai dengan pencarian
                                        @else
                                            Tidak ada data perkembangan anak
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                            
                            @if(count($perkembangan) > 0 && count($perkembangan) < 4)
                                @for($i = 0; $i < 4 - count($perkembangan); $i++)
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
                        Menampilkan {{ $perkembangan->firstItem() ?? 0 }} sampai {{ $perkembangan->lastItem() ?? 0 }} dari {{ $perkembangan->total() }} data
                    </div>
                    <div>
                        {{ $perkembangan->appends(['search' => $search ?? '', 'perPage' => request('perPage') ?? 10])->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
