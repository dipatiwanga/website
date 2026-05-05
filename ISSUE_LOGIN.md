# TASK: Implement Admin Login Feature (PHP Native MVC)

## Deskripsi Fitur
Menambahkan sistem autentikasi admin agar halaman upload produk hanya bisa diakses oleh pengguna yang sudah login. Ini bertujuan untuk mengamankan katalog e-commerce dari pengunggahan produk yang tidak sah.

## Fitur Utama
1. **Login Admin**: Halaman antarmuka untuk masuk ke sistem.
2. **Logout**: Fitur untuk menghancurkan sesi admin.
3. **Restriksi Akses (Middleware)**: Mencegah akses ke halaman `product/create` dan aksi `product/store` bagi user yang belum terautentikasi.

---

## Spesifikasi Teknis

### 1. Database (Table: `users`)
Tambahkan tabel berikut ke database Anda:
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);
```

### 2. Constraints & Aturan
- **Keamanan**: Wajib menggunakan `password_hash()` untuk penyimpanan dan `password_verify()` untuk pengecekan.
- **Session Management**: Gunakan native PHP `$_SESSION`. Pastikan `session_start()` dipanggil di entry point.
- **Dilarang menggunakan Framework**.
- **Paradigma MVC**: Tetap konsisten dengan struktur folder `app/Models`, `app/Controllers`, dan `app/Views`.

---

## Komponen yang Harus Dibuat

### 1. Model (`app/Models/User.php`)
- Method `findByUsername($username)`: Mengambil satu record user berdasarkan username untuk keperluan autentikasi.

### 2. Controller (`app/Controllers/AuthController.php`)
- Method `login()`: Merender tampilan form login.
- Method `authenticate()`: Mengambil data POST, memverifikasi kredensial via Model, dan memulai sesi jika valid.
- Method `logout()`: Menghapus sesi dan redirect ke halaman utama.

### 3. Middleware (Proteksi Akses)
- Tambahkan logika pengecekan session pada `ProductController`. Jika admin belum login, arahkan (*redirect*) secara paksa ke halaman login saat mencoba mengakses fitur upload.

### 4. Views (`app/Views/auth/login.php`)
- Form login yang bersih (gunakan estetika yang konsisten dengan desain sebelumnya).

---

## Tugas Pengembang (Checklist)
- [ ] Buat tabel `users` di database.
- [ ] Buat contoh query `INSERT` untuk admin pertama (seeding).
- [ ] Implementasi logic `User` Model.
- [ ] Implementasi `AuthController`.
- [ ] Update `public/index.php` untuk routing login/logout/authenticate.
- [ ] Update `ProductController` untuk proteksi halaman upload.
- [ ] Buat UI login form di `app/Views/auth/login.php`.

---
**Catatan**: Berikan penjelasan singkat mengenai alur autentikasi (dari input user hingga session tersimpan) dalam file README atau dokumentasi teknis setelah selesai.
