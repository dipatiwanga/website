<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini E-Commerce Gallery</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-hover: #4f46e5;
            --bg: #0f172a;
            --card-bg: #1e293b;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --glass: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--bg);
            color: var(--text-main);
            min-height: 100vh;
        }

        nav {
            background: var(--glass);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--glass-border);
            padding: 1rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 600;
            background: linear-gradient(to right, #818cf8, #c084fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-links a {
            color: var(--text-main);
            text-decoration: none;
            font-size: 0.95rem;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .search-form {
            display: flex;
            gap: 0.5rem;
        }

        .search-form input {
            background: var(--glass);
            border: 1px solid var(--glass-border);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            color: white;
            outline: none;
        }

        .btn {
            background: var(--primary);
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        footer {
            text-align: center;
            padding: 3rem;
            color: var(--text-muted);
            border-top: 1px solid var(--glass-border);
            margin-top: 4rem;
        }

        /* Form Styles */
        .form-card {
            background: var(--card-bg);
            padding: 2rem;
            border-radius: 16px;
            border: 1px solid var(--glass-border);
            max-width: 500px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-muted);
        }

        .form-group input[type="text"],
        .form-group textarea,
        .form-group input[type="file"] {
            width: 100%;
            background: var(--bg);
            border: 1px solid var(--glass-border);
            padding: 0.8rem;
            border-radius: 8px;
            color: white;
            outline: none;
        }

        .form-group textarea {
            height: 120px;
            resize: vertical;
        }
    </style>
</head>
<body>
    <nav>
        <a href="index.php" class="logo">MiniGallery</a>
        <div class="nav-links">
            <form action="index.php" method="GET" class="search-form">
                <input type="text" name="search" placeholder="Cari produk..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                <button type="submit" class="btn">Cari</button>
            </form>
            <?php if (isset($_SESSION['admin_id'])): ?>
                <span style="color: var(--text-muted); font-size: 0.9rem;">Hello, <strong><?= htmlspecialchars($_SESSION['admin_username']) ?></strong></span>
                <a href="index.php?controller=product&action=create" class="btn">Upload Produk</a>
                <a href="index.php?controller=auth&action=logout" style="color: #f87171;">Logout</a>
            <?php else: ?>
                <a href="index.php?controller=auth&action=login" class="btn">Admin Login</a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="container">
        <?php include $view; ?>
    </div>

    <footer>
        <p>&copy; 2024 MiniGallery E-Commerce. Built with Native PHP.</p>
    </footer>
</body>
</html>
