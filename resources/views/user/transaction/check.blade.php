@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-[#181820] text-white font-sans relative overflow-hidden">

    {{-- Ambient Background Glow (Efek cahaya kuning di kiri atas seperti screenshot) --}}
    <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-yellow-500/10 blur-[120px] rounded-full pointer-events-none"></div>

    <div class="container mx-auto px-4 py-12 relative z-10">

        {{-- SECTION 1: HERO & SEARCH --}}
        <div class="flex flex-col items-center justify-center min-h-[50vh] text-center space-y-8">
            
            {{-- Title & Subtitle --}}
            <div class="space-y-2">
                <h1 class="text-3xl md:text-4xl font-bold text-white tracking-wide">
                    Cek Invoice Kamu dengan Mudah dan Cepat
                </h1>
                <p class="text-gray-400 text-sm md:text-base">
                    Lihat detail pembelian kamu menggunakan nomor Invoice.
                </p>
            </div>

            {{-- Search Card --}}
            <div class="w-full max-w-2xl bg-[#242430] rounded-2xl p-6 md:p-8 shadow-2xl border border-white/5">
                <form action="#" method="GET" class="space-y-4 text-left">
                    <div class="space-y-2">
                        <label for="invoice" class="text-sm font-semibold text-gray-300">
                            Cari detail pembelian kamu disini
                        </label>
                        <div class="relative">
                            {{-- Input Field --}}
                            <input 
                                type="text" 
                                id="invoice" 
                                name="invoice"
                                placeholder="Masukkan nomor Invoice Kamu (Contoh: TPXXXXXXXXXXXXXXX)" 
                                class="w-full bg-[#2f2f3d] text-gray-200 text-sm rounded-lg border border-transparent focus:border-yellow-400 focus:ring-1 focus:ring-yellow-400 focus:outline-none py-3 px-4 placeholder-gray-500 transition-all"
                            >
                            {{-- Icon kecil di kanan input (opsional visual) --}}
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Button Search --}}
                    <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-300 text-black font-bold py-3 px-4 rounded-lg flex items-center justify-center gap-2 transition-colors shadow-[0_0_15px_rgba(250,204,21,0.4)]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Cari Invoice
                    </button>
                </form>
            </div>
        </div>

        {{-- SECTION 2: REAL-TIME TRANSACTIONS --}}
        <div class="mt-20 space-y-6">
            <div class="text-center space-y-1">
                <h2 class="text-xl md:text-2xl font-bold text-white">Transaksi Real-Time</h2>
                <p class="text-gray-400 text-sm">Berikut ini Real-Time data pesanan masuk terbaru TAKAPEDIA.</p>
            </div>

            {{-- Table Wrapper --}}
            <div class="overflow-x-auto rounded-xl border border-white/5 shadow-2xl bg-[#242430]/80 backdrop-blur-sm">
                <table class="w-full text-sm text-left">
                    <thead class="bg-[#2f2f3d] text-white font-semibold uppercase text-xs tracking-wider border-b border-white/5">
                        <tr>
                            <th scope="col" class="px-6 py-4">Tanggal</th>
                            <th scope="col" class="px-6 py-4">Nomor Invoice</th>
                            <th scope="col" class="px-6 py-4">No. Handphone</th>
                            <th scope="col" class="px-6 py-4">Harga</th>
                            <th scope="col" class="px-6 py-4 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 text-gray-300">
                        {{-- Dummy Row 1 --}}
                        <tr class="hover:bg-[#2f2f3d]/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">19-11-2025 19:08:53</td>
                            <td class="px-6 py-4 font-mono">TPxxxxxxxxxxxxx443</td>
                            <td class="px-6 py-4 font-mono">**********765</td>
                            <td class="px-6 py-4 font-mono">IDR 18xxxx</td>
                            <td class="px-6 py-4 text-center">
                                <span class="bg-yellow-400 text-black text-[10px] font-bold px-2.5 py-1 rounded leading-none">
                                    PENDING
                                </span>
                            </td>
                        </tr>

                        {{-- Dummy Row 2 (Active look/Slightly different bg if needed, here uniform) --}}
                        <tr class="hover:bg-[#2f2f3d]/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">19-11-2025 19:08:43</td>
                            <td class="px-6 py-4 font-mono">TPxxxxxxxxxxxxx080</td>
                            <td class="px-6 py-4 font-mono">**********916</td>
                            <td class="px-6 py-4 font-mono">IDR 30xxxx</td>
                            <td class="px-6 py-4 text-center">
                                <span class="bg-yellow-400 text-black text-[10px] font-bold px-2.5 py-1 rounded leading-none">
                                    PENDING
                                </span>
                            </td>
                        </tr>

                        {{-- Dummy Row 3 --}}
                        <tr class="hover:bg-[#2f2f3d]/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">19-11-2025 19:08:35</td>
                            <td class="px-6 py-4 font-mono">TPxxxxxxxxxxxxx515</td>
                            <td class="px-6 py-4 font-mono">**********638</td>
                            <td class="px-6 py-4 font-mono">IDR 53xxxx</td>
                            <td class="px-6 py-4 text-center">
                                <span class="bg-yellow-400 text-black text-[10px] font-bold px-2.5 py-1 rounded leading-none">
                                    PENDING
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    
    {{-- Bottom Decoration (Placeholder untuk elemen grafis kuning/hitam di bawah) --}}
    <div class="mt-20 w-full h-24 bg-gradient-to-t from-yellow-500/5 to-transparent pointer-events-none"></div>

</div>
@endsection