@extends('layouts.admin')

@section('header', 'Kelola Game')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Daftar Game</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola game yang tersedia untuk top up.</p>
        </div>
        <a href="{{ route('admin.game.create') }}" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl shadow-lg shadow-indigo-200 transition-all flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Game
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-lg shadow-gray-100/50 border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Game Info</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Slug / Code</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($games as $game)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <img class="h-12 w-12 rounded-lg object-cover shadow-sm border border-gray-200" src="{{ asset(''.$game->thumbnail) }}" alt="">
                                <span class="font-semibold text-gray-700">{{ $game->nama_game }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-600 font-mono text-sm">
                            {{ $game->slug }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs font-medium rounded-full {{ $game->status == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ ucfirst($game->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.game.edit', $game->id) }}" class="text-indigo-600 hover:text-indigo-800 font-medium text-sm">Edit</a>
                            <form action="{{ route('admin.game.destroy', $game->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus game ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 font-medium text-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100">
            </div>
    </div>
</div>
@endsection