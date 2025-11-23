<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Ambil semua produk beserta data Game-nya
        $products = Product::with('game')->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'message' => 'List of products retrieved successfully',
            'data'    => $products
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'name'    => 'required|string|max:255',
            'price'   => 'required|numeric|min:0',
            'sku'     => 'nullable|string|unique:products,sku',
        ]);

        $product = Product::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Product created successfully',
            'data'    => $product
        ], 201);
    }

    public function show(string $id)
    {
        $product = Product::with('game')->find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $product
        ]);
    }

    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $request->validate([
            'game_id' => 'sometimes|exists:games,id',
            'name'    => 'sometimes|string|max:255',
            'price'   => 'sometimes|numeric|min:0',
            'sku'     => 'nullable|string|unique:products,sku,' . $id,
        ]);

        $product->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully',
            'data'    => $product
        ]);
    }

    public function destroy(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully'
        ]);
    }
}