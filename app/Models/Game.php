<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi massal
    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
    ];

    /**
     * Mendefinisikan relasi: Satu Game (kategori) memiliki banyak Product.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}