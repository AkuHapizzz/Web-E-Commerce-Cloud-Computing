# ITB Speedshop - AI Project Context

Dokumen ini berisi informasi mengenai alur kerja (flow) aplikasi, teknologi yang digunakan, dan struktur proyek untuk membantu AI Agent memahami codebase ini dengan cepat.

## 🚀 Teknologi Utama
- **Framework Backend**: Laravel 12.0 (PHP 8.2+)
- **Frontend Engine**: Blade Templating + Vite
- **Styling**: Tailwind CSS
- **Interactivity**: AlpineJS
- **Authentication**: Laravel Breeze
- **Payment Gateway**: Midtrans SDK (`midtrans/midtrans-php`)
- **Database**: MySQL/SQLite (Konfigurasi di `.env`)

## 🛠️ Struktur Direktori Penting
- `routes/web.php`: Definisi semua rute (Guest, Customer, Admin).
- `app/Http/Controllers/`: Logika bisnis utama (Product, Cart, Profile).
- `app/Models/`: Definisi skema data (Product, Order, User).
- `resources/views/`: Semua file UI (Blade templates).
    - `components/`: Komponen reusable (Navbar, Footer, dsb).
    - `admin/`: View khusus panel admin.
    - `cart/`: View keranjang belanja.
- `database/migrations/`: Struktur tabel database.

## 🔄 Alur Aplikasi (Flow)

### 1. Autentikasi
- Menggunakan **Laravel Breeze**.
- Terdapat dua tipe user (`usertype`): `admin` dan `customer`.
- Login/Register dapat diakses melalui rute default Breeze.

### 2. Belanja (Customer Flow)
- **Katalog**: User (Guest/Auth) melihat produk di halaman `/` atau `/categories`.
- **Detail Produk**: Melihat detail produk di `/product/{slug}`.
- **Keranjang (Cart)**:
    - Customer menambah produk ke cart (`/cart/add/{product}`).
    - Lihat isi cart di `/cart`.
- **Checkout**:
    - Proses checkout di `/checkout`.
    - Integrasi Midtrans untuk pembayaran di `CartController@process`.
    - Halaman sukses di `/checkout/success/{order}`.

### 3. Manajemen Produk (Admin Flow)
- Admin mengakses dashboard di `/dashboard`.
- Melakukan CRUD produk di prefix rute `/admin/products`.
- Mengatur stok, harga, dan gambar produk.

### 4. Profil User
- User dapat mengupdate profil dan password di `/profile`.

## 📌 Catatan untuk AI Agent
- **Middleware**: 
    - `auth`: Harus login.
    - `admin`: Harus user dengan `usertype === 'admin'`.
    - `customer`: Harus user dengan `usertype === 'customer'`.
- **Vite**: Selalu jalankan `npm run dev` saat melakukan perubahan pada CSS/JS.
- **Artisan**: Gunakan `php artisan` untuk migrasi, seeder, dan command Laravel lainnya.

---
*Dibuat untuk membantu pemahaman konteks proyek oleh AI Agent.*
