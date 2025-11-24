@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-[#18181b] py-8 font-sans text-gray-200 relative overflow-hidden">
    
    {{-- Ambient Background Glow --}}
    <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-yellow-500/10 blur-[120px] rounded-full pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            {{-- KOLOM KIRI: GAMBAR GAME --}}
            <div class="lg:col-span-4 xl:col-span-3">
                {{-- Menggunakan komponen game-card atau manual --}}
                <div class="bg-[#27272a] rounded-3xl p-4 border border-gray-700/50 shadow-xl sticky top-24">
                    <img src="{{ asset('storage/' . $game->thumbnail) }}" alt="{{ $game->name }}" 
                         class="w-full aspect-[3/4] object-cover rounded-2xl mb-4 shadow-lg">
                    <h2 class="text-2xl font-bold text-white text-center mb-1">{{ $game->name }}</h2>
                    <p class="text-center text-yellow-400 text-sm font-medium">Official Partner</p>
                </div>
            </div>

            {{-- KOLOM KANAN: FORM TRANSAKSI --}}
            <div class="lg:col-span-8 xl:col-span-9">
                
                {{-- FORM PEMBUKA --}}
                <form action="{{ route('transaction.store') }}" method="POST">
                    @csrf
                    {{-- PAYMENT METHOD HARDCODE (Sementara) --}}
                    <input type="hidden" name="payment_method" value="BCA">

                    <div class="space-y-6">

                        {{-- 1. MASUKKAN DATA AKUN --}}
                        <div class="bg-[#27272a] shadow-xl rounded-3xl p-6 md:p-8 border border-gray-700/50 relative overflow-hidden">
                            <div class="absolute top-0 left-0 w-1 h-full bg-yellow-500"></div>
                            <div class="flex items-center gap-4 mb-6">
                                <div class="w-10 h-10 rounded-xl bg-yellow-400 text-black flex items-center justify-center font-bold text-lg shadow-lg transform -rotate-3">1</div>
                                <h3 class="text-xl font-bold text-white tracking-wide">Masukkan Data Akun</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label class="text-sm font-medium text-gray-400 ml-1">User ID / No. HP</label>
                                    {{-- Name wajib 'target_account' sesuai Controller --}}
                                    <input type="text" name="target_account" required placeholder="Masukkan User ID" 
                                        class="w-full bg-[#18181b] text-white border border-gray-700 rounded-xl px-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition">
                                </div>
                                
                                {{-- Server ID (Opsional visual saja, bisa digabung JS nanti) --}}
                                <div class="space-y-2">
                                    <label class="text-sm font-medium text-gray-400 ml-1">Server ID (Opsional)</label>
                                    <input type="text" placeholder="Contoh: 1234" 
                                        class="w-full bg-[#18181b] text-white border border-gray-700 rounded-xl px-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition">
                                </div>
                            </div>
                        </div>

                        {{-- 2. PILIH NOMINAL --}}
                        <div class="bg-[#27272a] shadow-xl rounded-3xl p-6 md:p-8 border border-gray-700/50 relative overflow-hidden">
                            <div class="absolute top-0 left-0 w-1 h-full bg-yellow-500"></div>
                            <div class="flex items-center gap-4 mb-6">
                                <div class="w-10 h-10 rounded-xl bg-yellow-400 text-black flex items-center justify-center font-bold text-lg shadow-lg transform -rotate-3">2</div>
                                <h3 class="text-xl font-bold text-white tracking-wide">Pilih Nominal</h3>
                            </div>

                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                @forelse($game->products as $product)
                                    <div class="relative group cursor-pointer">
                                        {{-- Name wajib 'product_id' dan Value wajib ID --}}
                                        <input type="radio" name="product_id" value="{{ $product->id }}" class="peer hidden" id="item_{{ $product->id }}" required>
                                        
                                        <label for="item_{{ $product->id }}" 
                                            class="flex flex-col justify-between h-full bg-[#32323e] rounded-xl border border-gray-600 p-4 hover:border-yellow-400 hover:bg-[#3a3a4a] transition-all cursor-pointer peer-checked:border-yellow-400 peer-checked:bg-[#3f3f4e] peer-checked:ring-1 peer-checked:ring-yellow-400">
                                            
                                            <div class="mb-3">
                                                <div class="text-sm font-medium text-gray-300 group-hover:text-white transition">
                                                    {{ $product->name }}
                                                </div>
                                            </div>

                                            <div class="flex justify-between items-end mt-2 pt-2 border-t border-gray-600/50">
                                                <div class="text-base font-bold text-yellow-400">
                                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                                </div>
                                                <div class="hidden peer-checked:block text-yellow-400">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                @empty
                                    <p class="text-gray-500 col-span-full text-center">Belum ada produk.</p>
                                @endforelse
                            </div>
                        </div>

                        {{-- 3. DETAIL KONTAK --}}
                        <div class="bg-[#27272a] shadow-xl rounded-3xl p-6 md:p-8 border border-gray-700/50 relative overflow-hidden">
                            <div class="absolute top-0 left-0 w-1 h-full bg-yellow-500"></div>
                            <div class="flex items-center gap-4 mb-6">
                                <div class="w-10 h-10 rounded-xl bg-yellow-400 text-black flex items-center justify-center font-bold text-lg shadow-lg transform -rotate-3">3</div>
                                <h3 class="text-xl font-bold text-white tracking-wide">Detail Kontak</h3>
                            </div>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-400 ml-1 mb-1 block">Nomor WhatsApp (Untuk Bukti Transaksi)</label>
                                    <div class="flex">
                                        <span class="inline-flex items-center px-4 rounded-l-xl border border-r-0 border-gray-700 bg-gray-800 text-gray-300 text-sm">🇮🇩 +62</span>
                                        {{-- Input ini optional di controller, tapi bagus untuk UX --}}
                                        <input type="number" placeholder="81234567890" 
                                            class="w-full bg-[#18181b] text-white border border-gray-700 rounded-r-xl px-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- TOMBOL BELI (Sticky Bottom) --}}
                        <div class="sticky bottom-4 z-20">
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white text-lg font-bold py-4 rounded-2xl shadow-xl shadow-blue-500/20 transition transform hover:-translate-y-1 flex items-center justify-center gap-2 border border-blue-400/30">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                Beli Sekarang
                            </button>
                        </div>

                    </div> {{-- End Space-y-6 --}}
                </form>
                {{-- END FORM --}}

            </div>
        </div>
    </div>
</div>
@endsection