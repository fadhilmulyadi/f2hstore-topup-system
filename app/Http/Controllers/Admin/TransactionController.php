<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Services\FonnteService; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Import Log untuk debugging jika WA gagal

class TransactionController extends Controller
{
    /**
     * Menampilkan daftar semua transaksi masuk
     */
    public function index()
    {
        // Ambil transaksi urut terbaru
        $transactions = Transaction::with(['user', 'product.game'])
            ->latest() // Shortcut untuk orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.transaksi.index', compact('transactions'));
    }

    /**
     * Update status transaksi menjadi SUCCESS & Kirim WA
     */
    public function update(Request $request, string $id)
    {
        // 1. Cari Transaksi
        $transaction = Transaction::findOrFail($id);

        // 2. Simpan Status Lama (Penting untuk pengecekan agar tidak kirim WA double)
        $oldStatus = $transaction->status;

        // 3. Update Status Baru ke Database
        // Karena tombol di blade Anda khusus "Set Success", kita hardcode 'SUCCESS'
        $transaction->update(['status' => 'SUCCESS']);

        // 4. LOGIKA BOT WHATSAPP
        // Cek: Jika status lama BUKAN 'SUCCESS' (berarti baru saja berubah jadi success)
        if ($oldStatus !== 'SUCCESS') {

            // Gunakan optional() untuk menghindari error jika user/produk sudah terhapus
            $userPhone = optional($transaction->user)->phone;

            if ($userPhone) {
                $userName = optional($transaction->user)->name ?? 'Pelanggan';
                $productName = optional($transaction->product)->name ?? 'Produk';
                $targetAccount = $transaction->target_account ?? '-';
                $invoice = $transaction->id; // Atau $transaction->payment_token jika ada

                // Format Pesan WhatsApp
                $pesan = "Halo kak *$userName*! 👋\n\n" .
                    "✅ Top Up *$productName* kamu BERHASIL!\n\n" .
                    "🆔 ID Tujuan: $targetAccount\n" .
                    "🧾 No. Invoice: #$invoice\n\n" .
                    "Terima kasih sudah belanja di F2H Store! ⭐";

                // Kirim Pesan via Fonnte dalam Try-Catch
                try {
                    // Pastikan class FonnteService sudah benar
                    FonnteService::sendWhatsApp($userPhone, $pesan);
                    
                } catch (\Exception $e) {
                    // Log error tapi JANGAN hentikan proses redirect
                    Log::error("Gagal kirim WA ke $userPhone: " . $e->getMessage());
                }
            }
        }

        // 5. Redirect SETELAH semua proses selesai
        return redirect()->back()->with('success', 'Status berhasil diubah menjadi SUCCESS & Notifikasi WA dikirim (jika nomor valid).');
    }
}