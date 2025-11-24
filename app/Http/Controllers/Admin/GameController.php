<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class GameController extends Controller
{
    public function index()
    {
        $games = Game::latest()->paginate(10);
        $totalGames = Game::count();
        $totalProducts = Product::count();

        // Kirim variabel ke view
        return view('admin.game.index', compact('games'));
        return view('admin.dashboard', compact('totalGames', 'totalProducts'));
        
    }

    public function create()
    {
        return view('admin.game.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'slug'      => 'required|string|unique:games,slug|max:255',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload Thumbnail ke folder 'thumbnails' sesuai seeder
        $path = null;
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Game::create([
            'name'      => $request->name,
            'slug'      => $request->slug,
            'thumbnail' => $path,
        ]);

        return redirect()->route('admin.game.index')->with('success', 'Game berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $game = Game::findOrFail($id);
        return view('admin.game.edit', compact('game'));
    }

    public function update(Request $request, $id)
    {
        $game = Game::findOrFail($id);

        $request->validate([
            'name'      => 'required|string|max:255',
            'slug'      => 'required|string|max:255|unique:games,slug,' . $game->id,
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'slug' => $request->slug,
        ];

        if ($request->hasFile('thumbnail')) {
            // Hapus thumbnail lama jika ada
            if ($game->thumbnail && Storage::disk('public')->exists($game->thumbnail)) {
                Storage::disk('public')->delete($game->thumbnail);
            }
            // Simpan thumbnail baru
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $game->update($data);

        return redirect()->route('admin.game.index')->with('success', 'Game berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $game = Game::findOrFail($id);

        if ($game->thumbnail && Storage::disk('public')->exists($game->thumbnail)) {
            Storage::disk('public')->delete($game->thumbnail);
        }

        $game->delete();

        return redirect()->route('admin.game.index')->with('success', 'Game berhasil dihapus!');
    }
}