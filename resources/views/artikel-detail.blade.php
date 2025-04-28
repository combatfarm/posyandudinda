@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-r from-[#63BE9A] to-[#06B3BF] p-6">
    <div class="max-w-5xl mx-auto relative">
        <h2 class="text-2xl font-bold text-black absolute top-0 left-0">Detail Artikel</h2>
        <nav class="text-gray-500 text-sm absolute top-10 right-0">
            <a href="{{ route('dashboard') }}" class="text-blue-600">Dashboard</a> / 
            <a href="{{ route('artikel.index') }}" class="text-blue-600">Artikel</a> / Detail
        </nav>
    </div>

    <div class="w-full max-w-5xl bg-white rounded-lg shadow-lg p-6 mx-auto mt-16">
        <div class="bg-gray-100 p-4 rounded-lg">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h1 class="text-3xl font-bold mb-4">{{ $artikel->judul }}</h1>
                
                <div class="flex items-center text-sm text-gray-500 mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>{{ \Carbon\Carbon::parse($artikel->tanggal)->format('d M Y') }}</span>
                </div>
                
                <div class="max-h-96 overflow-y-auto rounded-lg mb-6 border border-gray-200">
                    <img src="{{ asset('storage/artikel/' . $artikel->gambar_artikel) }}" alt="{{ $artikel->judul }}" class="w-full">
                </div>
                
                <div class="prose max-w-none">
                    {!! nl2br(e($artikel->isi_artikel)) !!}
                </div>
                
                <div class="mt-8 flex justify-between">
                    <a href="{{ route('artikel.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Daftar Artikel
                    </a>
                    
                    <form action="{{ route('artikel.destroy', $artikel->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Hapus Artikel
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 