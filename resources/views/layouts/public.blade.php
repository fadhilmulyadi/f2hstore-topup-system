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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-[#181820] text-gray-300">

    <nav class="bg-[#222327] border-b border-gray-800 h-16 sticky top-0 z-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 h-full">
            <div class="flex justify-between items-center h-full">

                <!-- BAGIAN 1: KIRI (Logo & Menu) -->
                <div class="flex items-center gap-8">
                    <a href="/" class="flex-shrink-0">
                        <span class="text-3xl font-bold text-yellow-400 tracking-tighter">F2H</span>
                    </a>

                    <div class="hidden md:flex items-center gap-6">
                        <a href="/" 
                           class="{{ request()->is('/') ? 'text-yellow-400 border-b-2 border-yellow-400 py-[1.3rem] font-bold' : 'text-gray-300 hover:text-white py-2 font-medium' }} px-1 text-sm transition-colors">
                            Topup
                        </a>
                        <a href="/transaction/check" 
                           class="{{ request()->is('transaction/check*') ? 'text-yellow-400 border-b-2 border-yellow-400 py-[1.3rem] font-bold' : 'text-gray-300 hover:text-white py-2 font-medium' }} px-1 text-sm transition-colors">
                            Cek Transaksi
                        </a>
                    </div>
                </div>

                <!-- BAGIAN 2: TENGAH (Search Bar) -->
                <div class="hidden md:flex flex-1 justify-center px-8">
                    <div class="w-full max-w-lg relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" class="block w-full pl-10 pr-4 py-2.5 bg-[#33343a] border-none rounded-lg text-gray-200 placeholder-gray-500 focus:ring-1 focus:ring-gray-500 sm:text-sm" placeholder="Cari Game atau Voucher">
                    </div>
                </div>

                <!-- BAGIAN 3: KANAN (Auth & ID/IDR) -->
                <div class="flex items-center justify-end gap-4 sm:gap-6">
                    
                    {{-- Group Login/Register/Dashboard/Logout --}}
                    <div class="flex items-center gap-4">
                        @guest
                            {{-- Jika Belum Login --}}
                            <a href="{{ route('login') }}" class="text-gray-300 hover:text-white text-sm font-bold transition-colors">
                                Masuk
                            </a>
                            <a href="{{ route('register') }}" class="text-gray-300 hover:text-white text-sm font-bold transition-colors">
                                Daftar
                            </a>
                        @endguest

                        @auth
                            {{-- 
                                LOGIKA ADMIN:
                                Sesuaikan 'usertype' dengan nama kolom di database Anda (misal: 'role', 'is_admin', dll).
                                Sesuaikan 'admin' dengan value untuk admin.
                            --}}
                            @if(Auth::user()->role === 'admin')
                                {{-- Cek apakah URL saat ini mengandung kata 'admin' --}}
                                @if(request()->is('admin*'))
                                    {{-- Jika sedang di Admin Panel, tombol mengarah ke '/' (Index) --}}
                                    <a href="{{ url('/') }}" class="text-yellow-400 hover:text-yellow-300 text-sm font-bold transition-colors">
                                        &larr; Kembali ke Website
                                    </a>
                                @else
                                    {{-- Jika sedang di Website Utama, tombol mengarah ke 'admin/dashboard' --}}
                                    {{-- Pastikan route 'admin.dashboard' sudah didefinisikan di web.php, atau ganti href dengan url('/admin/dashboard') --}}
                                    <a href="{{ route('admin.dashboard') }}" class="text-yellow-400 hover:text-yellow-300 text-sm font-bold transition-colors">
                                        Dashboard Admin
                                    </a>
                                @endif
                            @endif
                            {{-- Tombol Logout (Wajib Form method POST) --}}
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-gray-300 hover:text-white text-sm font-bold transition-colors pt-1">
                                    Logout
                                </button>
                            </form>
                        @endauth
                    </div>

                    {{-- Separator --}}
                    <div class="h-4 w-px bg-gray-600"></div>
                </div>

            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

</body>
</html>