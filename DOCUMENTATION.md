# Dokumentasi & Panduan Deploy: Mini E-Commerce Gallery (PHP Native MVC)

## 📌 Deskripsi Proyek
Proyek ini adalah sebuah aplikasi web **Mini E-Commerce Gallery** yang dibangun menggunakan murni **PHP Native** dengan arsitektur **Model-View-Controller (MVC)** tanpa menggunakan framework apapun (seperti Laravel atau CodeIgniter). Aplikasi ini dirancang untuk menjadi ringan, cepat, dan mudah dipahami.

### ✨ Fitur Utama
1. **Sistem Katalog Publik**:
   - Menampilkan daftar produk (gambar, caption, tanggal).
   - Fitur pencarian (*Search*) berdasarkan caption.
   - Paginasi (*Pagination*) yang terintegrasi penuh dengan sistem pencarian.
2. **Autentikasi & Keamanan**:
   - Sistem login admin berbasis `$_SESSION`.
   - Penyimpanan password yang dienkripsi dengan standar `password_hash()`.
   - Proteksi akses (*Middleware* sederhana) pada halaman admin.
3. **Manajemen Konten (Admin Panel CRUD)**:
   - **C**reate: Mengunggah gambar baru dan menyimpannya di server.
   - **R**ead: Melihat daftar seluruh produk dalam antarmuka tabel.
   - **U**pdate: Mengubah dan memperbarui caption/deskripsi produk.
   - **D**elete: Menghapus data dari database sekaligus menghapus file gambar fisik dari direktori server secara otomatis.

---

## 📂 Struktur Direktori Proyek
Arsitektur MVC yang digunakan membagi kode menjadi struktur yang rapi:

```text
website/
├── app/
│   ├── Controllers/
│   │   ├── AdminController.php   # Menangani logika CRUD Panel Admin
│   │   ├── AuthController.php    # Menangani alur Login/Logout
│   │   ├── HomeController.php    # Menangani halaman utama (Katalog)
│   │   └── ProductController.php # Menangani proses upload gambar
│   ├── Models/
│   │   ├── Product.php           # Interaksi Database untuk Produk
│   │   └── User.php              # Interaksi Database untuk Autentikasi
│   └── Views/
│       ├── admin/                # Tampilan Dasbor Admin
│       │   ├── edit.php
│       │   └── index.php
│       ├── auth/                 # Tampilan Login
│       │   └── login.php
│       ├── home/                 # Tampilan Utama (Daftar Produk Publik)
│       │   └── index.php
│       ├── product/              # Tampilan Upload Form
│       │   └── create.php
│       └── layout.php            # Template Utama (Header, Navbar, Footer, CSS)
├── config/
│   └── database.php              # Konfigurasi Koneksi PDO
├── public/
│   ├── uploads/                  # Direktori penyimpanan fisik gambar
│   └── index.php                 # SINGLE ENTRY POINT (Router Utama)
├── database.sql                  # Skema dan seeding database
└── docker-compose.yml & Dockerfile # File pendukung containerisasi
```

### 🧠 Analisis Alur Kerja (Router)
Seluruh request masuk diarahkan melalui `public/index.php`. Sistem *Routing* bekerja dengan membaca parameter `$_GET['controller']` dan `$_GET['action']`.
* Contoh: `index.php?controller=admin&action=delete&id=1`
* **Logika**: Router akan menginstansiasi class `AdminController` lalu menjalankan method `delete()` dengan menangkap nilai ID dari URI.

---

## 🚀 PANDUAN DEPLOY: Windows (XAMPP / WAMPServer)

Berikut adalah panduan *step-by-step* untuk menjalankan aplikasi ini di komputer Windows lokal Anda menggunakan XAMPP atau WAMPServer.

### Langkah 1: Persiapan Server Lokal
1. **Download & Install**: Unduh XAMPP (atau WAMP) dari situs resminya dan lakukan instalasi. Pastikan Anda menginstal minimal komponen **Apache** dan **MySQL/MariaDB**.
2. **Jalankan Server**: Buka XAMPP Control Panel. Klik tombol **Start** pada modul **Apache** dan **MySQL**.

### Langkah 2: Memindahkan File Proyek
1. Buka folder instalasi XAMPP Anda (secara *default* berada di `C:\xampp`).
2. Masuk ke dalam folder **`htdocs`** (`C:\xampp\htdocs`).
3. Buat folder baru di dalam `htdocs`, beri nama **`minigallery`** (atau bebas).
4. **Copy seluruh file proyek** ini ke dalam folder `C:\xampp\htdocs\minigallery\` tersebut.

### Langkah 3: Konfigurasi Database (phpMyAdmin)
1. Buka browser web Anda dan ketik URL: `http://localhost/phpmyadmin`
2. Pada panel sebelah kiri, klik tulisan **New** (Baru) untuk membuat database.
3. Beri nama database: **`website_db`** (atau sesuaikan dengan keinginan), lalu klik **Create**.
4. Klik database `website_db` yang baru saja terbuat.
5. Pilih tab **Import** (Impor) di menu navigasi atas.
6. Pada bagian *File to import*, klik tombol **Choose File** (Pilih File).
7. Cari dan pilih file **`database.sql`** yang terdapat di root folder proyek Anda (`C:\xampp\htdocs\minigallery\database.sql`).
8. Scroll ke bawah dan klik tombol **Go** (Kirim). Database, tabel `users`, tabel `products`, dan akun admin otomatis akan dibuat.

### Langkah 4: Menyesuaikan Koneksi Database di Kode
Karena pada XAMPP variabel *environment* Docker tidak tersedia, Anda perlu mengubah sedikit konfigurasi database agar sesuai dengan environment lokal Windows.

1. Buka file **`config/database.php`** menggunakan Code Editor (VSCode / Notepad++).
2. Ubah properti koneksi di dalam class `Database` menjadi seperti ini (baris *hardcode* default XAMPP):
   ```php
   class Database {
       private $host = "127.0.0.1";
       private $db_name = "website_db";
       private $username = "root";  // Default XAMPP adalah 'root'
       private $password = "";      // Default XAMPP adalah kosong (string kosong)
       public $conn;

       public function getConnection() {
           // ... biarkan sisa kodenya sama ...
   ```
3. Simpan file tersebut.

### Langkah 5: Mengakses Aplikasi
1. Buka browser Anda.
2. Akses URL proyek yang mengarah langsung ke router utama (index.php) di folder public:
   👉 **`http://localhost/minigallery/public/index.php`**
   *(Ganti `minigallery` jika Anda menggunakan nama folder yang berbeda).*

### Langkah 6: Login Admin
Anda dapat masuk ke dalam panel admin menggunakan kredensial yang sudah di-*seed* oleh `database.sql`:
* **Username**: `admin`
* **Password**: `admin123`

---

## 🛠️ Pemecahan Masalah Umum (Troubleshooting)

1. **Error: `Connection refused` atau `Access denied for user`**
   - Pastikan Anda sudah mengubah file `config/database.php` sesuai Langkah 4. Password XAMPP default biasanya kosong `""`.

2. **Error saat melakukan Upload Gambar**
   - Masalah ini terjadi jika direktori tidak memiliki izin tulis. Pada XAMPP Windows, biasanya hal ini jarang terjadi, namun pastikan folder `public/uploads/` tersedia.
   - Jika belum ada, buat folder `uploads` secara manual di dalam folder `public/`.

3. **Gambar Tidak Tampil / Link Rusak**
   - Jika Anda mengakses aplikasi bukan dari *DocumentRoot* (misal via sub-folder `htdocs/minigallery`), pastikan path yang digunakan *relative* atau disesuaikan. Kode aplikasi ini sudah disetel fleksibel dengan *relative routing*.

4. **Session Error / Logout tiba-tiba**
   - Pastikan tidak ada karakter spasi atau jeda baris (enter) sebelum tag `<?php` pada file `public/index.php` maupun controller. Hal ini dapat menggagalkan fungsi `session_start()`.
