{{-- Komponen untuk kartu game (Baris 2, Gambar 1) --}}
{{-- Style: Logo dan Judul berada di bawah gambar --}}
@props(['image', 'logo', 'title'])

<a href="#"
    class="block bg-[#2C2C2E] rounded-lg overflow-hidden group transition-all duration-300 hover:shadow-lg hover:shadow-yellow-500/20 hover:-translate-y-1">

    {{-- Container Gambar --}}
    <div class="relative h-32 overflow-hidden">
        {{-- Gambar Karakter --}}
        <img src="{{ $image }}" alt="{{ $title }}"
            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">

        {{-- Simulasi 'Swoosh' Kuning (Gradien) --}}
        <div
            class="absolute inset-x-0 bottom-0 h-3/4 bg-gradient-to-t from-yellow-500/20 via-yellow-500/10 to-transparent opacity-75 group-hover:opacity-100">
        </div>
    </div>

    {{-- Konten di Bawah Gambar --}}
    <div class="p-3 text-center">
        <img src="{{ $logo }}" alt="{{ $title }} Logo"
            class="h-10 w-10 mx-auto mb-2 rounded-full bg-gray-900 p-1">
        <h4 class="text-white text-sm font-bold truncate">{{ $title }}</h4>
    </div>
</a>