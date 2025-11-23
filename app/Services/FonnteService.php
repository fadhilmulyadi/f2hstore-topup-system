<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FonnteService
{
    /**
     * Kirim pesan WhatsApp via Fonnte
     *
     * @param string $target Nomor HP Tujuan (08xx atau 62xx)
     * @param string $message Isi Pesan
     */
    public static function sendWhatsApp(string $target, string $message)
    {
        // Ambil token dari .env (Pastikan Anda sudah tambah FONNTE_TOKEN=... di .env)
        $token = env('FONNTE_TOKEN');

        if (!$token) {
            return false; // Token belum diisi, skip kirim WA
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $token,
            ])->post('https://api.fonnte.com/send', [
                'target' => $target,
                'message' => $message,
                'countryCode' => '62', // Otomatis ubah 08 jadi 62
            ]);

            return $response->json();
        } catch (\Exception $e) {
            // Jika gagal (misal tidak ada internet), jangan bikin error aplikasi
            return false;
        }
    }
}