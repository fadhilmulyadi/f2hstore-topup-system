@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-[#18181b] py-8 font-sans text-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <div class="lg:col-span-4 xl:col-span-3">
            <x-game-card 
                :name="$game->name" 
                :thumbnail="asset($game->thumbnail)" 
            />
            </div>

            <div class="lg:col-span-8 xl:col-span-9 space-y-6">

                <div class="bg-[#27272a] shadow-xl rounded-3xl p-6 md:p-8 border border-gray-700/50 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-full bg-yellow-500"></div>
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-yellow-400 text-black flex items-center justify-center font-bold text-lg shadow-lg shadow-yellow-400/20 transform -rotate-3">1</div>
                        <h3 class="text-xl font-bold text-white tracking-wide">Masukkan Data Akun</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-400 ml-1">User ID</label>
                            <input type="text" name="user_id" placeholder="Masukkan User ID" 
                                class="w-full bg-[#18181b] text-white border border-gray-700 rounded-xl px-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition">
                        </div>
                        
                        @if($game->requires_server_id)
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-400 ml-1">Server ID / Zone ID</label>
                            <input type="text" name="server_id" placeholder="Contoh: 1234" 
                                class="w-full bg-[#18181b] text-white border border-gray-700 rounded-xl px-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition">
                        </div>
                        @endif
                    </div>
                </div>

                <div class="bg-[#27272a] shadow-xl rounded-3xl p-6 md:p-8 border border-gray-700/50 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-full bg-yellow-500"></div>
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-yellow-400 text-black flex items-center justify-center font-bold text-lg shadow-lg shadow-yellow-400/20 transform -rotate-3">2</div>
                        <h3 class="text-xl font-bold text-white tracking-wide">Pilih Nominal</h3>
                    </div>

                    <h4 class="font-bold text-gray-200 mb-4 flex items-center gap-2">
                        <span>📦</span> Paket Top Up
                    </h4>
                    
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        @forelse($game->products as $product)
                            <div class="relative group cursor-pointer">
                                <input type="radio" name="product_code" value="{{ $product->code }}" class="peer hidden" id="item_{{ $product->id }}">
                                
                                <label for="item_{{ $product->id }}" 
                                    class="flex flex-col justify-between h-full bg-[#32323e] rounded-xl border border-gray-600 p-4 hover:border-yellow-400 hover:bg-[#3a3a4a] hover:shadow-lg hover:shadow-yellow-500/10 transition-all cursor-pointer peer-checked:border-yellow-400 peer-checked:bg-[#3f3f4e] peer-checked:ring-1 peer-checked:ring-yellow-400">
                                    
                                    <div class="mb-3">
                                        <div class="text-sm font-medium text-gray-300 group-hover:text-white transition">
                                            {{ $product->name }}
                                        </div>
                                        <div class="text-xs text-blue-400 mt-1 flex items-center gap-1">
                                            <svg class="w-3 h-3" viewBox="0 0 24 24" fill="currentColor"><path d="M12,2L2,12L12,22L22,12L12,2Z" /></svg>
                                            {{ $game->currency_name ?? 'Diamonds' }}
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
                            <div class="col-span-full text-center text-gray-500 py-4">
                                Belum ada produk tersedia untuk game ini.
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="bg-[#27272a] shadow-xl rounded-3xl p-6 md:p-8 border border-gray-700/50 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-full bg-yellow-500"></div>
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-yellow-400 text-black flex items-center justify-center font-bold text-lg shadow-lg shadow-yellow-400/20 transform -rotate-3">3</div>
                        <h3 class="text-xl font-bold text-white tracking-wide">Detail Pesanan</h3>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between bg-[#18181b] p-4 rounded-xl border border-gray-700">
                            <span class="font-medium text-gray-300">Jumlah Pembelian</span>
                            <div class="flex items-center gap-3">
                                <button type="button" class="w-8 h-8 rounded-lg bg-gray-700 hover:bg-gray-600 text-white font-bold transition flex items-center justify-center">-</button>
                                <input type="text" name="quantity" value="1" class="w-12 text-center bg-transparent font-bold text-white focus:outline-none" readonly>
                                <button type="button" class="w-8 h-8 rounded-lg bg-yellow-400 hover:bg-yellow-300 text-black font-bold shadow-md transition flex items-center justify-center">+</button>
                            </div>
                        </div>

                        <div class="relative">
                            <label class="text-sm font-medium text-gray-400 ml-1 mb-1 block">Kode Promo</label>
                            <div class="flex gap-2">
                                <input type="text" name="promo_code" placeholder="Punya kode promo?" 
                                    class="flex-1 bg-[#18181b] text-white border border-gray-700 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-yellow-500/50 transition">
                                <button type="button" class="bg-yellow-400 hover:bg-yellow-300 text-black px-6 py-3 rounded-xl font-bold transition shadow-lg shadow-yellow-400/20">
                                    Gunakan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- @include('components.payment-methods')  --}}
                <div class="bg-[#27272a] shadow-xl rounded-3xl p-6 md:p-8 border border-gray-700/50 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-full bg-yellow-500"></div>
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-yellow-400 text-black flex items-center justify-center font-bold text-lg shadow-lg shadow-yellow-400/20 transform -rotate-3">5</div>
                        <h3 class="text-xl font-bold text-white tracking-wide">Detail Kontak</h3>
                    </div>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium text-gray-400 ml-1 mb-1 block">Nomor WhatsApp</label>
                            <div class="flex">
                                <span class="inline-flex items-center px-4 rounded-l-xl border border-r-0 border-gray-700 bg-gray-800 text-gray-300 text-sm">🇮🇩 +62</span>
                                <input type="number" name="whatsapp_number" placeholder="81234567890" 
                                    class="w-full bg-[#18181b] text-white border border-gray-700 rounded-r-xl px-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sticky bottom-4 z-20">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white text-lg font-bold py-4 rounded-2xl shadow-xl shadow-blue-500/20 transition transform hover:-translate-y-1 flex items-center justify-center gap-2 border border-blue-400/30">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Beli Sekarang
                    </button>
                </div>

            </div> </div>
    </div>
</div>
@endsection