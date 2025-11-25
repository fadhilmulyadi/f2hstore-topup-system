@extends('layouts.admin')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                Daftar Pesanan / Transaksi
            </h2>
            <!-- Bisa ditambahkan fitur search/filter di sini nanti -->
        </div>

        <!-- Main Card -->
        <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl">
            <div class="p-6 bg-white border-b border-gray-200">
                
                <!-- Table Container (untuk responsif mobile) -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID Pesanan
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    User
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Produk id
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Harga
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($transactions as $transaction)
                            <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                <!-- ID -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    #{{ $transaction->id }}
                                </td>

                                <!-- User Info -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $transaction->user->name }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $transaction->user->email ?? '-' }}
                                    </div>
                                </td>

                                <!-- Produk -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $transaction->product_id ?? 'Produk Terhapus' }}
                                </td>

                                <!-- Harga -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-800">
                                    Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                                </td>

                                <!-- Status Badge -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($transaction->status == 'SUCCESS')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            SUCCESS
                                        </span>
                                    @elseif($transaction->status == 'PENDING')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            PENDING
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            {{ $transaction->status }}
                                        </span>
                                    @endif
                                </td>

                                <!-- Aksi Form -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    @if($transaction->status != 'SUCCESS')
                                        <form method="POST" action="{{ route('admin.transaksi.update', $transaction->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin mengubah status menjadi SUCCESS?');">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-sm transition-all">
                                                Set Success
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-400 italic text-xs">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                                    Belum ada data transaksi.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination (Optional, jika menggunakan paginate di controller) -->
                @if(method_exists($transactions, 'links'))
                    <div class="mt-4">
                        {{ $transactions->links() }}
                    </div>
                @endif
                
            </div>
        </div>
    </div>
</div>
@endsection