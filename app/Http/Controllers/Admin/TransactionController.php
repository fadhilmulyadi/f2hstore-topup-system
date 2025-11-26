<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Services\FonnteService; // <-- Wajib Import Service WA
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Menampilkan daftar semua transaksi masuk
     */
    public function index()
    {
        // Ambil data transaksi urut dari yang terbaru
        $transactions = Transaction::with(['user', 'product.game'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.transaksi.index', compact('transactions'));
    }

    /**
     * Update status transaksi (Pending -> Success)
     * INI LOGIKA UTAMA YANG DIMINTA AGIL
     */
    public function update(Request $request, string $id)
    {
        // 1. Cari Transaksi
        $transaction = Transaction::with(['user', 'product'])->findOrFail($id);

        // 2. Validasi Input (Harus salah satu status yang valid)
        $request->validate([
            'status' => 'required|in:pending,processing,success,failed'
        ]);

        // Simpan status lama untuk pengecekan
        $oldStatus = $transaction->status;

        // 3. Update Status Baru ke Database
        $transaction->update([
            'status' => $request->status
        ]);

        // ==================================================
        // 🔥 LOGIKA BOT WHATSAPP (AUTO SEND) 🔥
        // ==================================================
        // Syarat kirim WA:
        // 1. Status baru harus 'success'
        // 2. Status lama BUKAN 'success' (supaya tidak kirim double kalau di-refresh)

        if ($request->status == 'success' && $oldStatus != 'success') {

            // Ambil nomor HP user dari relasi
            $userPhone = $transaction->user->phone;

            // Pastikan user punya nomor HP
            if ($userPhone) {
                // Siapkan Data Pesan
                $userName = $transaction->user->name;
                $productName = $transaction->product ? $transaction->product->name : 'Produk';
                $targetAccount = $transaction->target_account;
                $invoice = $transaction->payment_token;
                $price = number_format($transaction->total_price, 0, ',', '.');

                // Format Pesan WhatsApp yang Rapi
                $pesan = "Halo kak *$userName*! 👋\n\n" .
                    "✅ *Top Up BERHASIL!*\n" .
                    "--------------------------------\n" .
                    "📦 Produk: *$productName*\n" .
                    "🆔 ID Tujuan: $targetAccount\n" .
                    "💰 Nominal: Rp $price\n" .
                    "🧾 No. Invoice: $invoice\n" .
                    "--------------------------------\n\n" .
                    "Terima kasih sudah belanja di F2H Store! ⭐\n" .
                    "Simpan bukti ini jika ada kendala.";

                // Panggil Service Fonnte untuk kirim pesan
                try {
                    FonnteService::sendWhatsApp($userPhone, $pesan);
                } catch (\Exception $e) {
                    // Kalau error (misal internet mati), biarkan saja (Silent Fail)
                    // Agar halaman admin tidak crash
                }
            }
        }
        // ==================================================

        return redirect()->back()->with('success', 'Status transaksi diperbarui!');
    }
}