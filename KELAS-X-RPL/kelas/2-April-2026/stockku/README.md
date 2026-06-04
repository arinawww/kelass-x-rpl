# Stockku - Premium Point of Sale (POS)

Stockku adalah aplikasi Point of Sale (POS) premium berbasis _web_ yang dibangun menggunakan ekosistem **Laravel 12**. Antarmukanya menggunakan desain _Glassmorphism_ interaktif dengan tema gelap (_Dark Mode_), memberikan impresi yang sangat modern dan premium bagi pengguna (kasir maupun admin).

## 🚀 Fitur Utama

- **Premium UI/UX:** Tema gelap (_Dark Mode_) dengan elemen tembus pandang bergaya _Glassmorphism_. Dilengkapi lencana dinamis (Badge) dan animasi efek _hover_ yang lembut.
- **Kalkulator Kasir Real-Time (Interactive POS):** Layar kasir diperlengkapi dengan penghitungan subtotal dan kembalian secara _real-time_ via JavaScript tanpa perlu melakukan _refresh_ halaman. Sistem ini juga dilengkapi dengan validasi otomatis yang mencegah uang bayar kurang dari total item.
- **Multi-Role Authentication & Authorization:** Sistem _login_ aman yang secara ketat merute pengguna ke fungsi spesifik mereka berdasarkan peranan (_Role_).
- **Manajemen Inventaris:** Laporan detail, tambah, perbarui, dan hapus stok produk interaktif.
- **Riwayat Transaksi:** Pencatatan otomatis mendetail untuk setiap transaksi yang terjadi di sistem kasir, memberikan wawasan yang cepat terkait sirkulasi penjualan.

---

## 👥 Manajemen Hak Akses (Role-Based Access Control)

Aplikasi ini dibagi menjadi 4 peranan sistem (_Role_) spesifik yang memiliki fungsi dan akses dasbor masing-masing setelah mereka **Log In**:

| Peranan (Role) | Akses Fitur Utama                                          | Batasan Khusus                                                                                        |
| -------------- | ---------------------------------------------------------- | ----------------------------------------------------------------------------------------------------- |
| **`admin`**    | Akses Penuh Sistem (CRUD Produk, Kasir, Laporan Transaksi) | Tidak Ada                                                                                             |
| **`kasir`**    | **Mulai Kasir** (Transaksi Pelanggan Cepat)                | Tidak bisa mengolah/melihat data selain antarmuka POS                                                 |
| **`gudang`**   | **Update Stok Produk**                                     | Hanya dapat mengedit ketersediaan stok produk dan nama produk (Tanpa bisa hapus & tambah produk baru) |
| **`owner`**    | **Laporan Stok** & **Laporan Penjualan**                   | Semua akses bersifat _Read-Only_ (Hanya bisa membaca informasi)                                       |

Karyawan dengan hak akses tertentu hanya dapat beroperasi di _dashboard_ khusus mereka yang diatur secara otomatis oleh sistem `RoleMiddleware`.

---

## 🧰 Teknologi yang Digunakan

| Kategori       | Teknologi                                   |
| -------------- | ------------------------------------------- |
| **Framework**  | Laravel 12 (PHP ≥ 8.2)                      |
| **Templating** | Blade (`.blade.php`)                        |
| **CSS**        | Bootstrap 5.3 + Custom CSS (Glassmorphism)  |
| **Font**       | Google Fonts — Outfit                       |
| **JavaScript** | Vanilla JS (kalkulasi kasir real-time)      |
| **Database**   | MySQL / MariaDB / SQLite (via Eloquent ORM) |
| **Build Tool** | Vite                                        |
| **Auth**       | Laravel Auth manual (Session-Based)         |

---

## 🔨 Proses & Urutan Pengerjaan Website

Berikut adalah tahapan pengembangan proyek Stockku dari awal hingga selesai, disusun secara kronologis berdasarkan urutan pengerjaan sesungguhnya.

### Fase 1 — Inisialisasi Proyek Laravel

**Tujuan:** Membuat fondasi proyek dengan framework Laravel.

1. **Membuat proyek baru** dengan perintah `composer create-project laravel/laravel stockku`.
2. **Konfigurasi `.env`** — mengatur koneksi database (`DB_CONNECTION`, `DB_DATABASE`, dll).
3. **Generate Application Key** — `php artisan key:generate` untuk keamanan enkripsi session.

> File yang terlibat: `.env`, `composer.json`, `config/database.php`

---

### Fase 2 — Perancangan Database (Migrations)

**Tujuan:** Merancang cetak biru (_blueprint_) struktur tabel database menggunakan sistem Migration Laravel.

Urutan pembuatan migration sangat penting karena ada relasi antar tabel:

| Urutan | File Migration                                         | Tabel yang Dibuat      | Penjelasan                                                                                   |
| :----: | ------------------------------------------------------ | ---------------------- | -------------------------------------------------------------------------------------------- |
|   1    | `0001_01_01_000000_create_users_table.php`             | `users`, `sessions`    | Tabel bawaan Laravel untuk user dan sesi. Berisi `name`, `email`, `password`.                |
|   2    | `0001_01_01_000001_create_cache_table.php`             | `cache`, `cache_locks` | Tabel bawaan Laravel untuk sistem caching.                                                   |
|   3    | `0001_01_01_000002_create_jobs_table.php`              | `jobs`, `job_batches`  | Tabel bawaan Laravel untuk sistem antrian (queue).                                           |
|   4    | `2026_03_25_103712_create_products_table.php`          | `products`             | Tabel produk dengan kolom `name`, `price` (integer), dan `stock` (default: 0).               |
|   5    | `2026_03_26_070125_create_transactions_table.php`      | `transactions`         | Tabel transaksi dengan `total_price`, `paid`, dan `change`.                                  |
|   6    | `2026_03_26_070149_create_transaction_items_table.php` | `transaction_items`    | Tabel detail item per transaksi. Memiliki **Foreign Key** ke `transactions` dan `products`.  |
|   7    | `2026_03_26_075322_add_role_to_users_table.php`        | _(alter `users`)_      | Menambah kolom `role` bertipe `enum` (`admin`, `kasir`, `gudang`, `owner`) ke tabel `users`. |

**Catatan penting:** Migration ke-6 (`transaction_items`) wajib dibuat _setelah_ tabel `transactions` dan `products` karena ia menggunakan `foreignId()->constrained()->cascadeOnDelete()` yang mereferensikan kedua tabel tersebut.

Setelah semua file migration siap, jalankan:

```bash
php artisan migrate
```

---

### Fase 3 — Pembuatan Model (Eloquent ORM)

**Tujuan:** Membuat representasi PHP dari setiap tabel database agar bisa berinteraksi dengan data menggunakan Eloquent ORM.

| Urutan | File Model                       | Properti `$fillable`                           |
| :----: | -------------------------------- | ---------------------------------------------- |
|   1    | `app/Models/User.php`            | `name`, `email`, `password`, `role`            |
|   2    | `app/Models/Product.php`         | `name`, `price`, `stock`                       |
|   3    | `app/Models/Transaction.php`     | `total_price`, `paid`, `change`                |
|   4    | `app/Models/TransactionItem.php` | `transaction_id`, `product_id`, `qty`, `price` |

Model `User` juga dilengkapi dengan _casting_ otomatis: `password` di-hash secara transparan dan `email_verified_at` di-_cast_ ke `datetime`.

---

### Fase 4 — Sistem Autentikasi (Auth)

**Tujuan:** Membangun sistem Login, Register, dan Logout secara manual (tanpa Laravel Breeze/Jetstream).

**File:** `app/Http/Controllers/AuthController.php`

Alur kerja yang dibangun:

1. **Register** — Validasi input (nama, email unik, password min 6 karakter + konfirmasi, pilih role). Buat user baru dengan password di-hash via `Hash::make()`. Auto-login setelah register, lalu redirect ke dashboard sesuai role.

2. **Login** — Validasi kredensial via `Auth::attempt()`. Regenerasi session untuk keamanan. Redirect ke `{role}.dashboard` secara dinamis.

3. **Logout** — Hapus session via `Auth::logout()`, invalidasi session token, dan redirect ke halaman utama.

---

### Fase 5 — Middleware Otorisasi (Role-Based Access)

**Tujuan:** Membuat "penjaga pintu" yang memastikan setiap halaman hanya bisa diakses oleh role yang berhak.

**File:** `app/Http/Middleware/RoleMiddleware.php`

Logika inti middleware:

```php
// Admin selalu diizinkan masuk ke semua halaman
if (Auth::user()->role === 'admin' || in_array(Auth::user()->role, $roles)) {
    return $next($request); // Lanjutkan akses
}
abort(403, 'Akses Ditolak.');
```

**Registrasi Middleware** dilakukan di `bootstrap/app.php`:

```php
$middleware->alias([
    'role' => \App\Http\Middleware\RoleMiddleware::class,
]);
```

---

### Fase 6 — Routing (Pemetaan URL)

**Tujuan:** Mendefinisikan seluruh URL aplikasi dan menghubungkannya ke Controller + Middleware yang tepat.

**File:** `routes/web.php`

Struktur routing dibagi per role dengan _middleware group_:

```
GET  /                          → Welcome Page (redirect ke dashboard jika sudah login)
GET  /login                     → Form Login
POST /login                     → Proses Login
GET  /register                  → Form Register
POST /register                  → Proses Register
POST /logout                    → Proses Logout

[middleware: auth + role:kasir]
GET  /kasir/dashboard            → Dashboard Kasir
GET  /kasir                      → Halaman POS (Kasir)
POST /kasir                      → Proses Transaksi
GET  /kasir/transactions         → Riwayat Transaksi Kasir

[middleware: auth + role:admin]
GET  /admin/dashboard            → Dashboard Admin
CRUD /admin/products             → Kelola Produk (Resource Route)
GET  /admin/transactions         → Riwayat Transaksi Admin

[middleware: auth + role:gudang]
GET  /gudang/dashboard           → Dashboard Gudang
GET  /gudang/products            → Lihat Daftar Produk
GET  /gudang/products/{id}/edit  → Form Edit Produk
PUT  /gudang/products/{id}       → Proses Update Produk

[middleware: auth + role:owner]
GET  /owner/dashboard            → Dashboard Owner
GET  /owner/products             → Laporan Stok (Read-Only)
GET  /owner/transactions         → Laporan Penjualan (Read-Only)
```

---

### Fase 7 — Controller (Logika Bisnis)

**Tujuan:** Mengimplementasikan seluruh logika bisnis aplikasi.

#### 7a. `ProductController` — CRUD Produk

| Method      | Fungsi                                    |
| ----------- | ----------------------------------------- |
| `index()`   | Menampilkan semua produk                  |
| `create()`  | Menampilkan form tambah produk            |
| `store()`   | Validasi & simpan produk baru ke database |
| `edit($id)` | Menampilkan form edit produk tertentu     |
| `update()`  | Validasi & perbarui data produk           |
| `destroy()` | Hapus produk dari database                |

> `update()` memiliki logika dinamis: jika role `gudang`, redirect ke `gudang.products`; jika `admin`, redirect ke `products.index`.

#### 7b. `TransactionController` — Proses Kasir & Riwayat

| Method      | Fungsi                                                                          |
| ----------- | ------------------------------------------------------------------------------- |
| `index()`   | Ambil produk dengan stok > 0, kirim ke view POS                                 |
| `store()`   | Validasi item & bayaran → Hitung total → Simpan transaksi + item → Kurangi stok |
| `history()` | Ambil semua transaksi terbaru, kirim ke view riwayat                            |

Alur proses `store()` secara detail:

1. Validasi bahwa `items` adalah array dan `paid` adalah angka ≥ 0.
2. Loop setiap item: cek apakah `product_id` valid dan stok mencukupi.
3. Hitung `total_price` dari semua item valid.
4. Cek apakah `paid ≥ total` (jika kurang, tolak).
5. Simpan record ke tabel `transactions`.
6. Simpan setiap item ke tabel `transaction_items`.
7. Kurangi stok produk di tabel `products`.

---

### Fase 8 — Desain Antarmuka (Views & Blade Templates)

**Tujuan:** Membangun seluruh halaman UI dengan Blade templating engine dan desain Glassmorphism premium.

#### 8a. Layout Utama — `layouts/app.blade.php`

Fondasi desain seluruh halaman. Yang dibangun di sini:

- **CSS Variables** — Palet warna: `--primary: #6366f1`, `--accent: #ec4899`, `--bg-color: #0f172a`, dll.
- **Glassmorphism** — `.glass-card` dengan `backdrop-filter: blur(16px)` dan background semi-transparan.
- **Navbar Dinamis** — Menampilkan menu navigasi berbeda berdasarkan role user yang sedang login (`@auth` + `@if(Auth::user()->role)`).
- **Flash Messages** — Alert untuk pesan sukses/error dengan gaya glass.
- **Animasi** — `@keyframes fadeIn` untuk transisi halaman yang halus.
- **Typography** — Font Google Fonts `Outfit` untuk kesan modern.

#### 8b. Halaman-Halaman Aplikasi

| Urutan | View File                      | Fungsi                                      |
| :----: | ------------------------------ | ------------------------------------------- |
|   1    | `welcome.blade.php`            | Landing page dengan hero section & CTA      |
|   2    | `auth/login.blade.php`         | Form login dengan glass-card centered       |
|   3    | `auth/register.blade.php`      | Form register dengan dropdown pilih role    |
|   4    | `dashboard.blade.php`          | Dashboard dinamis (card menu beda per role) |
|   5    | `products/index.blade.php`     | Tabel produk dengan badge stok berwarna     |
|   6    | `products/create.blade.php`    | Form tambah produk baru                     |
|   7    | `products/edit.blade.php`      | Form edit produk (multi-role aware)         |
|   8    | `kasir/index.blade.php`        | Antarmuka POS interaktif                    |
|   9    | `transactions/index.blade.php` | Tabel riwayat transaksi                     |

#### 8c. JavaScript Kasir Real-Time — `kasir/index.blade.php`

Fitur interaktif yang dibangun murni dengan Vanilla JavaScript:

- **Checkbox produk** — Centang untuk memilih produk, otomatis aktifkan input qty.
- **Kalkulasi total** — Setiap perubahan qty langsung menghitung ulang subtotal.
- **Kalkulasi kembalian** — Otomatis menampilkan kembalian saat `paid` diinput.
- **Validasi tombol** — Tombol "PROSES TRANSAKSI" hanya aktif jika ada item terpilih DAN uang bayar mencukupi.
- **Format Rupiah** — Menggunakan `Intl.NumberFormat('id-ID')` untuk format mata uang Indonesia.

---

### Fase 9 — Pengujian & Finalisasi

**Tujuan:** Memastikan seluruh fitur berjalan benar.

1. **Test Migrasi** — Pastikan `php artisan migrate` berhasil tanpa error.
2. **Test Register** — Daftar akun untuk setiap role (Admin, Kasir, Gudang, Owner).
3. **Test Login/Logout** — Pastikan redirect ke dashboard yang benar per role.
4. **Test Middleware** — Coba akses URL role lain (harus muncul 403).
5. **Test CRUD Produk** — Tambah, edit, hapus produk sebagai Admin.
6. **Test Kasir** — Proses transaksi, cek pengurangan stok otomatis.
7. **Test Riwayat** — Pastikan transaksi tercatat dengan data yang benar.
8. **Test Gudang** — Pastikan hanya bisa edit stok, tidak bisa hapus/tambah.
9. **Test Owner** — Pastikan semua halaman bersifat read-only.

---

## 📁 Struktur Folder Proyek

```
stockku/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php          ← Login, Register, Logout
│   │   │   ├── ProductController.php       ← CRUD Produk
│   │   │   └── TransactionController.php   ← Kasir & Riwayat
│   │   └── Middleware/
│   │       └── RoleMiddleware.php          ← Penjaga hak akses per role
│   └── Models/
│       ├── User.php                        ← Model user + role
│       ├── Product.php                     ← Model produk
│       ├── Transaction.php                 ← Model transaksi
│       └── TransactionItem.php             ← Model detail item transaksi
├── bootstrap/
│   └── app.php                             ← Registrasi middleware alias
├── database/
│   └── migrations/                         ← 7 file cetak biru tabel
├── resources/
│   └── views/
│       ├── layouts/app.blade.php           ← Master layout (Glassmorphism)
│       ├── welcome.blade.php               ← Landing page
│       ├── dashboard.blade.php             ← Dashboard dinamis per role
│       ├── auth/
│       │   ├── login.blade.php             ← Halaman login
│       │   └── register.blade.php          ← Halaman register
│       ├── products/
│       │   ├── index.blade.php             ← Daftar produk + aksi
│       │   ├── create.blade.php            ← Form tambah produk
│       │   └── edit.blade.php              ← Form edit produk
│       ├── kasir/
│       │   └── index.blade.php             ← Antarmuka POS interaktif
│       └── transactions/
│           └── index.blade.php             ← Riwayat transaksi
├── routes/
│   └── web.php                             ← Seluruh definisi URL + middleware
├── .env                                    ← Konfigurasi lingkungan
├── composer.json                           ← Dependensi PHP
└── vite.config.js                          ← Konfigurasi build frontend
```

---

## 🧠 Arsitektur MVC & Cara Kerjanya

**Laravel** menggunakan arsitektur **MVC (Model-View-Controller)** yang memisahkan antara logika data, tampilan antarmuka, dan pengontrol jalannya aplikasi.

### Alur Request di Stockku

```
Browser (User)
    │
    ▼
┌─────────────────────┐
│  1. ROUTING          │  routes/web.php
│  "Papan petunjuk"    │  Cocokkan URL → Controller
└─────────┬───────────┘
          │
          ▼
┌─────────────────────┐
│  2. MIDDLEWARE        │  RoleMiddleware.php
│  "Satpam/Penjaga"    │  Cek: sudah login? role benar?
└─────────┬───────────┘
          │
          ▼
┌─────────────────────┐
│  3. CONTROLLER        │  *Controller.php
│  "Otak/Manajer"      │  Proses logika, panggil Model
└─────────┬───────────┘
          │
          ▼
┌─────────────────────┐
│  4. MODEL             │  app/Models/*.php
│  "Penghubung DB"     │  Ambil/simpan data ke database
└─────────┬───────────┘
          │
          ▼
┌─────────────────────┐
│  5. VIEW (BLADE)      │  resources/views/*.blade.php
│  "Wajah Aplikasi"    │  Render HTML + CSS + JS
└─────────────────────┘
          │
          ▼
    Browser (User) ← Halaman web ditampilkan
```

### Contoh Nyata: User Membuka Halaman Kasir

1. **User** mengakses `http://localhost:8000/kasir`.
2. **Router** (`web.php`) mencocokkan URL `/kasir` → `TransactionController@index`, dengan middleware `auth` dan `role:kasir`.
3. **Middleware** (`RoleMiddleware`) mengecek: user sudah login? Role-nya `kasir` atau `admin`? Jika tidak, tolak (403).
4. **Controller** (`TransactionController::index()`) memanggil `Product::where('stock', '>', 0)->get()` untuk mengambil produk yang stoknya masih ada.
5. **Model** (`Product`) menjalankan query SQL ke database dan mengembalikan hasilnya.
6. **View** (`kasir/index.blade.php`) menerima data `$products`, lalu me-render tampilan POS interaktif dengan card produk, kalkulasi JS, dan tombol proses transaksi.

---

## 🛠️ Instalasi & Panduan Migrasi

### 1. Persiapan Kebutuhan Server

Pastikan sistem operasi Anda sudah terinstal:

- **PHP** (Minimal versi 8.2)
- **Composer**
- **Database MySQL / MariaDB / SQLite**
- **Node.js & NPM** (Opsional, untuk build ulang aset frontend)

### 2. Konfigurasi Lingkungan

1. Buka folder proyek di teks editor Anda.
2. Salin `.env.example` menjadi `.env`.
3. Atur konfigurasi database di `.env`:

```env
DB_CONNECTION=sqlite
# Atau jika menggunakan MySQL:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=stockku
# DB_USERNAME=root
# DB_PASSWORD=
```

4. Instal dependensi Composer:

```bash
composer install
```

5. Generate Application Key:

```bash
php artisan key:generate
```

### 3. Database Migration

Untuk membangun struktur tabel secara otomatis:

```bash
php artisan migrate
```

> **Catatan:** Jangan melewati tahapan ini. Database wajib di-migrasi untuk menyiapkan arsitektur Role di tabel `users`.

### 4. Menjalankan Server

```bash
php artisan serve
```

Aplikasi dapat diakses di: **`http://localhost:8000`**

---

## 🧑‍💻 Memulai Pertama Kali

1. Buka aplikasi di browser (`http://localhost:8000`).
2. Klik **Mulai Masuk** pada _Welcome Screen_.
3. Klik **Daftar Sekarang**.
4. Daftarkan akun pertama dengan role **Admin** untuk mendapat akses penuh.
5. Gunakan akun Admin atau persilahkan karyawan mendaftar dengan role masing-masing (`Kasir`, `Gudang`, atau `Owner`).
6. Tambahkan Produk dasar sebelum memulai Transaksi via Dashboard Admin → **Kelola Produk**.

Selamat menggunakan **Stockku**! Berbisnis menjadi lebih terstruktur, aman, dan mempesona. ✨
