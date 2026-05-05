<style>
    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
    }

    .product-card {
        background: var(--card-bg);
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid var(--glass-border);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    }

    .product-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .product-info {
        padding: 1.5rem;
    }

    .product-caption {
        font-size: 0.95rem;
        line-height: 1.5;
        color: var(--text-main);
        margin-bottom: 1rem;
    }

    .product-date {
        font-size: 0.8rem;
        color: var(--text-muted);
    }

    .empty-state {
        text-align: center;
        padding: 5rem;
        color: var(--text-muted);
    }
</style>

<h1 style="margin-bottom: 2rem;">Katalog Produk</h1>

<?php if (empty($products)): ?>
    <div class="empty-state">
        <h2>Belum ada produk.</h2>
        <p>Silakan upload produk pertama Anda.</p>
    </div>
<?php else: ?>
    <div class="grid">
        <?php foreach ($products as $p): ?>
            <div class="product-card">
                <img src="<?= htmlspecialchars($p['image_path']) ?>" alt="Product Image" class="product-img">
                <div class="product-info">
                    <p class="product-caption"><?= nl2br(htmlspecialchars($p['caption'])) ?></p>
                    <p class="product-date"><?= date('d M Y, H:i', strtotime($p['created_at'])) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
