<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::orderBy('name', 'asc')->get();

        return response()->json([
            'success' => true,
            'message' => 'List of games retrieved successfully',
            'data'    => $games
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');

        $game = Game::create([
            'name'      => $request->name,
            'slug'      => Str::slug($request->name),
            'thumbnail' => $thumbnailPath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Game created successfully',
            'data'    => $game
        ], 201);
    }

    // public function show(string $id)
    // {
    //     $game = Game::find($id);

    //     if (!$game) {
    //         return response()->json(['message' => 'Game not found'], 404);
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'data'    => $game
    //     ]);
    // }

    public function show($slug)
{
    // // Cek 1: Apakah route berhasil masuk sini?
    // dd($slug); // <--- Hapus komentar (//) di depan dd ini lalu refresh browser.
    //             //  Jika browser menampilkan layar hitam bertuliskan "mobile-legends", 
    //             //  berarti Route AMAN. Masalahnya ada di Database.

    // Cek 2: Query Database
    $game = Game::where('slug', $slug)->with('products')->firstOrFail();
    
    return view('user.topup.show', [
        'game' => $game
    ]);
}

    public function update(Request $request, string $id)
    {
        $game = Game::find($id);

        if (!$game) {
            return response()->json(['message' => 'Game not found'], 404);
        }

        $request->validate([
            'name'      => 'nullable|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($game->thumbnail && Storage::disk('public')->exists($game->thumbnail)) {
                Storage::disk('public')->delete($game->thumbnail);
            }
            $game->thumbnail = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        if ($request->name) {
            $game->name = $request->name;
            $game->slug = Str::slug($request->name);
        }

        $game->save();

        return response()->json([
            'success' => true,
            'message' => 'Game updated successfully',
            'data'    => $game
        ]);
    }

    public function destroy(string $id)
    {
        $game = Game::find($id);

        if (!$game) {
            return response()->json(['message' => 'Game not found'], 404);
        }

        if ($game->thumbnail && Storage::disk('public')->exists($game->thumbnail)) {
            Storage::disk('public')->delete($game->thumbnail);
        }

        $game->delete();

        return response()->json([
            'success' => true,
            'message' => 'Game deleted successfully'
        ]);
    }
}