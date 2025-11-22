<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Reset Password - {{ config('app.name', 'H2F Topup') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-[#181820] text-white">

    <div class="min-h-screen w-full flex items-center justify-center relative overflow-hidden py-12 px-4">

        {{-- Ambient Background Glow --}}
        <div class="absolute top-[-10%] left-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-yellow-500/10 blur-[120px] rounded-full pointer-events-none"></div>

        <div class="w-full max-w-md relative z-10">
            
            {{-- Header --}}
            <div class="text-center mb-8 space-y-2">
                <a href="/" class="inline-block mb-4">
                    <span class="text-4xl font-bold text-yellow-400 tracking-tighter">H2F</span>
                </a>
                <h1 class="text-3xl font-bold text-white tracking-wide">
                    Buat Password Baru
                </h1>
                <p class="text-gray-400 text-sm">
                    Pastikan password baru Anda aman dan mudah diingat.
                </p>
            </div>

            {{-- Card --}}
            <div class="bg-[#242430] rounded-2xl p-6 md:p-8 shadow-2xl border border-white/5 backdrop-blur-sm">
                
                <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    {{-- Email Input (Biasanya readonly/otomatis terisi) --}}
                    <div class="space-y-2">
                        <label for="email" class="text-sm font-semibold text-gray-300">
                            Alamat Email
                        </label>
                        <div class="relative">
                            <input 
                                id="email" 
                                type="email" 
                                name="email" 
                                value="{{ old('email', $request->email) }}" 
                                required 
                                autofocus
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
                            Kata Sandi Baru
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
                                placeholder="Ulangi kata sandi baru"
                                class="w-full bg-[#2f2f3d] text-gray-200 text-sm rounded-lg border border-transparent focus:border-yellow-400 focus:ring-1 focus:ring-yellow-400 focus:outline-none py-3 px-4 placeholder-gray-500 transition-all"
                            >
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-300 text-black font-bold py-3 px-4 rounded-lg transition-colors shadow-[0_0_15px_rgba(250,204,21,0.4)] flex justify-center items-center gap-2">
                        <span>Ubah Password</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>