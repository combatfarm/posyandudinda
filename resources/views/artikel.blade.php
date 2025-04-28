@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-r from-[#63BE9A] to-[#06B3BF] p-6">
    <div class="max-w-5xl mx-auto relative">
        <h2 class="text-2xl font-bold text-black absolute top-0 left-0">Artikel</h2>
        <nav class="text-gray-500 text-sm absolute top-10 right-0">
            <a href="{{ route('dashboard') }}" class="text-blue-600">Dashboard</a> / Artikel
        </nav>
    </div>

    <div class="w-full max-w-5xl bg-white rounded-lg shadow-lg p-6 mx-auto mt-16">
        <div class="bg-gray-100 p-4 rounded-lg">
            <div class="flex space-x-2 my-4">
                <button id="create-article-btn" class="bg-green-500 text-white px-4 py-2 rounded">+ Buat Artikel</button>
                
                <form action="{{ route('artikel.search') }}" method="GET" class="flex-grow">
                    <div class="flex">
                        <input type="text" name="keyword" placeholder="Pencarian......" class="border p-2 rounded-l w-full" value="{{ isset($keyword) ? $keyword : '' }}">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r">Cari</button>
                        @if(isset($keyword) && $keyword)
                            <a href="{{ route('artikel.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Reset</a>
                        @endif
                    </div>
                </form>
            </div>

            @if(isset($keyword) && $keyword)
                <div class="mb-4 p-2 bg-blue-100 text-blue-700 rounded-lg">
                    Menampilkan hasil pencarian untuk: <strong>{{ $keyword }}</strong> ({{ count($artikels) }} hasil)
                </div>
            @endif

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Modal untuk menambah artikel -->
            <div id="create-article-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex justify-center items-center z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full mx-auto">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold">Tambah Artikel Baru</h3>
                        <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    
                    <form action="{{ route('artikel.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="block text-sm font-semibold mb-2">Judul Artikel*</label>
                                <input type="text" name="judul" class="w-full p-2 border rounded-lg" placeholder="Masukkan judul artikel" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-2">Gambar Artikel*</label>
                                <input type="file" name="gambar_artikel" class="w-full p-2 border rounded-lg" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-2">Tanggal*</label>
                                <input type="date" name="tanggal" class="w-full p-2 border rounded-lg" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-2">Isi Artikel*</label>
                                <textarea name="isi_artikel" class="w-full p-2 border rounded-lg" rows="6" placeholder="Tulis isi artikel di sini..." required></textarea>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end space-x-2">
                            <button type="button" onclick="closeModal()" class="bg-gray-300 text-black px-4 py-2 rounded">Batal</button>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Terbitkan</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Daftar Artikel dengan Grid Layout -->
            <div class="max-h-[70vh] overflow-y-auto pr-2">
                @if(count($artikels) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($artikels as $artikel)
                            <div class="bg-white border rounded-lg shadow-md p-4 relative">
                                <div class="h-40 overflow-y-auto rounded-md mb-2 border border-gray-200">
                                    <img src="{{ asset('storage/artikel/' . $artikel->gambar_artikel) }}" alt="Gambar Artikel" class="w-full">
                                </div>
                                <h4 class="font-bold mt-2 text-lg">{{ $artikel->judul }}</h4>
                                <div class="flex items-center text-xs text-gray-500 mt-1 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>{{ \Carbon\Carbon::parse($artikel->tanggal)->format('d M Y') }}</span>
                                </div>
                                <p class="text-sm text-gray-600">{{ Str::limit($artikel->isi_artikel, 120, '...') }}</p>
                                <div class="flex justify-between items-center mt-2">
                                    <a href="{{ route('artikel.show', $artikel->id) }}" class="text-blue-500 inline-block">Baca Selengkapnya...</a>
                                    <form action="{{ route('artikel.destroy', $artikel->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white p-8 rounded-lg text-center">
                        @if(isset($keyword) && $keyword)
                            <p class="text-gray-600">Tidak ada artikel yang sesuai dengan pencarian</p>
                        @else
                            <p class="text-gray-600">Belum ada artikel yang ditambahkan</p>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('create-article-btn').onclick = function() {
        const modal = document.getElementById('create-article-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    };

    function closeModal() {
        const modal = document.getElementById('create-article-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection
