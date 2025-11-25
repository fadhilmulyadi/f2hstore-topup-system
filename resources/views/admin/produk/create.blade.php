@extends('layouts.admin')

@section('header', 'Tambah Produk Baru')

@section('content')
<div class="max-w-3xl mx-auto">
    {{-- Tombol Kembali --}}
    <a href="{{ route('admin.produk.index') }}" class="flex items-center text-gray-500 hover:text-indigo-600 mb-6 transition-colors w-fit">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Daftar Produk
    </a>

    <div class="bg-white rounded-2xl shadow-lg shadow-gray-100/50 p-8 border border-gray-100">
        <h3 class="text-xl font-bold text-gray-800 mb-6">Informasi Produk (Top Up Item)</h3>
        
        {{-- Form Store --}}
        <form action="{{ route('admin.produk.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 gap-6">
                
                {{-- Field 1: Pilih Game (Relasi game_id) --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Game / Kategori</label>
                    <div class="relative">
                        <select name="game_id" required
                                class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition-all outline-none appearance-none">
                            <option value="" disabled selected>-- Pilih Game --</option>
                            @foreach($games as $game)
                                <option value="{{ $game->id }}">{{ $game->name }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    @error('game_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Field 2: Nama Produk --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Produk</label>
                    <input type="text" name="name" required
                           class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition-all outline-none" 
                           placeholder="Contoh: 100 Diamonds">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Grid Split untuk SKU dan Price agar rapi --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Field 3: SKU --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">SKU (Kode Unik)</label>
                        <input type="text" name="sku" required
                               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition-all outline-none font-mono uppercase" 
                               placeholder="MLBB-100-DM">
                        <p class="text-xs text-gray-400 mt-1">Kode unik untuk identifikasi item.</p>
                        @error('sku') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Field 4: Price --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Harga (IDR)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500 font-medium">Rp</span>
                            <input type="number" name="price" required
                                   class="w-full pl-12 pr-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition-all outline-none" 
                                   placeholder="15000">
                        </div>
                        @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Field 5: Deskripsi --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi (Opsional)</label>
                    <textarea name="description" rows="3"
                              class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition-all outline-none resize-none"
                              placeholder="Keterangan tambahan produk..."></textarea>
                    @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

            </div>

            {{-- Tombol Submit --}}
            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-indigo-200 transition-all transform hover:-translate-y-0.5">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection