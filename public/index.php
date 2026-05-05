<?php
// File: public/index.php
session_start();

// 1. Include file yang dibutuhkan
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/Controllers/HomeController.php';
require_once __DIR__ . '/../app/Controllers/ProductController.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Controllers/AdminController.php';

// 2. Ambil parameter routing dari URL
$controllerName = isset($_GET['controller']) ? $_GET['controller'] : 'home';
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';

// 3. Routing Manual
$controller = null;

switch ($controllerName) {
    case 'admin':
        $controller = new AdminController();
        break;
    case 'auth':
        $controller = new AuthController();
        break;
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
    $controller->{$actionName}();
} else {
    http_response_code(404);
    echo "<h1>404 Not Found</h1>";
    echo "<p>Halaman atau aksi yang Anda cari tidak ditemukan.</p>";
}
