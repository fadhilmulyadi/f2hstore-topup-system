@extends('layouts.admin')

@section('header', 'Dashboard Overview')

@section('content')
<div class="max-w-7xl mx-auto">
    
    {{-- BAGIAN ATAS: Welcome Card & Actions --}}
    <div class="bg-indigo-600 rounded-2xl p-6 mb-8 text-white shadow-lg shadow-indigo-200 flex flex-col md:flex-row items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold mb-1">Halo, Admin! 👋</h2>
            <p class="text-indigo-100 text-sm opacity-90">Selamat datang kembali di panel kontrol F2H.</p>
        </div>
        
        {{-- Flex Container untuk Tombol --}}
        <div class="mt-4 md:mt-0 flex flex-col sm:flex-row gap-3">
            
            {{-- TOMBOL BARU: KEMBALI KE HOME --}}
            <a href="{{ url('/') }}" class="px-4 py-2 bg-indigo-800 text-indigo-100 border border-indigo-500 rounded-lg text-sm font-bold shadow-md hover:bg-indigo-900 hover:text-white transition-colors flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Lihat Website
            </a>

            {{-- Tombol Lama --}}
            <a href="{{ route('admin.game.create') }}" class="px-4 py-2 bg-white text-indigo-600 rounded-lg text-sm font-bold shadow-md hover:bg-gray-50 transition-colors flex items-center justify-center">
                + Tambah Game Baru
            </a>
        </div>
    </div>

    {{-- BAGIAN TENGAH: Statistik Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        
        <div class="bg-white p-6 rounded-2xl shadow-lg shadow-gray-100/50 border border-gray-100 flex items-center gap-4">
            <div class="w-14 h-14 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Total Game</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $totalGames ?? 0 }}</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-lg shadow-gray-100/50 border border-gray-100 flex items-center gap-4">
            <div class="w-14 h-14 rounded-xl bg-purple-50 flex items-center justify-center text-purple-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Total Item/Produk</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $totalProducts ?? 0 }}</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-lg shadow-gray-100/50 border border-gray-100 flex items-center gap-4">
            <div class="w-14 h-14 rounded-xl bg-green-50 flex items-center justify-center text-green-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Status Sistem</p>
                <h3 class="text-lg font-bold text-green-600">Online & Aman</h3>
            </div>
        </div>
    </div>

    {{-- BAGIAN BAWAH: Akses Cepat & Panduan --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-2xl p-6 shadow-lg shadow-gray-100/50 border border-gray-100">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Akses Cepat</h3>
            <div class="space-y-3">
                
                {{-- TOMBOL BARU: Cek Transaksi --}}
                <a href="{{ route('admin.transaksi.index') }}" class="block w-full p-4 rounded-xl border border-gray-100 hover:border-indigo-200 hover:bg-indigo-50 transition-all group">
                    <div class="flex items-center justify-between">
                        <span class="font-medium text-gray-700 group-hover:text-indigo-700">Cek Pesanan / Transaksi</span>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                </a>

                <a href="{{ route('admin.game.index') }}" class="block w-full p-4 rounded-xl border border-gray-100 hover:border-indigo-200 hover:bg-indigo-50 transition-all group">
                    <div class="flex items-center justify-between">
                        <span class="font-medium text-gray-700 group-hover:text-indigo-700">Kelola Daftar Game</span>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                </a>
                <a href="{{ route('admin.produk.index') }}" class="block w-full p-4 rounded-xl border border-gray-100 hover:border-indigo-200 hover:bg-indigo-50 transition-all group">
                    <div class="flex items-center justify-between">
                        <span class="font-medium text-gray-700 group-hover:text-indigo-700">Update Harga Produk</span>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                </a>
            </div>
        </div>

        <div class="bg-indigo-50 rounded-2xl p-6 border border-indigo-100">
            <h3 class="text-lg font-bold text-indigo-900 mb-2">Panduan Admin</h3>
            <ul class="space-y-3 mt-4 text-sm text-indigo-800">
                <li class="flex gap-2">
                    <span class="font-bold">•</span>
                    <span>Pastikan ukuran gambar game persegi (ratio 1:1) agar rapi.</span>
                </li>
                <li class="flex gap-2">
                    <span class="font-bold">•</span>
                    <span>SKU Produk harus unik, tidak boleh sama antar item.</span>
                </li>
                <li class="flex gap-2">
                    <span class="font-bold">•</span>
                    <span>Jangan lupa cek halaman user setelah update harga.</span>
                </li>
            </ul>
        </div>
    </div>

</div>
@endsection