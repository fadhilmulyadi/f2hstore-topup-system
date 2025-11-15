<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Game; // <-- IMPORT MODEL GAME
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data game, urutkan berdasarkan nama
        $games = Game::orderBy('name', 'asc')->get();

        // Kembalikan data sebagai JSON
        return response()->json([
            'success' => true,
            'message' => 'Daftar data game (kategori)',
            'data'    => $games
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Nanti kita isi untuk 'CREATE' data
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Nanti kita isi untuk 'GET' 1 data
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Nanti kita isi untuk 'UPDATE' data
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Nanti kita isi untuk 'DELETE' data
    }
}