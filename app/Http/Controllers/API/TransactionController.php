<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Services\FonnteService; // <-- Import Service WA
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * GET: Lihat semua transaksi
     */
    public function index()
    {
        // Load relasi 'product' dan 'user' agar frontend dapat data lengkap
        $transactions = Transaction::with(['product', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'List of transactions retrieved successfully',
            'data' => $transactions
        ]);
    }

    /**
     * POST: User melakukan Top Up (Checkout)
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'target_account' => 'required|string', // ID Game / No HP Tujuan
            'payment_method' => 'required|string', // BCA, GOPAY, DANA, dll
        ]);

        // 2. Ambil data produk untuk tau harganya
        $product = Product::find($request->product_id);

        // 3. Simpan Transaksi
        // Catatan: Auth::id() ?? 1 adalah trik jika belum ada login (User ID 1 dianggap pembeli)
        $transaction = Transaction::create([
            'user_id' => Auth::id() ?? 1,
            'product_id' => $product->id,
            'target_account' => $request->target_account,
            'total_price' => $product->price,
            'status' => 'pending',
            'payment_method' => $request->payment_method,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Transaction created successfully',
            'data' => $transaction
        ], 201);
    }

    /**
     * GET: Detail 1 Transaksi
     */
    public function show(string $id)
    {
        $transaction = Transaction::with(['product', 'user', 'payment'])->find($id);

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $transaction
        ]);
    }

    /**
     * PUT: Admin Mengubah Status (Pending -> Success/Failed)
     * Memicu Notifikasi WhatsApp jika status berubah jadi SUCCESS
     */
    public function update(Request $request, string $id)
    {
        $transaction = Transaction::with(['user', 'product'])->find($id);

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        // Validasi status
        $request->validate([
            'status' => 'required|in:pending,processing,success,failed'
        ]);

        $oldStatus = $transaction->status;

        // Update status
        $transaction->update([
            'status' => $request->status
        ]);

        // --- LOGIKA NOTIFIKASI WHATSAPP ---
        // Jika status berubah menjadi 'success' DAN sebelumnya bukan 'success'
        if ($request->status == 'success' && $oldStatus != 'success') {

            // Cek apakah user punya nomor HP
            if ($transaction->user && $transaction->user->phone) {
                $userPhone = $transaction->user->phone;
                $userName = $transaction->user->name;
                $productName = $transaction->product ? $transaction->product->name : 'Produk';
                $targetAccount = $transaction->target_account;

                $pesan = "Halo kak *$userName*! 👋\n\n" .
                    "Top Up *$productName* kamu BERHASIL! ✅\n" .
                    "ID Tujuan: $targetAccount\n\n" .
                    "Terima kasih sudah belanja di F2H Store.";

                // Panggil Service WA
                FonnteService::sendWhatsApp($userPhone, $pesan);
            }
        }
        // -----------------------------------

        return response()->json([
            'success' => true,
            'message' => 'Transaction status updated successfully',
            'data' => $transaction
        ]);
    }

    /**
     * DELETE: Hapus history transaksi
     */
    public function destroy(string $id)
    {
        $transaction = Transaction::find($id);
        if ($transaction) {
            $transaction->delete();
            return response()->json(['success' => true, 'message' => 'Transaction deleted successfully']);
        }
        return response()->json(['message' => 'Transaction not found'], 404);
    }
}