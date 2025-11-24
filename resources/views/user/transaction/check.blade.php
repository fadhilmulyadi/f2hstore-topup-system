@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-[#181820] text-white font-sans relative overflow-hidden">

    {{-- Ambient Background Glow --}}
    <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-yellow-500/10 blur-[120px] rounded-full pointer-events-none"></div>

    <div class="container mx-auto px-4 py-12 relative z-10">

        {{-- PESAN ERROR / SUKSES --}}
        @if(session('error'))
            <div class="bg-red-500/10 border border-red-500 text-red-500 px-4 py-3 rounded-lg mb-6 text-center font-bold max-w-2xl mx-auto">
                {{ session('error') }}
            </div>
        @endif

        {{-- SECTION 1: HERO & SEARCH --}}
        <div class="flex flex-col items-center justify-center min-h-[40vh] text-center space-y-8">
            
            <div class="space-y-2">
                <h1 class="text-3xl md:text-4xl font-bold text-white tracking-wide">
                    Cek Invoice Kamu
                </h1>
                <p class="text-gray-400 text-sm md:text-base">
                    Masukkan nomor invoice (Contoh: INV-XXXXXXXX) untuk melihat status pesanan.
                </p>
            </div>

            {{-- Search Card --}}
            <div class="w-full max-w-2xl bg-[#242430] rounded-2xl p-6 md:p-8 shadow-2xl border border-white/5">
                {{-- Form Action diarahkan ke route check --}}
                <form action="{{ route('transaction.check') }}" method="GET" class="space-y-4 text-left">
                    <div class="space-y-2">
                        <div class="relative">
                            <input 
                                type="text" 
                                name="invoice" 
                                required
                                placeholder="Masukkan Nomor Invoice (Contoh: INV-MJS5JI5XFN)" 
                                class="w-full bg-[#2f2f3d] text-gray-200 text-sm rounded-lg border border-transparent focus:border-yellow-400 focus:ring-1 focus:ring-yellow-400 focus:outline-none py-3 px-4 placeholder-gray-500 transition-all"
                            >
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-300 text-black font-bold py-3 px-4 rounded-lg flex items-center justify-center gap-2 transition-colors shadow-[0_0_15px_rgba(250,204,21,0.4)]">
                        Cari Invoice
                    </button>
                </form>
            </div>
        </div>

        {{-- SECTION 2: RIWAYAT TRANSAKSI (HANYA MUNCUL JIKA LOGIN) --}}
        {{-- Logika @auth ini yang diminta Agil --}}
        @auth
            <div class="mt-20 space-y-6">
                <div class="text-center space-y-1">
                    <h2 class="text-xl md:text-2xl font-bold text-white">Riwayat Transaksi Anda</h2>
                    <p class="text-gray-400 text-sm">Daftar pembelian terakhir yang Anda lakukan.</p>
                </div>

                <div class="overflow-x-auto rounded-xl border border-white/5 shadow-2xl bg-[#242430]/80 backdrop-blur-sm">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-[#2f2f3d] text-white font-semibold uppercase text-xs tracking-wider border-b border-white/5">
                            <tr>
                                <th class="px-6 py-4">Waktu</th>
                                <th class="px-6 py-4">Nomor Invoice</th>
                                <th class="px-6 py-4">Game</th>
                                <th class="px-6 py-4">Nominal</th>
                                <th class="px-6 py-4 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5 text-gray-300">
                            {{-- Looping Data Asli dari Controller --}}
                            @forelse($myTransactions as $trx)
                                <tr class="hover:bg-[#2f2f3d]/50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-400">
                                        {{ $trx->created_at->format('d M Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 font-mono text-yellow-400">
                                        {{ $trx->payment_token }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $trx->product->game->name ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 font-mono">
                                        Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if($trx->status == 'success')
                                            <span class="bg-green-500/20 text-green-400 text-[10px] font-bold px-2.5 py-1 rounded">SUKSES</span>
                                        @elseif($trx->status == 'pending')
                                            <span class="bg-yellow-500/20 text-yellow-400 text-[10px] font-bold px-2.5 py-1 rounded">PENDING</span>
                                        @else
                                            <span class="bg-red-500/20 text-red-400 text-[10px] font-bold px-2.5 py-1 rounded">{{ strtoupper($trx->status) }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-8 text-gray-500">
                                        Anda belum memiliki riwayat transaksi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endauth
        {{-- Jika Tamu (Guest), bagian di atas ini otomatis HILANG --}}

    </div>
    
    {{-- Bottom Decoration --}}
    <div class="mt-20 w-full h-24 bg-gradient-to-t from-yellow-500/5 to-transparent pointer-events-none"></div>

</div>
@endsection