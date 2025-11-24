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
     * LOGIC 1: HALAMAN LIHAT TRANSAKSI (HISTORY)
     * Menampilkan daftar transaksi milik user yang sedang login.
     */
    public function index()
    {
        // Ambil transaksi milik user, urutkan dari yang terbaru
        $transactions = Transaction::where('user_id', Auth::id())
            ->with('product.game') // Load data produk & game biar lengkap
            ->orderBy('created_at', 'desc')
            ->get();

        // Kirim ke tampilan (sesuaikan nama file blade Agil)
        return view('user.transaction.index', compact('transactions'));
    }

    /**
     * LOGIC 2: PROSES BELI (STORE)
     * Dipanggil saat user klik tombol "Bayar" / "Checkout"
     */
    public function store(Request $request)
    {
        // 1. Validasi Input dari Form Agil
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'target_account' => 'required|string', // ID Game / No HP
            'payment_method' => 'required|string', // BCA, GOPAY, dll
        ]);

        // 2. Ambil info produk (untuk harga)
        $product = Product::find($request->product_id);

        // 3. Simpan Transaksi ke Database
        $transaction = Transaction::create([
            'user_id' => Auth::id() ?? 1, // Default ID 1 jika belum login
            'product_id' => $product->id,
            'target_account' => $request->target_account,
            'total_price' => $product->price,
            'status' => 'pending', // Status awal
            'payment_method' => $request->payment_method,
            'payment_token' => 'INV-' . Str::upper(Str::random(10)), // Kode unik invoice
        ]);

        // 4. Arahkan user ke halaman "Sukses/Detail Transaksi"
        // Kita redirect ke route 'transaction.show' membawa ID transaksi
        return redirect()->route('transaction.show', $transaction->payment_token)
            ->with('success', 'Pesanan berhasil dibuat!');
    }

    /**
     * LOGIC 3: DETAIL / STRUK TRANSAKSI
     * Menampilkan detail satu transaksi setelah beli
     */
    public function show($payment_token)
    {
        // Cari transaksi berdasarkan payment_token (Invoice ID)
        $transaction = Transaction::where('payment_token', $payment_token)
            ->with(['product.game', 'user'])
            ->firstOrFail();

        return view('user.transaction.detail', compact('transaction'));
    }
}
