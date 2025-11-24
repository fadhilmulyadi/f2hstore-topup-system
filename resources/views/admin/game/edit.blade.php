@extends('layouts.admin')

@section('header', 'Edit Game')

@section('content')
<div class="max-w-3xl mx-auto">
    <a href="{{ route('admin.game.index') }}" class="flex items-center text-gray-500 hover:text-indigo-600 mb-6 transition-colors w-fit">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Daftar Game
    </a>

    <div class="bg-white rounded-2xl shadow-lg shadow-gray-100/50 p-8 border border-gray-100">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h3 class="text-xl font-bold text-gray-800">Edit Game</h3>
                <p class="text-sm text-gray-500 mt-1">Perbarui informasi game dan logonya.</p>
            </div>
            @if($game->thumbnail)
                <img src="{{ asset('storage/'.$game->thumbnail) }}" class="h-10 w-10 rounded-lg object-cover border border-gray-200" alt="Current Logo">
            @endif
        </div>
        
        <form action="{{ route('admin.game.update', $game->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT') <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Game</label>
                    <input type="text" name="name" id="name" required
                           value="{{ old('name', $game->name) }}"
                           class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition-all outline-none" 
                           placeholder="Contoh: Mobile Legends">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Slug / Kode URL</label>
                    <input type="text" name="slug" id="slug" required
                           value="{{ old('slug', $game->slug) }}"
                           class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition-all outline-none" 
                           placeholder="mobile-legends">
                    <p class="text-xs text-gray-400 mt-1">Ubah hanya jika diperlukan. Spasi akan diganti tanda hubung (-).</p>
                    @error('slug') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="p-4 bg-gray-50 rounded-xl border border-gray-200">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Thumbnail / Logo Game</label>
                    
                    <div class="flex flex-col md:flex-row gap-6 items-start">
                        <div class="flex-shrink-0">
                            <p class="text-xs text-gray-500 mb-2 font-semibold uppercase tracking-wider">Logo Saat Ini</p>
                            @if($game->thumbnail)
                                <img src="{{ asset('storage/'.$game->thumbnail) }}" alt="Current Logo" class="w-32 h-32 object-cover rounded-xl shadow-sm border border-gray-200">
                            @else
                                <div class="w-32 h-32 bg-gray-200 rounded-xl flex items-center justify-center text-gray-400 text-xs">
                                    No Image
                                </div>
                            @endif
                        </div>

                        <div class="flex-1 w-full">
                            <p class="text-xs text-gray-500 mb-2 font-semibold uppercase tracking-wider">Ganti Logo (Opsional)</p>
                            <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-white hover:bg-gray-50 transition-colors group">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-2 text-gray-400 group-hover:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <p class="mb-1 text-sm text-gray-500"><span class="font-semibold text-indigo-600">Klik upload</span> jika ingin mengganti</p>
                                    <p class="text-xs text-gray-400">Biarkan kosong jika tidak ingin mengubah</p>
                                </div>
                                <input type="file" name="thumbnail" class="hidden" />
                            </label>
                            @error('thumbnail') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-gray-100 flex justify-end gap-4">
                <a href="{{ route('admin.game.index') }}" class="px-6 py-3 rounded-xl text-gray-600 bg-gray-100 hover:bg-gray-200 font-medium transition-colors">
                    Batal
                </a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-indigo-200 transition-all transform hover:-translate-y-0.5">
                    Update Game
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');
    
    // Flag untuk mengetahui apakah slug pernah diedit manual
    let isSlugManuallyEdited = false;

    slugInput.addEventListener('input', () => {
        isSlugManuallyEdited = true;
    });

    nameInput.addEventListener('keyup', function() {
        if (!isSlugManuallyEdited) {
            let preslug = nameInput.value;
            preslug = preslug.replace(/ /g,"-");
            slugInput.value = preslug.toLowerCase();
        }
    });
</script>
@endsection