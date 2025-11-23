<p align="center">
<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
</p>

<h1 align="center">📡 API DOCUMENTATION - F2H STORE</h1>

<p align="center">
Dokumentasi resmi endpoint Backend untuk integrasi Frontend.
</p>

<p align="center">
<a href="#"><img src="https://img.shields.io/badge/Base_URL-http://localhost:8000/api-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Base URL"></a>
<a href="#"><img src="https://img.shields.io/badge/Status-Ready_for_Integration-success?style=for-the-badge" alt="Status"></a>
<a href="#"><img src="https://img.shields.io/badge/Auth-No_Auth_(Dev_Mode)-orange?style=for-the-badge" alt="Auth"></a>
</p>

📋 Daftar Isi

1. Games (Kategori)
2. Products (Item Produk)
3. Transactions (Transaksi)

# 1. 🎮 Games (Kategori)

Mengelola data kategori game (Mobile Legends, PUBG, dll).

GET /games

Mengambil daftar semua game untuk ditampilkan di halaman Home.

### Response Sukses (200 OK):

```json
{
    "success": true,
    "message": "List of games retrieved successfully",
    "data": [
        {
            "id": 1,
            "name": "Mobile Legends",
            "slug": "mobile-legends",
            "thumbnail": "thumbnails/ml.png"
        }
    ]
}
```

POST /games

(Khusus Admin) Menambah game baru beserta gambar thumbnail.

| Parameter | Tipe | Wajib? | Keterangan |
| :--- | :--- | :--- | :--- |
| `name` | Text | Ya | Nama Game (Contoh: "Genshin Impact") |
| `thumbnail` | File | Ya | Format: jpg, png, jpeg (Max 2MB) |

# 2. 💎 Products (Item Produk)

Mengelola item dagangan (100 Diamond, Pulsa 50k, dll).

GET /products

Mengambil semua produk beserta info gamenya.

### Response Sukses (200 OK):
```json
{
    "success": true,
    "message": "List of products retrieved successfully",
    "data": [
        {
            "id": 10,
            "game_id": 1,
            "name": "100 Diamonds",
            "price": 30000,
            "sku": "ML-100",
            "game": {
                "id": 1,
                "name": "Mobile Legends"
            }
        }
    ]
}
```

POST /products

(Khusus Admin) Menambah item produk baru.

| Parameter | Tipe | Wajib? | Keterangan |
| :--- | :--- | :--- | :--- |
| `game_id` | Int | Ya | ID dari Game (Ambil dari endpoint `/games`) |
| `name` | Text | Ya | Nama Item (Contoh: "Starlight Member") |
| `price` | Int | Ya | Harga (Contoh: 150000) |
| `sku` | Text | Tidak | Kode unik barang |
# 3. 💳 Transactions (Transaksi)

Inti dari sistem jual beli.

POST /transactions

User melakukan checkout barang (Membuat pesanan baru).

| Parameter | Tipe | Wajib? | Keterangan |
| :--- | :--- | :--- | :--- |
| `product_id` | Int | Ya | ID produk yang dibeli |
| `target_account` | Text | Ya | ID Game User / No HP Tujuan |
| `payment_method` | Text | Ya | Contoh: "BCA", "DANA", "GOPAY" |

### Response (200 OK)

```json
{
    "success": true,
    "message": "List of games retrieved successfully",
    "data": [
        {
            "id": 1,
            "name": "Mobile Legends",
            "slug": "mobile-legends"
        }
    ]
}
```

PUT /transactions/{id}

(Khusus Admin) Mengubah status pesanan.

🔔 FITUR OTOMATIS: > Jika status diubah menjadi success, sistem akan otomatis mengirim WhatsApp Notifikasi ke nomor HP pembeli.

### Body Request (JSON):

```json
{
    "status": "success"
}
```

Pilihan status: pending, processing, success, failed.

⚠️ Catatan Penting Frontend

Gambar: URL gambar di API hanya berupa path (misal thumbnails/foto.jpg).

Frontend wajib menambahkan base URL storage:

http://localhost:8000/storage/thumbnails/foto.jpg

Error 422: Jika validasi gagal, API akan mengembalikan status 422 dengan detail error.

<p align="center">Backend Documentation by Developer A</p>