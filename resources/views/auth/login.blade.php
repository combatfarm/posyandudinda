<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Posyandu Mahoni 54</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen flex items-center justify-center bg-gradient-to-r from-[#63BE9A] via-[#FFA4D3] to-[#06B3BF]">
  <div class="w-full max-w-lg flex flex-col items-center bg-green-300 p-8 rounded-2xl">
  <!-- Bagian Kiri: Form Login -->      
    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-24 h-24 rounded-full mb-4 border-4 border-white">
        <h3 class="text-xl font-bold text-black mb-4">POSYANDU</h3>
        <form action="{{ route('login') }}" method="POST" class="w-full">
            @csrf
            <div class="mb-4 flex items-center bg-white p-2 rounded-lg">
                <span class="text-gray-400 px-2">&#128100;</span>
                <input type="text" name="username" class="w-full p-2 focus:outline-none" placeholder="Username" required>
            </div>
            <div class="mb-4 flex items-center bg-white p-2 rounded-lg">
                <span class="text-gray-400 px-2">&#128274;</span>
                <input type="password" name="password" class="w-full p-2 focus:outline-none" placeholder="Password" required>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Login</button>
        </form>
    </div>
        
        <!-- Bagian Kanan: Ilustrasi -->
        <div class="w-1/2 flex items-center justify-center p-4">
            <img src="{{ asset('images/ilustrasi.png') }}" alt="Illustration" class="max-w-full h-auto">
        </div>
    </div>
</body>
</html>
