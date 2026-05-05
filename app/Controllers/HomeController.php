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
        $products = $this->product->getAll($keyword);
        
        $view = __DIR__ . '/../Views/home/index.php';
        require_once __DIR__ . '/../Views/layout.php';
    }
}
