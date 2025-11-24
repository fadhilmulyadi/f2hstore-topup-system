<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Services\FonnteService; 
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Menampilkan daftar semua transaksi masuk
     */
    public function index()
    {
        // Ambil transaksi urut terbaru, load relasi user & product biar tidak berat
        $transactions = Transaction::with(['user', 'product.game'])
            ->orderBy('created_at', 'desc')
            ->paginate(10); // Tampilkan 10 per halaman

        return view('admin.transaction.index', compact('transactions'));
    }

    /**
     * Update status transaksi (Pending -> Success/Failed)
     * Ini tombol pemicu Bot WhatsApp!
     */
    public function update(Request $request, string $id)
    {
        $transaction = Transaction::with(['user', 'product'])->findOrFail($id);

        // Validasi input status dari form admin
        $request->validate([
            'status' => 'required|in:pending,processing,success,failed'
        ]);

        $oldStatus = $transaction->status;

        // Simpan status baru ke database
        $transaction->update([
            'status' => $request->status
        ]);

        // --- LOGIKA BOT WHATSAPP ---
        // Kirim notifikasi HANYA JIKA status berubah jadi 'success'
        if ($request->status == 'success' && $oldStatus != 'success') {

            // Ambil nomor HP user
            $userPhone = $transaction->user->phone;

            if ($userPhone) {
                $userName = $transaction->user->name;
                $productName = $transaction->product ? $transaction->product->name : 'Produk';
                $targetAccount = $transaction->target_account;
                $invoice = $transaction->payment_token;

                // Format Pesan WhatsApp
                $pesan = "Halo kak *$userName*! 👋\n\n" .
                    "✅ Top Up *$productName* kamu BERHASIL!\n\n" .
                    "🆔 ID Tujuan: $targetAccount\n" .
                    "🧾 No. Invoice: $invoice\n\n" .
                    "Terima kasih sudah belanja di F2H Store! ⭐";

                // Kirim Pesan via Fonnte
                try {
                    FonnteService::sendWhatsApp($userPhone, $pesan);
                } catch (\Exception $e) {
                    // Jika gagal kirim WA, biarkan saja agar tidak error di web admin
                    // Bisa tambahkan Log::error($e) jika mau
                }
            }
        }
        // ---------------------------

        return redirect()->back()->with('success', 'Status transaksi diperbarui! Notifikasi WA dikirim (jika sukses).');
    }
}