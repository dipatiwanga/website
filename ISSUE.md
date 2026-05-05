# TASK: Mini E-Commerce Image Upload (PHP Native MVC)

## Deskripsi Sistem
Website upload gambar sederhana yang bertindak seperti katalog mini e-commerce. Sistem ini memungkinkan pengguna untuk:
1. Mengunggah gambar (sebagai representasi produk).
2. Menambahkan caption (sebagai deskripsi produk).
3. Mencari produk berdasarkan keyword deskripsi.

## Constraint & Aturan Main
- **Dilarang menggunakan Framework** (Murni PHP Native).
- Gunakan paradigma **OOP Sederhana**.
- Struktur direktori harus menggunakan pola MVC: `app`, `public`, `config`.
- Semua request HTTP harus ditangani melalui **Single Entry Point** di `public/index.php`.
- **Routing sederhana manual** menggunakan GET parameter `controller` dan `action` (misal: `index.php?controller=product&action=create`).

---

## 1. Struktur Folder

Silakan setup direktori proyek dengan struktur file dan folder berikut:

```text
/
├── app/
│   ├── Controllers/
│   │   ├── HomeController.php
│   │   └── ProductController.php
│   ├── Models/
│   │   └── Product.php
│   └── Views/
│       ├── layout.php
│       ├── home/
│       │   └── index.php
│       └── product/
│           └── create.php
├── config/
│   └── database.php
├── public/
│   ├── uploads/
│   └── index.php
└── ISSUE.md
```

---

## 2. Entry Point & Router (public/index.php)

Berikut adalah fondasi file utama `public/index.php` yang mengatur routing manual menggunakan parameter GET. **Gunakan kode ini sebagai referensi utama untuk routing:**

```php
<?php
// File: public/index.php

// 1. Include file yang dibutuhkan
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/Controllers/HomeController.php';
require_once __DIR__ . '/../app/Controllers/ProductController.php';

// 2. Ambil parameter routing dari URL
// Default routing mengarah ke HomeController dan method index
$controllerName = isset($_GET['controller']) ? $_GET['controller'] : 'home';
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';

// 3. Routing Manual ke Controller yang tepat
$controller = null;

switch ($controllerName) {
    case 'product':
        $controller = new ProductController();
        break;
    case 'home':
    default:
        $controller = new HomeController();
        break;
}

// 4. Jalankan Action/Method pada Controller
if (method_exists($controller, $actionName)) {
    // Memanggil method dinamis, misal $controller->index()
    $controller->{$actionName}();
} else {
    // Penanganan error sederhana jika action tidak ditemukan
    http_response_code(404);
    echo "<h1>404 Not Found</h1>";
    echo "<p>Halaman atau aksi yang Anda cari tidak ditemukan.</p>";
}
```

---

## 3. Instruksi Pengerjaan (To-Do List)

Bagi Developer / AI Assistant yang ditugaskan untuk mengerjakan Issue ini, selesaikan langkah-langkah berikut secara berurutan:

### Tahap 1: Setup Database & Konfigurasi
- [ ] Buat tabel `products` di database MySQL dengan spesifikasi:
  - `id` (INT, Primary Key, Auto Increment)
  - `image_path` (VARCHAR 255) - Untuk menyimpan path relatif file yang diunggah.
  - `caption` (TEXT) - Deskripsi produk.
  - `created_at` (TIMESTAMP, default CURRENT_TIMESTAMP)
- [ ] Lengkapi file `config/database.php` menggunakan instance `PDO` untuk koneksi database yang aman.

### Tahap 2: Pembuatan Model (`app/Models/Product.php`)
- [ ] Buat kelas class `Product` dengan dependency injection atau instansiasi PDO.
- [ ] Buat method `getAll($keyword = null)`. Jika `$keyword` ada isinya, gunakan klausa `WHERE caption LIKE '%keyword%'`.
- [ ] Buat method `create($imagePath, $caption)` untuk melakukan `INSERT` data produk baru ke tabel. Gunakan prepared statements.

### Tahap 3: Pembuatan Controllers (`app/Controllers/`)
- [ ] **HomeController**:
  - Buat method `index()`.
  - Tangkap parameter dari URL `$_GET['search']` jika ada.
  - Panggil model `Product` untuk mendapatkan data array.
  - `require` file view di `app/Views/home/index.php` untuk merender data.
- [ ] **ProductController**:
  - Buat method `create()` untuk me-render view form upload (`app/Views/product/create.php`).
  - Buat method `store()` untuk menangani *form submission* (`$_POST` dan `$_FILES`).
  - Validasi file gambar (ekstensi dan ukuran).
  - Pindahkan gambar ke direktori `public/uploads/`.
  - Panggil method `create()` pada model `Product` untuk menyimpan data ke database.
  - Lakukan header redirect `header('Location: index.php');` jika sukses.

### Tahap 4: Pembuatan Views (`app/Views/`)
- [ ] **layout.php**: Buat template HTML shell standar. Sertakan komponen navbar/header berisi link "Home", link "Upload", dan form `<form action="index.php" method="GET">` dengan input name="search" (ini otomatis mengarah ke Home dengan query pencarian).
- [ ] **home/index.php**: Looping data array dari controller dan tampilkan daftar produk menggunakan struktur *card* CSS dasar (Gambar di atas, caption di bawah).
- [ ] **product/create.php**: Buat `<form method="POST" action="index.php?controller=product&action=store" enctype="multipart/form-data">`. Sediakan elemen `<input type="file" name="image">` dan `<textarea name="caption">`.

### Catatan Keselamatan & Best Practices
- Pastikan folder `public/uploads/` dibuat secara manual dan dapat ditulis (*writable*).
- Jangan lupa validasi XSS sederhana menggunakan `htmlspecialchars()` saat me-render output `$caption` di halaman utama.
- Validasi strict untuk file upload pastikan hanya ekstensi *jpg, jpeg, png, gif* yang dapat diunggah.
