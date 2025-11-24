<x-app-layout>
    

    <!-- Ubah background utama area ini jika perlu, tapi kita fokus ke Card-nya -->
    <div class="py-12 bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- CARD UTAMA: Ganti putih jadi Gelap (Gray-800) -->
            <div class="bg-gray-800 overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-700">
                <div class="p-8 text-gray-100">
                    
                    <!-- Sapaan User -->
                    <div class="mb-8 text-center sm:text-left">
                        <h3 class="text-3xl font-bold text-yellow-400 mb-2">Halo, {{ Auth::user()->name }}! 👋</h3>
                        <p class="text-gray-400 text-lg">
                            Senang melihat Anda kembali.
                            @if(Auth::user()->role === 'admin')
                                Status Akun: <span class="font-bold text-yellow-400 bg-yellow-400/10 px-2 py-1 rounded">Administrator</span>
                            @else
                                Siap untuk petualangan gaming berikutnya?
                            @endif
                        </p>
                    </div>

                    <!-- Garis Pemisah Halus -->
                    <div class="border-b border-gray-700 mb-8"></div>

                    <!-- Pilihan Menu Berdasarkan Role -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        @if(Auth::user()->role === 'admin')
                            <!-- TAMPILAN KHUSUS ADMIN (DARK) -->
                            
                            <!-- Card Admin Panel -->
                            <div class="p-6 bg-gray-900 rounded-xl border border-gray-700 hover:border-yellow-500/50 transition duration-300 flex flex-col sm:flex-row items-center justify-between gap-4 group">
                                <div class="text-center sm:text-left">
                                    <h4 class="text-xl font-bold text-white group-hover:text-yellow-400 transition">Admin Panel</h4>
                                    <p class="text-sm text-gray-500 mt-1">Kelola game, produk, dan harga.</p>
                                </div>
                                <a href="{{ route('admin.dashboard') }}" class="whitespace-nowrap px-6 py-3 bg-yellow-500 text-black font-bold rounded-lg hover:bg-yellow-400 transition shadow-lg shadow-yellow-500/20">
                                    Buka Panel &rarr;
                                </a>
                            </div>

                            <!-- Card Lihat Website -->
                            <div class="p-6 bg-gray-900 rounded-xl border border-gray-700 hover:border-gray-500 transition duration-300 flex flex-col sm:flex-row items-center justify-between gap-4">
                                <div class="text-center sm:text-left">
                                    <h4 class="text-xl font-bold text-gray-300">Halaman Depan</h4>
                                    <p class="text-sm text-gray-500 mt-1">Lihat tampilan user (Frontend).</p>
                                </div>
                                <a href="{{ url('/') }}" class="whitespace-nowrap px-6 py-3 bg-transparent border border-gray-500 text-gray-300 font-bold rounded-lg hover:bg-gray-700 hover:text-white transition">
                                    Lihat Website
                                </a>
                            </div>

                        @else
                            <!-- TAMPILAN KHUSUS USER BIASA (DARK & HEROIC) -->
                            <div class="col-span-1 md:col-span-2 p-8 bg-gradient-to-r from-gray-900 to-gray-800 rounded-2xl border border-gray-700 relative overflow-hidden group">
                                <!-- Hiasan Background Glow -->
                                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-yellow-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10 group-hover:opacity-20 transition"></div>

                                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6 text-center md:text-left">
                                    <div>
                                        <h4 class="text-2xl font-bold text-white">Mau Top Up Game Apa Hari Ini?</h4>
                                        <p class="text-gray-400 mt-2 max-w-lg">
                                            Dapatkan harga termurah, proses instan, dan layanan terpercaya 24 jam hanya di Takapedia.
                                        </p>
                                    </div>
                                    <a href="{{ url('/') }}" class="whitespace-nowrap px-8 py-4 bg-yellow-500 text-black font-bold text-lg rounded-xl hover:bg-yellow-400 transition shadow-lg shadow-yellow-500/20 transform hover:-translate-y-1">
                                        Mulai Belanja 🛒
                                    </a>
                                </div>
                            </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>