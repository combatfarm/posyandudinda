@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-r from-[#63BE9A] to-[#06B3BF] p-6">
    <div class="max-w-5xl mx-auto relative">
        <h2 class="text-2xl font-bold text-black absolute top-0 left-0">Data Stunting</h2>
        <nav class="text-gray-500 text-sm absolute top-10 right-0">
            <a href="{{ route('dashboard') }}" class="text-blue-600">Dashboard</a> / Data Stunting
        </nav>
    </div>
    
    @if(isset($action) && $action == 'create')
        <!-- Form Create -->
        <div class="w-full max-w-5xl bg-white rounded-lg shadow-lg p-6 mx-auto mt-16">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold">Tambah Data Stunting</h3>
                <a href="{{ route('stunting.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Kembali</a>
            </div>
            
            <div class="bg-gray-100 p-4 rounded-lg">
                <form action="{{ route('stunting.store') }}" method="POST">
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
                            <label class="block text-sm font-semibold">Usia*</label>
                            <input type="text" name="usia" class="w-full p-2 border rounded-lg @error('usia') border-red-500 @enderror" 
                                   placeholder="Usia" value="{{ old('usia') }}" maxlength="10">
                            @error('usia')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Berat Badan (kg)*</label>
                            <input type="number" step="0.01" name="berat_badan" class="w-full p-2 border rounded-lg @error('berat_badan') border-red-500 @enderror" 
                                   placeholder="Berat Badan" value="{{ old('berat_badan') }}">
                            @error('berat_badan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Tinggi Badan (cm)*</label>
                            <input type="number" step="0.01" name="tinggi_badan" class="w-full p-2 border rounded-lg @error('tinggi_badan') border-red-500 @enderror" 
                                   placeholder="Tinggi Badan" value="{{ old('tinggi_badan') }}">
                            @error('tinggi_badan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Lingkar Kepala (cm)*</label>
                            <input type="number" step="0.01" name="lingkar_kepala" class="w-full p-2 border rounded-lg @error('lingkar_kepala') border-red-500 @enderror" 
                                   placeholder="Lingkar Kepala" value="{{ old('lingkar_kepala') }}">
                            @error('lingkar_kepala')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Status*</label>
                            <select name="status" class="w-full p-2 border rounded-lg @error('status') border-red-500 @enderror">
                                <option value="">-Pilih-</option>
                                <option value="Normal" {{ old('status') == 'Normal' ? 'selected' : '' }}>Normal</option>
                                <option value="Stunting" {{ old('status') == 'Stunting' ? 'selected' : '' }}>Stunting</option>
                                <option value="Gizi Buruk" {{ old('status') == 'Gizi Buruk' ? 'selected' : '' }}>Gizi Buruk</option>
                                <option value="Gizi Kurang" {{ old('status') == 'Gizi Kurang' ? 'selected' : '' }}>Gizi Kurang</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold">Catatan</label>
                            <textarea name="catatan" rows="3" class="w-full p-2 border rounded-lg @error('catatan') border-red-500 @enderror" 
                                      placeholder="Catatan">{{ old('catatan') }}</textarea>
                            @error('catatan')
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
                <h3 class="text-xl font-bold">Edit Data Stunting</h3>
                <a href="{{ route('stunting.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Kembali</a>
            </div>
            
            <div class="bg-gray-100 p-4 rounded-lg">
                <form action="{{ route('stunting.update', $stunting->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold">Nama Anak*</label>
                            <input type="text" name="nama_anak" class="w-full p-2 border rounded-lg @error('nama_anak') border-red-500 @enderror" 
                                   placeholder="Nama Anak" value="{{ old('nama_anak', $stunting->nama_anak) }}">
                            @error('nama_anak')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Tanggal*</label>
                            <input type="date" name="tanggal" class="w-full p-2 border rounded-lg @error('tanggal') border-red-500 @enderror" 
                                   value="{{ old('tanggal', $stunting->tanggal->format('Y-m-d')) }}">
                            @error('tanggal')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Usia*</label>
                            <input type="text" name="usia" class="w-full p-2 border rounded-lg @error('usia') border-red-500 @enderror" 
                                   placeholder="Usia" value="{{ old('usia', $stunting->usia) }}" maxlength="10">
                            @error('usia')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Berat Badan (kg)*</label>
                            <input type="number" step="0.01" name="berat_badan" class="w-full p-2 border rounded-lg @error('berat_badan') border-red-500 @enderror" 
                                   placeholder="Berat Badan" value="{{ old('berat_badan', $stunting->berat_badan) }}">
                            @error('berat_badan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Tinggi Badan (cm)*</label>
                            <input type="number" step="0.01" name="tinggi_badan" class="w-full p-2 border rounded-lg @error('tinggi_badan') border-red-500 @enderror" 
                                   placeholder="Tinggi Badan" value="{{ old('tinggi_badan', $stunting->tinggi_badan) }}">
                            @error('tinggi_badan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Lingkar Kepala (cm)*</label>
                            <input type="number" step="0.01" name="lingkar_kepala" class="w-full p-2 border rounded-lg @error('lingkar_kepala') border-red-500 @enderror" 
                                   placeholder="Lingkar Kepala" value="{{ old('lingkar_kepala', $stunting->lingkar_kepala) }}">
                            @error('lingkar_kepala')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold">Status*</label>
                            <select name="status" class="w-full p-2 border rounded-lg @error('status') border-red-500 @enderror">
                                <option value="">-Pilih-</option>
                                <option value="Normal" {{ old('status', $stunting->status) == 'Normal' ? 'selected' : '' }}>Normal</option>
                                <option value="Stunting" {{ old('status', $stunting->status) == 'Stunting' ? 'selected' : '' }}>Stunting</option>
                                <option value="Gizi Buruk" {{ old('status', $stunting->status) == 'Gizi Buruk' ? 'selected' : '' }}>Gizi Buruk</option>
                                <option value="Gizi Kurang" {{ old('status', $stunting->status) == 'Gizi Kurang' ? 'selected' : '' }}>Gizi Kurang</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold">Catatan</label>
                            <textarea name="catatan" rows="3" class="w-full p-2 border rounded-lg @error('catatan') border-red-500 @enderror" 
                                      placeholder="Catatan">{{ old('catatan', $stunting->catatan) }}</textarea>
                            @error('catatan')
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
                <h3 class="text-xl font-bold">Detail Data Stunting</h3>
                <a href="{{ route('stunting.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Kembali</a>
            </div>
            
            <div class="bg-gray-100 p-4 rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-semibold">Nama Anak</p>
                        <p class="p-2 bg-white rounded-lg">{{ $stunting->nama_anak }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">Tanggal</p>
                        <p class="p-2 bg-white rounded-lg">{{ $stunting->tanggal->format('d F Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">Usia</p>
                        <p class="p-2 bg-white rounded-lg">{{ $stunting->usia }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">Berat Badan</p>
                        <p class="p-2 bg-white rounded-lg">{{ $stunting->berat_badan }} kg</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">Tinggi Badan</p>
                        <p class="p-2 bg-white rounded-lg">{{ $stunting->tinggi_badan }} cm</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">Lingkar Kepala</p>
                        <p class="p-2 bg-white rounded-lg">{{ $stunting->lingkar_kepala }} cm</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">Status</p>
                        <p class="p-2 bg-white rounded-lg">
                            @if($stunting->status == 'Stunting')
                                <span class="text-red-500 font-bold">{{ $stunting->status }}</span> 🔴
                            @elseif($stunting->status == 'Normal')
                                <span class="text-green-500 font-bold">{{ $stunting->status }}</span> 🟢
                            @elseif($stunting->status == 'Gizi Buruk')
                                <span class="text-red-700 font-bold">{{ $stunting->status }}</span> 🔴
                            @elseif($stunting->status == 'Gizi Kurang')
                                <span class="text-yellow-500 font-bold">{{ $stunting->status }}</span> 🟡
                            @else
                                {{ $stunting->status }}
                            @endif
                        </p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-sm font-semibold">Catatan</p>
                        <p class="p-2 bg-white rounded-lg min-h-[80px]">{{ $stunting->catatan ?? '-' }}</p>
                    </div>
                </div>
                
                <div class="mt-6 flex space-x-2">
                    <a href="{{ route('stunting.edit', $stunting->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
                    <form action="{{ route('stunting.destroy', $stunting->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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
                    <a href="{{ route('stunting.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">Tambah</a>
                    
                    <form action="{{ route('stunting.index') }}" method="GET" class="flex-grow">
                        <div class="flex">
                            <input type="text" name="search" placeholder="Pencarian......" class="border p-2 rounded-l w-full" value="{{ $search ?? '' }}">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r">Cari</button>
                            @if(isset($search) && $search)
                                <a href="{{ route('stunting.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Reset</a>
                            @endif
                        </div>
                    </form>
                </div>

                @if(isset($search) && $search)
                    <div class="mb-4 p-2 bg-blue-100 text-blue-700 rounded-lg">
                        Menampilkan hasil pencarian untuk: <strong>{{ $search }}</strong> ({{ $stunting->total() }} hasil)
                    </div>
                @endif

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Row Page Selector -->
                <div class="flex justify-end mb-4">
                    <form action="{{ route('stunting.index') }}" method="GET" class="flex items-center">
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

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[1200px] border-collapse border border-gray-300 text-left">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="border border-gray-300 p-2 w-16">No</th>
                                <th class="border border-gray-300 p-2">Nama Anak</th>
                                <th class="border border-gray-300 p-2">Tanggal</th>
                                <th class="border border-gray-300 p-2">Usia</th>
                                <th class="border border-gray-300 p-2">Berat Badan</th>
                                <th class="border border-gray-300 p-2">Tinggi Badan</th>
                                <th class="border border-gray-300 p-2">L.Kepala</th>
                                <th class="border border-gray-300 p-2">Catatan</th>
                                <th class="border border-gray-300 p-2">Status</th>
                                <th class="border border-gray-300 p-2 w-32">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($stunting as $index => $s)
                                <tr>
                                    <td class="border border-gray-300 p-2">{{ ($stunting->currentPage() - 1) * $stunting->perPage() + $index + 1 }}</td>
                                    <td class="border border-gray-300 p-2">{{ $s->nama_anak }}</td>
                                    <td class="border border-gray-300 p-2">{{ $s->tanggal->format('d F Y') }}</td>
                                    <td class="border border-gray-300 p-2">{{ $s->usia }}</td>
                                    <td class="border border-gray-300 p-2">{{ $s->berat_badan }} kg</td>
                                    <td class="border border-gray-300 p-2">{{ $s->tinggi_badan }} cm</td>
                                    <td class="border border-gray-300 p-2">{{ $s->lingkar_kepala }} cm</td>
                                    <td class="border border-gray-300 p-2">{{ Str::limit($s->catatan, 30) }}</td>
                                    <td class="border border-gray-300 p-2">
                                        @if($s->status == 'Stunting')
                                            <span class="text-red-500 font-bold">{{ $s->status }}</span> 🔴
                                        @elseif($s->status == 'Normal')
                                            <span class="text-green-500 font-bold">{{ $s->status }}</span> 🟢
                                        @elseif($s->status == 'Gizi Buruk')
                                            <span class="text-red-700 font-bold">{{ $s->status }}</span> 🔴
                                        @elseif($s->status == 'Gizi Kurang')
                                            <span class="text-yellow-500 font-bold">{{ $s->status }}</span> 🟡
                                        @else
                                            {{ $s->status }}
                                        @endif
                                    </td>
                                    <td class="border border-gray-300 p-2">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('stunting.show', $s->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded text-xs">Detail</a>
                                            <a href="{{ route('stunting.edit', $s->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded text-xs">Edit</a>
                                            <form action="{{ route('stunting.destroy', $s->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded text-xs">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="border border-gray-300 p-2 text-center">
                                        @if(isset($search) && $search)
                                            Tidak ada data stunting yang sesuai dengan pencarian
                                        @else
                                            Tidak ada data stunting
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                            
                            @if(count($stunting) > 0 && count($stunting) < 4)
                                @for($i = 0; $i < 4 - count($stunting); $i++)
                                    <tr>
                                        <td class="border border-gray-300 p-2 h-12" colspan="10"></td>
                                    </tr>
                                @endfor
                            @endif
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4 flex justify-between items-center">
                    <div class="text-sm text-gray-600">
                        Menampilkan {{ $stunting->firstItem() ?? 0 }} sampai {{ $stunting->lastItem() ?? 0 }} dari {{ $stunting->total() }} data
                    </div>
                    <div>
                        {{ $stunting->appends(['search' => $search ?? '', 'perPage' => request('perPage') ?? 10])->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
