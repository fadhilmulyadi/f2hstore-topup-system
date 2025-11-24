@extends('layouts.public')

@section('content')
    <div class="container mx-auto px-4 py-8">

        <!-- Hero Section -->
        {{--
        Container untuk banner.
        Diberi 'overflow-hidden' dan 'rounded-lg' agar gambar
        sesuai dengan estetika desain (seperti search bar di atasnya).

        Wrapper 'max-w-7xl' dihapus agar lebarnya mengikuti
        parent 'container' seperti section 'Populer Sekarang'.
        'my-6' diubah menjadi 'mb-10' agar konsisten dengan spasi section lain.
        --}}
        <div class="w-full overflow-hidden rounded-lg shadow-md mb-10">
            {{--
            Ini adalah gambar banner hero Anda.
            Pastikan path-nya sesuai: public/images/hero/user-index-banner.jpg
            --}}
            <img src="{{ asset('images/hero/user-index-banner.jpg') }}" alt="Hero Banner F2H"
                class="w-full h-auto object-cover">
        </div>


        {{-- 1. Bagian Populer Sekarang --}}
        <section class="mb-10">
            <div class="flex items-center space-x-2 mb-3">
                <span
                    class="flex h-5 w-5 items-center justify-center rounded-full bg-orange-500 text-white text-sm font-bold">!</span>
                <h2 class="text-xl font-semibold text-white">POPULER SEKARANG!</h2>
            </div>
            <p class="text-sm text-gray-400 mb-5">Berikut adalah beberapa produk yang paling populer saat ini.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                {{--
                Kode dari 'popular-card.blade.php' digabung di sini.
                Ini akan diulang untuk setiap kartu.
                --}}

                <div class="relative rounded-lg overflow-hidden group shadow-lg cursor-pointer h-40 md:h-48">
                    <img src="https://placehold.co/600x300/222/FFF?text=Mobile+Legends+BG" alt="Mobile Legends"
                        class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-300">
                    <div class="absolute inset-0 bg-black/30"></div>
                    <div
                        class="absolute bottom-0 left-0 right-0 h-16 bg-yellow-400 p-3 flex justify-between items-center transition-transform duration-300 group-hover:translate-y-[-8px]">
                        <div>
                            <h3 class="text-gray-900 font-bold text-sm md:text-base truncate">Mobile Legends</h3>
                        </div>
                        <div class_alias="flex-shrink-0 ml-2">
                            <span class="text-gray-800 text-xs font-semibold bg-white/60 rounded-full px-2.5 py-1">
                                Voucherize
                            </span>
                        </div>
                    </div>
                </div>
                <div class="relative rounded-lg overflow-hidden group shadow-lg cursor-pointer h-40 md:h-48">
                    <img src="https://placehold.co/600x300/222/FFF?text=Joki+Rank+BG" alt="Joki Rank Mobile Legends"
                        class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-300">
                    <div class="absolute inset-0 bg-black/30"></div>
                    <div
                        class="absolute bottom-0 left-0 right-0 h-16 bg-yellow-400 p-3 flex justify-between items-center transition-transform duration-300 group-hover:translate-y-[-8px]">
                        <div>
                            <h3 class="text-gray-900 font-bold text-sm md:text-base truncate">Joki Rank Mobile Legends</h3>
                        </div>
                        <div class_alias="flex-shrink-0 ml-2">
                            <span class="text-gray-800 text-xs font-semibold bg-white/60 rounded-full px-2.5 py-1">
                                Tokopedia
                            </span>
                        </div>
                    </div>
                </div>
                <div class="relative rounded-lg overflow-hidden group shadow-lg cursor-pointer h-40 md:h-48">
                    <img src="https://placehold.co/600x300/222/FFF?text=Jasa+Mabar+BG" alt="Jasa Mabar Push"
                        class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-300">
                    <div class="absolute inset-0 bg-black/30"></div>
                    <div
                        class="absolute bottom-0 left-0 right-0 h-16 bg-yellow-400 p-3 flex justify-between items-center transition-transform duration-300 group-hover:translate-y-[-8px]">
                        <div>
                            <h3 class="text-gray-900 font-bold text-sm md:text-base truncate">Jasa Mabar Push</h3>
                        </div>
                        <div class_alias="flex-shrink-0 ml-2">
                            <span class="text-gray-800 text-xs font-semibold bg-white/60 rounded-full px-2.5 py-1">
                                Tokopedia
                            </span>
                        </div>
                    </div>
                </div>
                <div class="relative rounded-lg overflow-hidden group shadow-lg cursor-pointer h-40 md:h-48">
                    <img src="https://placehold.co/600x300/222/FFF?text=Roblox+BG" alt="ROBLOX - VOUCHER"
                        class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-300">
                    <div class="absolute inset-0 bg-black/30"></div>
                    <div
                        class="absolute bottom-0 left-0 right-0 h-16 bg-yellow-400 p-3 flex justify-between items-center transition-transform duration-300 group-hover:translate-y-[-8px]">
                        <div>
                            <h3 class="text-gray-900 font-bold text-sm md:text-base truncate">ROBLOX - VOUCHER</h3>
                        </div>
                        <div class_alias="flex-shrink-0 ml-2">
                            <span class="text-gray-800 text-xs font-semibold bg-white/60 rounded-full px-2.5 py-1">
                                Roblox Corporation
                            </span>
                        </div>
                    </div>
                </div>
                <div class="relative rounded-lg overflow-hidden group shadow-lg cursor-pointer h-40 md:h-48">
                    <img src="https://placehold.co/600x300/222/FFF?text=Jasa+Mabar+Casual+BG" alt="Jasa Mabar Casual"
                        class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-300">
                    <div class="absolute inset-0 bg-black/30"></div>
                    <div
                        class="absolute bottom-0 left-0 right-0 h-16 bg-yellow-400 p-3 flex justify-between items-center transition-transform duration-300 group-hover:translate-y-[-8px]">
                        <div>
                            <h3 class="text-gray-900 font-bold text-sm md:text-base truncate">Jasa Mabar Casual</h3>
                        </div>
                        <div class_alias="flex-shrink-0 ml-2">
                            <span class="text-gray-800 text-xs font-semibold bg-white/60 rounded-full px-2.5 py-1">
                                Tokopedia
                            </span>
                        </div>
                    </div>
                </div>
                <div class="relative rounded-lg overflow-hidden group shadow-lg cursor-pointer h-40 md:h-48">
                    <img src="https://placehold.co/600x300/222/FFF?text=Free+Fire+BG" alt="Free Fire"
                        class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-300">
                    <div class="absolute inset-0 bg-black/30"></div>
                    <div
                        class="absolute bottom-0 left-0 right-0 h-16 bg-yellow-400 p-3 flex justify-between items-center transition-transform duration-300 group-hover:translate-y-[-8px]">
                        <div>
                            <h3 class="text-gray-900 font-bold text-sm md:text-base truncate">Free Fire</h3>
                        </div>
                        <div class_alias="flex-shrink-0 ml-2">
                            <span class="text-gray-800 text-xs font-semibold bg-white/60 rounded-full px-2.5 py-1">
                                Garena
                            </span>
                        </div>
                    </div>
                </div>
                <div class="relative rounded-lg overflow-hidden group shadow-lg cursor-pointer h-40 md:h-48">
                    <img src="https://placehold.co/600x300/222/FFF?text=PUBG+Mobile+BG" alt="PUBG Mobile"
                        class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-300">
                    <div class="absolute inset-0 bg-black/30"></div>
                    <div
                        class="absolute bottom-0 left-0 right-0 h-16 bg-yellow-400 p-3 flex justify-between items-center transition-transform duration-300 group-hover:translate-y-[-8px]">
                        <div>
                            <h3 class="text-gray-900 font-bold text-sm md:text-base truncate">PUBG Mobile</h3>
                        </div>
                        <div class_alias="flex-shrink-0 ml-2">
                            <span class="text-gray-800 text-xs font-semibold bg-white/60 rounded-full px-2.5 py-1">
                                Tencent Games
                            </span>
                        </div>
                    </div>
                </div>
                <div class="relative rounded-lg overflow-hidden group shadow-lg cursor-pointer h-40 md:h-48">
                    <img src="https://placehold.co/600x300/222/FFF?text=Honor+of+Kings+BG" alt="Honor Of Kings"
                        class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-300">
                    <div class="absolute inset-0 bg-black/30"></div>
                    <div
                        class="absolute bottom-0 left-0 right-0 h-16 bg-yellow-400 p-3 flex justify-between items-center transition-transform duration-300 group-hover:translate-y-[-8px]">
                        <div>
                            <h3 class="text-gray-900 font-bold text-sm md:text-base truncate">Honor Of Kings</h3>
                        </div>
                        <div class_alias="flex-shrink-0 ml-2">
                            <span class="text-gray-800 text-xs font-semibold bg-white/60 rounded-full px-2.5 py-1">
                                Tencent Games
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- 2. Bagian Tag Kategori --}}
        <section class="mb-10">
            <div class="flex flex-wrap gap-2 md:gap-3">
                {{--
                Kode dari 'category-tag.blade.php' digabung di sini.
                Perhatikan perbedaan kelas untuk 'Top Up Games' (aktif)
                --}}
                <a href="#"
                    class="rounded-full px-4 py-2 text-xs sm:text-sm font-medium transition-colors duration-200 bg-yellow-400 text-gray-900">
                    Top Up Games
                </a>
                <a href="#"
                    class="rounded-full px-4 py-2 text-xs sm:text-sm font-medium transition-colors duration-200 bg-[#3A3B3F] text-gray-300 hover:bg-gray-700 hover:text-white">
                    Spesialist MLBB
                </a>
                <a href="#"
                    class="rounded-full px-4 py-2 text-xs sm:text-sm font-medium transition-colors duration-200 bg-[#3A3B3F] text-gray-300 hover:bg-gray-700 hover:text-white">
                    Spesialist Roblox
                </a>
                <a href="#"
                    class="rounded-full px-4 py-2 text-xs sm:text-sm font-medium transition-colors duration-200 bg-[#3A3B3F] text-gray-300 hover:bg-gray-700 hover:text-white">
                    Spesialist PUBGM
                </a>
                <a href="#"
                    class="rounded-full px-4 py-2 text-xs sm:text-sm font-medium transition-colors duration-200 bg-[#3A3B3F] text-gray-300 hover:bg-gray-700 hover:text-white">
                    Spesialist HOK
                </a>
                <a href="#"
                    class="rounded-full px-4 py-2 text-xs sm:text-sm font-medium transition-colors duration-200 bg-[#3A3B3F] text-gray-300 hover:bg-gray-700 hover:text-white">
                    Voucher
                </a>
                <a href="#"
                    class="rounded-full px-4 py-2 text-xs sm:text-sm font-medium transition-colors duration-200 bg-[#3A3B3F] text-gray-300 hover:bg-gray-700 hover:text-white">
                    Pulsa, Data & Tagihan
                </a>
                <a href="#"
                    class="rounded-full px-4 py-2 text-xs sm:text-sm font-medium transition-colors duration-200 bg-[#3A3B3F] text-gray-300 hover:bg-gray-700 hover:text-white">
                    Entertainment
                </a>
            </div>
        </section>

        {{-- 3. Bagian Grid Game Top Up --}}
        <section>
            {{-- Baris 1: Overlay Style --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-4">
                {{--
                Kode dari 'game-card-overlay.blade.php' digabung di sini.
                Perhatikan tambahan 'HOT' badge untuk ML & Magic Chess
                --}}

                <a href="#"
                    class="relative block bg-[#2C2C2E] rounded-lg overflow-hidden group transition-all duration-300 hover:shadow-lg hover:shadow-yellow-500/20 hover:-translate-y-1">
                    <div class="relative h-40 overflow-hidden">
                        <img src="https://placehold.co/300x300/555/FFF?text=ML+Character" alt="Mobile Legends"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div
                            class="absolute inset-x-0 bottom-0 h-3/4 bg-gradient-to-t from-yellow-500/20 via-yellow-500/10 to-transparent opacity-75 group-hover:opacity-100">
                        </div>
                        <span
                            class="absolute top-2 right-2 bg-red-600 text-white text-[10px] font-bold px-2 py-0.5 rounded-full z-10">HOT</span>
                        <div class="absolute inset-x-0 bottom-0 p-3 text-center z-10">
                            <img src="https://placehold.co/100x100/333/FFF?text=ML+Logo" alt="Mobile Legends Logo"
                                class="h-10 w-auto mx-auto mb-1 drop-shadow-lg">
                            <h4 class="text-white text-sm font-bold truncate drop-shadow-lg">Mobile Legends</h4>
                        </div>
                    </div>
                </a>
                <a href="#"
                    class="relative block bg-[#2C2C2E] rounded-lg overflow-hidden group transition-all duration-300 hover:shadow-lg hover:shadow-yellow-500/20 hover:-translate-y-1">
                    <div class="relative h-40 overflow-hidden">
                        <img src="https://placehold.co/300x300/555/FFF?text=MC+Character" alt="Magic Chess"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div
                            class="absolute inset-x-0 bottom-0 h-3/4 bg-gradient-to-t from-yellow-500/20 via-yellow-500/10 to-transparent opacity-75 group-hover:opacity-100">
                        </div>
                        <span
                            class="absolute top-2 right-2 bg-red-600 text-white text-[10px] font-bold px-2 py-0.5 rounded-full z-10">HOT</span>
                        <div class="absolute inset-x-0 bottom-0 p-3 text-center z-10">
                            <img src="https://placehold.co/100x100/333/FFF?text=MC+Logo" alt="Magic Chess Logo"
                                class="h-10 w-auto mx-auto mb-1 drop-shadow-lg">
                            <h4 class="text-white text-sm font-bold truncate drop-shadow-lg">Magic Chess</h4>
                        </div>
                    </div>
                </a>
                <a href="#"
                    class="relative block bg-[#2C2C2E] rounded-lg overflow-hidden group transition-all duration-300 hover:shadow-lg hover:shadow-yellow-500/20 hover:-translate-y-1">
                    <div class="relative h-40 overflow-hidden">
                        <img src="https://placehold.co/300x300/555/FFF?text=AB+Character" alt="Arena Breakout"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div
                            class="absolute inset-x-0 bottom-0 h-3/4 bg-gradient-to-t from-yellow-500/20 via-yellow-500/10 to-transparent opacity-75 group-hover:opacity-100">
                        </div>
                        <div class="absolute inset-x-0 bottom-0 p-3 text-center z-10">
                            <img src="https://placehold.co/100x100/333/FFF?text=AB+Logo" alt="Arena Breakout Logo"
                                class="h-10 w-auto mx-auto mb-1 drop-shadow-lg">
                            <h4 class="text-white text-sm font-bold truncate drop-shadow-lg">Arena Breakout</h4>
                        </div>
                    </div>
                </a>
                <a href="#"
                    class="relative block bg-[#2C2C2E] rounded-lg overflow-hidden group transition-all duration-300 hover:shadow-lg hover:shadow-yellow-500/20 hover:-translate-y-1">
                    <div class="relative h-40 overflow-hidden">
                        <img src="https://placehold.co/300x300/555/FFF?text=FF+Character" alt="Free Fire"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div
                            class="absolute inset-x-0 bottom-0 h-3/4 bg-gradient-to-t from-yellow-500/20 via-yellow-500/10 to-transparent opacity-75 group-hover:opacity-100">
                        </div>
                        <div class="absolute inset-x-0 bottom-0 p-3 text-center z-10">
                            <img src="https://placehold.co/100x100/333/FFF?text=FF+Logo" alt="Free Fire Logo"
                                class="h-10 w-auto mx-auto mb-1 drop-shadow-lg">
                            <h4 class="text-white text-sm font-bold truncate drop-shadow-lg">Free Fire</h4>
                        </div>
                    </div>
                </a>
                <a href="#"
                    class="relative block bg-[#2C2C2E] rounded-lg overflow-hidden group transition-all duration-300 hover:shadow-lg hover:shadow-yellow-500/20 hover:-translate-y-1">
                    <div class="relative h-40 overflow-hidden">
                        <img src="https://placehold.co/300x300/555/FFF?text=FFM+Character" alt="Free Fire MAX"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div
                            class="absolute inset-x-0 bottom-0 h-3/4 bg-gradient-to-t from-yellow-500/20 via-yellow-500/10 to-transparent opacity-75 group-hover:opacity-100">
                        </div>
                        <div class="absolute inset-x-0 bottom-0 p-3 text-center z-10">
                            <img src="https://placehold.co/100x100/333/FFF?text=FFM+Logo" alt="Free Fire MAX Logo"
                                class="h-10 w-auto mx-auto mb-1 drop-shadow-lg">
                            <h4 class="text-white text-sm font-bold truncate drop-shadow-lg">Free Fire MAX</h4>
                        </div>
                    </div>
                </a>
                <a href="#"
                    class="relative block bg-[#2C2C2E] rounded-lg overflow-hidden group transition-all duration-300 hover:shadow-lg hover:shadow-yellow-500/20 hover:-translate-y-1">
                    <div class="relative h-40 overflow-hidden">
                        <img src="https://placehold.co/300x300/555/FFF?text=PUBG+Character" alt="PUBG Mobile"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div
                            class="absolute inset-x-0 bottom-0 h-3/4 bg-gradient-to-t from-yellow-500/20 via-yellow-500/10 to-transparent opacity-75 group-hover:opacity-100">
                        </div>
                        <div class="absolute inset-x-0 bottom-0 p-3 text-center z-10">
                            <img src="https://placehold.co/100x100/333/FFF?text=PUBG+Logo" alt="PUBG Mobile Logo"
                                class="h-10 w-auto mx-auto mb-1 drop-shadow-lg">
                            <h4 class="text-white text-sm font-bold truncate drop-shadow-lg">PUBG Mobile</h4>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Baris 2: Stacked Style --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                {{--
                Kode dari 'game-card-stacked.blade.php' digabung di sini.
                --}}

                <a href="#"
                    class="block bg-[#2C2C2E] rounded-lg overflow-hidden group transition-all duration-300 hover:shadow-lg hover:shadow-yellow-500/20 hover:-translate-y-1">
                    <div class="relative h-32 overflow-hidden">
                        <img src="https://placehold.co/300x300/555/FFF?text=HOK+Character" alt="Honor of Kings"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div
                            class="absolute inset-x-0 bottom-0 h-3/4 bg-gradient-to-t from-yellow-500/20 via-yellow-500/10 to-transparent opacity-75 group-hover:opacity-100">
                        </div>
                    </div>
                    <div class="p-3 text-center">
                        <img src="https://placehold.co/100x100/333/FFF?text=HOK+Logo" alt="Honor of Kings Logo"
                            class="h-10 w-10 mx-auto mb-2 rounded-full bg-gray-900 p-1">
                        <h4 class="text-white text-sm font-bold truncate">Honor of Kings</h4>
                    </div>
                </a>
                <a href="#"
                    class="block bg-[#2C2C2E] rounded-lg overflow-hidden group transition-all duration-300 hover:shadow-lg hover:shadow-yellow-500/20 hover:-translate-y-1">
                    <div class="relative h-32 overflow-hidden">
                        <img src="https://placehold.co/300x300/555/FFF?text=Valo+Character" alt="Valorant"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div
                            class="absolute inset-x-0 bottom-0 h-3/4 bg-gradient-to-t from-yellow-500/20 via-yellow-500/10 to-transparent opacity-75 group-hover:opacity-100">
                        </div>
                    </div>
                    <div class="p-3 text-center">
                        <img src="https://placehold.co/100x100/333/FFF?text=Valo+Logo" alt="Valorant Logo"
                            class="h-10 w-10 mx-auto mb-2 rounded-full bg-gray-900 p-1">
                        <h4 class="text-white text-sm font-bold truncate">Valorant</h4>
                    </div>
                </a>
                <a href="#"
                    class="block bg-[#2C2C2E] rounded-lg overflow-hidden group transition-all duration-300 hover:shadow-lg hover:shadow-yellow-500/20 hover:-translate-y-1">
                    <div class="relative h-32 overflow-hidden">
                        <img src="https://placehold.co/300x300/555/FFF?text=GI+Character" alt="Genshin Impact"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div
                            class="absolute inset-x-0 bottom-0 h-3/4 bg-gradient-to-t from-yellow-500/20 via-yellow-500/10 to-transparent opacity-75 group-hover:opacity-100">
                        </div>
                    </div>
                    <div class="p-3 text-center">
                        <img src="https://placehold.co/100x100/333/FFF?text=GI+Logo" alt="Genshin Impact Logo"
                            class="h-10 w-10 mx-auto mb-2 rounded-full bg-gray-900 p-1">
                        <h4 class="text-white text-sm font-bold truncate">Genshin Impact</h4>
                    </div>
                </a>
                <a href="#"
                    class="block bg-[#2C2C2E] rounded-lg overflow-hidden group transition-all duration-300 hover:shadow-lg hover:shadow-yellow-500/20 hover:-translate-y-1">
                    <div class="relative h-32 overflow-hidden">
                        <img src="https://placehold.co/300x300/555/FFF?text=COD+Character" alt="Call of Duty"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div
                            class="absolute inset-x-0 bottom-0 h-3/4 bg-gradient-to-t from-yellow-500/20 via-yellow-500/10 to-transparent opacity-75 group-hover:opacity-100">
                        </div>
                    </div>
                    <div class="p-3 text-center">
                        <img src="https://placehold.co/100x100/333/FFF?text=COD+Logo" alt="Call of Duty Logo"
                            class="h-10 w-10 mx-auto mb-2 rounded-full bg-gray-900 p-1">
                        <h4 class="text-white text-sm font-bold truncate">Call of Duty</h4>
                    </div>
                </a>
                <a href="#"
                    class="block bg-[#2C2C2E] rounded-lg overflow-hidden group transition-all duration-300 hover:shadow-lg hover:shadow-yellow-500/20 hover:-translate-y-1">
                    <div class="relative h-32 overflow-hidden">
                        <img src="https://placehold.co/300x300/555/FFF?text=HSR+Character" alt="Honkai: Star Rail"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div
                            class="absolute inset-x-0 bottom-0 h-3/4 bg-gradient-to-t from-yellow-500/20 via-yellow-500/10 to-transparent opacity-75 group-hover:opacity-100">
                        </div>
                    </div>
                    <div class="p-3 text-center">
                        <img src="https://placehold.co/100x100/333/FFF?text=HSR+Logo" alt="Honkai: Star Rail Logo"
                            class="h-10 w-10 mx-auto mb-2 rounded-full bg-gray-900 p-1">
                        <h4 class="text-white text-sm font-bold truncate">Honkai: Star Rail</h4>
                    </div>
                </a>
                <a href="#"
                    class="block bg-[#2C2C2E] rounded-lg overflow-hidden group transition-all duration-300 hover:shadow-lg hover:shadow-yellow-500/20 hover:-translate-y-1">
                    <div class="relative h-32 overflow-hidden">
                        <img src="https://placehold.co/300x300/555/FFF?text=Undawn+Character" alt="Undawn"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div
                            class="absolute inset-x-0 bottom-0 h-3/4 bg-gradient-to-t from-yellow-500/20 via-yellow-500/10 to-transparent opacity-75 group-hover:opacity-100">
                        </div>
                    </div>
                    <div class="p-3 text-center">
                        <img src="https://placehold.co/100x100/333/FFF?text=Undawn+Logo" alt="Undawn Logo"
                            class="h-10 w-10 mx-auto mb-2 rounded-full bg-gray-900 p-1">
                        <h4 class="text-white text-sm font-bold truncate">Undawn</h4>
                    </div>
                </a>
            </div>
        </section>

        {{-- 4. Tombol "Tampilkan Lainnya" --}}
        <div class="flex justify-center mt-10">
            <button
                class="bg-[#3A3B3F] text-yellow-400 font-semibold py-2 px-6 rounded-full text-sm hover:bg-gray-700 transition-colors">
                Tampilkan Lainnya...
            </button>
        </div>

    </div> {{-- Penutup <div class="container..."> --}}


        {{-- 5. Tombol Customer Service (Fixed) --}}
        <div class="fixed bottom-6 right-6 z-50">
            <button
                class="bg-yellow-400 text-gray-900 font-bold py-2.5 px-5 rounded-lg flex items-center space-x-2 shadow-lg hover:bg-yellow-300 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a2 2 0 01-2-2V10a2 2 0 012-2h8z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 8V6a2 2 0 00-2-2H9a2 2 0 00-2 2v2" />
                </svg>
                <span>CUSTOMER SERVICE</span>
            </button>
        </div>
@endsection