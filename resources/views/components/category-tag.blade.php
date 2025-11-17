{{-- Komponen untuk tombol filter kategori (Gambar 2) --}}
@props(['title', 'active' => false])

@php
$classes = ($active)
    ? 'bg-yellow-400 text-gray-900'
    : 'bg-[#3A3B3F] text-gray-300 hover:bg-gray-700 hover:text-white';
@endphp

<a href="#"
    class="rounded-full px-4 py-2 text-xs sm:text-sm font-medium transition-colors duration-200 {{ $classes }}">
    {{ $title }}
</a>