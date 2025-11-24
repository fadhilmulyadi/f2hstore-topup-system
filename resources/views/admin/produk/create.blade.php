@extends('layouts.admin')

@section('header', 'Tambah Game Baru')

@section('content')
<div class="max-w-3xl mx-auto">
    <a href="{{ route('admin.game.index') }}" class="flex items-center text-gray-500 hover:text-indigo-600 mb-6 transition-colors w-fit">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Daftar Game
    </a>

    <div class="bg-white rounded-2xl shadow-lg shadow-gray-100/50 p-8 border border-gray-100">
        <h3 class="text-xl font-bold text-gray-800 mb-6">Informasi Game</h3>
        
        <form action="{{ route('admin.game.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Game</label>
                    <input type="text" name="name" id="name" required
                           class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition-all outline-none" 
                           placeholder="Contoh: Mobile Legends">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Slug / Kode URL</label>
                    <input type="text" name="slug" required
                           class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition-all outline-none" 
                           placeholder="mobile-legends">
                    <p class="text-xs text-gray-400 mt-1">Gunakan huruf kecil dan tanda hubung (-). Jangan pakai spasi.</p>
                    @error('slug') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Thumbnail / Logo Game</label>
                    <div class="flex items-center justify-center w-full">
                        <label class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors group">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-10 h-10 mb-3 text-gray-400 group-hover:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> gambar</p>
                                <p class="text-xs text-gray-400">PNG, JPG (Max. 2MB)</p>
                            </div>
                            <input type="file" name="thumbnail" class="hidden" required />
                        </label>
                    </div>
                    @error('thumbnail') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-indigo-200 transition-all transform hover:-translate-y-0.5">
                    Simpan Game
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const nameInput = document.querySelector('input[name="name"]');
    const slugInput = document.querySelector('input[name="slug"]');

    nameInput.addEventListener('keyup', function() {
        let preslug = nameInput.value;
        preslug = preslug.replace(/ /g,"-");
        slugInput.value = preslug.toLowerCase();
    });
</script>
@endsection