@extends('layouts.admin')

@section('header', 'Kelola Produk')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Daftar Item Produk</h2>
            <p class="text-sm text-gray-500 mt-1">Atur harga dan SKU produk disini.</p>
        </div>
        <a href="{{ route('admin.produk.create') }}" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl shadow-lg shadow-indigo-200 transition-all flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Produk
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-lg shadow-gray-100/50 border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Game</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Produk</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">SKU</th> <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($produks as $produk)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-700">
                            {{ $produk->game->name ?? 'Game Terhapus' }}
                        </td>
                        
                        <td class="px-6 py-4 text-gray-600">
                            {{ $produk->name }}
                        </td>

                        <td class="px-6 py-4">
                            <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs font-mono font-semibold border border-gray-200">
                                {{ $produk->sku }}
                            </span>
                        </td>

                        <td class="px-6 py-4 font-semibold text-indigo-600">
                            Rp {{ number_format($produk->price, 0, ',', '.') }}
                        </td>

                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.produk.edit', $produk->id) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Edit</a>
                            
                            <form action="{{ route('admin.produk.destroy', $produk->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus produk ini?')">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $produks->links() }}
        </div>
    </div>
</div>
@endsection