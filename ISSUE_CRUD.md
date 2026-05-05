# TASK: Implement Admin Panel for Product CRUD Management (PHP Native MVC)

## Deskripsi Fitur
Menambahkan halaman khusus Admin Panel untuk mengelola data produk yang sudah diunggah. Admin dapat melihat daftar lengkap, mengubah deskripsi, dan menghapus produk (beserta file fisiknya).

## Fitur & Persyaratan
1. **Admin List**: Menampilkan tabel seluruh produk.
2. **Edit Product**: Form untuk memperbarui caption produk.
3. **Delete Product**: Menghapus data dari database dan menghapus file gambar dari folder `public/uploads/`.
4. **Access Control**: Seluruh fitur ini hanya dapat diakses oleh admin yang sudah login.

---

## Spesifikasi Teknis

### 1. Model (`app/Models/Product.php`)
- **Tambah** `getById($id)`: Mengambil satu data produk spesifik berdasarkan ID.
- **Tambah** `update($id, $caption)`: Melakukan query `UPDATE` untuk mengubah data caption.
- **Tambah** `delete($id)`: Melakukan query `DELETE` untuk menghapus baris data.

### 2. Controller (`app/Controllers/AdminController.php`)
- **index()**: Menampilkan dashboard manajemen produk (List View).
- **edit()**: Mengambil data via model dan menampilkan form edit.
- **update()**: Memvalidasi input dan memproses pembaruan data.
- **delete()**: 
    1. Ambil path file dari database.
    2. Hapus file fisik via `unlink()`.
    3. Hapus record di database.
- **Proteksi**: Wajib melakukan pengecekan session di constructor atau setiap method.

### 3. Routing (`public/index.php`)
Daftarkan `AdminController` pada router untuk mendukung aksi: `index`, `edit`, `update`, dan `delete`.

### 4. Views (`app/Views/admin/`)
- `index.php`: Tabel responsif dengan aksi Edit dan Delete.
- `edit.php`: Form pembaruan caption.

---

## Tugas Pengembang (Checklist)
- [ ] Implementasi method `getById`, `update`, dan `delete` pada `Product` Model.
- [ ] Buat `AdminController` beserta logika CRUD lengkap.
- [ ] Update `public/index.php` untuk routing admin.
- [ ] Buat folder `app/Views/admin/` dan file di dalamnya.
- [ ] Update navbar untuk menambahkan link ke "Admin Panel" jika sudah login.
- [ ] Lakukan pengujian: Pastikan file di `uploads/` benar-benar terhapus saat data di-delete.
