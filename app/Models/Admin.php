<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// Penting: Gunakan Authenticatable agar bisa login
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    // Kolom yang boleh diisi massal
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Kolom yang disembunyikan
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    // Cast tipe data
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}