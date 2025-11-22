<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Daftar - {{ config('app.name', 'H2F Topup') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-[#181820] text-white">

    {{-- Container Utama --}}
    <div class="min-h-screen w-full flex items-center justify-center relative overflow-hidden py-12 px-4">

        {{-- Ambient Background Glow (Sama seperti Login) --}}
        <div class="absolute top-[-10%] left-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-yellow-500/10 blur-[120px] rounded-full pointer-events-none"></div>

        {{-- Wrapper Konten --}}
        <div class="w-full max-w-md relative z-10">
            
            {{-- Header Title --}}
            <div class="text-center mb-8 space-y-2">
                <a href="/" class="inline-block mb-4">
                    <span class="text-4xl font-bold text-yellow-400 tracking-tighter">H2F</span>
                </a>
                
                <h1 class="text-3xl font-bold text-white tracking-wide">
                    Buat Akun Baru
                </h1>
                <p class="text-gray-400 text-sm">
                    Bergabunglah untuk menikmati kemudahan transaksi.
                </p>
            </div>

            {{-- Register Card --}}
            <div class="bg-[#242430] rounded-2xl p-6 md:p-8 shadow-2xl border border-white/5 backdrop-blur-sm">
                
                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    {{-- Name Input --}}
                    <div class="space-y-2">
                        <label for="name" class="text-sm font-semibold text-gray-300">
                            Nama Lengkap
                        </label>
                        <div class="relative">
                            <input 
                                id="name" 
                                type="text" 
                                name="name" 
                                value="{{ old('name') }}" 
                                required 
                                autofocus
                                placeholder="Nama Kamu"
                                class="w-full bg-[#2f2f3d] text-gray-200 text-sm rounded-lg border border-transparent focus:border-yellow-400 focus:ring-1 focus:ring-yellow-400 focus:outline-none py-3 px-4 placeholder-gray-500 transition-all @error('name') border-red-500 ring-red-500 @enderror"
                            >
                            @error('name')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Email Input --}}
                    <div class="space-y-2">
                        <label for="email" class="text-sm font-semibold text-gray-300">
                            Alamat Email
                        </label>
                        <div class="relative">
                            <input 
                                id="email" 
                                type="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                required 
                                placeholder="nama@email.com"
                                class="w-full bg-[#2f2f3d] text-gray-200 text-sm rounded-lg border border-transparent focus:border-yellow-400 focus:ring-1 focus:ring-yellow-400 focus:outline-none py-3 px-4 placeholder-gray-500 transition-all @error('email') border-red-500 ring-red-500 @enderror"
                            >
                            @error('email')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Password Input --}}
                    <div class="space-y-2">
                        <label for="password" class="text-sm font-semibold text-gray-300">
                            Kata Sandi
                        </label>
                        <div class="relative">
                            <input 
                                id="password" 
                                type="password" 
                                name="password" 
                                required 
                                placeholder="Minimal 8 karakter"
                                class="w-full bg-[#2f2f3d] text-gray-200 text-sm rounded-lg border border-transparent focus:border-yellow-400 focus:ring-1 focus:ring-yellow-400 focus:outline-none py-3 px-4 placeholder-gray-500 transition-all @error('password') border-red-500 ring-red-500 @enderror"
                            >
                            @error('password')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Confirm Password Input --}}
                    <div class="space-y-2">
                        <label for="password_confirmation" class="text-sm font-semibold text-gray-300">
                            Konfirmasi Kata Sandi
                        </label>
                        <div class="relative">
                            <input 
                                id="password_confirmation" 
                                type="password" 
                                name="password_confirmation" 
                                required 
                                placeholder="Ulangi kata sandi"
                                class="w-full bg-[#2f2f3d] text-gray-200 text-sm rounded-lg border border-transparent focus:border-yellow-400 focus:ring-1 focus:ring-yellow-400 focus:outline-none py-3 px-4 placeholder-gray-500 transition-all"
                            >
                        </div>
                    </div>

                    {{-- Terms & Conditions (Opsional tapi bagus untuk UI) --}}
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="terms" name="terms" type="checkbox" class="w-4 h-4 text-yellow-400 bg-[#2f2f3d] border-gray-600 rounded focus:ring-yellow-400 focus:ring-2 focus:ring-offset-0" required>
                        </div>
                        <label for="terms" class="ml-2 text-xs text-gray-400">
                            Saya menyetujui <a href="#" class="text-yellow-400 hover:underline">Syarat & Ketentuan</a> serta <a href="#" class="text-yellow-400 hover:underline">Kebijakan Privasi</a>.
                        </label>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-300 text-black font-bold py-3 px-4 rounded-lg transition-colors shadow-[0_0_15px_rgba(250,204,21,0.4)] flex justify-center items-center gap-2 mt-2">
                        <span>Daftar Sekarang</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </button>
                </form>

                {{-- Footer / Login Link --}}
                <div class="mt-8 text-center text-sm text-gray-400 border-t border-white/5 pt-6">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-yellow-400 hover:text-yellow-300 font-semibold transition-colors ml-1">
                        Masuk Disini
                    </a>
                </div>
            </div>

            {{-- Tombol Kembali --}}
            <div class="mt-6 text-center">
                <a href="/" class="text-sm text-gray-500 hover:text-white transition-colors flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>

        </div>
    </div>

</body>
</html>