<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi massal
    protected $fillable = [
        'game_id',
        'name',
        'sku',
        'price',
        'description',
    ];

    /**
     * Mendefinisikan relasi: Satu Product dimiliki oleh satu Game (kategori).
     */
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}