{{-- Komponen untuk card "Populer Sekarang" (Gambar 2) --}}
@props(['image', 'title', 'tag'])

<div
    class="relative rounded-lg overflow-hidden group shadow-lg cursor-pointer h-40 md:h-48">
    {{-- Background Image --}}
    <img src="{{ $image }}" alt="{{ $title }}"
        class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-300">

    {{-- Black overlay for better contrast --}}
    <div class="absolute inset-0 bg-black/30"></div>

    {{-- Konten Banner Kuning --}}
    <div
        class="absolute bottom-0 left-0 right-0 h-16 bg-yellow-400 p-3 flex justify-between items-center transition-transform duration-300 group-hover:translate-y-[-8px]">
        {{-- Judul --}}
        <div>
            <h3 class="text-gray-900 font-bold text-sm md:text-base truncate">{{ $title }}</h3>
        </div>
        {{-- Tag --}}
        <div class_alias="flex-shrink-0 ml-2">
            <span
                class="text-gray-800 text-xs font-semibold bg-white/60 rounded-full px-2.5 py-1">
                {{ $tag }}
            </span>
        </div>
    </div>
</div>