<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login - {{ config('app.name', 'H2F Topup') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts (Memuat CSS/JS Tailwind) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-[#181820] text-white">

    {{-- Container Utama (Full Screen) --}}
    <div class="min-h-screen w-full flex items-center justify-center relative overflow-hidden py-12 px-4">

        {{-- Ambient Background Glow (Efek Cahaya) --}}
        <div class="absolute top-[-10%] left-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-yellow-500/10 blur-[120px] rounded-full pointer-events-none"></div>

        {{-- Wrapper Konten Login --}}
        <div class="w-full max-w-md relative z-10">
            
            {{-- Logo atau Judul Header --}}
            <div class="text-center mb-8 space-y-2">
                {{-- Opsional: Jika ingin menampilkan Logo H2F --}}
                <a href="/" class="inline-block mb-4">
                    <span class="text-4xl font-bold text-yellow-400 tracking-tighter">H2F</span>
                </a>
                
                <h1 class="text-3xl font-bold text-white tracking-wide">
                    Selamat Datang Kembali
                </h1>
                <p class="text-gray-400 text-sm">
                    Masuk ke akun kamu untuk mengelola transaksi.
                </p>
            </div>

            {{-- Login Card --}}
            <div class="bg-[#242430] rounded-2xl p-6 md:p-8 shadow-2xl border border-white/5 backdrop-blur-sm">
                
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

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
                                autofocus
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
                        <div class="flex justify-between items-center">
                            <label for="password" class="text-sm font-semibold text-gray-300">
                                Kata Sandi
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs text-yellow-400 hover:text-yellow-300 transition-colors">
                                    Lupa Password?
                                </a>
                            @endif
                        </div>
                        <div class="relative">
                            <input 
                                id="password" 
                                type="password" 
                                name="password" 
                                required 
                                placeholder="••••••••"
                                class="w-full bg-[#2f2f3d] text-gray-200 text-sm rounded-lg border border-transparent focus:border-yellow-400 focus:ring-1 focus:ring-yellow-400 focus:outline-none py-3 px-4 placeholder-gray-500 transition-all @error('password') border-red-500 ring-red-500 @enderror"
                            >
                        </div>
                    </div>

                    {{-- Remember Me --}}
                    <div class="flex items-center">
                        <input 
                            id="remember_me" 
                            type="checkbox" 
                            name="remember" 
                            class="w-4 h-4 text-yellow-400 bg-[#2f2f3d] border-gray-600 rounded focus:ring-yellow-400 focus:ring-2 focus:ring-offset-0"
                        >
                        <label for="remember_me" class="ml-2 text-sm text-gray-400">
                            Ingat saya
                        </label>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-300 text-black font-bold py-3 px-4 rounded-lg transition-colors shadow-[0_0_15px_rgba(250,204,21,0.4)] flex justify-center items-center gap-2">
                        <span>Masuk Sekarang</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </form>

                {{-- Footer / Register Link --}}
                <div class="mt-8 text-center text-sm text-gray-400 border-t border-white/5 pt-6">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-yellow-400 hover:text-yellow-300 font-semibold transition-colors ml-1">
                        Daftar Disini
                    </a>
                </div>
            </div>
            
            {{-- Tombol Kembali ke Home (Opsional) --}}
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