<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Ganti 'Laravel' dengan nama app Anda --}}
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts (Memuat Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

{{-- Latar belakang gelap dari desain Anda --}}
<body class="font-sans antialiased bg-[#222327] text-gray-300">

    {{-- 
      NAVBAR KUSTOM (Berdasarkan Desain Anda)
      Ini adalah mockup navbar dari gambar Anda.
      Logo "T" dan ikon search (magnifying glass) menggunakan SVG.
    --}}
    <nav class="bg-transparent backdrop-blur-sm border-b border-gray-700/50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Bagian Kiri: Logo & Nav Links -->
                <div class="flex items-center space-x-8">
                    <!-- Logo 'T' -->
                    <a href="/" class="flex-shrink-0 flex items-center">
                        <span class="text-3xl font-bold text-yellow-400">H2F</span>
                    </a>

                    <!-- Nav Links (hidden di mobile) -->
                    <div class="hidden md:flex items-center space-x-6">
                        <a href="/" class="text-yellow-400 border-b-2 border-yellow-400 px-1 py-2 text-sm font-medium">Topup</a>
                        <a href="#" class="text-gray-300 hover:text-white text-sm font-medium">Cek Transaksi</a>
                        <a href="#" class="text-gray-300 hover:text-white text-sm font-medium">Leaderboard</a>
                        <a href="#" class="text-gray-300 hover:text-white text-sm font-medium">Artikel</a>
                        <a href="#" class="text-gray-300 hover:text-white text-sm font-medium">Kalkulator</a>
                    </div>
                </div>

                <!-- Bagian Tengah: Search Bar (hidden di mobile) -->
                <div class="hidden md:flex flex-1 justify-center px-8">
                    <div class="relative w-full max-w-md">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input
                            class="block w-full pl-10 pr-3 py-2 bg-[#3A3B3F] border border-transparent rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-yellow-400 focus:border-yellow-400 sm:text-sm"
                            placeholder="Cari Game atau Voucher" type="search">
                    </div>
                </div>

                <!-- Bagian Kanan: Auth Links -->
                <div class="flex items-center space-x-4">
                    {{-- 
                      Tampilkan link 'Masuk' dan 'Daftar' jika pengguna adalah tamu (belum login).
                      Ini menggunakan Blade directive '@guest'
                    --}}
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-300 hover:text-white text-sm font-medium">Masuk</a>
                        <a href="{{ route('register') }}" class="text-gray-300 hover:text-white text-sm font-medium">Daftar</a>
                    @endguest

                    {{-- 
                      Tampilkan link ke 'Dashboard' jika pengguna sudah login.
                      Ini menggunakan Blade directive '@auth'
                    --}}
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white text-sm font-medium">Dashboard</a>
                    @endauth
                    
                    <span class="text-gray-500">|</span>
                    <button class="flex items-center text-gray-300 hover:text-white text-sm font-medium">
                        <span>ID / IDR</span>
                        {{-- Ikon chevron down --}}
                        <svg class="w-4 h-4 ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Konten Halaman -->
    <main>
        {{-- Di sinilah konten dari 'index.blade.php' akan disuntikkan --}}
        @yield('content')
    </main>

    {{-- 
      Anda bisa menambahkan footer kustom di sini jika perlu
      <footer class="bg-gray-800 mt-12 py-8">
          <div class="container mx-auto px-4">
              <p class="text-center text-gray-400 text-sm">&copy; 2025 NamaPerusahaanAnda. All rights reserved.</p>
          </div>
      </footer>
    --}}

</body>
</html>