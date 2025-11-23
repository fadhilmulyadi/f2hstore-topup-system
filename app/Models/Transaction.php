<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi massal
    protected $fillable = [
        'user_id',
        'product_id',
        'target_account',
        'total_price',
        'status',
        'payment_token',
    ];

    /**
     * Relasi: Satu Transaksi dimiliki oleh satu User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: Satu Transaksi milik satu Product.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relasi: Satu Transaksi memiliki satu Payment.
     */
    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }
}