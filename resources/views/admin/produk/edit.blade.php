@extends('layouts.admin')

@section('header', 'Edit Produk')

@section('content')
<div class="max-w-3xl mx-auto">
    <a href="{{ route('admin.produk.index') }}" class="flex items-center text-gray-500 hover:text-indigo-600 mb-6 transition-colors w-fit">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Daftar Produk
    </a>

    <div class="bg-white rounded-2xl shadow-lg shadow-gray-100/50 p-8 border border-gray-100">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-gray-800">Edit Informasi Produk</h3>
            <span class="bg-indigo-50 text-indigo-700 px-3 py-1 rounded-full text-xs font-mono font-semibold">
                {{ $produk->sku }}
            </span>
        </div>
        
        <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Game</label>
                <div class="relative">
                    <select name="game_id" required
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition-all appearance-none outline-none cursor-pointer">
                        <option value="" disabled>-- Pilih Game --</option>
                        @foreach($games as $game)
                            <option value="{{ $game->id }}" {{ old('game_id', $produk->game_id) == $game->id ? 'selected' : '' }}>
                                {{ $game->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
                @error('game_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Item / Produk</label>
                    <input type="text" name="name" required
                           value="{{ old('name', $produk->name) }}"
                           class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition-all outline-none" 
                           placeholder="Contoh: 100 Diamonds">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">SKU (Kode Unik)</label>
                    <input type="text" name="sku" required
                           value="{{ old('sku', $produk->sku) }}"
                           class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition-all outline-none" 
                           placeholder="ML-100-DM">
                    <p class="text-xs text-gray-400 mt-1">Pastikan SKU tetap unik jika diubah.</p>
                    @error('sku') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Harga (Rupiah)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 font-medium">Rp</span>
                        <input type="number" name="price" required min="0"
                               value="{{ old('price', $produk->price) }}"
                               class="w-full pl-12 pr-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition-all outline-none" 
                               placeholder="25000">
                    </div>
                    @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="pt-6 border-t border-gray-100 flex justify-end gap-4">
                <a href="{{ route('admin.produk.index') }}" class="px-6 py-3 rounded-xl text-gray-600 bg-gray-100 hover:bg-gray-200 font-medium transition-colors">
                    Batal
                </a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-indigo-200 transition-all transform hover:-translate-y-0.5">
                    Update Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection