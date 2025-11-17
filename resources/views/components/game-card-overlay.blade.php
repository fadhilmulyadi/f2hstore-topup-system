{{-- Komponen untuk kartu game (Baris 1, Gambar 1) --}}
{{-- Style: Logo dan Judul mengambang di atas gambar --}}
@props(['image', 'logo', 'title', 'hot' => false])

<a href="#"
    class="relative block bg-[#2C2C2E] rounded-lg overflow-hidden group transition-all duration-300 hover:shadow-lg hover:shadow-yellow-500/20 hover:-translate-y-1">

    {{-- Container Gambar Utama --}}
    <div class="relative h-40 overflow-hidden">
        {{-- Gambar Karakter --}}
        <img src="{{ $image }}" alt="{{ $title }}"
            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">

        {{-- Simulasi 'Swoosh' Kuning (Gradien) --}}
        <div
            class="absolute inset-x-0 bottom-0 h-3/4 bg-gradient-to-t from-yellow-500/20 via-yellow-500/10 to-transparent opacity-75 group-hover:opacity-100">
        </div>

        {{-- Badge 'HOT' --}}
        @if ($hot)
            <span
                class="absolute top-2 right-2 bg-red-600 text-white text-[10px] font-bold px-2 py-0.5 rounded-full z-10">HOT</span>
        @endif

        {{-- Konten Overlay (Logo & Judul) --}}
        <div class="absolute inset-x-0 bottom-0 p-3 text-center z-10">
            <img src="{{ $logo }}" alt="{{ $title }} Logo"
                class="h-10 w-auto mx-auto mb-1 drop-shadow-lg">
            <h4 class="text-white text-sm font-bold truncate drop-shadow-lg">{{ $title }}</h4>
        </div>
    </div>
</a>