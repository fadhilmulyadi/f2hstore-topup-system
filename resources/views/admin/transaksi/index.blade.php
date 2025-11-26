@extends('layouts.admin')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Judul Halaman --}}
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">
                    Kelola Transaksi / Pesanan
                </h2>
            </div>

            {{-- Pesan Sukses (Penting untuk Feedback setelah klik tombol) --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 shadow-sm"
                    role="alert">
                    <strong class="font-bold">Berhasil!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Pesan Error --}}
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 shadow-sm">
                    <strong class="font-bold">Ups!</strong>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Main Card -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl border border-gray-100">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Table Container -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        Info</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        User / Pembeli</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        Item Produk</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        Total Harga</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($transactions as $transaction)
                                    <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">

                                        {{-- Kolom 1: Info ID & Tanggal --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-bold text-gray-900">#{{ $transaction->id }}</div>
                                            <div class="text-xs text-gray-500 font-mono mt-1">{{ $transaction->payment_token }}
                                            </div>
                                            <div class="text-xs text-gray-400 mt-1">
                                                {{ $transaction->created_at->format('d M Y H:i') }}</div>
                                        </td>

                                        {{-- Kolom 2: User --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $transaction->user->name ?? 'Guest' }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                {{ $transaction->user->email ?? '-' }}
                                            </div>
                                            <div
                                                class="text-xs text-gray-500 font-mono bg-gray-100 px-2 py-0.5 rounded inline-block mt-1">
                                                Target: {{ $transaction->target_account }}
                                            </div>
                                        </td>

                                        {{-- Kolom 3: Produk --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            <div class="font-bold">{{ $transaction->product->game->name ?? '-' }}</div>
                                            <div class="text-gray-500">{{ $transaction->product->name ?? 'Produk Terhapus' }}
                                            </div>
                                        </td>

                                        {{-- Kolom 4: Harga --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-800">
                                            Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                                        </td>

                                        {{-- Kolom 5: Status --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($transaction->status == 'success')
                                                <span
                                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 border border-green-200">
                                                    SUCCESS
                                                </span>
                                            @elseif($transaction->status == 'pending')
                                                <span
                                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-200 animate-pulse">
                                                    PENDING
                                                </span>
                                            @else
                                                <span
                                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 border border-red-200">
                                                    {{ strtoupper($transaction->status) }}
                                                </span>
                                            @endif
                                        </td>

                                        {{-- Kolom 6: Aksi (FORM PENTING DI SINI) --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            @if($transaction->status != 'success')

                                                {{-- FORM UPDATE STATUS KE SUCCESS --}}
                                                {{-- Route mengarah ke 'admin.transaksi.update' sesuai web.php --}}
                                                <form method="POST" action="{{ route('admin.transaksi.update', $transaction->id) }}"
                                                    onsubmit="return confirm('Yakin verifikasi transaksi #{{ $transaction->id }}? Pesan WhatsApp akan otomatis dikirim ke pembeli.');">
                                                    @csrf
                                                    {{-- @method('PUT') KITA HAPUS KARENA ROUTE AGIL MENGGUNAKAN POST --}}

                                                    {{-- WAJIB ADA: Mengirim data status = success --}}
                                                    <input type="hidden" name="status" value="success">

                                                    <button type="submit"
                                                        class="inline-flex items-center px-4 py-2 border border-transparent text-xs font-bold rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-md transition-all transform hover:scale-105">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M5 13l4 4L19 7" />
                                                        </svg>
                                                        Terima Pesanan
                                                    </button>
                                                </form>

                                                {{-- Tombol Tolak (Opsional) --}}
                                                <form method="POST" action="{{ route('admin.transaksi.update', $transaction->id) }}"
                                                    class="mt-2" onsubmit="return confirm('Tolak pesanan ini?');">
                                                    @csrf
                                                    {{-- @method('PUT') KITA HAPUS JUGA --}}
                                                    <input type="hidden" name="status" value="failed">
                                                    <button type="submit" class="text-red-600 hover:text-red-900 text-xs underline">
                                                        Tolak
                                                    </button>
                                                </form>

                                            @else
                                                <span class="text-gray-400 italic text-xs flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-green-500"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Selesai
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                                    </path>
                                                </svg>
                                                <span class="text-lg font-medium">Belum ada transaksi masuk.</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $transactions->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection