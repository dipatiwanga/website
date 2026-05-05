<div class="form-card">
    <h2 style="margin-bottom: 2rem; text-align: center;">Admin Login</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); color: #f87171; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.9rem;">
            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>
    
    <form action="index.php?controller=auth&action=authenticate" method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required autocomplete="username">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required autocomplete="current-password" style="width: 100%; background: var(--bg); border: 1px solid var(--glass-border); padding: 0.8rem; border-radius: 8px; color: white; outline: none;">
        </div>

        <button type="submit" class="btn" style="width: 100%;">Login Sekarang</button>
        
        <div style="text-align: center; margin-top: 1.5rem;">
            <a href="index.php" style="color: var(--text-muted); text-decoration: none; font-size: 0.9rem;">Kembali ke Beranda</a>
        </div>
    </form>
</div>
