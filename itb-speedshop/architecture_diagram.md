# Diagram Arsitektur Integrasi Midtrans

Berikut adalah diagram arsitektur yang menunjukkan alur integrasi aplikasi E-Commerce (berbasis Laravel) dengan *Payment Gateway* Midtrans.

```mermaid
sequenceDiagram
    autonumber
    actor User
    participant WebApp as Web E-Commerce (Laravel)
    participant Database
    participant Midtrans as Midtrans (Snap API)
    
    User->>WebApp: Checkout & Pilih Pembayaran
    WebApp->>Database: Simpan Data Order (Status: Pending)
    WebApp->>Midtrans: Request Snap Token (Kirim data order, nominal, dll)
    Midtrans-->>WebApp: Kembalikan Snap Token
    WebApp-->>User: Tampilkan Halaman Checkout dengan Tombol Bayar
    User->>WebApp: Klik Tombol "Bayar Sekarang"
    WebApp->>Midtrans: Menampilkan Pop-up Pembayaran (Snap UI)
    User->>Midtrans: Melakukan Pembayaran (Transfer Bank, GoPay, dll)
    Midtrans-->>User: Pembayaran Selesai / Menunggu
    
    %% Webhook Notification Asynchronous
    Note over WebApp, Midtrans: Asynchronous Notification (Webhook) berjalan di belakang layar
    Midtrans->>WebApp: HTTP POST ke Webhook Endpoint (/api/midtrans-notification)
    WebApp->>WebApp: Verifikasi Signature Key (Keamanan)
    WebApp->>Database: Update Status Order (Success / Settlement / Expire / Cancel)
    WebApp-->>Midtrans: Respon HTTP 200 OK (Tanda terima sukses)
```

## Komponen Utama Arsitektur

```mermaid
graph TD
    Client([Browser / User]) --> |Akses Website & Checkout| Laravel
    
    subgraph "Server Aplikasi (ITB SpeedShop)"
        Laravel[Aplikasi Laravel]
        Controllers[Controllers<br>- CheckoutController<br>- PaymentCallbackController]
        Models[Models<br>- Order, User, Product]
        Views[Blade Views<br>- checkout.blade.php]
        
        Laravel --> Controllers
        Controllers --> Models
        Controllers --> Views
    end
    
    subgraph "Database Server"
        DB[(MySQL Database)]
    end
    
    subgraph "Midtrans Payment Gateway"
        SnapAPI[Midtrans Snap API]
        Webhook[Midtrans Webhook / Notification]
    end

    Models <--> |Read/Write| DB
    Controllers --> |Request Token| SnapAPI
    SnapAPI --> |Return Token| Controllers
    
    Views --> |Snap.js Load Token| Client
    Client --> |Proses Transaksi| SnapAPI
    
    Webhook --> |Kirim Notifikasi Status| Laravel
```

## Penjelasan Alur Integrasi
1. **Inisiasi Checkout**: Saat user melakukan checkout, aplikasi akan menyimpan data order ke dalam database dengan status `Pending`.
2. **Request Token**: Aplikasi Laravel menggunakan **Midtrans Snap API** untuk mengirimkan detail pembayaran (ID Order, total harga, info user). Midtrans akan membalas dengan sebuah `snap_token`.
3. **Menampilkan UI Pembayaran**: Halaman `checkout.blade.php` akan memuat file javascript dari Midtrans (`snap.js`) dan menggunakan `snap_token` tersebut untuk memunculkan pop-up pilihan metode pembayaran kepada user.
4. **Proses Bayar**: User memilih metode pembayaran (BCA VA, GoPay, Kartu Kredit, dll) dan menyelesaikan transaksi.
5. **Webhook/Notification (Penting)**: Ini adalah jalur utama untuk memastikan kebenaran status pembayaran. Setelah user membayar, Midtrans secara otomatis akan menembak sebuah endpoint di server kita (Webhook) melalui metode `POST`. Server kita akan memvalidasi *signature* dari Midtrans dan mengupdate status pesanan di database menjadi `Settlement` (sukses) atau lainnya.
