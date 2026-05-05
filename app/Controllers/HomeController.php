<?php
require_once __DIR__ . '/../Models/Product.php';

class HomeController {
    private $db;
    private $product;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->product = new Product($this->db);
    }

    public function index() {
        $keyword = isset($_GET['search']) ? $_GET['search'] : null;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 6;
        $offset = ($page - 1) * $limit;

        $totalRows = $this->product->countAll($keyword);
        $totalPages = ceil($totalRows / $limit);

        $products = $this->product->getAll($keyword, $offset, $limit);
        
        $view = __DIR__ . '/../Views/home/index.php';
        require_once __DIR__ . '/../Views/layout.php';
    }
}
