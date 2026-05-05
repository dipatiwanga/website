<style>
    .admin-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
        background: var(--card-bg);
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid var(--glass-border);
    }

    .admin-table th, .admin-table td {
        padding: 1.2rem;
        text-align: left;
        border-bottom: 1px solid var(--glass-border);
    }

    .admin-table th {
        background: var(--glass);
        color: var(--text-muted);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.05em;
    }

    .admin-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
    }

    .action-links {
        display: flex;
        gap: 1rem;
    }

    .action-links a {
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .edit-link { color: #818cf8; }
    .delete-link { color: #f87171; }
</style>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h1>Manajemen Produk</h1>
    <a href="index.php?controller=product&action=create" class="btn">Tambah Baru</a>
</div>

<?php if (isset($_SESSION['success'])): ?>
    <div style="background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.2); color: #4ade80; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.9rem;">
        <?= $_SESSION['success']; unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); color: #f87171; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.9rem;">
        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<table class="admin-table">
    <thead>
        <tr>
            <th>Gambar</th>
            <th>Caption</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $p): ?>
            <tr>
                <td><img src="<?= htmlspecialchars($p['image_path']) ?>" class="admin-img"></td>
                <td><?= htmlspecialchars(substr($p['caption'], 0, 100)) ?><?= strlen($p['caption']) > 100 ? '...' : '' ?></td>
                <td><span style="color: var(--text-muted); font-size: 0.85rem;"><?= date('d/m/Y', strtotime($p['created_at'])) ?></span></td>
                <td>
                    <div class="action-links">
                        <a href="index.php?controller=admin&action=edit&id=<?= $p['id'] ?>" class="edit-link">Edit</a>
                        <a href="index.php?controller=admin&action=delete&id=<?= $p['id'] ?>" class="delete-link" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($products)): ?>
            <tr>
                <td colspan="4" style="text-align: center; padding: 4rem; color: var(--text-muted);">Belum ada data produk.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
