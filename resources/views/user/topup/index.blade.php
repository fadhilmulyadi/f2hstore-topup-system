@extends('layouts.public')

@section('content')
    <div class="container mx-auto px-4 py-8">

        {{-- ========================================== --}}
        {{-- 1. HERO SECTION (BANNER) --}}
        {{-- ========================================== --}}
        <div class="w-full overflow-hidden rounded-lg shadow-md mb-10">
            {{-- Ganti gambar ini sesuai aset yang ada --}}
            <img src="{{ asset('images/hero/user-index-banner.jpg') }}" alt="Hero Banner F2H"
                class="w-full h-auto object-cover" onerror="this.style.display='none'"> {{-- Hide jika gambar tidak ada --}}
        </div>


        {{-- ========================================== --}}
        {{-- 2. BAGIAN POPULER SEKARANG (JUDUL) --}}
        {{-- ========================================== --}}
        <section class="mb-5">
            <div class="flex items-center space-x-2 mb-3">
                <span
                    class="flex h-5 w-5 items-center justify-center rounded-full bg-orange-500 text-white text-sm font-bold">!</span>
                <h2 class="text-xl font-semibold text-white">POPULER SEKARANG!</h2>
            </div>
            <p class="text-sm text-gray-400 mb-5">Berikut adalah beberapa produk yang paling populer saat ini.</p>
        </section>


        {{-- ========================================== --}}
        {{-- 3. TAG KATEGORI (Statis / Hiasan) --}}
        {{-- ========================================== --}}
        <section class="mb-10 overflow-x-auto">
            <div class="flex flex-nowrap md:flex-wrap gap-2 md:gap-3 pb-2">
                <a href="#"
                    class="whitespace-nowrap rounded-full px-4 py-2 text-xs sm:text-sm font-medium transition-colors duration-200 bg-yellow-400 text-gray-900">
                    Top Up Games
                </a>
                <a href="#"
                    class="whitespace-nowrap rounded-full px-4 py-2 text-xs sm:text-sm font-medium transition-colors duration-200 bg-[#3A3B3F] text-gray-300 hover:bg-gray-700 hover:text-white">
                    Spesialist MLBB
                </a>
                <a href="#"
                    class="whitespace-nowrap rounded-full px-4 py-2 text-xs sm:text-sm font-medium transition-colors duration-200 bg-[#3A3B3F] text-gray-300 hover:bg-gray-700 hover:text-white">
                    Voucher
                </a>
                <a href="#"
                    class="whitespace-nowrap rounded-full px-4 py-2 text-xs sm:text-sm font-medium transition-colors duration-200 bg-[#3A3B3F] text-gray-300 hover:bg-gray-700 hover:text-white">
                    Pulsa & Data
                </a>
            </div>
        </section>


        {{-- ========================================== --}}
        {{-- 4. GRID GAME (DINAMIS DARI DATABASE) --}}
        {{-- ========================================== --}}
        <section>
            {{-- Grid Responsif: 2 kolom di HP, 3 di Tablet, 6 di Desktop --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-4">

                @forelse($games as $game)
                    {{--
                    LINK MENUJU DETAIL PRODUK
                    Menggunakan route 'order.show' dan parameter slug
                    --}}
                    <a href="{{ route('order.show', $game->slug) }}"
                        class="relative block bg-[#2C2C2E] rounded-lg overflow-hidden group transition-all duration-300 hover:shadow-lg hover:shadow-yellow-500/20 hover:-translate-y-1">

                        <div class="relative h-40 overflow-hidden">
                            {{-- GAMBAR DARI STORAGE --}}
                            <img src="{{ asset('storage/' . $game->thumbnail) }}" alt="{{ $game->name }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                onerror="this.src='https://placehold.co/300x300/333/FFF?text={{ urlencode($game->name) }}'">

                            {{-- Efek Gelap di Bawah --}}
                            <div
                                class="absolute inset-x-0 bottom-0 h-3/4 bg-gradient-to-t from-yellow-500/20 via-yellow-500/10 to-transparent opacity-75 group-hover:opacity-100">
                            </div>

                            {{-- Badge HOT (Hanya untuk 3 item pertama biar keren) --}}
                            @if($loop->iteration <= 3)
                                <span
                                    class="absolute top-2 right-2 bg-red-600 text-white text-[10px] font-bold px-2 py-0.5 rounded-full z-10">HOT</span>
                            @endif

                            {{-- Judul Game --}}
                            <div class="absolute inset-x-0 bottom-0 p-3 text-center z-10">
                                <h4 class="text-white text-sm font-bold truncate drop-shadow-lg">
                                    {{ $game->name }}
                                </h4>
                            </div>
                        </div>
                    </a>
                @empty
                    {{-- Tampilan jika Database Kosong --}}
                    <div class="col-span-full text-center py-10 text-gray-400">
                        <p>Belum ada game yang tersedia.</p>
                    </div>
                @endforelse

            </div>
        </section>


        {{-- ========================================== --}}
        {{-- 5. TOMBOL TAMPILKAN LAINNYA --}}
        {{-- ========================================== --}}
        <div class="flex justify-center mt-10">
            <button
                class="bg-[#3A3B3F] text-yellow-400 font-semibold py-2 px-6 rounded-full text-sm hover:bg-gray-700 transition-colors">
                Tampilkan Lainnya...
            </button>
        </div>

    </div> {{-- End Container --}}


    {{-- ========================================== --}}
    {{-- 6. FLOATING CUSTOMER SERVICE --}}
    {{-- ========================================== --}}
    <div class="fixed bottom-6 right-6 z-50">
        <a href="#"
            class="bg-yellow-400 text-gray-900 font-bold py-2.5 px-5 rounded-lg flex items-center space-x-2 shadow-lg hover:bg-yellow-300 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a2 2 0 01-2-2V10a2 2 0 012-2h8z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 8V6a2 2 0 00-2-2H9a2 2 0 00-2 2v2" />
            </svg>
            <span>CS</span>
        </a>
    </div>
@endsection