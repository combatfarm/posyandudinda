<div class="bg-white w-64 min-h-screen p-4 shadow-lg">
    <div class="flex items-center justify-center mb-6">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Posyandu" class="w-25 h-25">
    </div>

    <nav class="space-y-2">
        <a href="{{ route('dashboard') }}" 
           class="flex items-center p-2 rounded 
                  {{ Request::is('dashboard') ? 'bg-[#4FFBC5] text-white' : 'hover:bg-gray-200' }}">
            📊 Dashboard
        </a>
        
        <a href="{{ route('jadwal') }}" 
           class="flex items-center p-2 rounded 
                  {{ Request::is('jadwal') ? 'bg-[#4FFBC5] text-white' : 'hover:bg-gray-200' }}">
            📅 Jadwal
        </a>

        <a href="{{ route('petugas') }}" 
           class="flex items-center p-2 rounded 
                  {{ Request::is('petugas') ? 'bg-[#4FFBC5] text-white' : 'hover:bg-gray-200' }}">
            👮 Petugas
        </a>

        <a href="{{ route('artikel.index') }}" 
           class="flex items-center p-2 rounded 
                  {{ Request::is('artikel') ? 'bg-[#4FFBC5] text-white' : 'hover:bg-gray-200' }}">
            📰 Artikel
        </a>

        <a href="{{ route('pengguna.index') }}" 
           class="flex items-center p-2 rounded 
                  {{ request()->routeIs('pengguna.*') ? 'bg-[#4FFBC5] text-white' : 'hover:bg-gray-200' }}">
            👥 Data Pengguna
        </a>

        <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="mt-4">
            @csrf
            <button type="button" onclick="confirmLogout()" class="w-full p-2 bg-red-500 text-white rounded">
                🚪 Logout
            </button>
        </form>
    </nav>
</div>

<script>
    function confirmLogout() {
        if (confirm("Apakah Anda yakin ingin keluar?")) {
            document.getElementById('logoutForm').submit(); // Kirim form logout jika pengguna memilih "Ya"
        }
    }
</script>
