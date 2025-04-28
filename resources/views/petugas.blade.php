@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-r from-[#63BE9A] to-[#06B3BF] p-6">
    <div class="max-w-5xl mx-auto relative">
        <h2 class="text-2xl font-bold text-black absolute top-0 left-0">Data Petugas</h2>
        <nav class="text-gray-500 text-sm absolute top-10 right-0">
            <a href="{{ route('dashboard') }}" class="text-blue-600">Dashboard</a> / Data Petugas
        </nav>
    </div>
    
    <div class="w-full max-w-5xl bg-white rounded-lg shadow-lg p-6 mx-auto mt-16">
        <div class="bg-gray-100 p-4 rounded-lg">
            <div class="flex space-x-2 my-4">
                <button onclick="openModal()" class="bg-green-500 text-white px-4 py-2 rounded">Tambah</button>
                
                <form action="{{ route('petugas') }}" method="GET" class="flex-grow">
                    <div class="flex">
                        <input type="text" name="search" placeholder="Pencarian......" class="border p-2 rounded-l w-full" value="{{ request('search') }}">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r">Cari</button>
                        @if(request('search'))
                            <a href="{{ route('petugas') }}" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Reset</a>
                        @endif
                    </div>
                </form>
            </div>

            @if(request('search'))
                <div class="mb-4 p-2 bg-blue-100 text-blue-700 rounded-lg">
                    Menampilkan hasil pencarian untuk: <strong>{{ request('search') }}</strong> ({{ count($petugas) }} hasil)
                </div>
            @endif

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Wrapper untuk Scroll Horizontal -->
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300 text-left">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border border-gray-300 p-2 w-16">No</th>
                            <th class="border border-gray-300 p-2">Username</th>
                            <th class="border border-gray-300 p-2">Password</th>
                            <th class="border border-gray-300 p-2 w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($petugas as $index => $p)
                            <tr>
                                <td class="border border-gray-300 p-2">{{ $index + 1 }}</td>
                                <td class="border border-gray-300 p-2">{{ $p->username }}</td>
                                <td class="border border-gray-300 p-2">******</td>
                                <td class="border border-gray-300 p-2">
                                    <div class="flex items-center space-x-2">
                                        <button onclick="openEditModal('{{ $p->id }}', '{{ $p->username }}')" class="bg-yellow-500 text-white px-2 py-1 rounded text-xs">Edit</button>
                                        <form action="{{ route('petugas.destroy', $p->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded text-xs">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="border border-gray-300 p-2 text-center">
                                    @if(request('search'))
                                        Tidak ada data petugas yang sesuai dengan pencarian
                                    @else
                                        Tidak ada data petugas
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                        
                        @if(count($petugas) > 0 && count($petugas) < 4)
                            @for($i = 0; $i < 4 - count($petugas); $i++)
                                <tr>
                                    <td class="border border-gray-300 p-2 h-12" colspan="4"></td>
                                </tr>
                            @endfor
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Petugas -->
<div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex justify-center items-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold">Tambah Petugas Baru</h3>
            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <form id="addPetugasForm" method="POST" action="{{ route('petugas.store') }}">
            @csrf
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block text-sm font-semibold mb-2">Username*</label>
                    <input type="text" name="username" id="username" required class="w-full p-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300" placeholder="Masukkan username">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2">Password*</label>
                    <input type="password" name="password" id="password" required class="w-full p-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300" placeholder="Masukkan password">
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-2">
                <button type="button" onclick="closeModal()" class="bg-gray-300 text-black px-4 py-2 rounded">Batal</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Petugas -->
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex justify-center items-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold">Edit Petugas</h3>
            <button onclick="closeEditModal()" class="text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <form id="editPetugasForm" method="POST" action="">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block text-sm font-semibold mb-2">Username*</label>
                    <input type="text" name="username" id="edit_username" required class="w-full p-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2">Password Baru (kosongkan jika tidak ingin mengubah)</label>
                    <input type="password" name="password" id="edit_password" class="w-full p-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300" placeholder="Masukkan password baru">
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-2">
                <button type="button" onclick="closeEditModal()" class="bg-gray-300 text-black px-4 py-2 rounded">Batal</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Perbarui</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('modal').classList.remove('hidden');
        document.getElementById('modal').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
        document.getElementById('modal').classList.remove('flex');
    }

    function openEditModal(id, username) {
        // Set form action URL dengan route yang benar
        document.getElementById('editPetugasForm').action = "{{ url('petugas') }}/" + id;
        
        // Set current values
        document.getElementById('edit_username').value = username;
        
        // Show modal
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editModal').classList.add('flex');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.getElementById('editModal').classList.remove('flex');
    }
</script>

@endsection
