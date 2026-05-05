# TASK: Fix Search and Pagination Integration (PHP Native MVC)

## Deskripsi Masalah
Saat ini, fitur pencarian dan paginasi perlu diintegrasikan agar bekerja secara harmonis. Pengguna harus dapat mencari produk dan menavigasi hasil pencarian melalui beberapa halaman tanpa kehilangan kata kunci (*keyword*) pencarian mereka.

## Fitur & Persyaratan
1. **Search by Caption**: Pencarian tetap berfungsi secara akurat berdasarkan keyword yang dimasukkan oleh pengguna.
2. **Integrated Pagination**: Hasil pencarian harus ditampilkan dalam beberapa halaman (misal: 6 atau 8 produk per halaman).
3. **Persistent Keyword**: Saat berpindah halaman (navigasi Next/Prev/Page Number), kata kunci pencarian harus tetap dipertahankan di URL (query string) agar hasil tetap relevan dengan pencarian awal.

---

## Spesifikasi Teknis

### 1. Model (`app/Models/Product.php`)
- **Update** `getAll($keyword = null, $offset = 0, $limit = 6)`: Modifikasi query SQL untuk menyertakan klausa `LIMIT` dan `OFFSET`.
- **Tambah** `countAll($keyword = null)`: Method baru untuk menghitung total jumlah baris data (dengan filter keyword) guna menentukan total jumlah halaman yang dibutuhkan.

### 2. Controller (`app/Controllers/HomeController.php`)
- Ambil `page` dari `$_GET['page']` (default ke 1).
- Definisikan jumlah data per halaman (*limit*).
- Hitung *offset* berdasarkan halaman saat ini.
- Ambil total data via `countAll($keyword)` untuk menghitung total halaman.
- Ambil data produk via `getAll($keyword, $offset, $limit)`.
- Kirim variabel pagination (`totalPages`, `currentPage`, `searchKeyword`) ke View.

### 3. Views (`app/Views/home/index.php`)
- Implementasikan komponen navigasi paginasi di bagian bawah grid produk.
- **Penting**: Pastikan link paginasi menyertakan parameter `search`, contoh: `index.php?page=2&search=baju`.

---

## Tugas Pengembang (Checklist)
- [ ] Modifikasi method `getAll` pada Model `Product`.
- [ ] Implementasi method `countAll` pada Model `Product`.
- [ ] Perbarui logika `index()` pada `HomeController` untuk kalkulasi paginasi.
- [ ] Buat UI navigasi paginasi yang responsif dan cantik di View `home/index.php`.
- [ ] Lakukan pengujian: Pastikan keyword pencarian tetap ada saat berpindah ke halaman 2 dan seterusnya.
