<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    /**
     * FITUR BARU: CEK TRANSAKSI & SEARCH
     * - Tamu: Cuma bisa search invoice.
     * - Member: Bisa liat history sendiri di tabel bawah.
     */
    public function check(Request $request)
    {
        // 1. LOGIKA PENCARIAN (Tetap Sama)
        if ($request->has('invoice') && $request->invoice != null) {
            // Cari transaksi berdasarkan Invoice ID
            $transaction = Transaction::where('payment_token', $request->invoice)->first();

            if ($transaction) {
                // Jika ketemu, arahkan ke struk
                return redirect()->route('transaction.show', $transaction->payment_token);
            } else {
                // Jika tidak ketemu, error
                return back()->with('error', 'Nomor Invoice tidak ditemukan!');
            }
        }

        // 2. LOGIKA TABEL BAWAH (DIBUAT PRIVAT)
        $myTransactions = []; // Default kosong buat tamu (Sesuai request Agil)

        if (Auth::check()) {
            // Kalau user LOGIN, baru kita ambil datanya
            $myTransactions = Transaction::where('user_id', Auth::id())
                ->with('product.game')
                ->orderBy('created_at', 'desc')
                ->take(10) // Tampilkan 10 terakhir saja
                ->get();
        }

        // Kirim variabel $myTransactions ke view
        return view('user.transaction.check', compact('myTransactions'));
    }

    /**
     * LOGIC 1: HALAMAN LIHAT TRANSAKSI (HISTORY FULL)
     * Dipakai di menu "History Transaksi" (jika ada)
     */
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id())
            ->with('product.game')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.transaction.index', compact('transactions'));
    }

    /**
     * LOGIC 2: PROSES BELI (STORE)
     * Dipakai saat klik tombol "Beli Sekarang"
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'target_account' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        $product = Product::find($request->product_id);

        // SIMPAN TRANSAKSI
        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'target_account' => $request->target_account,
            'total_price' => $product->price,
            'status' => 'pending',
            'payment_method' => $request->payment_method,
            'payment_token' => 'INV-' . Str::upper(Str::random(10)),
        ]);

        return redirect()->route('transaction.show', $transaction->payment_token)
            ->with('success', 'Pesanan berhasil dibuat!');
    }

    /**
     * LOGIC 3: DETAIL / STRUK TRANSAKSI
     * Dipakai setelah beli atau saat cek invoice
     */
    public function show($payment_token)
    {
        $transaction = Transaction::where('payment_token', $payment_token)
            ->with(['product.game', 'user'])
            ->firstOrFail();

        return view('user.transaction.detail', compact('transaction'));
    }
}