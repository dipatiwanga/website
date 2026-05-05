<div class="form-card">
    <h2 style="margin-bottom: 2rem; text-align: center;">Edit Produk</h2>
    
    <div style="text-align: center; margin-bottom: 2rem;">
        <img src="<?= htmlspecialchars($productData['image_path']) ?>" style="width: 150px; height: 150px; object-fit: cover; border-radius: 12px; border: 1px solid var(--glass-border);">
    </div>

    <form action="index.php?controller=admin&action=update" method="POST">
        <input type="hidden" name="id" value="<?= $productData['id'] ?>">
        
        <div class="form-group">
            <label for="caption">Deskripsi / Caption</label>
            <textarea name="caption" id="caption" required><?= htmlspecialchars($productData['caption']) ?></textarea>
        </div>

        <button type="submit" class="btn" style="width: 100%;">Simpan Perubahan</button>
        
        <div style="text-align: center; margin-top: 1.5rem;">
            <a href="index.php?controller=admin&action=index" style="color: var(--text-muted); text-decoration: none; font-size: 0.9rem;">Batal & Kembali</a>
        </div>
    </form>
</div>
