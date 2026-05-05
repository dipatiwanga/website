<div class="form-card">
    <h2 style="margin-bottom: 2rem; text-align: center;">Upload Produk Baru</h2>
    
    <form action="index.php?controller=product&action=store" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="image">Gambar Produk</label>
            <input type="file" name="image" id="image" required accept="image/*">
        </div>

        <div class="form-group">
            <label for="caption">Deskripsi / Caption</label>
            <textarea name="caption" id="caption" placeholder="Tulis deskripsi produk di sini..." required></textarea>
        </div>

        <button type="submit" class="btn" style="width: 100%;">Upload Sekarang</button>
        
        <div style="text-align: center; margin-top: 1.5rem;">
            <a href="index.php" style="color: var(--text-muted); text-decoration: none; font-size: 0.9rem;">Batal & Kembali</a>
        </div>
    </form>
</div>
