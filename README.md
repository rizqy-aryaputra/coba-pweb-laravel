# SECOND CHANCE

SECOND CHANCE adalah website e-commerce berbasis Laravel yang menyediakan platform jual beli produk fashion mewah preloved (second-hand luxury fashion). Website ini memungkinkan customer untuk melihat koleksi produk, menyimpan produk ke wishlist, melakukan pemesanan, serta memantau status pesanan. Admin dapat mengelola produk dan memproses pesanan pelanggan melalui dashboard yang telah disediakan.

## Fitur

### Customer
- Register dan Login
- Melihat koleksi produk
- Melihat detail produk
- Menambahkan produk ke Wishlist
- Menghapus produk dari Wishlist
- Checkout produk
- Melihat riwayat pesanan
- Melihat status pesanan (Pending, Confirmed, Cancelled)
- Dark Mode Preference

### Admin
- Login
- Dashboard Admin
- Melihat statistik produk
- Melihat statistik customer
- Melihat total pesanan
- Melihat pendapatan
- CRUD Produk
  - Tambah Produk
  - Edit Produk
  - Hapus Produk
  - Lihat Produk
- Mengelola Pesanan
  - Konfirmasi Pesanan
  - Membatalkan Pesanan

---

## Teknologi yang Digunakan

- Laravel
- PHP
- MySQL
- Blade Template Engine
- CSS
- JavaScript
- Laravel Breeze Authentication

---

## Database

### Tabel Users
- id
- name
- email
- password
- role

### Tabel Products
- id
- user_id
- kode
- nama
- kategori
- stok
- harga
- tanggal_masuk
- foto

### Tabel Wishlists
- id
- user_id
- product_id

### Tabel Orders
- id
- user_id
- product_id
- name
- phone
- address
- total_price
- status

---

## Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/username/second-chance.git
```

### 2. Masuk ke Folder Project

```bash
cd second-chance
```

### 3. Install Dependency

```bash
composer install
npm install
```

### 4. Copy Environment File

```bash
cp .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Konfigurasi Database

Edit file `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=secondchance_db
DB_USERNAME=root
DB_PASSWORD=
```

### 7. Migrasi Database

```bash
php artisan migrate
```

### 8. Jalankan Vite

```bash
npm run dev
```

### 9. Jalankan Server Laravel

```bash
php artisan serve
```

Buka browser:

```text
http://127.0.0.1:8000
```

---

## Struktur Role

### Admin
Admin memiliki akses untuk:
- Dashboard
- Manajemen Produk
- Manajemen Pesanan

### Customer
Customer memiliki akses untuk:
- Dashboard
- Wishlist
- Checkout
- Riwayat Pesanan

---

## Status Pesanan

- Pending
- Confirmed
- Cancelled

---

## Pengembang

Project ini dikembangkan sebagai tugas mata kuliah Pemrograman Web menggunakan Laravel Framework.
