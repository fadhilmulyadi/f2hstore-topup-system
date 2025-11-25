@extends('layouts.admin')

@section('header', 'Tambah Game Baru')

@section('content')
<div class="max-w-3xl mx-auto">
    <a href="{{ route('admin.game.index') }}" class="flex items-center text-gray-500 hover:text-gray-700 mb-6 transition-colors w-fit">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Daftar Game
    </a>

    <div class="bg-white rounded-2xl shadow-lg shadow-gray-100/50 p-8 border border-gray-100">
        <h3 class="text-xl font-bold text-gray-800 mb-6">Informasi Game</h3>
        
        {{-- Pastikan enctype ada untuk upload file --}}
        <form action="{{ route('admin.game.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                {{-- Field Nama Game --}}
                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Game</label>
                    {{-- UBAH name="nama_game" JADI name="name" --}}
                    <input type="text" name="name" id="name" required
                           class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-400 transition-all outline-none" 
                           placeholder="Contoh: Mobile Legends"
                           value="{{ old('name') }}"> {{-- Tambah old() agar input tidak hilang saat error --}}
                    
                    {{-- Tampilkan Error --}}
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Field Slug --}}
                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Slug / Kode Unik</label>
                    <input type="text" name="slug" id="slug" required
                           class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-400 transition-all outline-none" 
                           placeholder="mobile-legends"
                           value="{{ old('slug') }}">
                    @error('slug') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Field Status --}}
                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Game</label>
                    <select name="status" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-400 transition-all outline-none">
                        <option value="1">Aktif</option> {{-- Biasanya boolean atau integer --}}
                        <option value="0">Non-Aktif</option>
                    </select>
                </div>

                {{-- Field Logo / Thumbnail --}}
                <div class="col-span-2">
    <label class="block text-sm font-medium text-gray-700 mb-2">Logo Game</label>
    <div class="flex items-center justify-center w-full">
        <!-- Tambahkan ID "drop-zone" pada label agar mudah dikontrol -->
            <label for="thumbnail-upload" class="relative flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors overflow-hidden">
                
                <!-- 1. Bagian Placeholder (Icon & Teks) -->
                <!-- Beri ID "placeholder" agar bisa disembunyikan nanti -->
                <div id="placeholder" class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-8 h-8 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> logo</p>
                    <p class="text-xs text-gray-400">PNG, JPG (Max. 2MB)</p>
                </div>

                <!-- 2. Bagian Image Preview (Awalnya Hidden/Tersembunyi) -->
                <img id="img-preview" src="#" alt="Preview" class="hidden absolute inset-0 w-full h-full object-cover rounded-xl" />

                <!-- 3. Input File -->
                <!-- Tambahkan ID "thumbnail-upload" dan event onchange -->
                <input id="thumbnail-upload" type="file" name="thumbnail" class="hidden" accept="image/*" onchange="previewImage(event)" />
            </label>
        </div>
        @error('thumbnail') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <!-- Script Javascript untuk menangani Preview -->
    <script>
        function previewImage(event) {
            const input = event.target;
            const placeholder = document.getElementById('placeholder');
            const preview = document.getElementById('img-preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    // Set sumber gambar ke file yang baru dipilih
                    preview.src = e.target.result;
                    
                    // Tampilkan gambar
                    preview.classList.remove('hidden');
                    
                    // Sembunyikan teks placeholder
                    placeholder.classList.add('hidden');
                }

                // Membaca file gambar
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
            </div>

            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-indigo-200 transition-all">
                    Simpan Game
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Script JS Sederhana untuk Auto Slug --}}
<script>
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');

    nameInput.addEventListener('keyup', function() {
        let preslug = nameInput.value;
        preslug = preslug.replace(/ /g,"-");
        slugInput.value = preslug.toLowerCase();
    });
</script>
@endsection