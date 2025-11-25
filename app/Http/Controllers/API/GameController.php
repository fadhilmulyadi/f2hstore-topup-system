<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File; // Ganti Storage dengan File untuk manajemen file di public

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
            'status'    => 'nullable',
        ]);

        // LOGIKA BARU: Simpan langsung ke public/images/hero
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            // Buat nama file unik
            $fileName = time() . '_' . $file->getClientOriginalName();
            // Pindahkan file ke folder public/images/hero
            $file->move(public_path('images/hero'), $fileName);
            // Path yang disimpan di database
            $thumbnailPath = 'images/hero/' . $fileName;
        }

        $game = Game::create([
            'name'      => $request->name,
            'slug'      => $request->slug ?? Str::slug($request->name),
            'thumbnail' => $thumbnailPath, 
            'status'    => $request->status ?? 1,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Game created successfully',
            'data'    => $game
        ], 201);
    }

    public function show($slug)
    {
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
            // Hapus gambar lama di folder public jika ada
            $oldPath = public_path($game->thumbnail);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
            
            // Upload gambar baru ke public/images/hero
            $file = $request->file('thumbnail');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/hero'), $fileName);
            
            $game->thumbnail = 'images/hero/' . $fileName;
        }

        if ($request->name) {
            $game->name = $request->name;
            $game->slug = Str::slug($request->name);
        }

        if ($request->has('status')) {
            $game->status = $request->status;
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

        // Hapus file fisik di folder public
        if ($game->thumbnail) {
            $path = public_path($game->thumbnail);
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $game->delete();

        return response()->json([
            'success' => true,
            'message' => 'Game deleted successfully'
        ]);
    }
}