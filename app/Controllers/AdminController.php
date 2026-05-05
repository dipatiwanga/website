<?php
require_once __DIR__ . '/../Models/Product.php';

class AdminController {
    private $db;
    private $product;

    public function __construct() {
        if (!isset($_SESSION['admin_id'])) {
            header("Location: index.php?controller=auth&action=login");
            exit();
        }
        $database = new Database();
        $this->db = $database->getConnection();
        $this->product = new Product($this->db);
    }

    public function index() {
        // Mendapatkan semua produk tanpa paginasi untuk kemudahan manajemen
        $products = $this->product->getAll(null, 0, 100); 
        $view = __DIR__ . '/../Views/admin/index.php';
        require_once __DIR__ . '/../Views/layout.php';
    }

    public function edit() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $productData = $this->product->getById($id);

        if (!$productData) {
            header("Location: index.php?controller=admin&action=index");
            exit();
        }

        $view = __DIR__ . '/../Views/admin/edit.php';
        require_once __DIR__ . '/../Views/layout.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = (int)$_POST['id'];
            $caption = $_POST['caption'];

            if ($this->product->update($id, $caption)) {
                header("Location: index.php?controller=admin&action=index");
                exit();
            } else {
                echo "Gagal memperbarui data.";
            }
        }
    }

    public function delete() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $productData = $this->product->getById($id);

        if ($productData) {
            // Hapus file fisik - gunakan path absolut dari root project
            $filePath = $_SERVER['DOCUMENT_ROOT'] . '/' . $productData['image_path'];
            
            // Logika tambahan jika DOCUMENT_ROOT tidak mencakup folder public
            if (!file_exists($filePath)) {
                $filePath = __DIR__ . "/../../public/" . $productData['image_path'];
            }

            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Hapus dari database
            if ($this->product->delete($id)) {
                $_SESSION['success'] = "Produk berhasil dihapus.";
            } else {
                $_SESSION['error'] = "Gagal menghapus data dari database.";
            }
        } else {
            $_SESSION['error'] = "Data produk tidak ditemukan.";
        }

        header("Location: index.php?controller=admin&action=index");
        exit();
    }
}
