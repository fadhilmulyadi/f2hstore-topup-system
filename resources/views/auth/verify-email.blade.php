<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Verifikasi Email - {{ config('app.name', 'H2F Topup') }}</title>

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
                    Verifikasi Email Kamu
                </h1>
                <div class="text-gray-400 text-sm leading-relaxed px-2">
                    Terima kasih telah mendaftar! Sebelum memulai, bisakah kamu memverifikasi alamat emailmu dengan mengklik link yang baru saja kami kirimkan?
                </div>
            </div>

            {{-- Card --}}
            <div class="bg-[#242430] rounded-2xl p-6 md:p-8 shadow-2xl border border-white/5 backdrop-blur-sm">
                
                {{-- Status Message --}}
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-6 text-sm font-medium text-green-400 bg-green-400/10 p-4 rounded-lg border border-green-400/20 text-center">
                        Link verifikasi baru telah dikirim ke alamat email yang kamu gunakan saat pendaftaran.
                    </div>
                @endif

                <div class="space-y-4">
                    {{-- Resend Button Form --}}
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-300 text-black font-bold py-3 px-4 rounded-lg transition-colors shadow-[0_0_15px_rgba(250,204,21,0.4)] flex justify-center items-center gap-2">
                            <span>Kirim Ulang Email Verifikasi</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </button>
                    </form>

                    {{-- Logout Form --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full bg-[#2f2f3d] hover:bg-[#3a3a4b] text-gray-300 font-semibold py-3 px-4 rounded-lg transition-colors border border-white/5 flex justify-center items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Keluar
                        </button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</body>
</html>