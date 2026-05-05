<?php
require_once __DIR__ . '/../Models/User.php';

class AuthController {
    private $db;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function login() {
        if (isset($_SESSION['admin_id'])) {
            header("Location: index.php");
            exit();
        }
        $view = __DIR__ . '/../Views/auth/login.php';
        require_once __DIR__ . '/../Views/layout.php';
    }

    public function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $userData = $this->user->findByUsername($username);

            if ($userData && password_verify($password, $userData['password'])) {
                $_SESSION['admin_id'] = $userData['id'];
                $_SESSION['admin_username'] = $userData['username'];
                header("Location: index.php");
                exit();
            } else {
                $_SESSION['error'] = "Username atau password salah!";
                header("Location: index.php?controller=auth&action=login");
                exit();
            }
        }
    }

    public function logout() {
        session_destroy();
        header("Location: index.php");
        exit();
    }
}
