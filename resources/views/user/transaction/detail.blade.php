@extends('layouts.public')

@section('content')
    <div class="min-h-screen bg-[#18181b] py-12 font-sans text-gray-200 flex items-center justify-center px-4">

        {{-- Ambient Background --}}
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
            <div
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-blue-500/10 blur-[120px] rounded-full">
            </div>
        </div>

        <div class="max-w-md w-full bg-[#27272a] rounded-3xl p-8 border border-gray-700/50 shadow-2xl relative z-10">

            {{-- Decoration Line --}}
            <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-yellow-400 to-yellow-600"></div>

            {{-- Success Icon --}}
            <div
                class="mx-auto w-16 h-16 bg-green-500/20 rounded-full flex items-center justify-center mb-6 animate-bounce">
                <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-white mb-1">Pesanan Dibuat!</h2>
                <p class="text-gray-400 text-sm">Mohon selesaikan pembayaran Anda.</p>
            </div>

            {{-- Invoice Details Box --}}
            <div class="space-y-4 bg-[#18181b] p-6 rounded-2xl border border-gray-700/50 mb-6 relative overflow-hidden">
                {{-- Watermark --}}
                <div class="absolute -right-4 -bottom-4 text-white/5 font-black text-6xl select-none pointer-events-none">
                    F2H
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-gray-400 text-xs uppercase tracking-wider">No. Invoice</span>
                    <span
                        class="font-mono font-bold text-yellow-400 tracking-wide select-all">{{ $transaction->payment_token }}</span>
                </div>

                <div class="border-b border-gray-700/50 my-2"></div>

                <div class="space-y-2">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-400">Item</span>
                        <span
                            class="font-medium text-white text-right truncate w-40">{{ $transaction->product->name }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-400">Game</span>
                        <span class="font-medium text-white">{{ $transaction->product->game->name }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-400">Akun Tujuan</span>
                        <span class="font-medium text-white">{{ $transaction->target_account }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-400">Metode</span>
                        <span class="font-medium text-white">{{ $transaction->payment_method }}</span>
                    </div>
                </div>

                <div class="border-b border-gray-700/50 my-2"></div>

                <div class="flex justify-between items-center">
                    <span class="text-gray-400 text-sm">Total Bayar</span>
                    <span class="text-xl font-bold text-white">Rp
                        {{ number_format($transaction->total_price, 0, ',', '.') }}</span>
                </div>
            </div>

            {{-- Status Badge --}}
            <div class="flex justify-center mb-8">
                <span
                    class="px-4 py-1.5 rounded-full bg-yellow-500/10 text-yellow-400 text-xs font-bold border border-yellow-500/20 uppercase tracking-widest">
                    Status: {{ $transaction->status }}
                </span>
            </div>

            {{-- Action Buttons --}}
            <div class="space-y-3">

                {{-- GANTI NOMOR WA ADMIN DI BAWAH INI (Cari '628...') --}}
                <a href="https://wa.me/6282189131704?text=Halo%20Admin,%20saya%20ingin%20konfirmasi%20pembayaran%20untuk%20Invoice%20{{ $transaction->payment_token }}%20sebesar%20Rp%20{{ number_format($transaction->total_price, 0, ',', '.') }}"
                    target="_blank"
                    class="flex items-center justify-center w-full bg-green-600 hover:bg-green-500 text-white font-bold py-3.5 rounded-xl transition shadow-lg shadow-green-600/20 group">
                    <svg class="w-5 h-5 mr-2 group-hover:animate-pulse" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                    </svg>
                    Konfirmasi Pembayaran
                </a>

                <a href="{{ url('/') }}"
                    class="block w-full bg-[#323238] hover:bg-[#3f3f46] text-gray-300 text-center font-semibold py-3.5 rounded-xl transition border border-white/5">
                    Kembali ke Beranda
                </a>
            </div>

        </div>
    </div>
@endsection