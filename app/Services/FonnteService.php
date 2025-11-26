<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FonnteService
{
    public static function sendWhatsApp(string $target, string $message)
    {
        $token = env('FONNTE_TOKEN');

        // DEBUG 1: Cek Token
        if (!$token) {
            dump("ERROR: Token Fonnte KOSONG di .env!");
            return false;
        }

        try {
            // PERBAIKAN: Tambahkan withoutVerifying() untuk bypass error SSL cURL 77
            $response = Http::withoutVerifying()->withHeaders([
                'Authorization' => $token,
            ])->post('https://api.fonnte.com/send', [
                        'target' => $target,
                        'message' => $message,
                        'countryCode' => '62',
                    ]);

            // DEBUG 2: Cek Balasan Fonnte
            if ($response->failed()) {
                dump("Gagal Kirim ke Fonnte: " . $response->body());
            } else {
                dump("Sukses Fonnte: " . $response->body());
            }

            return $response->json();
        } catch (\Exception $e) {
            // DEBUG 3: Cek Koneksi Internet/Error Lain
            dump("Exception Error: " . $e->getMessage());
            return false;
        }
    }
}