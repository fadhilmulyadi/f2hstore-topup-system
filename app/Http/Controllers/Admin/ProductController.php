<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Product; // Pastikan Model bernama Product (sesuai tabel products)
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Pastikan relasi di model Product bernama 'game'
        $produks = Product::with('game')->latest()->paginate(10);
        return view('admin.produk.index', compact('produks'));
    }

    public function create()
    {
        $games = Game::all();
        return view('admin.produk.create', compact('games'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'name'    => 'required|string|max:255',
            'sku'     => 'required|string|max:100|unique:products,sku',
            'price'   => 'required|numeric|min:0',
        ]);

        Product::create([
            'game_id' => $request->game_id,
            'name'    => $request->name,
            'sku'     => $request->sku,
            'price'   => $request->price,
        ]);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $produk = Product::findOrFail($id);
        $games = Game::all();
        return view('admin.produk.edit', compact('produk', 'games'));
    }

    public function update(Request $request, $id)
    {
        $produk = Product::findOrFail($id);

        $request->validate([
            'game_id' => 'required|exists:games,id',
            'name'    => 'required|string|max:255',
            'sku'     => 'required|string|max:100|unique:products,sku,' . $produk->id,
            'price'   => 'required|numeric|min:0',
        ]);

        $produk->update([
            'game_id' => $request->game_id,
            'name'    => $request->name,
            'sku'     => $request->sku,
            'price'   => $request->price,
        ]);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $produk = Product::findOrFail($id);
        $produk->delete();

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}