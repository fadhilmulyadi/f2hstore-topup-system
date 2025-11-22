<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Judul Halaman --}}
    <title>{{ config('app.name', 'H2F Topup') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts (Pastikan Vite berjalan) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-[#181820] text-gray-300">

    {{-- 
       NAVBAR
       Parent menggunakan 'justify-between' untuk memisahkan 3 bagian (Kiri, Tengah, Kanan) secara merata.
    --}}
    <nav class="bg-[#222327] border-b border-gray-800 h-16 sticky top-0 z-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 h-full">
            <div class="flex justify-between items-center h-full">

                <!-- BAGIAN 1: KIRI (Logo & Menu Navigasi) -->
                <div class="flex items-center gap-8">
                    {{-- Logo H2F --}}
                    <a href="/" class="flex-shrink-0">
                        <span class="text-3xl font-bold text-yellow-400 tracking-tighter">F2H</span>
                    </a>

                    {{-- Menu Links (Desktop) --}}
                    <div class="hidden md:flex items-center gap-6">
                        {{-- 
                            LOGIKA ACTIVE STATE:
                            Kita menggunakan request()->is('/') untuk mengecek URL.
                            Jika aktif: class kuning + border bawah + padding tinggi (py-[1.3rem]) agar border menempel di bawah navbar.
                            Jika tidak: class abu-abu + padding standar (py-2).
                        --}}
                        
                        {{-- Menu 'Topup' --}}
                        <a href="/" 
                           class="{{ request()->is('/') ? 'text-yellow-400 border-b-2 border-yellow-400 py-[1.3rem] font-bold' : 'text-gray-300 hover:text-white py-2 font-medium' }} px-1 text-sm transition-colors">
                            Topup
                        </a>

                        {{-- Menu 'Cek Transaksi' --}}
                        <a href="/transaction/check" 
                           class="{{ request()->is('transaction/check*') ? 'text-yellow-400 border-b-2 border-yellow-400 py-[1.3rem] font-bold' : 'text-gray-300 hover:text-white py-2 font-medium' }} px-1 text-sm transition-colors">
                            Cek Transaksi
                        </a>
                    </div>
                </div>

                <!-- BAGIAN 2: TENGAH (Search Bar) -->
                {{-- flex-1 agar mengisi ruang kosong, max-w-xl membatasi lebar agar tidak terlalu panjang --}}
                <div class="hidden md:flex flex-1 justify-center px-8">
                    <div class="w-full max-w-lg relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input
                            type="text"
                            class="block w-full pl-10 pr-4 py-2.5 bg-[#33343a] border-none rounded-lg text-gray-200 placeholder-gray-500 focus:ring-1 focus:ring-gray-500 sm:text-sm"
                            placeholder="Cari Game atau Voucher"
                        >
                    </div>
                </div>

                <!-- BAGIAN 3: KANAN (Auth & ID/IDR) -->
                {{-- justify-end memastikan elemen ini menempel ke kanan --}}
                <div class="flex items-center justify-end gap-4 sm:gap-6">
                    
                    {{-- Group Login/Register --}}
                    <div class="flex items-center gap-4">
                        @guest
                            <a href="{{ route('login') }}" class="text-gray-300 hover:text-white text-sm font-bold transition-colors">
                                Masuk
                            </a>
                            <a href="{{ route('register') }}" class="text-gray-300 hover:text-white text-sm font-bold transition-colors">
                                Daftar
                            </a>
                        @endguest

                        @auth
                            <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white text-sm font-bold">
                                Dashboard
                            </a>
                        @endauth
                    </div>

                    {{-- Separator Garis Vertikal --}}
                    <div class="h-4 w-px bg-gray-600"></div>

                    {{-- ID / IDR Dropdown --}}
                    <button class="flex items-center text-gray-300 hover:text-white text-sm font-bold gap-2 transition-colors">
                        <span>ID / IDR</span>
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </div>

            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main>
        @yield('content')
    </main>

</body>
</html>